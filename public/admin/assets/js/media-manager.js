/**
 * Sahaj Admin — centralized media library & picker.
 */
(function () {
    const config = window.SahajMediaConfig || {};
    const csrfToken = config.csrfToken || document.querySelector('meta[name="csrf-token"]')?.content || '';

    const iconMap = {
        pdf: 'ti-file-type-pdf',
        document: 'ti-file-text',
        video: 'ti-video',
        other: 'ti-file-zip',
        image: 'ti-photo',
    };

    function urlFromTemplate(template, id) {
        return template.replace('__MEDIA__', id);
    }

    function toast(message, icon = 'success') {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: message,
                showConfirmButton: false,
                timer: 2200,
                timerProgressBar: true,
            });
            return;
        }

        alert(message);
    }

    function copyText(text) {
        if (navigator.clipboard?.writeText) {
            return navigator.clipboard.writeText(text);
        }

        const input = document.createElement('textarea');
        input.value = text;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        return Promise.resolve();
    }

    function debounce(fn, delay) {
        let timer;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(this, args), delay);
        };
    }

    function fileIcon(item) {
        return iconMap[item.file_category] || iconMap.other;
    }

    function renderThumb(item) {
        if (item.is_image) {
            return `<img src="${item.url}" alt="${item.display_name}">`;
        }

        if (item.file_category === 'video') {
            return `
                <video class="media-thumb-video" src="${item.url}" preload="metadata" muted playsinline></video>
                <span class="media-thumb-video-badge" aria-hidden="true"><i class="ti ti-player-play"></i></span>
            `;
        }

        return `<i class="ti ${fileIcon(item)}"></i>`;
    }

    function initMediaVideoThumbnails(root) {
        (root || document).querySelectorAll('.media-thumb-video').forEach((video) => {
            if (video.dataset.posterReady === '1') {
                return;
            }

            video.dataset.posterReady = '1';

            const showFrame = () => {
                if (!video.duration || Number.isNaN(video.duration)) {
                    return;
                }

                video.currentTime = Math.min(0.5, Math.max(0.1, video.duration * 0.05));
            };

            video.addEventListener('loadedmetadata', showFrame, { once: true });
            video.addEventListener('seeked', () => video.pause(), { once: true });
        });
    }

    function renderActions(item, mode) {
        const downloadUrl = urlFromTemplate(config.downloadUrlTemplate, item.id);

        if (mode === 'picker') {
            return `
                <button type="button" class="btn btn-sm btn-primary js-media-select-item" data-media='${JSON.stringify(item).replace(/'/g, '&#39;')}'>Select</button>
                <button type="button" class="btn btn-sm btn-light js-media-preview" data-media='${JSON.stringify(item).replace(/'/g, '&#39;')}'>Preview</button>
            `;
        }

        return `
            <div class="dropdown">
                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><button type="button" class="dropdown-item js-media-preview" data-media='${JSON.stringify(item).replace(/'/g, '&#39;')}'>Preview</button></li>
                    <li><button type="button" class="dropdown-item js-media-copy-url" data-url="${item.url}">Copy URL</button></li>
                    <li><a class="dropdown-item" href="${downloadUrl}">Download</a></li>
                    <li><button type="button" class="dropdown-item js-media-rename" data-media='${JSON.stringify(item).replace(/'/g, '&#39;')}'>Rename Display Name</button></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><button type="button" class="dropdown-item text-danger js-media-delete" data-media-id="${item.id}" data-media-name="${item.display_name}">Delete</button></li>
                </ul>
            </div>
        `;
    }

    function renderCard(item, mode, view, selectedId) {
        const selectedClass = selectedId === item.id ? ' is-selected' : '';
        const itemJson = JSON.stringify(item).replace(/'/g, '&#39;');
        const pickerSelect = mode === 'picker'
            ? `<button type="button" class="media-card-select js-media-pick-card${selectedClass}" data-media='${itemJson}' aria-label="Select ${item.display_name}"></button>`
            : '';

        if (view === 'list') {
            return `
                <div class="media-list-item${selectedClass}" data-media-id="${item.id}" title="${item.original_name} · ${item.category_label} · ${item.formatted_size}">
                    ${pickerSelect}
                    <div class="media-list-thumb">${renderThumb(item)}</div>
                    <div class="media-list-body">
                        <strong class="text-truncate d-block">${item.display_name}</strong>
                        <span class="text-muted font-12">${item.formatted_size}</span>
                    </div>
                    <div class="media-list-actions">${renderActions(item, mode)}</div>
                </div>
            `;
        }

        return `
            <div class="media-card${selectedClass}" data-media-id="${item.id}">
                ${pickerSelect}
                <div class="media-card-inner">
                    <div class="media-card-thumb">${renderThumb(item)}</div>
                    <div class="media-card-caption" title="${item.display_name}">${item.display_name}</div>
                    <div class="media-card-hover">
                        <div class="media-card-hover-meta">
                            <strong class="d-block text-truncate mb-1">${item.display_name}</strong>
                            <span class="d-block text-truncate">${item.original_name}</span>
                            <span class="d-block">${item.category_label} · ${item.formatted_size}</span>
                            <span class="d-block">${item.created_at}</span>
                        </div>
                        <div class="media-card-hover-actions">${renderActions(item, mode)}</div>
                    </div>
                </div>
            </div>
        `;
    }

    function buildPageNumbers(current, last) {
        if (last <= 1) {
            return [];
        }

        if (last <= 7) {
            return Array.from({ length: last }, (_, index) => index + 1);
        }

        const pages = new Set([1, last, current, current - 1, current + 1, current - 2, current + 2]);
        const sorted = [...pages].filter((page) => page >= 1 && page <= last).sort((a, b) => a - b);
        const result = [];
        let previous = 0;

        sorted.forEach((page) => {
            if (previous && page - previous > 1) {
                result.push('…');
            }
            result.push(page);
            previous = page;
        });

        return result;
    }

    function renderPaginationSummary(meta, container) {
        if (!container) {
            return;
        }

        if (!meta || !meta.total) {
            container.textContent = '';
            return;
        }

        container.textContent = `Showing ${meta.from}–${meta.to} of ${meta.total} file${meta.total === 1 ? '' : 's'}`;
    }

    function renderPagination(meta, container, summaryContainer, onPage, scrollTarget) {
        renderPaginationSummary(meta, summaryContainer);

        if (!container || !meta || meta.last_page <= 1) {
            if (container) {
                container.innerHTML = '';
            }
            return;
        }

        const pages = buildPageNumbers(meta.current_page, meta.last_page);
        let html = '<nav aria-label="Media pagination"><ul class="pagination pagination-sm mb-0 justify-content-center flex-wrap">';

        html += `<li class="page-item ${meta.current_page === 1 ? 'disabled' : ''}">
            <button type="button" class="page-link" data-page="${meta.current_page - 1}" ${meta.current_page === 1 ? 'disabled' : ''} aria-label="Previous page">&lsaquo;</button>
        </li>`;

        pages.forEach((page) => {
            if (page === '…') {
                html += '<li class="page-item disabled"><span class="page-link">…</span></li>';
                return;
            }

            html += `<li class="page-item ${page === meta.current_page ? 'active' : ''}">
                <button type="button" class="page-link" data-page="${page}">${page}</button>
            </li>`;
        });

        html += `<li class="page-item ${meta.current_page === meta.last_page ? 'disabled' : ''}">
            <button type="button" class="page-link" data-page="${meta.current_page + 1}" ${meta.current_page === meta.last_page ? 'disabled' : ''} aria-label="Next page">&rsaquo;</button>
        </li>`;

        html += '</ul></nav>';
        container.innerHTML = html;

        container.querySelectorAll('[data-page]').forEach((button) => {
            button.addEventListener('click', () => {
                const page = Number(button.dataset.page);
                if (!page || page < 1 || page > meta.last_page || page === meta.current_page) {
                    return;
                }

                onPage(page);

                if (scrollTarget) {
                    scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }

    class MediaBrowser {
        constructor(options) {
            this.options = options;
            this.state = {
                search: '',
                category: 'all',
                sort: 'latest',
                page: 1,
                perPage: options.perPage || 12,
                view: 'grid',
                pickerType: options.pickerType || 'all',
                selected: null,
            };
        }

        async load() {
            const params = new URLSearchParams({
                search: this.state.search,
                category: this.state.category,
                sort: this.state.sort,
                page: String(this.state.page),
                per_page: String(this.state.perPage),
                picker_type: this.state.pickerType,
            });

            const response = await fetch(`${config.browseUrl}?${params.toString()}`, {
                headers: { Accept: 'application/json' },
            });

            if (!response.ok) {
                throw new Error('Unable to load media library.');
            }

            return response.json();
        }

        render(data) {
            const { container, emptyState, pagination, paginationSummary, mode } = this.options;
            const items = data.data || [];

            if (!items.length) {
                container.innerHTML = '';
                emptyState?.classList.remove('d-none');
                renderPaginationSummary({ total: 0 }, paginationSummary);
            } else {
                emptyState?.classList.add('d-none');
                container.classList.toggle('media-view-grid', this.state.view === 'grid');
                container.classList.toggle('media-view-list', this.state.view === 'list');
                container.innerHTML = items
                    .map((item) => renderCard(item, mode, this.state.view, this.state.selected?.id))
                    .join('');
                initMediaVideoThumbnails(container);
            }

            renderPagination(data.meta, pagination, paginationSummary, (page) => {
                this.state.page = page;
                this.refresh();
            }, container);

            this.bindItemEvents(container);
        }

        bindItemEvents(container) {
            container.querySelectorAll('.js-media-preview').forEach((button) => {
                button.addEventListener('click', () => {
                    const item = JSON.parse(button.dataset.media);
                    MediaUI.preview(item);
                });
            });

            container.querySelectorAll('.js-media-copy-url').forEach((button) => {
                button.addEventListener('click', () => {
                    copyText(button.dataset.url).then(() => toast('URL copied to clipboard.'));
                });
            });

            container.querySelectorAll('.js-media-rename').forEach((button) => {
                button.addEventListener('click', () => {
                    MediaUI.openRename(JSON.parse(button.dataset.media), () => this.refresh());
                });
            });

            container.querySelectorAll('.js-media-delete').forEach((button) => {
                button.addEventListener('click', () => {
                    MediaUI.confirmDelete(button.dataset.mediaId, button.dataset.mediaName, () => this.refresh());
                });
            });

            container.querySelectorAll('.js-media-pick-card, .js-media-select-item').forEach((button) => {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    event.stopPropagation();
                    const item = JSON.parse(button.dataset.media);
                    this.selectItem(item);
                });
            });
        }

        selectItem(item) {
            this.state.selected = item;
            this.options.onSelect?.(item);
            this.refresh();
        }

        async refresh() {
            const data = await this.load();
            this.render(data);
        }

        initControls() {
            const { searchInput, categoryFilter, sortFilter, viewButtons } = this.options;

            if (searchInput) {
                searchInput.addEventListener('input', debounce((event) => {
                    this.state.search = event.target.value.trim();
                    this.state.page = 1;
                    this.refresh();
                }, 300));
            }

            if (categoryFilter) {
                categoryFilter.addEventListener('change', (event) => {
                    this.state.category = event.target.value;
                    this.state.page = 1;
                    this.refresh();
                });
            }

            if (sortFilter) {
                sortFilter.addEventListener('change', (event) => {
                    this.state.sort = event.target.value;
                    this.state.page = 1;
                    this.refresh();
                });
            }

            viewButtons?.forEach((button) => {
                button.addEventListener('click', () => {
                    viewButtons.forEach((item) => item.classList.remove('active'));
                    button.classList.add('active');
                    this.state.view = button.dataset.mediaView;
                    this.refresh();
                });
            });
        }
    }

    const MediaUI = {
        preview(item) {
            const modal = document.getElementById('mediaPreviewModal');
            const body = document.getElementById('mediaPreviewBody');
            const title = document.getElementById('mediaPreviewModalLabel');
            const download = document.getElementById('mediaPreviewDownload');

            if (!modal || !body) {
                return;
            }

            title.textContent = item.display_name;
            download.href = urlFromTemplate(config.downloadUrlTemplate, item.id);
            download.classList.remove('d-none');

            if (item.file_category === 'image') {
                body.innerHTML = `<img src="${item.url}" alt="${item.display_name}" class="img-fluid rounded">`;
            } else if (item.file_category === 'video') {
                body.innerHTML = `<video src="${item.url}" controls autoplay playsinline class="w-100 rounded media-preview-video"></video>`;
            } else if (item.file_category === 'pdf') {
                body.innerHTML = `<iframe src="${item.url}" class="media-preview-frame" title="${item.display_name}"></iframe>`;
            } else if (item.file_category === 'document') {
                body.innerHTML = `
                    <div class="media-preview-fallback">
                        <i class="ti ${fileIcon(item)}"></i>
                        <p class="mb-2">${item.original_name}</p>
                        <p class="text-muted font-13 mb-3">This document type opens best via download.</p>
                        <a href="${item.url}" class="btn btn-primary btn-sm" target="_blank" rel="noopener">Open File</a>
                    </div>
                `;
            } else {
                body.innerHTML = `<div class="media-preview-fallback"><i class="ti ${fileIcon(item)}"></i><p>${item.original_name}</p></div>`;
            }

            bootstrap.Modal.getOrCreateInstance(modal).show();
        },

        openRename(item, callback) {
            const modal = document.getElementById('mediaRenameModal');
            const form = document.getElementById('mediaRenameForm');
            const input = document.getElementById('mediaRenameInput');
            const idInput = document.getElementById('mediaRenameId');

            if (!modal || !form || !input || !idInput) {
                return;
            }

            idInput.value = item.id;
            input.value = item.display_name;

            const handler = async (event) => {
                event.preventDefault();
                const response = await fetch(urlFromTemplate(config.updateUrlTemplate, idInput.value), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ display_name: input.value.trim() }),
                });

                const payload = await response.json();
                if (!response.ok) {
                    toast(payload.message || 'Unable to rename file.', 'error');
                    return;
                }

                bootstrap.Modal.getInstance(modal)?.hide();
                toast(payload.message || 'Display name updated.');
                callback?.();
            };

            form.onsubmit = handler;
            bootstrap.Modal.getOrCreateInstance(modal).show();
        },

        confirmDelete(id, name, callback) {
            Swal.fire({
                title: 'Delete media file?',
                text: `"${name}" will be permanently removed.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light ms-2',
                },
                buttonsStyling: false,
            }).then(async (result) => {
                if (!result.isConfirmed) {
                    return;
                }

                const response = await fetch(urlFromTemplate(config.deleteUrlTemplate, id), {
                    method: 'DELETE',
                    headers: {
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });

                const payload = await response.json();
                if (!response.ok) {
                    toast(payload.message || 'Unable to delete file.', 'error');
                    return;
                }

                toast(payload.message || 'Media deleted.');
                callback?.();
            });
        },

        uploadFiles(files, progressElements, callback) {
            if (!files.length) {
                return;
            }

            const formData = new FormData();
            Array.from(files).forEach((file) => formData.append('files[]', file));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', config.uploadUrl, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhr.setRequestHeader('Accept', 'application/json');

            const { wrap, bar, label, percent } = progressElements;

            xhr.upload.addEventListener('progress', (event) => {
                if (!event.lengthComputable || !bar) {
                    return;
                }

                const value = Math.round((event.loaded / event.total) * 100);
                bar.style.width = `${value}%`;
                if (percent) {
                    percent.textContent = `${value}%`;
                }
            });

            xhr.addEventListener('load', () => {
                wrap?.classList.add('d-none');
                if (bar) {
                    bar.style.width = '0%';
                }

                let payload = {};
                try {
                    payload = JSON.parse(xhr.responseText);
                } catch (error) {
                    toast('Upload failed.', 'error');
                    return;
                }

                if (xhr.status >= 200 && xhr.status < 300) {
                    toast(payload.message || 'Upload complete.');
                    callback?.(payload.data || []);
                    return;
                }

                toast(payload.message || 'Upload failed.', 'error');
            });

            xhr.addEventListener('error', () => {
                wrap?.classList.add('d-none');
                toast('Upload failed.', 'error');
            });

            wrap?.classList.remove('d-none');
            if (label) {
                label.textContent = `Uploading ${files.length} file(s)...`;
            }

            xhr.send(formData);
        },

        bindUploadZone(zone, input, browseButton, progressElements, callback) {
            if (!zone || !input) {
                return;
            }

            const openPicker = () => input.click();

            browseButton?.addEventListener('click', (event) => {
                event.stopPropagation();
                openPicker();
            });

            zone.addEventListener('click', (event) => {
                if (event.target.closest('button') && event.target !== browseButton) {
                    return;
                }
                if (event.target.closest('.media-upload-progress')) {
                    return;
                }
                if (event.target.closest('.dropdown')) {
                    return;
                }
                openPicker();
            });

            zone.addEventListener('dragover', (event) => {
                event.preventDefault();
                zone.classList.add('is-dragover');
            });

            zone.addEventListener('dragleave', () => zone.classList.remove('is-dragover'));

            zone.addEventListener('drop', (event) => {
                event.preventDefault();
                zone.classList.remove('is-dragover');
                if (event.dataTransfer?.files?.length) {
                    this.uploadFiles(event.dataTransfer.files, progressElements, callback);
                }
            });

            input.addEventListener('change', () => {
                if (input.files?.length) {
                    this.uploadFiles(input.files, progressElements, callback);
                    input.value = '';
                }
            });
        },
    };

    function initLibraryPage() {
        const container = document.getElementById('mediaLibraryContainer');
        if (!container) {
            return;
        }

        const browser = new MediaBrowser({
            mode: 'library',
            container,
            emptyState: document.getElementById('mediaLibraryEmpty'),
            pagination: document.getElementById('mediaLibraryPagination'),
            paginationSummary: document.getElementById('mediaLibrarySummary'),
            searchInput: document.getElementById('mediaSearchInput'),
            categoryFilter: document.getElementById('mediaCategoryFilter'),
            sortFilter: document.getElementById('mediaSortFilter'),
            viewButtons: document.querySelectorAll('[data-media-view]'),
            perPage: 24,
        });

        browser.initControls();
        browser.refresh();

        MediaUI.bindUploadZone(
            document.getElementById('mediaUploadZone'),
            document.getElementById('mediaUploadInput'),
            document.getElementById('mediaUploadBrowseBtn'),
            {
                wrap: document.getElementById('mediaUploadProgress'),
                bar: document.getElementById('mediaUploadProgressBar'),
                label: document.getElementById('mediaUploadProgressLabel'),
                percent: document.getElementById('mediaUploadProgressPercent'),
            },
            () => browser.refresh()
        );
    }

    function initUrlFields() {
        document.querySelectorAll('[data-media-url-field]').forEach((field) => {
            const input = field.querySelector('input[type="url"]');
            const preview = field.querySelector('[data-url-preview]');

            if (!input || !preview) {
                return;
            }

            const updatePreview = () => {
                const value = input.value.trim();

                if (!value) {
                    preview.classList.add('d-none');
                    preview.innerHTML = '';
                    return;
                }

                preview.classList.remove('d-none');
                preview.innerHTML = `<img src="${value}" alt="Preview" class="img-thumbnail" style="max-height: 100px;">`;
            };

            input.addEventListener('input', updatePreview);
            input.addEventListener('change', updatePreview);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        initUrlFields();

        if (config.browseUrl) {
            initLibraryPage();
        }
    });
})();

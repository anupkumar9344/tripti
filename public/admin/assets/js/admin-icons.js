(function () {
    const config = window.SahajIconsConfig || {};
    const grid = document.getElementById('iconGrid');
    const searchInput = document.getElementById('iconSearchInput');
    const resultCount = document.getElementById('iconResultCount');
    const emptyState = document.getElementById('iconEmptyState');

    if (!grid || !searchInput || !config.iconsUrl) {
        return;
    }

    let icons = [];
    let filteredIcons = [];
    let toastTimer = null;

    const toast = document.createElement('div');
    toast.className = 'admin-icon-toast';
    document.body.appendChild(toast);

    function showToast(name) {
        toast.innerHTML = 'Copied <code>' + name + '</code>';
        toast.classList.add('is-visible');

        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () {
            toast.classList.remove('is-visible');
        }, 1800);
    }

    async function copyText(text) {
        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(text);
            return;
        }

        const helper = document.createElement('textarea');
        helper.value = text;
        helper.setAttribute('readonly', '');
        helper.style.position = 'absolute';
        helper.style.left = '-9999px';
        document.body.appendChild(helper);
        helper.select();
        document.execCommand('copy');
        document.body.removeChild(helper);
    }

    function renderIcons(list) {
        grid.innerHTML = '';

        if (!list.length) {
            emptyState.classList.remove('d-none');
            resultCount.textContent = '0 icons';
            return;
        }

        emptyState.classList.add('d-none');
        resultCount.textContent = list.length.toLocaleString() + ' icons';

        const fragment = document.createDocumentFragment();

        list.forEach(function (name) {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'admin-icon-item';
            button.dataset.iconName = name;
            button.title = 'Copy ' + name;
            button.innerHTML =
                '<span class="admin-icon-preview"><i class="fa-solid ' + name + '"></i></span>' +
                '<span class="admin-icon-name">' + name + '</span>';

            button.addEventListener('click', async function () {
                try {
                    await copyText(name);
                    showToast(name);

                    grid.querySelectorAll('.admin-icon-item.is-copied').forEach(function (item) {
                        item.classList.remove('is-copied');
                    });
                    button.classList.add('is-copied');
                } catch (error) {
                    window.alert('Could not copy icon name. Please copy it manually.');
                }
            });

            fragment.appendChild(button);
        });

        grid.appendChild(fragment);
    }

    function filterIcons() {
        const query = searchInput.value.trim().toLowerCase();

        if (!query) {
            filteredIcons = icons.slice();
        } else {
            filteredIcons = icons.filter(function (name) {
                return name.toLowerCase().includes(query);
            });
        }

        renderIcons(filteredIcons);
    }

    fetch(config.iconsUrl, {
        headers: {
            Accept: 'application/json',
        },
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Failed to load icons');
            }

            return response.json();
        })
        .then(function (data) {
            icons = Array.isArray(data.icons) ? data.icons : [];
            filteredIcons = icons.slice();
            renderIcons(filteredIcons);
        })
        .catch(function () {
            grid.innerHTML = '<div class="text-danger font-13">Unable to load icons. Please refresh the page.</div>';
        });

    searchInput.addEventListener('input', filterIcons);
})();

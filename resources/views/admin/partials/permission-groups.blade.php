@php
    $selected = collect($selectedPermissions ?? []);
    $totalPermissions = collect($permissionSections)->flatMap(fn ($items) => array_keys($items))->count();
    $selectedCount = $selected->intersect(collect($permissionSections)->flatMap(fn ($items) => array_keys($items))->all())->count();

    $sectionIcons = [
        'Dashboard' => 'ti-smart-home',
        'Contact Messages' => 'ti-mail',
        'Bookings' => 'ti-briefcase',
        'Inquiries' => 'ti-message-2',
        'Hotel Amenities' => 'ti-list-check',
        'Hotel Facilities' => 'ti-building-community',
        'Bed Types' => 'ti-layout-grid',
        'Room Types' => 'ti-home-2',
        'Rooms' => 'ti-bed',
        'Premium Services' => 'ti-diamond',
        'Hero Banners' => 'ti-photo',
        'About Us' => 'ti-info-circle',
        'Why Choose Us' => 'ti-star',
        'Careers' => 'ti-briefcase',
        'Feedback' => 'ti-stars',
        'Shorts Video' => 'ti-video',
        'Gallery' => 'ti-camera',
        'Blog' => 'ti-news',
        'FAQs' => 'ti-zoom-question',
        'Legal Pages' => 'ti-file-text',
        'Media Library' => 'ti-files',
        'General Settings' => 'ti-settings',
        'Staff' => 'ti-user-check',
        'Roles & Permissions' => 'ti-shield-lock',
        'System' => 'ti-tool',
    ];
@endphp

<div class="permission-panel" data-permission-panel>
    <div class="permission-toolbar">
        <div class="permission-toolbar-search">
            <i class="ti ti-search"></i>
            <input
                type="search"
                class="form-control"
                id="permissionSearch"
                placeholder="Search sections or permissions..."
                @disabled($isProtected ?? false)
            >
        </div>
        <div class="permission-toolbar-actions">
            <button type="button" class="btn btn-sm btn-outline-primary permission-select-all" @disabled($isProtected ?? false)>
                Select all
            </button>
            <button type="button" class="btn btn-sm btn-light permission-clear-all" @disabled($isProtected ?? false)>
                Clear all
            </button>
        </div>
    </div>

    <div class="permission-summary">
        <div class="permission-summary-copy">
            <span class="permission-summary-count" data-permission-summary-count>{{ $selectedCount }}</span>
            <span>of</span>
            <span>{{ $totalPermissions }}</span>
            <span>permissions selected</span>
        </div>
        <div class="permission-summary-bar" aria-hidden="true">
            <span class="permission-summary-bar-fill" data-permission-summary-bar style="width: {{ $totalPermissions > 0 ? round(($selectedCount / $totalPermissions) * 100) : 0 }}%;"></span>
        </div>
    </div>

    <div class="permission-groups">
        @foreach ($permissionSections as $section => $permissions)
            @php
                $sectionKey = \Illuminate\Support\Str::slug($section);
                $sectionPermissionKeys = array_keys($permissions);
                $sectionCheckedCount = $selected->intersect($sectionPermissionKeys)->count();
                $sectionTotal = count($permissions);
                $sectionAllChecked = $sectionCheckedCount === $sectionTotal && $sectionTotal > 0;
                $sectionIcon = $sectionIcons[$section] ?? 'ti-lock';
                $sectionProgress = $sectionTotal > 0 ? round(($sectionCheckedCount / $sectionTotal) * 100) : 0;
            @endphp
            <div
                class="permission-group-card @if($sectionAllChecked) is-complete @endif"
                data-permission-section
                data-section-label="{{ strtolower($section) }}"
            >
                <div class="permission-group-header">
                    <button
                        type="button"
                        class="permission-group-toggle"
                        data-bs-toggle="collapse"
                        data-bs-target="#permission_section_{{ $sectionKey }}"
                        aria-expanded="true"
                    >
                        <span class="permission-group-icon">
                            <i class="ti {{ $sectionIcon }}"></i>
                        </span>
                        <span class="permission-group-meta">
                            <span class="permission-group-title">{{ $section }}</span>
                            <span class="permission-group-subtitle">
                                <span data-section-selected-count>{{ $sectionCheckedCount }}</span>/{{ $sectionTotal }} selected
                            </span>
                        </span>
                        <span class="permission-group-progress" aria-hidden="true">
                            <span style="width: {{ $sectionProgress }}%;"></span>
                        </span>
                        <span class="permission-group-chevron">
                            <i class="ti ti-chevron-down"></i>
                        </span>
                    </button>

                    <div class="permission-group-select">
                        <input
                            type="checkbox"
                            class="permission-section-toggle"
                            id="section_toggle_{{ $sectionKey }}"
                            data-section="{{ $sectionKey }}"
                            @checked($sectionAllChecked)
                            @disabled($isProtected ?? false)
                        >
                        <label for="section_toggle_{{ $sectionKey }}">All</label>
                    </div>
                </div>

                <div class="collapse show" id="permission_section_{{ $sectionKey }}">
                    <div class="permission-group-body">
                        <div class="permission-item-grid">
                            @foreach ($permissions as $permission => $label)
                                <label
                                    class="permission-item @if($selected->contains($permission)) is-checked @endif"
                                    data-permission-label="{{ strtolower($label . ' ' . $permission) }}"
                                >
                                    <input
                                        type="checkbox"
                                        class="permission-checkbox permission-section-{{ $sectionKey }}"
                                        name="permissions[]"
                                        id="permission_{{ str_replace('.', '_', $permission) }}"
                                        value="{{ $permission }}"
                                        @checked($selected->contains($permission))
                                        @disabled($isProtected ?? false)
                                    >
                                    <span class="permission-item-box" aria-hidden="true">
                                        <i class="ti ti-check"></i>
                                    </span>
                                    <span class="permission-item-text">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <p class="permission-empty-state d-none" data-permission-empty>No permissions match your search.</p>
</div>

@once
    @push('styles')
        <style>
            .permission-panel {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .permission-toolbar {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
                align-items: center;
                justify-content: space-between;
            }

            .permission-toolbar-search {
                position: relative;
                flex: 1 1 240px;
                min-width: 220px;
            }

            .permission-toolbar-search i {
                position: absolute;
                left: 0.85rem;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                pointer-events: none;
            }

            .permission-toolbar-search .form-control {
                padding-left: 2.35rem;
                border-radius: 0.65rem;
                border-color: rgba(115, 86, 165, 0.15);
                background: #faf9fc;
            }

            .permission-toolbar-search .form-control:focus {
                border-color: rgba(var(--admin-primary-rgb), 0.45);
                box-shadow: 0 0 0 0.2rem rgba(var(--admin-primary-rgb), 0.12);
                background: #fff;
            }

            .permission-toolbar-actions {
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
            }

            .permission-summary {
                padding: 0.85rem 1rem;
                border: 1px solid rgba(115, 86, 165, 0.12);
                border-radius: 0.75rem;
                background: linear-gradient(135deg, rgba(var(--admin-primary-rgb), 0.06), rgba(var(--admin-primary-rgb), 0.02));
            }

            .permission-summary-copy {
                display: flex;
                flex-wrap: wrap;
                gap: 0.35rem;
                align-items: center;
                font-size: 0.8125rem;
                color: #64748b;
                margin-bottom: 0.55rem;
            }

            .permission-summary-count {
                font-size: 1rem;
                font-weight: 700;
                color: var(--admin-primary);
            }

            .permission-summary-bar {
                height: 6px;
                border-radius: 999px;
                background: rgba(var(--admin-primary-rgb), 0.12);
                overflow: hidden;
            }

            .permission-summary-bar-fill {
                display: block;
                height: 100%;
                border-radius: inherit;
                background: linear-gradient(90deg, var(--admin-primary), var(--admin-secondary));
                transition: width 0.2s ease;
            }

            .permission-groups {
                display: flex;
                flex-direction: column;
                gap: 0.85rem;
            }

            .permission-group-card {
                border: 1px solid rgba(115, 86, 165, 0.12);
                border-radius: 0.85rem;
                background: #fff;
                overflow: hidden;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .permission-group-card.is-complete {
                border-color: rgba(var(--admin-primary-rgb), 0.28);
                box-shadow: 0 8px 24px rgba(var(--admin-primary-rgb), 0.08);
            }

            .permission-group-card.is-hidden {
                display: none;
            }

            .permission-group-header {
                display: flex;
                align-items: stretch;
                gap: 0.75rem;
                padding: 0.65rem 0.85rem 0.65rem 0.65rem;
                background: #fcfbfe;
                border-bottom: 1px solid rgba(115, 86, 165, 0.08);
            }

            .permission-group-toggle {
                flex: 1;
                display: grid;
                grid-template-columns: auto 1fr auto auto;
                gap: 0.75rem;
                align-items: center;
                padding: 0.35rem 0.45rem;
                border: 0;
                background: transparent;
                text-align: left;
            }

            .permission-group-icon {
                width: 2.35rem;
                height: 2.35rem;
                border-radius: 0.65rem;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: rgba(var(--admin-primary-rgb), 0.1);
                color: var(--admin-primary);
                font-size: 1rem;
            }

            .permission-group-meta {
                min-width: 0;
            }

            .permission-group-title {
                display: block;
                font-size: 0.9375rem;
                font-weight: 600;
                color: #1e293b;
            }

            .permission-group-subtitle {
                display: block;
                margin-top: 0.1rem;
                font-size: 0.75rem;
                color: #94a3b8;
            }

            .permission-group-progress {
                width: 72px;
                height: 6px;
                border-radius: 999px;
                background: rgba(var(--admin-primary-rgb), 0.12);
                overflow: hidden;
            }

            .permission-group-progress span {
                display: block;
                height: 100%;
                border-radius: inherit;
                background: var(--admin-primary);
                transition: width 0.2s ease;
            }

            .permission-group-chevron {
                color: #94a3b8;
                transition: transform 0.2s ease;
            }

            .permission-group-toggle[aria-expanded="false"] .permission-group-chevron {
                transform: rotate(-90deg);
            }

            .permission-group-select {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                padding: 0 0.35rem;
                border-left: 1px solid rgba(115, 86, 165, 0.1);
                font-size: 0.75rem;
                color: #64748b;
                white-space: nowrap;
            }

            .permission-group-select label {
                margin: 0;
                cursor: pointer;
                user-select: none;
            }

            .permission-group-body {
                padding: 0.9rem;
            }

            .permission-item-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.65rem;
            }

            .permission-item {
                display: flex;
                align-items: center;
                gap: 0.65rem;
                margin: 0;
                padding: 0.7rem 0.8rem;
                border: 1px solid rgba(115, 86, 165, 0.12);
                border-radius: 0.7rem;
                background: #fff;
                cursor: pointer;
                transition: border-color 0.2s ease, background 0.2s ease, transform 0.15s ease;
            }

            .permission-item:hover {
                border-color: rgba(var(--admin-primary-rgb), 0.28);
                background: rgba(var(--admin-primary-rgb), 0.03);
            }

            .permission-item.is-checked {
                border-color: rgba(var(--admin-primary-rgb), 0.35);
                background: rgba(var(--admin-primary-rgb), 0.07);
            }

            .permission-item.is-hidden {
                display: none;
            }

            .permission-item input {
                position: absolute;
                opacity: 0;
                pointer-events: none;
            }

            .permission-item-box {
                width: 1.15rem;
                height: 1.15rem;
                border-radius: 0.35rem;
                border: 1.5px solid #cbd5e1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                color: transparent;
                font-size: 0.7rem;
                transition: all 0.2s ease;
            }

            .permission-item.is-checked .permission-item-box {
                border-color: var(--admin-primary);
                background: var(--admin-primary);
                color: #fff;
            }

            .permission-item-text {
                font-size: 0.8125rem;
                color: #334155;
                line-height: 1.35;
            }

            .permission-empty-state {
                margin: 0;
                padding: 1rem;
                text-align: center;
                font-size: 0.875rem;
                color: #94a3b8;
                border: 1px dashed rgba(115, 86, 165, 0.18);
                border-radius: 0.75rem;
            }

            @media (max-width: 767.98px) {
                .permission-item-grid {
                    grid-template-columns: 1fr;
                }

                .permission-group-toggle {
                    grid-template-columns: auto 1fr;
                }

                .permission-group-progress,
                .permission-group-chevron {
                    display: none;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const panel = document.querySelector('[data-permission-panel]');
                if (!panel) {
                    return;
                }

                const searchInput = panel.querySelector('#permissionSearch');
                const summaryCount = panel.querySelector('[data-permission-summary-count]');
                const summaryBar = panel.querySelector('[data-permission-summary-bar]');
                const emptyState = panel.querySelector('[data-permission-empty]');
                const allCheckboxes = panel.querySelectorAll('.permission-checkbox:not(:disabled)');
                const sectionCards = panel.querySelectorAll('[data-permission-section]');

                function updateSectionState(sectionKey) {
                    const checkboxes = panel.querySelectorAll('.permission-section-' + sectionKey + ':not(:disabled)');
                    const toggle = panel.querySelector('.permission-section-toggle[data-section="' + sectionKey + '"]');
                    const card = toggle ? toggle.closest('[data-permission-section]') : null;
                    const selectedCountEl = card ? card.querySelector('[data-section-selected-count]') : null;
                    const progressEl = card ? card.querySelector('.permission-group-progress span') : null;

                    if (!checkboxes.length || !toggle || !card) {
                        return;
                    }

                    let checkedCount = 0;
                    checkboxes.forEach(function (checkbox) {
                        const item = checkbox.closest('.permission-item');
                        if (checkbox.checked) {
                            checkedCount += 1;
                            item?.classList.add('is-checked');
                        } else {
                            item?.classList.remove('is-checked');
                        }
                    });

                    const total = checkboxes.length;
                    toggle.checked = checkedCount === total;
                    toggle.indeterminate = checkedCount > 0 && checkedCount < total;
                    card.classList.toggle('is-complete', checkedCount === total);

                    if (selectedCountEl) {
                        selectedCountEl.textContent = checkedCount;
                    }

                    if (progressEl) {
                        progressEl.style.width = total > 0 ? Math.round((checkedCount / total) * 100) + '%' : '0%';
                    }
                }

                function updateSummary() {
                    const total = allCheckboxes.length;
                    let selected = 0;

                    allCheckboxes.forEach(function (checkbox) {
                        if (checkbox.checked) {
                            selected += 1;
                        }
                    });

                    if (summaryCount) {
                        summaryCount.textContent = selected;
                    }

                    if (summaryBar) {
                        summaryBar.style.width = total > 0 ? Math.round((selected / total) * 100) + '%' : '0%';
                    }
                }

                function refreshAllSections() {
                    panel.querySelectorAll('.permission-section-toggle').forEach(function (toggle) {
                        updateSectionState(toggle.dataset.section);
                    });
                    updateSummary();
                }

                panel.querySelectorAll('.permission-section-toggle').forEach(function (toggle) {
                    toggle.addEventListener('change', function () {
                        const section = toggle.dataset.section;
                        panel.querySelectorAll('.permission-section-' + section + ':not(:disabled)').forEach(function (checkbox) {
                            checkbox.checked = toggle.checked;
                        });
                        updateSectionState(section);
                        updateSummary();
                    });
                });

                allCheckboxes.forEach(function (checkbox) {
                    checkbox.addEventListener('change', function () {
                        const sectionClass = Array.from(checkbox.classList).find(function (name) {
                            return name.startsWith('permission-section-');
                        });

                        if (sectionClass) {
                            updateSectionState(sectionClass.replace('permission-section-', ''));
                        }

                        updateSummary();
                    });
                });

                panel.querySelector('.permission-select-all')?.addEventListener('click', function () {
                    allCheckboxes.forEach(function (checkbox) {
                        checkbox.checked = true;
                    });
                    refreshAllSections();
                });

                panel.querySelector('.permission-clear-all')?.addEventListener('click', function () {
                    allCheckboxes.forEach(function (checkbox) {
                        checkbox.checked = false;
                    });
                    refreshAllSections();
                });

                searchInput?.addEventListener('input', function () {
                    const query = searchInput.value.trim().toLowerCase();
                    let visibleSections = 0;

                    sectionCards.forEach(function (card) {
                        const sectionLabel = card.dataset.sectionLabel || '';
                        let sectionVisible = sectionLabel.includes(query);
                        let visibleItems = 0;

                        card.querySelectorAll('.permission-item').forEach(function (item) {
                            const itemLabel = item.dataset.permissionLabel || '';
                            const itemVisible = query === '' || sectionLabel.includes(query) || itemLabel.includes(query);
                            item.classList.toggle('is-hidden', !itemVisible);

                            if (itemVisible) {
                                visibleItems += 1;
                                sectionVisible = true;
                            }
                        });

                        card.classList.toggle('is-hidden', !sectionVisible);
                        if (sectionVisible) {
                            visibleSections += 1;
                        }
                    });

                    emptyState?.classList.toggle('d-none', visibleSections > 0);
                });

                refreshAllSections();
            });
        </script>
    @endpush
@endonce

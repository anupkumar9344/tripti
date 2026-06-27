@php
    $selectedIds = array_map('intval', (array) old('profile_category_ids', $selectedCategoryIds ?? []));
@endphp

<div class="card mb-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title mb-0">Profile Categories</h4>
        <a href="{{ route('admin.expert-profile-categories.index') }}" class="font-13">Manage Categories</a>
    </div>
    <div class="card-body">
        @if ($profileCategories->isEmpty())
            <p class="text-muted mb-0">No categories yet. <a href="{{ route('admin.expert-profile-categories.create') }}">Add a category</a> first — categories are shared across all team members.</p>
        @else
            <p class="text-muted font-13 mb-3">Select the categories that apply to this team member, then add content for each. Selected categories with content appear as tabs on the public profile page.</p>

            <div class="border rounded p-3 mb-4">
                <label class="form-label fw-semibold mb-3">Select Categories</label>
                <div class="row">
                    @foreach ($profileCategories as $category)
                        @php
                            $isSelected = in_array($category->id, $selectedIds, true);
                        @endphp
                        <div class="col-md-6 col-lg-4">
                            <div class="form-check mb-2">
                                <input
                                    type="checkbox"
                                    class="form-check-input profile-category-checkbox"
                                    id="category_{{ $category->id }}"
                                    name="profile_category_ids[]"
                                    value="{{ $category->id }}"
                                    data-target="profile-section-{{ $category->id }}"
                                    @checked($isSelected)
                                >
                                <label class="form-check-label" for="category_{{ $category->id }}">
                                    @if ($category->icon)
                                        <i class="fa-solid {{ $category->icon }} me-1"></i>
                                    @endif
                                    {{ $category->title }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @foreach ($profileCategories as $category)
                @php
                    $isSelected = in_array($category->id, $selectedIds, true);
                @endphp
                <div
                    class="profile-section-editor border rounded p-3 mb-3 {{ $isSelected ? '' : 'd-none' }}"
                    id="profile-section-{{ $category->id }}"
                >
                    <label class="form-label fw-semibold" for="profile_section_{{ $category->id }}">
                        @if ($category->icon)
                            <i class="fa-solid {{ $category->icon }} me-1"></i>
                        @endif
                        {{ $category->title }}
                    </label>
                    <textarea
                        class="form-control expert-profile-editor @error('profile_sections.'.$category->id) is-invalid @enderror"
                        id="profile_section_{{ $category->id }}"
                        name="profile_sections[{{ $category->id }}]"
                        rows="6"
                    >{{ old('profile_sections.'.$category->id, $profileSectionContents[$category->id] ?? '') }}</textarea>
                    @error('profile_sections.'.$category->id)
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        @endif
    </div>
</div>

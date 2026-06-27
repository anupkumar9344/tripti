<div class="modal fade" id="mediaPickerModal" tabindex="-1" aria-labelledby="mediaPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaPickerModalLabel">Choose Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="media-upload-zone media-upload-zone-compact mb-3" id="mediaPickerUploadZone">
                    <input type="file" id="mediaPickerUploadInput" class="d-none" multiple accept=".jpg,.jpeg,.png,.webp,.svg,.pdf,.doc,.docx,.xls,.xlsx,.zip,.mp4">
                    <div class="media-upload-zone-inner">
                        <i class="ti ti-cloud-upload"></i>
                        <p class="mb-2">Drop files here or <button type="button" class="btn btn-link p-0 align-baseline" id="mediaPickerUploadBrowseBtn">upload new</button></p>
                    </div>
                    <div class="media-upload-progress d-none" id="mediaPickerUploadProgress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="mediaPickerUploadProgressBar" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <div class="media-toolbar mb-3">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-5">
                            <input type="search" class="form-control form-control-sm" id="mediaPickerSearchInput" placeholder="Search media...">
                        </div>
                        <div class="col-md-3 col-6">
                            <select class="form-select form-select-sm" id="mediaPickerCategoryFilter">
                                <option value="all">All Types</option>
                                <option value="image">Images</option>
                                <option value="pdf">PDFs</option>
                                <option value="document">Documents</option>
                                <option value="video">Videos</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-6">
                            <select class="form-select form-select-sm" id="mediaPickerSortFilter">
                                <option value="latest">Latest</option>
                                <option value="oldest">Oldest</option>
                                <option value="name_asc">Name A–Z</option>
                                <option value="name_desc">Name Z–A</option>
                                <option value="size">File Size</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="mediaPickerSummary" class="media-library-summary text-muted font-12 mb-2"></div>
                <div id="mediaPickerContainer" class="media-library-container media-view-grid"></div>
                <div id="mediaPickerEmpty" class="media-library-empty d-none">
                    <p class="mb-0">No media found. Upload a file to get started.</p>
                </div>
                <div id="mediaPickerPagination" class="media-library-pagination"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="mediaPickerSelectBtn" disabled>Select Media</button>
            </div>
        </div>
    </div>
</div>

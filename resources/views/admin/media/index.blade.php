@extends('admin.layouts.app')

@section('title', 'Media Library')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Media Library</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card media-library-card">
                <div class="card-body">
                    <div class="media-upload-zone" id="mediaUploadZone">
                        <input type="file" id="mediaUploadInput" class="d-none" multiple accept=".jpg,.jpeg,.png,.webp,.svg,.pdf,.doc,.docx,.xls,.xlsx,.zip,.mp4">
                        <div class="media-upload-zone-inner">
                            <i class="ti ti-cloud-upload"></i>
                            <h5>Drag &amp; drop files here</h5>
                            <p class="text-muted mb-3">or click to browse — JPG, PNG, WEBP, SVG, PDF, DOC, DOCX, XLS, XLSX, ZIP, MP4</p>
                            <button type="button" class="btn btn-primary btn-sm" id="mediaUploadBrowseBtn">Upload Files</button>
                        </div>
                        <div class="media-upload-progress d-none" id="mediaUploadProgress">
                            <div class="d-flex justify-content-between mb-1 font-13">
                                <span id="mediaUploadProgressLabel">Uploading...</span>
                                <span id="mediaUploadProgressPercent">0%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" id="mediaUploadProgressBar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="media-toolbar">
                        <div class="row g-2 align-items-center">
                            <div class="col-lg-4 col-md-6">
                                <input type="search" class="form-control" id="mediaSearchInput" placeholder="Search by display name or filename...">
                            </div>
                            <div class="col-lg-2 col-md-3 col-6">
                                <select class="form-select" id="mediaCategoryFilter">
                                    <option value="all">All Types</option>
                                    <option value="image">Images</option>
                                    <option value="pdf">PDFs</option>
                                    <option value="document">Documents</option>
                                    <option value="video">Videos</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-3 col-6">
                                <select class="form-select" id="mediaSortFilter">
                                    <option value="latest">Latest</option>
                                    <option value="oldest">Oldest</option>
                                    <option value="name_asc">Name A–Z</option>
                                    <option value="name_desc">Name Z–A</option>
                                    <option value="size">File Size</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="media-view-toggle float-md-end">
                                    <button type="button" class="btn btn-light active" data-media-view="grid" title="Grid view"><i class="ti ti-layout-grid"></i></button>
                                    <button type="button" class="btn btn-light" data-media-view="list" title="List view"><i class="ti ti-list"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="mediaLibrarySummary" class="media-library-summary text-muted font-12 mb-2"></div>
                    <div id="mediaLibraryContainer" class="media-library-container media-view-grid"></div>
                    <div id="mediaLibraryEmpty" class="media-library-empty d-none">
                        <i class="ti ti-photo-off"></i>
                        <p class="mb-0">No media files found. Upload your first file above.</p>
                    </div>
                    <div id="mediaLibraryPagination" class="media-library-pagination"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

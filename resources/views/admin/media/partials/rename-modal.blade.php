<div class="modal fade" id="mediaRenameModal" tabindex="-1" aria-labelledby="mediaRenameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaRenameModalLabel">Rename Display Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="mediaRenameForm">
                <div class="modal-body">
                    <input type="hidden" id="mediaRenameId">
                    <div class="form-group mb-0">
                        <label class="form-label" for="mediaRenameInput">Display Name</label>
                        <input type="text" class="form-control" id="mediaRenameInput" required maxlength="255">
                        <span class="form-text text-muted font-12">Only the display name changes. Original filename and file path stay the same.</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

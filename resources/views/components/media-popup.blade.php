<!-- Popup chọn ảnh -->
<div id="media_popup" class="image-popup shadow-lg rounded bg-white border"
    style="display: none; position: fixed; width: 90%; height: 90vh; z-index: 1000; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <div class="popup-header border-bottom p-3 d-flex justify-content-between align-items-center bg-light cursor-move">
        <h5 class="mb-0">📁 Thư viện ảnh</h5>
        <button onclick="window.mediaPopup.close()" type="button" class="btn btn-sm btn-outline-danger" data-close><i
                class="fas fa-times-circle"></i></button>
    </div>

    <div class="popup-body d-flex" style="height: calc(90vh - 120px);">
        <div class="flex-grow-1 border-end overflow-auto p-3" style="background: #f9f9f9;">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div class="d-flex gap-2 align-items-center">
                    <input type="file" id="popup_upload_input" class="d-none" accept="image/*" multiple>
                    <button onclick="window.mediaPopup.upload()" type="button" class="btn btn-primary"
                        id="popup_upload_btn">
                        <i class="fas fa-cloud-upload-alt me-1"></i> Tải ảnh lên
                    </button>
                    <button type="button" onclick="window.mediaPopup.delete()"
                        class="btn btn-outline-danger d-none" id="delete_btn">
                        <i class="fas fa-trash-alt me-1"></i> Xoá ảnh đã chọn
                    </button>
                </div>
                <div class="input-group" style="max-width: 250px;">
                    <input type="text" class="form-control form-control" placeholder="Tìm kiếm ảnh..."
                        id="popup_search_input">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>

            <div data-list></div>
        </div>
        <div class="p-3 overflow-auto h-100" style="flex: 0 0 18%; max-width: 18%; background: #fcfcfc;" data-detail>
            <div class="text-muted fst-italic">Chọn ảnh để xem thông tin</div>
        </div>
    </div>

    <div class="popup-footer p-3 border-top bg-light text-end">
        <button type="button" onclick="window.mediaPopup.handleSelect()" class="btn btn-primary" data-select><i
                class="bi bi-check2-circle"></i> Chọn ảnh</button>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('global/js/media.js') }}"></script>
@endpush


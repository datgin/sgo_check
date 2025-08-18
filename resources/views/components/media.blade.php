@php

    $uid = uniqid('media_');
    $isSingle = !$multiple;

    $wrapperClass = $isSingle ? 'upload-single' : 'upload-multiple';

    $previewClass = $isSingle
        ? 'upload-preview w-100 h-100 position-relative'
        : 'upload-preview d-flex flex-wrap gap-3 justify-content-start align-items-start w-100 h-100 position-relative';
@endphp

<div id="{{ $uid }}_upload_wrapper" class="btn-open-media upload-glow-border {{ $wrapperClass }}"
    data-name="{{ $name }}" data-multiple="{{ $multiple ? 'true' : 'false' }}"
    data-selected='@json($selected)' data-uid="{{ $uid }}">

    <div class="upload-wrapper rounded p-3 bg-light position-relative "
        style="cursor: pointer; {{ $isSingle ? 'width: 100%; aspect-ratio: 1 / 1;' : 'min-height: 180px;' }}">

        <div id="{{ $uid }}_upload-preview"
            class="upload-preview w-100 h-100 position-relative {{ $isSingle ? '' : 'd-flex' }}"></div>

        <div id="{{ $uid }}_placeholder_text"
            class="placeholder-text text-muted text-center position-absolute top-50 start-50 translate-middle">
            <i class="fas fa-cloud-upload-alt fs-3 d-block mb-2"></i>
            Bấm để chọn ảnh
        </div>

    </div>

    <div id="{{ $uid }}_selected-images-input" data-name="{{ $name }}"></div>

</div>

@push('script')
    <script>
        $(function() {
            const uid = "{{ $uid }}";
            const selected = @json($selected);

            const multiple = {{ $multiple ? 'true' : 'false' }};

            if (
                !selected ||
                (Array.isArray(selected) && selected.length === 0) ||
                (Array.isArray(selected) && selected.every(item => !item)) // mảng chỉ có '', null, undefined
            ) {
                return;
            }

            // Khởi tạo global map nếu chưa có
            window.selectedImages = window.selectedImages || {};
            selectedImages[uid] = selectedImages[uid] || new Map();

            if (Array.isArray(selected)) {
                selected.forEach(function(path) {
                    const uniqueId = Date.now().toString() + Math.floor(Math.random() * 1000000);
                    selectedImages[uid].set(uniqueId, path);
                });
            }

            window.mediaPopup.currentUid = uid;
            window.mediaPopup.multiple = multiple;

            if (typeof window.mediaPopup.handleSelect === 'function') {
                window.mediaPopup.handleSelect();
            }
        });
    </script>
@endpush

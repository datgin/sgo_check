<div class="d-flex align-items-center gap-2">
    <button type="submit" name="action" value="save" class="btn btn-primary d-inline-flex align-items-center gap-2">
        <i data-feather="save" class="feather-icon"></i>
        <span>Lưu</span>
    </button>

    <button type="submit" name="action" value="save_exit" class="btn btn-light d-inline-flex align-items-center gap-2">
        <i data-feather="home" class="feather-icon"></i>
        <span>Lưu và thoát</span>
    </button>

</div>

@push('style')
    <style>
        .feather-icon {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }
    </style>
@endpush

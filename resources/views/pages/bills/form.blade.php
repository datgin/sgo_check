@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :items="[['label' => $title]]" />

        <form id="myForm">
            @csrf

            @if ($bill)
                @method('PUT')
            @endif

            <div class="row">
                <!-- Thông tin cơ bản -->
                <div class="col-md-9">
                    <x-card>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <x-input label="Tên sản phẩm" name="name" required
                                    value="{{ old('name', optional($bill)->name) }}" />
                            </div>

                            <div class="col-md-6">
                                <x-input label="Xuất xứ" name="origin"
                                    value="{{ old('origin', optional($bill)->origin) }}" />
                            </div>

                            <div class="col-md-6">
                                <x-input label="Mã sản phẩm" name="product_code" required
                                    value="{{ old('product_code', optional($bill)->product_code) }}" />
                            </div>

                            <div class="col-md-6">
                                <x-input type="date" label="Ngày sản xuất" name="production_date"
                                    value="{{ optional($bill?->production_date)->format('Y-m-d') }}" />
                            </div>


                            <div class="col-md-6">
                                <x-input label="Bảo hành" name="guarantee"
                                    value="{{ old('guarantee', optional($bill)->guarantee) }}" />
                            </div>

                            <div class="col-md-12">
                                <x-input label="Thông tin khác" name="other_information"
                                    value="{{ implode(', ', $bill?->other_information ?? []) }}" id="other_information" />
                            </div>

                            <div class="col-md-12">
                                <x-textarea label="Mô tả ngắn" name="short_description"
                                    value="{{ optional($bill)->short_description }}" />
                            </div>
                        </div>
                    </x-card>
                </div>

                <!-- Hình ảnh & submit -->
                <div class="col-md-3">
                    <x-card>
                        <x-submit />
                    </x-card>

                    <x-card title="Ảnh sản phẩm">
                        <x-media name="image" selected="{{ optional($bill)->image }}" />
                    </x-card>
                </div>
            </div>
        </form>

    </div>

    <x-media-popup />
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        $(function() {
            var $input = $('#other_information');

            if ($input.length) {
                // Khởi tạo Tagify
                var tagify = new Tagify($input[0], {
                    whitelist: [],
                    dropdown: {
                        enabled: 1, // bật gợi ý khi gõ
                        maxItems: 10,
                        classname: "tags-look",
                        fuzzySearch: true
                    }
                });

                // Ví dụ: bắt sự kiện thay đổi
                tagify.on('change', function(e) {
                    console.log("Tags hiện tại:", e.detail.value);
                });
            }

            submitForm('#myForm', function(res, form, submitAction) {
                const isCreating = @json(!$bill);

                if (submitAction === 'save') {
                    if (isCreating) {
                        form.trigger('reset');
                    }
                    datgin.success(res.message)
                    return;
                }

                window.location.href = "/{{ auth()->user()->phone }}/bills";
            });
        });
    </script>
@endpush


@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush

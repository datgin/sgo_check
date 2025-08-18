@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :items="[['label' => $title]]" />

        <form id="myForm">
            @csrf

            @if ($user)
                @method('PUT')
            @endif

            <div class="row">
                <!-- Thông tin cơ bản -->
                <div class="col-md-9">
                    <x-card title="Thông tin khách hàng">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <x-input label="Họ tên" name="name" required
                                    value="{{ old('name', optional($user)->name) }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input type="email" label="Email" name="email" required
                                    value="{{ old('email', optional($user)->email) }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input label="Số điện thoại" name="phone"
                                    value="{{ old('phone', optional($user)->phone) }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input label="Công ty" name="company"
                                    value="{{ old('company', optional($user)->company) }}" />
                            </div>
                            <div class="col-md-12">
                                <x-input label="Địa chỉ" name="address"
                                    value="{{ old('address', optional($user)->address) }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input label="Mã số thuế" name="tax_number"
                                    value="{{ old('tax_number', optional($user)->tax_number) }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input type="url" label="Website" name="website"
                                    value="{{ old('website', optional($user)->website) }}" />
                            </div>
                            <div class="col-md-6">
                                <x-input type="password" label="Mật khẩu" name="password" />
                            </div>
                            <div class="col-md-6">
                                <x-input type="password" label="Xác nhận mật khẩu" name="password_confirmation" />
                            </div>
                        </div>
                    </x-card>
                </div>

                <!-- Hình ảnh & submit -->
                <div class="col-md-3">
                    <x-card>
                        <x-submit />
                    </x-card>

                    <x-card title="Logo">
                        <x-media name="logo" selected="{{ optional($user)->logo }}" />
                    </x-card>

                    <x-card title="Favicon">
                        <x-media name="favicon" selected="{{ optional($user)->favicon }}" />
                    </x-card>
                </div>
            </div>
        </form>


    </div>

    <x-media-popup />
@endsection

@push('script')
    <script>
        submitForm('#myForm', function(res, form, submitAction) {
            const isCreating = @json(!$user);

            if (submitAction === 'save') {
                if (isCreating) {
                    form.trigger('reset');
                }
                datgin.success(res.message)
                return;
            }

            window.location.href = "/{{ auth()->user()->phone }}/clients";
        });
    </script>
@endpush

@extends('app')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb :items="[['label' => 'Tài khoản của tôi']]" />

        <form id="myForm">

            @method('PUT')

            <div class="row">
                <div class="col-md-9">
                    <x-card title="Thông tin cá nhân">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <x-input label="Họ tên" name="name" :value="$user->name" required />
                            </div>
                            <div class="col-md-6">
                                <x-input type="email" label="Email" :value="$user->email" name="email" required />
                            </div>
                            <div class="col-md-6">
                                <x-input label="Số điện thoại" :value="$user->phone" name="phone" required />
                            </div>
                            <div class="col-md-6">
                                <x-input label="Công ty" name="company" :value="$user->company" required />
                            </div>
                            <div class="col-md-12">
                                <x-input label="Địa chỉ" name="address" :value="$user->address" />
                            </div>
                            <div class="col-md-6">
                                <x-input label="Mã số thuế" name="tax_number" :value="$user->tax_number" />
                            </div>
                            <div class="col-md-6">
                                <x-input type="url" label="Website" name="website" :value="$user->website" />
                            </div>
                        </div>
                    </x-card>
                </div>

                <div class="col-md-3">
                    <x-card>
                        <x-submit />
                    </x-card>

                    <x-card title="Logo">
                        <x-media name="logo" :selected="$user->logo" />
                    </x-card>
                    <x-card title="Icon">
                        <x-media name="favicon" :selected="$user->favicon" />
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

            if (submitAction === 'save') {
                datgin.success(res.message)
                return;
            }

            window.location.href = "/{{ Str::slug($user->company) }}";
        });
    </script>
@endpush

@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :items="[['label' => 'Danh sách khách hàng']]" />

        <x-page-header title="Danh sách khách hàng">
            <a href="clients/create" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> TẠO MỚI KHÁCH HÀNG
            </a>
        </x-page-header>

        <x-table fileName="user" />
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            const api = "clients"
            dataTables(api)

            initBulkAction('Catalogue')

            handleDestroy('Catalogue')
        })
    </script>
@endpush

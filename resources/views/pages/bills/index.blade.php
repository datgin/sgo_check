@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :items="[['label' => 'Danh sách']]" />

        <x-page-header title="Danh sách">
            <a href="bills/create" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> TẠO MỚI
            </a>
        </x-page-header>

        <x-table fileName="bill" />
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            const api = "bills"
            dataTables(api)

            initBulkAction('Bill')

            handleDestroy('Bill')
        })
    </script>
@endpush

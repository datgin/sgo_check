<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="display" style="width:100%">
            </table>
        </div>
    </div>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="{{ asset("assets/js/columns/{$fileName}.js") }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/fixedColumns.min.js') }}"></script>
    <script src="{{ asset('global/js/data-tables.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fixedColumns.dataTables.min.css') }}">
@endpush

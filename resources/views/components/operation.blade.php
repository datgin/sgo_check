@if (Str::contains(request()->path(), 'bills'))
    @php
        $url = route('bills.certificate', [
            'phone' => auth()->user()->phone,
            'billId' => $row->id,
            'clientId' => $row->user_id,
        ]);
    @endphp
    <a class="btn btn-info btn-sm" href="{{ $url }}" target="_blank">
        <i class="fas fa-eye"></i>
    </a>
@endif

@isset($urlEdit)
    <a class="btn btn-primary btn-sm btn-edit" data-id="{{ $row->id }}" href="{{ $urlEdit }}">
        <i class="fas fa-edit"></i>
    </a>
@endisset

<a class="btn btn-sm btn-danger btn-delete" data-id="{{ $row->id }}">
    <i class="fas fa-trash"></i>
</a>

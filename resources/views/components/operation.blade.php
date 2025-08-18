@if (Str::contains(request()->path(), 'bills'))
    @php
        // Tạo token encode user ở đây hoặc controller truyền xuống
        $token = base64_encode(json_encode(auth()->user()));
        $url = route('bills.certificate', [
            'company' => Str::slug(auth()->user()->company),
            'bill' => $row->id,
            'token' => $token,
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

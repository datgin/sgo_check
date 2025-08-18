<div class="card">
    @if ($title)
        <div class="card-header">
            <h4 class="card-title mb-0 fw-semibold">{{ $title }}</h4>
        </div>
    @endif

    <div class="card-body {{ $class }}">
        {{ $slot }}
    </div>
</div>

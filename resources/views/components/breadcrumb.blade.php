<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb" class="py-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="/{{ Str::slug(auth()->user()->company) }}" class="text-uppercase">Home</a></li>
        @foreach ($items as $item)
            <li class="breadcrumb-item active text-uppercase" aria-current="page">
                @isset($item['url'])
                    <a href="{{ $item['url'] }}" class="text-uppercase"> {{ $item['label'] }}</a>
                @else
                    <span class="text-uppercase fw-bold">{{ $item['label'] }}</span>
                @endisset
            </li>
        @endforeach
        </li>
    </ol>
</nav>

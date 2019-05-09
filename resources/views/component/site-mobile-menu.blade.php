<li class="nav-item">
    <span class="nav-title">{{ $title }}</span>
</li>
@foreach ($items as $item)
<li class="nav-item">
    <a class="nav-link @if ($item['uri'] === $active) active @endif" href="{{ $item['uri'] }}" title="{{ $item['title'] }}">
        {{ $item['name'] }}
    </a>
</li>
@endforeach

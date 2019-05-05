<li class="nav-item">
    <span class="nav-title">{{ $title }}</span>
</li>
@foreach ($items as $item)
<li class="nav-item @if ($item['icon'] !== null)icon @endif @if ($item['uri'] === $active) active @endif">
    <a class="nav-link @if ($item['icon'] !== null)icon @endif" href="{{ $item['uri'] }}" title="{{ $item['title'] }}">
        @if ($item['icon'] !== null && $item['uri'] === $active)
        <img src="{{ asset('images/theme/' . $item['icon'] . '-on.png') }}" width="20" height="20" class="icon" alt="{{ $item['title'] }}" />
        @elseif ($item['icon'] !== null)
        <img src="{{ asset('images/theme/' . $item['icon'] . '.png') }}" width="20" height="20" class="icon" alt="{{ $item['title'] }}" />
        @endif
        {{ $item['name'] }}
    </a>
</li>
@endforeach

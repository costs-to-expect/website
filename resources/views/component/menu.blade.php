<li class="nav-item">
    <span class="nav-title">{{ $title }}</span>
</li>
@foreach ($items as $item)
<li class="nav-item @if ($item['image'] !== null)icon @endif @if ($item['uri'] === $actve) active @endif">
    <a class="nav-link" href="{{ $item['uri'] }}" title="{{ $item['title'] }}">
        @if ($item['icon'] !== null)
        <img src="{{ asset('images/theme/{{ $item['icon'] }}-on.png') }}" width="20" height="20" class="icon" alt="{{ $item['title']}}" />
        @endif
        {{ $item['name'] }}
    </a>
</li>

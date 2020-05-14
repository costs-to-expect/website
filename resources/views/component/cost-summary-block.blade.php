<div class="media summary-block shadow-sm h-100 @if ($active === true) active @endif">
    @if ($uri !== null)
    <a href="{{ $uri }}"><img src="{{ asset('images/theme/' . $icon) }}" class="mr-2" width="48" height="48" alt="icon" /></a>
    @else
    <img src="{{ asset('images/theme/' . $icon) }}" class="mr-2" width="48" height="48" alt="icon" />
    @endif
    <div class="media-body">
        <h4 class="mt-0">@if ($uri !== null && (float) $value !== 0.00)
            <a href="{{ $uri }}">{{ $heading }}</a>
            @else
            {{ $heading }}
            @endif
        </h4>
        <h6 class="mt-0">{{ $subheading }}
            <small class="text-muted">{{ $description }}</small>
        </h6>
        <p class="total mb-0">&pound;{{ number_format((float) $value, 2) }}</p>
    </div>
</div>

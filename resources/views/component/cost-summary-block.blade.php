<div class="media summary-block shadow-sm h-100">
    <img src="{{ asset('images/theme/' . $icon) }}" class="mr-2" width="48" height="48" alt="icon">
    <div class="media-body">
        <h4 class="mt-0">@if ($uri !== null)
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

<div class="p-1 assigned-filters">
    @foreach ($filters as $filter => $filter_data)
        @if ($filter_data['set'] !== null)
        <div class="assigned-filter">
            <a href="{{ $filter_data['uri'] }}">
                {{ $filter_data['values'][$filter_data['set']]['name'] }}
                <span class="badge badge-light">&times;</span>
            </a>
        </div>
        @endif
    @endforeach
</div>

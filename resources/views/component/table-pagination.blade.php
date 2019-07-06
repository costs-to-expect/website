<div class="table-pagination p-3">
    <div class="row">
        <div class="pages col-9 col-sm-10 col-xl-11">
            @if ($offset > 0)
            <a href="{{ $uri['base'] }}?offset={{ $offset - $limit }}&limit={{ $limit }}{{ $uri['parameters'] }}#expenses-table" class="btn btn-primary"><</a>
            @else
            <a class="btn btn-primary disabled"><</a>
            @endif
            <a class="btn btn-primary active">
                @if ($prefix !== null) <span class="d-none d-sm-inline">{{ $prefix }}</span> @endif
                {{ $offset + 1 }} to
                @if ($total > ($offset + $limit))
                {{ $offset + $limit }}
                @else
                {{ $total }}
                @endif
                of
                {{ $total }}
            </a>
            @if ($total > ($offset + $limit))
            <a href="{{ $uri['base'] }}?offset={{ $offset + $limit }}&limit={{ $limit }}{{ $uri['parameters'] }}#expenses-table" class="btn btn-primary">></a>
            @else
            <a class="btn btn-primary disabled">></a>
            @endif
        </div>
        <div class="per-page col-3 col-sm-2 col-xl-1">
            <form class="form-inline">
                <select class="form-control form-control-sm per-page" data-uri="{{ $uri['base'] }}">
                    @foreach ($limit_options as $option)
                    <option value="{{ $option }}" @if ($option === $limit) selected="selected" @endif>{{ $option }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
</div>

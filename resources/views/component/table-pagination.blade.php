<div class="table-pagination p-3">
    <div class="row">
        <div class="pages col-7 col-sm-10 col-xl-11">
            @if ($offset > 0)
            <a class="btn btn-primary disabled"><</a>
            @endif
            <a class="btn btn-primary active">
                @if ($prefix !== null){{ $prefix }} @endif
                @if ($current !== 0) {{ $current + 1 }} @else 1 @endif to
                @if ($total > ($current + $per_page))
                {{ $current + $per_page }}
                @else
                {{ $total }}
                @endif
            </a>
            @if ($total > ($current + $per_page))
            <a class="btn btn-primary">></a>
            @endif
        </div>
        <div class="per-page col-5 col-sm-2 col-xl-1">
            <form class="form-inline">
                <select class="form-control form-control-sm">
                    @foreach ($per_page_options as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
</div>

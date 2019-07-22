<form method="post" action="{{ $uri }}" class="filter-options">
    <div class="form-row">
        @foreach ($filters as $filter => $filter_data)
        @if ($filter !== 'term')
        <div class="{{ $filter_data['classes'] }}">
            <select name="{{ $filter }}" id="{{ $filter }}-expense-filter" title="{{ $filter_data['title'] }}" class="form-control" @if(count($filter_data['values']) === 0) disabled="disabled" @endif>
                <option value="" @if($filter_data['set'] === null)selected="selected"@endif>{{ $filter_data['name'] }}</option>
                @if (count($filter_data['values']) > 0)
                    @foreach ($filter_data['values'] as $value)
                        <option value="{{ $value['id'] }}" @if($filter_data['set'] == $value['id'])selected="selected"@endif>{{ $value['name'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        @endif
        @endforeach

        <div class="col-9 col-md-6 col-lg-3 col-xl-2 mb-2">
            <input name="term" type="text" class="form-control"  title="Search expenses by description" placeholder="Search description... " @if ($filters['term'] !== null) value="{{ $filters['term']['set'] }}"@else value=""@endif />
        </div>
        <div class="col-3 col-md-6 col-lg-9 col-xl-1 mb-2">
            <input type="hidden" name="offset" value="{{ $pagination['offset'] }}" />
            <input type="hidden" name="limit" value="{{ $pagination['limit'] }}" />
            <input type="hidden" name="child" value="{{ $child }}" />
            <button type="submit" class="btn btn-primary">Filter</button>
            {{ csrf_field() }}
        </div>
    </div>
</form>

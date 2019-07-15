<form method="post" action="{{ $uri }}" class="filter-options">
    <div class="form-row">
        @foreach ($filters as $filter => $filter_data)
        @if ($filter !== 'year')
        <div class="{{ $filter_data['classes'] }}">
            <select name="{{ $filter }}" id="{{ $filter }}-expense-filter" class="form-control">
                <option value="" @if($filter_data['set'] === null)selected="selected"@endif>{{ $filter_data['name'] }}</option>
                @foreach ($filter_data['values'] as $value)
                    <option value="{{ $value['id'] }}" @if($filter_data['set'] == $value['id'])selected="selected"@endif>{{ $value['name'] }}</option>
                @endforeach
            </select>
        </div>
        @else
        <div class="{{ $filter_data['classes'] }}">
            <select name="{{ $filter }}" id="{{ $filter }}-expense-filter" class="form-control">
                <option value="" @if($filter_data['set'] === null)selected="selected"@endif>{{ $filter_data['name'] }}</option>
                @foreach ($filter_data['values'] as $value)
                    <option value="{{ $value }}" @if($filter_data['set'] == $value)selected="selected"@endif>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        @endif
        @endforeach

        <div class="col-9 col-md-6 col-lg-3 col-xl-2 mb-2">
            <input type="text" class="form-control" placeholder="Search... " disabled="disabled" />
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

<table class="table table-borderless table-hover">
    <caption>{{ $caption }}</caption>
    <thead>
        <tr>
            <th scope="col">Expense</th>
            <th scope="col">Date</th>
            <th scope="col" class="d-none d-md-table-cell">Category</th>
            <th scope="col" class="d-none d-md-table-cell">Subcategory</th>
            <th scope="col" class="d-none d-xl-table-cell">Total</th>
            <th scope="col" class="d-none d-xl-table-cell">Allocation</th>
            <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
        <tr class="top">
            <td>{{ $expense['name'] }}</td>
            <td><span class="d-none d-md-block">{{ date('j M Y', strtotime($expense['effective_date'])) }}</span><span class="d-table-cell d-sm-block d-md-none">{{ date('d/m/Y', strtotime($expense['effective_date'])) }}</span></td>
            <td class="d-none d-md-table-cell">
                <span class="category">
                    @if ($expense['category'] !== null && array_key_exists('category_id', $expense['category']))
                    <a href="{{ $base_uri . '/expenses?category=' . $expense['category']['category_id'] }}">{{ $expense['category']['name'] }}</a>
                    @else
                    Not set
                    @endif
                </span>
            </td>
            <td class="d-none d-md-table-cell">
                <span class="category">
                    @if ($expense['category'] !== null && array_key_exists('category_id', $expense['category']) && $expense['subcategory'] !== null && array_key_exists('subcategory_id', $expense['subcategory']))
                    <a href="{{ $base_uri . '/expenses?category=' . $expense['category']['category_id'] . '&subcategory=' . $expense['subcategory']['subcategory_id'] }}">{{ $expense['subcategory']['name'] }}</a>
                    @else
                    Not set
                    @endif
                </span>
            </td>
            <td class="d-none d-xl-table-cell">£{{ $expense['total'] }}</td>
            <td class="d-none d-xl-table-cell">{{ $expense['percentage'] }}%</td>
            <td><strong>&pound;{{ $expense['actualised_total'] }}</strong></td>
        </tr>
        @endforeach
    </tbody>
</table>

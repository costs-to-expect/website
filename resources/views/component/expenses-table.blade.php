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
            <td class="d-none d-md-table-cell"><span class="category"><a href="{{ $base_uri . '/expenses?category=' . $expense['category']['id'] }}">{{ $expense['category']['name'] }}</a></span></td>
            <td class="d-none d-md-table-cell"><span class="category"><a href="{{ $base_uri . '/expenses?category=' . $expense['category']['id'] . '&subcategory=' . $expense['subcategory']['id'] }}">{{ $expense['subcategory']['name'] }}</a></span></td>
            <td class="d-none d-xl-table-cell">£{{ $expense['total'] }}</td>
            <td class="d-none d-xl-table-cell">{{ $expense['percentage'] }}%</td>
            <td><strong>&pound;{{ $expense['actualised_total'] }}</strong></td>
        </tr>
        @endforeach
    </tbody>
</table>

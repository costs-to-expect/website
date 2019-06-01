@extends('layouts.default', ['meta' => $meta, 'welcome' => $welcome])

@section('content')

<div class="row mt-4">
    <div class="col-12">
        <h4>Total expenses to date</h4>

        <p>Total expenses for each child to date, select a child to see further detail.</p>
    </div>
</div>
<div class="row">
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => '/jack',
            'heading' => $children['jack']['name'],
            'subheading' => 'Total Expenses',
            'description' => 'From birth, ' . $children['jack']['date_of_birth'],
            'value' => $children['jack']['total']
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => '/niall',
            'heading' => $children['niall']['name'],
            'subheading' => 'Total Expenses',
            'description' => 'From birth, ' . $children['niall']['date_of_birth'],
            'value' => $children['niall']['total']
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => null,
            'heading' => 'Blackborough Children',
            'subheading' => 'Total Expenses',
            'description' => 'For both our children',
            'value' => $children['niall']['total'] + $children['jack']['total']
        ]
    )
    <hr />
</div>
<div class="row mt-4">
    <div class="col-12">
        <h4>Expenses for current year (2019)</h4>

        <p>Sum of expenses for the current year, select to see the total for each year.</p>
    </div>
</div>
<div class="row">
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => '/jack/years',
            'heading' => 'Jack Blackborough',
            'subheading' => '2019',
            'description' => 'All expenses in 2019',
            'value' => '1121,19'
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => '/niall/years',
            'heading' => 'Niall Blackborough',
            'subheading' => '2019',
            'description' => 'All expenses in 2019',
            'value' => '484.42'
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => null,
            'heading' => 'Blackborough Children',
            'subheading' => '2019',
            'description' => 'All expenses in 2019',
            'value' => '1605.61'
        ]
    )
</div>
<div class="row">
    <div class="col-12">
        <hr />
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <h4>The 25 most recent expenses for both children</h4>

        <p>The table below lists the last 25 expenses we have logged for both children, to see more,
            select a child, any summary count or a category or subcategory.</p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="p-3 shadow-sm white-container">
            <table class="table table-borderless table-hover">
                <caption>25 most recent expenses</caption>
                <thead>
                    <tr>
                        <th scope="col">Child</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="d-none d-md-table-cell">Category</th>
                        <th scope="col" class="d-none d-md-table-cell">Subcategory</th>
                        <th scope="col" class="d-none d-xl-table-cell">Total</th>
                        <th scope="col" class="d-none d-xl-table-cell">Allocation</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent_expenses as $expense)
                    <tr class="top">
                        <td><a href="/{{ strtolower($expense['resource']['name']) }}">{{ $expense['resource']['name'] }}</a></td>
                        <td>{{ $expense['description'] }}</td>
                        <td><span class="d-none d-md-block">{{ date('j M Y', strtotime($expense['effective_date'])) }}</span><span class="d-table-cell d-sm-block d-md-none">{{ date('d/m/Y', strtotime($expense['effective_date'])) }}</span></td>
                        <td class="d-none d-md-table-cell"><span class="category">{{ $expense['category']['name'] }}</span></td>
                        <td class="d-none d-md-table-cell"><span class="category">{{ $expense['subcategory']['name'] }}</span></td>
                        <td class="d-none d-xl-table-cell">£{{ $expense['total'] }}</td>
                        <td class="d-none d-xl-table-cell">{{ $expense['percentage'] }}%</td>
                        <td><strong>&pound;{{ $expense['actualised_total'] }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include(
    'page-component.api-requests',
    [
        'api_requests' => $api_requests
    ]
)

@endsection

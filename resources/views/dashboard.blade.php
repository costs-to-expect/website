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
            'heading' => $jack_total['name'],
            'subheading' => 'Total Expenses',
            'description' => 'From birth, ' . $jack_total['dob'],
            'value' => $jack_total['total']
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => '/niall',
            'heading' => $niall_total['name'],
            'subheading' => 'Total Expenses',
            'description' => 'From birth, ' . $niall_total['dob'],
            'value' => $niall_total['total']
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => null,
            'heading' => 'The Blackboroughs',
            'subheading' => 'Total Expenses',
            'description' => 'For both our children',
            'value' => $jack_total['total'] + $niall_total['total']
        ]
    )
    <hr />
</div>
@if ($jack_current_year !== null && $niall_current_year !== null)
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
            'uri' => '/jack',
            'heading' => 'Jack Blackborough',
            'subheading' => date('Y'),
            'description' => 'All expenses in ' . date('Y'),
            'value' => ($jack_current_year !== null ? $jack_current_year : 0.00)
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => '/niall',
            'heading' => 'Niall Blackborough',
            'subheading' => date('Y'),
            'description' => 'All expenses in ' . date('Y'),
            'value' => ($niall_current_year !== null ? $niall_current_year : 0.00)
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => null,
            'heading' => 'The Blackboroughs',
            'subheading' => date('Y'),
            'description' => 'All expenses in ' . date('Y'),
            'value' => ($jack_current_year !== null ? $jack_current_year : 0.00) + ($niall_current_year !== null ? $niall_current_year : 0.00)
        ]
    )
</div>
<div class="row">
    <div class="col-12">
        <hr />
    </div>
</div>
@endif
@if ($recent_expenses !== null)
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
@endif

@include(
    'page-component.api-requests',
    [
        'api_requests' => $api_requests
    ]
)

@endsection

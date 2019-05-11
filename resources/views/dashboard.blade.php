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
            'heading' => 'Jack Blackborough',
            'subheading' => 'Total Expenses',
            'description' => 'From birth, 28th June 2013',
            'value' => '39.952.29'
        ]
    )
    @include(
        'component-container.cost-summary-block',
        [
            'icon' => 'expenses.png',
            'uri' => '/niall',
            'heading' => 'Niall Blackborough',
            'subheading' => 'Total Expenses',
            'description' => 'From birth, 22nd April 2019',
            'value' => '484.42'
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
            'value' => '40,435.71'
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
            'value' => '1,121,19'
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
            'value' => '1,605.61'
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
            select a child above.</p>
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
                <tr class="top">
                    <td>Jack</td>
                    <td>Easter egg</td>
                    <td><span class="d-none d-md-block">9th April 2019</span><span class="d-table-cell d-sm-block d-md-none">9/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Non-Essential</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Clothes, Food, Medicine etc.</span></td>
                    <td class="d-none d-xl-table-cell">£7.00</td>
                    <td class="d-none d-xl-table-cell">100%</td>
                    <td><strong>&pound;7.00</strong></td>
                </tr>
                <tr class="top">
                    <td>Jack</td>
                    <td>Share of shopping</td>
                    <td><span class="d-none d-md-block">12th April 2019</span><span class="d-table-cell d-sm-block d-md-none">12/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Essential</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Clothes, Food, Medicine etc.</span></td>
                    <td class="d-none d-xl-table-cell">£42.52</td>
                    <td class="d-none d-xl-table-cell">100%</td>
                    <td><strong>&pound;42.52</strong></td>
                </tr>
                <tr class="top">
                    <td>Jack</td>
                    <td>Share of pizza</td>
                    <td><span class="d-none d-md-block">12th April 2019</span><span class="d-table-cell d-sm-block d-md-none">12/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Essential</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Clothes, Food, Medicine etc.</span></td>
                    <td class="d-none d-xl-table-cell">£7.00</td>
                    <td class="d-none d-xl-table-cell">100%</td>
                    <td><strong>&pound;7.00</strong></td>
                </tr>
                <tr class="top">
                    <td>Niall</td>
                    <td>Mattress for Moses basket</td>
                    <td><span class="d-none d-md-block">5th April 2019</span><span class="d-table-cell d-sm-block d-md-none">5/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Essential</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Furniture</span></td>
                    <td class="d-none d-xl-table-cell">£12.38</td>
                    <td class="d-none d-xl-table-cell">100%</td>
                    <td><strong>&pound;12.38</strong></td>
                </tr>
                <tr class="top">
                    <td>...</td>
                    <td>...</td>
                    <td><span class="d-none d-md-block">...</span><span class="d-table-cell d-sm-block d-md-none">5/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">...</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">...</span></td>
                    <td class="d-none d-xl-table-cell">...</td>
                    <td class="d-none d-xl-table-cell">...</td>
                    <td><strong>...</strong></td>
                </tr>
                <tr class="top">
                    <td>Jack</td>
                    <td>Easter egg</td>
                    <td><span class="d-none d-md-block">9th April 2019</span><span class="d-table-cell d-sm-block d-md-none">9/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Non-Essential</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Clothes, Food, Medicine etc.</span></td>
                    <td class="d-none d-xl-table-cell">£7.00</td>
                    <td class="d-none d-xl-table-cell">100%</td>
                    <td><strong>&pound;7.00</strong></td>
                </tr>
                <tr class="top">
                    <td>Jack</td>
                    <td>Share of shopping</td>
                    <td><span class="d-none d-md-block">12th April 2019</span><span class="d-table-cell d-sm-block d-md-none">12/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Essential</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Clothes, Food, Medicine etc.</span></td>
                    <td class="d-none d-xl-table-cell">£42.52</td>
                    <td class="d-none d-xl-table-cell">100%</td>
                    <td><strong>&pound;42.52</strong></td>
                </tr>
                <tr class="top">
                    <td>Jack</td>
                    <td>Share of pizza</td>
                    <td><span class="d-none d-md-block">12th April 2019</span><span class="d-table-cell d-sm-block d-md-none">12/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Essential</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Clothes, Food, Medicine etc.</span></td>
                    <td class="d-none d-xl-table-cell">£7.00</td>
                    <td class="d-none d-xl-table-cell">100%</td>
                    <td><strong>&pound;7.00</strong></td>
                </tr>
                <tr class="top">
                    <td>Niall</td>
                    <td>Mattress for Moses basket</td>
                    <td><span class="d-none d-md-block">5th April 2019</span><span class="d-table-cell d-sm-block d-md-none">5/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Essential</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">Furniture</span></td>
                    <td class="d-none d-xl-table-cell">£12.38</td>
                    <td class="d-none d-xl-table-cell">100%</td>
                    <td><strong>&pound;12.38</strong></td>
                </tr>
                <tr class="top">
                    <td>...</td>
                    <td>...</td>
                    <td><span class="d-none d-md-block">...</span><span class="d-table-cell d-sm-block d-md-none">5/04/2019</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">...</span></td>
                    <td class="d-none d-md-table-cell"><span class="category">...</span></td>
                    <td class="d-none d-xl-table-cell">...</td>
                    <td class="d-none d-xl-table-cell">...</td>
                    <td><strong>...</strong></td>
                </tr>
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

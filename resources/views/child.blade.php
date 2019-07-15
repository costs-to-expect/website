@extends('layouts.default', ['meta' => $meta, 'welcome' => $welcome])

@section('content')

@include(
    'page-component.child-details',
    [
        'child_details' => $child_overview['child_details'],
        'total' => $child_overview['total'],
        'total_number_of_expenses' => $child_overview['total_number_of_expenses'],
        'largest_essential_expense' => $child_overview['largest_essential_expense'],
        'largest_non_essential_expense' => $child_overview['largest_non_essential_expense'],
        'largest_hobby_interest_expense' => $child_overview['largest_hobby_interest_expense']
    ]
)

@if ($categories_summary !== null)
<div class="row mt-4">
    <div class="col-12">
        <h4>Total expenses by category</h4>

        <p>We group expenses into three core categories, these are the totals for each category,
            select a category for more detail.</p>
    </div>
</div>
<div class="row">
    @foreach ($categories_summary as $category)
        @include(
            'component-container.cost-summary-block',
            [
                'icon' => 'expenses.png',
                'uri' => $active . '/expenses/category/' . $category['id'],
                'heading' => $category['name'],
                'subheading' => $category['description'],
                'description' => null,
                'value' => $category['total'],
                'active' => false
            ]
        )
    @endforeach
</div>
<div class="row">
    <div class="col-12">
        <hr />
    </div>
</div>
@endif
@if ($annual_summary !== null)
<div class="row mt-4">
    <div class="col-12">
        <h4>Expenses for the last three years</h4>

        <p>Total expenses for the last three years, select a year for additional detail including
            the ability to view all years.</p>
    </div>
</div>
<div class="row">
    @foreach ($annual_summary as $year)
        @include(
            'component-container.cost-summary-block',
            [
                'icon' => 'expenses.png',
                'uri' => $active . '/expenses/year/' . $year['year'],
                'heading' => $year['year'],
                'subheading' => 'Summary of all expenses for ' . $child_details['short_name'] . ' in ' . $year['year'],
                'description' => null,
                'value' => $year['total'],
                'active' => false
            ]
        )
    @endforeach
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
        <h4>The 25 most recent expenses for {{ $child_details['short_name'] }} <small> - <a href="{{ $child_details['uri'] . '/expenses' }}">(View all)</a></small></h4>

        <p>The table below lists the last 25 expenses we have logged for {{ $child_details['short_name'] }}, to see more select any
            summary count, category or subcategory.</p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="p-3 shadow-sm white-container">
            @include(
                'component.expenses-table',
                [
                    'caption' => '25 most recent expenses for ' . $child_details['short_name'],
                    'expenses' => $recent_expenses,
                    'base_uri' => $child_details['uri']
                ]
            )
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

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

@if ($annual_summary !== null)
<div class="row mt-4">
    <div class="col-12">
        <h4>Total expenses by year</h4>

        <p>Total expenses grouped by year for each year of {{ $child_details['short_name'] }}'s life.</p>
    </div>
</div>
<div class="row">
    @foreach ($annual_summary as $year)
        @include(
            'component-container.cost-summary-block',
            [
                'icon' => 'expenses.png',
                'uri' => '/jack/expenses/year/' . $year['year'],
                'heading' => $year['year'],
                'subheading' => 'Summary of all expenses for ' . $child_details['short_name'] .
                    ' in ' . $year['year'],
                'description' => null,
                'value' => $year['total'],
                'active' => ($active_year == $year['year'])
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

@if ($monthly_summary !== null)
<div class="row mt-4">
    <div class="col-12">
        <h4>Total expenses by month for {{ $active_year }}</h4>

        <p>Total expenses grouped by month for {{ $active_year }} of {{ $child_details['short_name'] }}'s life.</p>
    </div>
</div>
<div class="row">
    @foreach ($monthly_summary as $month)
        @include(
            'component-container.cost-summary-block',
            [
                'icon' => 'expenses.png',
                'uri' => '/jack/expenses/year/' . $active_year . '/month/' . $month['id'],
                'heading' => $month['month'] . ' ' . $active_year,
                'subheading' => 'Summary of all expenses for ' . $child_details['short_name'] .
                    ' in ' . $month['month'] . ' ' . $active_year,
                'description' => null,
                'value' => $month['total'],
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
        <h4>The 25 most recent expenses for {{ $child_details['short_name'] }} in {{ $active_year }} <small> - <a href="{{ $child_details['uri'] . '/expenses?year=' . $active_year }}">(View all {{ $active_year }} expenses)</a></small></h4>

        <p>The table below lists the last 25 expenses we have logged for {{ $child_details['short_name'] }} in {{ $active_year }},
            to see more select any summary count, year or month.</p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="p-3 shadow-sm white-container">
            @include(
                'component.expenses-table',
                [
                    'caption' => '25 most recent ' . $active_year . ' expenses for ' . $child_details['short_name'],
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

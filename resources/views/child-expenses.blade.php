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

@if ($expenses !== null)
<div class="row mt-4">
    <div class="col-12" id="expenses-table">
        <h4>All expenses for {{ $child_details['short_name'] }}</h4>

        <p>The table below lists all the expenses assigned to {{ $child_details['short_name'] }},
            filter and search the data using the options below.</p>
    </div>
</div>
<div class="row">
    <div class="col-12">

        @include(
            'component.filters',
            [
                'uri' => $child_details['uri'] . '/expenses',
                'filters' => $filters,
                'pagination' => $pagination,
                'child' => $child_details['uri']
            ]
        )

        @include('component.assigned-filters', $filters)

        @if (count($expenses) > 0)

            @include(
                'laravel-view-helpers::pagination',
                [
                    'offset' => $pagination['offset'],
                    'total' => $pagination['total'],
                    'limit' => $pagination['limit'],
                    'limit_options' => [
                        50,
                        100,
                        250
                    ],
                    'uri' => [
                        'base' => $pagination['uri']['base'],
                        'parameters' => $pagination['uri']['parameters'],
                        'anchor' => $pagination['uri']['anchor']
                    ],
                    'count_prefix' => 'Expenses',
                    'css_classes' => [
                        'left' => ' col-9 col-sm-10 col-xl-11',
                        'right' => ' col-3 col-sm-2 col-xl-1'
                    ]
                ]
            )

            <div class="p-3 shadow-sm white-container">
                @include(
                    'component.expenses-table',
                    [
                        'caption' => 'All expenses for ' . $child_details['short_name'],
                        'expenses' => $expenses,
                        'base_uri' => $child_details['uri']
                    ]
                )
            </div>
        @else
            <div class="alert alert-info" role="alert">
                There are no listed expenses for {{ $child_details['short_name'] }} with the set filters.
            </div>
        @endif
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

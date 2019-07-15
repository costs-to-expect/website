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
                <table class="table table-borderless table-hover">
                    <caption>All expenses for {{ $child_details['name'] }}</caption>
                    <thead>
                        <tr>
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
                        @foreach ($expenses as $expense)
                        <tr class="top">
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

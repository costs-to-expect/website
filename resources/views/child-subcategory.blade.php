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
    <div class="col-12" id="categories">
        <h4>Total expenses by category</h4>

        <p>We group expenses into three core categories, these are the totals for each category,
            select a category for more detail.</p>
    </div>
</div>
<div class="row">
    @foreach ($categories_summary as $category_id => $category)
        @include(
            'component-container.cost-summary-block',
            [
                'icon' => 'expenses.png',
                'uri' => $active . '/expenses/category/' . $category['id'] . '#subcategories',
                'heading' => $category['name'],
                'subheading' => $category['description'],
                'description' => null,
                'value' => $category['total'],
                'active' => ($category_id === $active_category_id)
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

@if ($subcategories_summary !== null)
<div class="row mt-4">
    <div class="col-12" id="subcategories">
        <h4>Total expenses by subcategory</h4>

        <p>These are the totals for all the subcategories in the
            {{ $active_category_name }} category, select a subcategory for
            more detail.</p>
    </div>
</div>
<div class="row">
    @if (count($subcategories_summary) > 0)
        @foreach ($subcategories_summary as $subcategory)
            @include(
                'component-container.cost-summary-block',
                [
                    'icon' => 'expenses.png',
                    'uri' => $active . '/expenses/category/' . $active_category_id . '/subcategory/' . $subcategory['id'] . '#expenses-table',
                    'heading' => $subcategory['name'],
                    'subheading' => $subcategory['description'] . ' expenses',
                    'description' => null,
                    'value' => $subcategory['total'],
                    'active' => ($subcategory['id'] === $active_subcategory_id)
                ]
            )
        @endforeach
    @else
    <div class="col-12">
        <div class="alert alert-info" role="alert">
            There are no listed expenses for {{ $child_details['short_name'] }} in
                the {{ $active_category_name }} category.
        </div>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-12">
        <hr />
    </div>
</div>
@endif

@if ($recent_expenses !== null)
<div class="row mt-4">
    <div class="col-12" id="expenses-table">
        <h4>The 25 most recent {{ $active_category_name . '/' . $active_subcategory_name }} expenses for
            {{ $child_details['short_name'] }} <small> - <a href="{{ $child_details['uri'] . '/expenses?category=' . $active_category_id . '&subcategory=' . $active_subcategory_id . '#expenses-table' }}">(View all {{ $active_category_name . '/' . $active_subcategory_name }} expenses)</a></small></h4>

        <p>The table below lists the last 25 expenses we have logged for
            {{ $child_details['short_name'] }} in the {{ $active_category_name }} category,
            to see more select any summary count, category or subcategory.</p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @if (count($recent_expenses) > 0)
        <div class="p-3 shadow-sm white-container">
            @include(
                'component.expenses-table',
                [
                    'caption' => '25 most recent ' . $active_category_name . '/' . $active_subcategory_name . ' expenses for ' . $child_details['short_name'],
                    'expenses' => $recent_expenses,
                    'base_uri' => $child_details['uri']
                ]
            )
        </div>
        @else
        <div class="alert alert-info" role="alert" id="expenses-table">
            There are no listed expenses for {{ $child_details['short_name'] }} in
                the {{ $active_category_name }} category.
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

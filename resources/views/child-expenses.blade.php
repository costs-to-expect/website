@extends('layouts.default', ['meta' => $meta, 'welcome' => $welcome])

@section('content')

<div class="row mb-3">
    <div class="col-md-3 col-lg-4 col-sm-6 col-12">
        <img src="{{ asset($child_details['image_uri']) }}" class="img-fluid rounded mx-auto d-block" alt="icon">
    </div>
    <div class="col-md-9 col-lg-8 col-sm-6 col-12">
        <div class="detail-page-intro">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h5>Name</h5>
                    <p class="sub-heading text-muted d-none d-md-block">What did we call him?</p>
                    <p class="data">{{ $child_details['name'] }}</p>
                    <h5>Born</h5>
                    <p class="sub-heading text-muted d-none d-md-block">When did he emerge?</p>
                    <p class="data">{{ $child_details['dob'] }}</p>
                    <h5>Sex & Birth weight</h5>
                    <p class="sub-heading text-muted d-none d-md-block">What were his vital statistics?</p>
                    <p class="data">{{ $child_details['sex'] }} & {{ $child_details['weight'] }}</p>
                    <h5>Total expenses</h5>
                    <p class="sub-heading text-muted d-none d-md-block">How much to raise {{ $child_details['short_name'] }}?</p>
                    <p class="data">&pound;{{ number_format((float) $total, 2) }}</p>
                </div>
                <div class="col-md-6 col-12">
                    <h5>Number of expenses</h5>
                    <p class="sub-heading text-muted d-none d-md-block">How many purchases have we made?</p>
                    <p class="data">{{ $number_of_expenses }}</p>
                    @if ($largest_non_essential_expense !== null)
                        <h5>Top Non-Essential expense</h5>
                        <p class="sub-heading text-muted d-none d-md-block">The grandest expense?</p>
                        <p class="data">&pound;{{ number_format((float) $largest_non_essential_expense['actualised_total'], 2) }} <small>({{ $largest_non_essential_expense['description'] }})</small></p>
                    @endif
                    @if ($largest_essential_expense !== null)
                        <h5>Top Essential expense</h5>
                        <p class="sub-heading text-muted d-none d-md-block">The grandest expense?</p>
                        <p class="data">&pound;{{ number_format((float) $largest_essential_expense['actualised_total'], 2) }} <small>({{ $largest_essential_expense['description'] }})</small></p>
                    @endif
                    @if ($largest_hobby_interest_expense !== null)
                        <h5>Top Hobby and Interests expense</h5>
                        <p class="sub-heading text-muted d-none d-md-block">The grandest expense?</p>
                        <p class="data">&pound;{{ number_format((float) $largest_hobby_interest_expense['actualised_total'], 2) }} <small>({{ $largest_hobby_interest_expense['description'] }})</small></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <hr />
    </div>
</div>

@if ($expenses !== null)
<div class="row mt-4">
    <div class="col-12">
        <h4>The 25 most recent {{ $active_category_name }} expenses for
            {{ $child_details['short_name'] }}</h4>

        <p>The table below lists the last 25 expenses we have logged for
            {{ $child_details['short_name'] }} in the {{ $active_category_name }} category,
            to see more select any summary count, category or subcategory.</p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @if (count($expenses) > 0)
        <div class="p-3 shadow-sm white-container">
            <table class="table table-borderless table-hover">
                <caption>25 most recent expenses</caption>
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
                    @foreach ($recent_expenses as $expense)
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
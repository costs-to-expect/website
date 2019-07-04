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
                    <p class="data">{{ $number_of_expenses }} <small><a href="{{ $child_details['uri'] }}/expenses">(View all)</a></small></p>
                    @if ($largest_essential_expense !== null)
                        <h5>Top Essential expense</h5>
                        <p class="sub-heading text-muted d-none d-md-block">The grandest expense?</p>
                        <p class="data">&pound;{{ number_format((float) $largest_essential_expense['actualised_total'], 2) }} <small>({{ $largest_essential_expense['description'] }})</small></p>
                    @endif
                    @if ($largest_non_essential_expense !== null)
                        <h5>Top Non-Essential expense</h5>
                        <p class="sub-heading text-muted d-none d-md-block">The grandest expense?</p>
                        <p class="data">&pound;{{ number_format((float) $largest_non_essential_expense['actualised_total'], 2) }} <small>({{ $largest_non_essential_expense['description'] }})</small></p>
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
        <h4>All expenses for {{ $child_details['short_name'] }}</h4>

        <p>The table below lists all the expenses assigned to {{ $child_details['short_name'] }},
            filter the table using the options below or by clicking on a category or subcategory in the
            table.</p>
    </div>
</div>
<div class="row">
    <div class="col-12" id="expenses-data">
        @if (count($expenses) > 0)
        <form method="post" action="{{ $child_details['uri'] . '/expenses' }}" class="filter-options">
            <div class="form-row">
                <div class="col-6 col-md-4 col-lg-4 col-xl-2 mb-2">
                    <select name="category" id="category-expense-filter" class="form-control">
                        <option value="" @if($filters['category']['set'] === null)selected="selected"@endif>Category</option>
                        @foreach ($filters['category']['values'] as $category)
                            <option value="{{ $category['id'] }}" @if($filters['category']['set'] === $category['id'])selected="selected"@endif>{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-3 col-lg-4 col-xl-3 mb-2">
                    <select name="subcategory" id="subcategory-expense-filter" class="form-control" @if(count($filters['subcategory']['values']) === 0)disabled="disabled"@endif>
                        <option value="" @if($filters['subcategory']['set'] === null)selected="selected"@endif>Subcategory</option>
                        @foreach ($filters['subcategory']['values'] as $subcategory)
                            <option value="{{ $subcategory['id'] }}" @if($filters['subcategory']['set'] === $subcategory['id'])selected="selected"@endif>{{ $subcategory['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-2 col-lg-2 col-xl-2 mb-2">
                    <select name="year" class="form-control">
                        <option value="" @if($filters['year']['set'] === null)selected="selected"@endif>Year</option>
                        @foreach ($filters['year']['values'] as $year)
                            <option value="{{ $year }}" @if($filters['year']['set'] == $year)selected="selected"@endif>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-3 col-lg-2 col-xl-2 mb-2">
                    <select name="month" class="form-control">
                        <option value="" @if($filters['month']['set'] === null)selected="selected"@endif>Month</option>
                        @foreach ($filters['month']['values'] as $month)
                            <option value="{{ $month['id'] }}" @if($filters['month']['set'] == $month['id'])selected="selected"@endif>{{ $month['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-9 col-md-6 col-lg-3 col-xl-2 mb-2">
                    <input type="text" class="form-control" placeholder="Search... " disabled="disabled" />
                </div>
                <div class="col-3 col-md-6 col-lg-9 col-xl-1 mb-2">
                    <input type="hidden" name="offset" value="{{ $pagination['offset'] }}" />
                    <input type="hidden" name="limit" value="{{ $pagination['limit'] }}" />
                    <input type="hidden" name="child" value="{{ $child_details['uri'] }}" />
                    <button type="submit" class="btn btn-primary">Filter</button>
                    {{ csrf_field() }}
                </div>
            </div>
        </form>

        <div class="p-1 assigned-filters">
            <div class="assigned-filter"><a href="">Category <span class="badge badge-light">&times;</span></a></div>
            <div class="assigned-filter"><a href="">Subcategory <span class="badge badge-light">&times;</span></a></div>
            <div class="assigned-filter"><a href="">Year <span class="badge badge-light">&times;</span></a></div>
            <div class="assigned-filter"><a href="">Month <span class="badge badge-light">&times;</span></a></div>
            <!--<div class="assigned-filter"><a href="">Search: "term" <span class="badge badge-light">&times;</span></a></div>-->
        </div>

        <hr />

        @include(
            'component.table-pagination',
            [
                'prefix' => 'Expenses',
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
                    'parameters' => $pagination['uri']['parameters']
                ]
            ]
        )

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
            There are no listed expenses for {{ $child_details['short_name'] }}.
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

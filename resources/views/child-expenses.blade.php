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
        <h4>All expenses for {{ $child_details['short_name'] }}</h4>

        <p>The table below lists all the expenses assigned to {{ $child_details['short_name'] }},
            filter the table using the options below or by clicking on a category or subcategory in the
            table.</p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @if (count($expenses) > 0)

        <form class="filter-options">
            <div class="form-row">
                <div class="col-6 col-md-4 col-lg-4 col-xl-2 mb-2">
                    <select class="form-control">
                        <option value="" selected="selected">Category</option>
                        <option value="" selected="selected">Essentials</option>
                        <option value="" selected="selected">Non-Essentials</option>
                        <option value="" selected="selected">Hobbies & Interests</option>
                    </select>
                </div>
                <div class="col-6 col-md-3 col-lg-4 col-xl-3 mb-2">
                    <select class="form-control" disabled>
                        <option value="" selected="selected">Subcategory</option>
                    </select>
                </div>
                <div class="col-6 col-md-2 col-lg-2 col-xl-2 mb-2">
                    <select class="form-control">
                        <option value="" selected="selected">Year</option>
                        <option value="" selected="selected">2019</option>
                        <option value="" selected="selected">2018</option>
                        <option value="" selected="selected">2017</option>
                        <option value="" selected="selected">2016</option>
                        <option value="" selected="selected">2015</option>
                        <option value="" selected="selected">2014</option>
                        <option value="" selected="selected">2013</option>
                    </select>
                </div>
                <div class="col-6 col-md-3 col-lg-2 col-xl-2 mb-2">
                    <select class="form-control" disabled>
                        <option value="" selected="selected">Month</option>
                        <option value="" selected="selected">January</option>
                        <option value="" selected="selected">February</option>
                        <option value="" selected="selected">March</option>
                        <option value="" selected="selected">April</option>
                        <option value="" selected="selected">May</option>
                        <option value="" selected="selected">June</option>
                        <option value="" selected="selected">July</option>
                        <option value="" selected="selected">August</option>
                        <option value="" selected="selected">September</option>
                        <option value="" selected="selected">October</option>
                        <option value="" selected="selected">November</option>
                        <option value="" selected="selected">December</option>
                    </select>
                </div>
                <div class="col-9 col-md-6 col-lg-3 col-xl-2 mb-2">
                    <input type="text" class="form-control" placeholder="Search... " />
                </div>
                <div class="col-3 col-md-6 col-lg-9 col-xl-1 mb-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <hr />

        <p class="assigned-filters">
            <button type="button" class="btn btn-primary mb-1">
                Category <span class="badge badge-light">X</span>
            </button>
            <button type="button" class="btn btn-primary mb-1">
                Subcategory <span class="badge badge-light">&times;</span>
            </button>
            <button type="button" class="btn btn-primary mb-1">
                Year <span class="badge badge-light">&times;</span>
            </button>
            <button type="button" class="btn btn-primary mb-1">
                Month <span class="badge badge-light">&times;</span>
            </button>
            <button type="button" class="btn btn-primary mb-1">
                Search: "term" <span class="badge badge-light">&times;</span>
            </button>
        </p>

        <hr />

        @include(
            'component.table-pagination',
            [
                'prefix' => 'Expenses',
                'offset' => 0,
                'total' => 100,
                'limit' => 25,
                'limit_options' => [
                    25,
                    50,
                    100
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

        @include(
            'component.table-pagination',
            [
                'prefix' => 'Expenses',
                'offset' => 0,
                'total' => 100,
                'limit' => 25,
                'limit_options' => [
                    25,
                    50,
                    100
                ]
            ]
        )

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

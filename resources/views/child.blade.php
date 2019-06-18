<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('images/theme/favicon.ico') }}">
        <link rel="icon" sizes="16x16 32x32 64x64" href="{{ asset('images/theme/favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('images/theme/favicon-192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/theme/favicon-180.png') }}">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="{{ asset('images/theme/favicon-144.png') }}">
        <title>Jack: Costs to Expect</title>
    </head>
    <body>
        <div class="container-fluid container-cte">
            <div class="row container-row">
                <div class="col-xl-2 col-lg-3 col-md-3 container-column container-left d-none d-sm-none d-md-block sticky-top">
                    <div class="logo">
                        <a href="/"><img src="{{ asset('images/theme/logo-190.png') }}" width="64" height="64" alt="Logo" title="Costs to Expect" /></a>
                    </div>
                    <ul class="nav flex-column">
                        @include(
                            'component.site-menu',
                            [
                                'title' => $menus['children']['title'],
                                'active' => $uri,
                                'items' => $menus['children']['items']
                            ]
                        )
                    </ul>
                    <ul class="nav flex-column mt-5">
                        @include(
                            'component.site-menu',
                            [
                                'title' => $menus['site']['title'],
                                'active' => $uri,
                                'items' => $menus['site']['items']
                            ]
                        )
                    </ul>
                </div>
                <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 col-12 container-column container-right d-block">
                    <nav class="navbar navbar-light d-md-none">
                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('images/theme/logo.png') }}" width="30" height="30" class="d-inline-block align-middle" alt=""><span class="d-none">C</span>osts to Expect.com
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                @include(
                                    'component.site-mobile-menu',
                                    [
                                        'title' => $menus['children']['title'],
                                        'active' => $uri,
                                        'items' => $menus['children']['items']
                                    ]
                                )
                                @include(
                                    'component.site-mobile-menu',
                                    [
                                        'title' => $menus['site']['title'],
                                        'active' => $uri,
                                        'items' => $menus['site']['items']
                                    ]
                                )
                            </ul>
                        </div>
                    </nav>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="screen-intro">
                                <div class="icon">
                                    <img src="{{ asset('images/theme/dashboard.png') }}" width="50" height="50" alt="Screen icon" title="Dashboard" />
                                </div>
                                <div class="welcome">
                                    <small class="text-muted">{{ $child_details['version'] }}</small>
                                </div>
                                <div class="title">
                                    <h1>{{ $child_details['name'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        @if ($largest_non_essential_expense !== null)
                                            <h5>Top Non-Essential expense</h5>
                                            <p class="sub-heading text-muted d-none d-md-block">The grandest expense?</p>
                                            <p class="data">&pound;{{ number_format((float) $largest_non_essential_expense['actualised_total'], 2) }} <small>({{ $largest_non_essential_expense['description'] }})</small></p>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h5>Total expenses</h5>
                                        <p class="sub-heading text-muted d-none d-md-block">How much to raise {{ $child_details['short_name'] }}?</p>
                                        <p class="data">&pound;{{ number_format((float) $total, 2) }}</p>
                                        <h5>Number of expenses</h5>
                                        <p class="sub-heading text-muted d-none d-md-block">How many purchases?</p>
                                        <p class="data">{{ $number_of_expenses }}</p>
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
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">{{ $category['name'] }}</h4>
                                    <h6 class="mt-0">{{ $category['description'] }}</h6>
                                    <p class="total mb-0">&pound;{{ number_format((float) $category['total'], 2) }}</p>
                                </div>
                            </div>
                        </div>
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
                            <h4>Expenses for the last three years <!-- - <small><a href="/jack/years">View all years</a></small>--></h4>

                            <p>Total expenses for the last three years<!--, select all years for a complete listing-->.</p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($annual_summary as $year)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">{{ $year['year'] }}</h4>
                                    <h6 class="mt-0">All expenses for {{ $year['year'] }}</h6>
                                    <p class="total mb-0">&pound;{{ number_format((float) $year['total'], 2) }}</p>
                                </div>
                            </div>
                        </div>
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
                            <h4>The 25 most recent expenses for {{ $child_details['short_name'] }}</h4>

                            <p>The table below lists the last 25 expenses we have logged for {{ $child_details['short_name'] }}, to see more select any
                                summary count, category or subcategory.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr />
                        </div>
                    </div>
                    @endif

                    @include(
                        'page-component.api-requests',
                        [
                            'api_requests' => $api_requests
                        ]
                    )

                    <div class="row mt-5 mb-5">
                        <div class="col-12">
                            <p class="text-center text-muted footer">
                                <a href="https://www.costs-to-expect.com">Costs to Expect</a> Copyright &copy; <a href="https://www.deanblackborough.com">{{ $config['copyright'] }}</a><br />
                                <a href="{{ $config['api-link'] }}">Costs to Expect API</a> | <a href="/changelog">Changelog</a><br />
                                <small>{{ $config['release'] }} released {{ $config['date'] }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('node_modules/jquery/dist/jquery.js') }}" defer></script>
        <script src="{{ asset('node_modules/popper.js/dist/umd/popper.js') }}" defer></script>
        <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.js') }}" defer></script>
    </body>
</html>

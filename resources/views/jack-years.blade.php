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
        <title>Dashboard: Costs to Expect</title>
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
                                'active' => $active,
                                'items' => $menus['children']['items']
                            ]
                        )
                    </ul>
                    <ul class="nav flex-column mt-5">
                        @include(
                            'component.site-menu',
                            [
                                'title' => $menus['site']['title'],
                                'active' => $active,
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
                                        'active' => $active,
                                        'items' => $menus['children']['items']
                                    ]
                                )
                                @include(
                                    'component.site-mobile-menu',
                                    [
                                        'title' => $menus['site']['title'],
                                        'active' => $active,
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
                                    <small class="text-muted">Our first child</small>
                                </div>
                                <div class="title">
                                    <h1>Jack Blackborough - Total per year</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-lg-4 col-sm-6 col-12">
                            <img src="{{ asset('images/theme/jack.jpg') }}" class="img-fluid rounded mx-auto d-block" alt="icon">
                        </div>
                        <div class="col-md-9 col-lg-8 col-sm-6 col-12">
                            <div class="detail-page-intro">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h5>Name</h5>
                                        <p class="sub-heading text-muted d-none d-md-block">What did we call him?</p>
                                        <p class="data">Jack Blackborough</p>
                                        <h5>Born</h5>
                                        <p class="sub-heading text-muted d-none d-md-block">When did he emerge?</p>
                                        <p class="data">28th June 2013 at 05:41</p>
                                        <h5>Sex & Birth weight</h5>
                                        <p class="sub-heading text-muted d-none d-md-block">What are his vital statistics?</p>
                                        <p class="data">Male & 7lb 7oz</p>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h5>Total expenses</h5>
                                        <p class="sub-heading text-muted d-none d-md-block">How much to raise Jack?</p>
                                        <p class="data">&pound;40,000</p>
                                        <h5>Number of expenses</h5>
                                        <p class="sub-heading text-muted d-none d-md-block">How many purchases?</p>
                                        <p class="data">1,000</p>
                                        <h5>Largest expense</h5>
                                        <p class="sub-heading text-muted d-none d-md-block">The grandest expense?</p>
                                        <p class="data">&pound;1,000 <small>(Baptism)</small></p>
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
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Expenses by year</h4>

                            <p>These are the totals for each year, select a year to see all the expenses for the selected year.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">2013</h4>
                                    <h6 class="mt-0">All expenses for 2013</h6>
                                    <p class="total mb-0">&pound;3,153.45</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">2014</h4>
                                    <h6 class="mt-0">All expenses for 2014</h6>
                                    <p class="total mb-0">&pound;5,706.38</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">2015</h4>
                                    <h6 class="mt-0">All expenses for 2015</h6>
                                    <p class="total mb-0">&pound;8,253.82</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">2016</h4>
                                    <h6 class="mt-0">All expenses for 2016</h6>
                                    <p class="total mb-0">&pound;10,900.24</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">2017</h4>
                                    <h6 class="mt-0">All expenses for 2017</h6>
                                    <p class="total mb-0">&pound;6,803.51</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">2018</h4>
                                    <h6 class="mt-0">All expenses for 2018</h6>
                                    <p class="total mb-0">&pound;4,012.70</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="margin-bottom: 1rem;">
                            <div class="media summary-block shadow-sm h-100">
                                <img src="{{ asset('images/theme/expenses.png') }}" class="mr-2" width="48" height="48" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">2019</h4>
                                    <h6 class="mt-0">All expenses for 2019</h6>
                                    <p class="total mb-0">&pound;1,251.38</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr />
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Jack's expenses for 2019 - <small class="text-muted">1000 results</small></h4>

                            <p>The table below lists all the expenses we logged for Jack in 2019.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-pagination p-3">
                                <div class="row">
                                    <div class="pages col-7 col-sm-10 col-xl-11"><a class="btn btn-primary disabled"><</a> <a class="btn btn-primary d-none d-sm-inline-block">1</a> <a class="btn btn-primary active">2</a> <a class="btn btn-primary d-none d-sm-inline-block">3</a> <a class="btn btn-primary">></a></div>
                                    <div class="per-page col-5 col-sm-2 col-xl-1"><form class="form-inline"><select class="form-control form-control-sm"><option>100</option></select></form></div>
                                </div>
                            </div>
                            <div class="p-3 shadow-sm white-container">
                                <table class="table table-borderless table-hover">
                                    <caption>Expenses for 2019</caption>
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
                    <div class="row">
                        <div class="col-12">
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4>API Requests</h4>

                            <p>This page was generated using the data returned from the following API requests.</p>

                            <div class="p-3 shadow-sm white-container">
                                <table class="table table-borderless table-sm api-requests">
                                    <caption>API Requests to https://api.costs-to-expect.com</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Page section</th>
                                            <th scope="col">API request</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="top">
                                            <td>1</td>
                                            <td>Total for Jack</td>
                                            <td>/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items</td>
                                        </tr>
                                        <tr class="top">
                                            <td>2</td>
                                            <td>Total for Niall</td>
                                            <td>/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items</td>
                                        </tr>
                                        <tr class="top">
                                            <td>3</td>
                                            <td>Total for Blackborough Children</td>
                                            <td>/v1/summary/resource-types/d185Q15grY/items</td>
                                        </tr>
                                        <tr class="top">
                                            <td>4</td>
                                            <td>2019 Total for Jack</td>
                                            <td>/v1/summary/resource-types/d185Q15grY/resources/kw8gLq31VB/items?years=2019</td>
                                        </tr>
                                        <tr class="top">
                                            <td>5</td>
                                            <td>2019 Total for Niall</td>
                                            <td>/v1/summary/resource-types/d185Q15grY/resources/Eq9g6BgJL0/items?years=2019</td>
                                        </tr>
                                        <tr class="top">
                                            <td>6</td>
                                            <td>2019 Total for Blackborough Children</td>
                                            <td>/v1/summary/resource-types/d185Q15grY/items?year=2019</td>
                                        </tr>
                                        <tr class="top">
                                            <td>7</td>
                                            <td>25 most recent expenses</td>
                                            <td>/v1/resource-types/d185Q15grY/items?limit=25&amp;show-categories=true&show-subcategories=true</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

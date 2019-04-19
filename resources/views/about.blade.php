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
                        <li class="nav-item">
                            <span class="nav-title">Costs to Expect</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/changelog">Changelog</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 col-12 container-column container-right d-block">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="screen-intro">
                                <div class="icon">
                                    <img src="{{ asset('images/theme/logo.png') }}" width="50" height="50" alt="Screen icon" title="Dashboard" />
                                </div>
                                <div class="welcome">
                                    <small class="text-muted">Costs to Expect.com</small>
                                </div>
                                <div class="title">
                                    <h1>About</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row content mt-5">
                        <div class="col-12">
                            <h2>In short</h2>

                            <p>Costs to Expect is a service which will allow tracking and forecasting of any expenses, be
                                they the costs to raise a child to the age of 18 or your Business account budget for the
                                next financial year.</p>

                            <p>The public side of Costs to Expect tracks the expenses involved in raising a child to the
                                age of 18 in the UK.</p>

                            <hr />

                            <h2>The public site</h2>

                            <h3>What does it cost to raise a child in the UK?</h3>

                            <p>Costs to Expect is a long-term project, my wife and I are tracking the
                                expenses to raise our child to adulthood, 18.</p>

                            <h3>Why?</h3>

                            <p>There are two core reasons as to why we have chosen to do this. I love data, the more then
                                better, and, for as long I remember, it appears to have become accepted knowledge that
                                it costs around £250,000 to raise a child in the UK.</p>

                            <p>If you think about the number, it becomes apparent quickly that it just can't be correct for
                                the majority of the UK, on average over £10k a year?</p>

                            <hr />

                            <h2>The service</h2>

                            <h3>Budgeting and Forecasting</h3>

                            <p>In addition to tracking historic costs the Costs to Expect service will include
                                forecasting and budgeting tools, more details will be provided as the service expands,
                                we have exciting plans for 2019 and 2020, we look forward to releasing the first version
                                of the service before the year is out.</p>

                            <p class="text-muted text-right">The Costs to Expect Team</p>
                            <p class="text-muted small text-right">April 2019</p>
                        </div>
                    </div>
                    <div class="row mt-5 mb-5">
                        <div class="col-12">
                            <p class="text-center text-muted footer">
                                <a href="https://www.costs-to-expect.com">Costs to Expect</a> Copyright &copy; <a href="https://www.deanblackborough.com">Dean Blackborough 2018-2019</a><br />
                                <a href="https://api.costs-to-expect.com">Costs to Expect API</a> | <a class="disabled" href="/changelog">Changelog</a><br />
                                <small>v1.00.0 released xxth April 2019</small>
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

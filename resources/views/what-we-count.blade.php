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
        <title>About: Costs to Expect</title>
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
                            <span class="nav-title">The Blackborough Children</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link icon" href="/"><img src="{{ asset('images/theme/icon-dashboard.png') }}" width="20" height="20" class="icon" alt="Dashboard" />  Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link icon" href="/jack"><img src="{{ asset('images/theme/icon-expenses.png') }}" width="20" height="20" class="icon" alt="Jack" /> Jack</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link icon" href="/niall"><img src="{{ asset('images/theme/icon-expenses.png') }}" width="20" height="20" class="icon" alt="Niall" /> Niall</a>
                        </li>
                    </ul>
                    <ul class="nav flex-column mt-5">
                        <li class="nav-item">
                            <span class="nav-title">Costs to Expect</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/what-we-count">What we count?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/changelog">Changelog</a>
                        </li>
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
                                <li class="nav-item">
                                    <span class="nav-title">Blackborough Children</span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/jack">Jack</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/niall">Niall</a>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-title">Costs to Expect</span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/what-we-count">What we count?</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/changelog">Changelog</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="screen-intro">
                                <div class="icon">
                                    <img src="{{ asset('images/theme/info.png') }}" width="50" height="50" alt="Screen icon" title="Dashboard" />
                                </div>
                                <div class="welcome">
                                    <small class="text-muted">How do we arrive at the figures?</small>
                                </div>
                                <div class="title">
                                    <h1>What we count?</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row content mt-3">
                        <div class="col-12">
                            <h2>What expenses do we count?</h2>

                            <p>As much as we feel make sense, </p>

                            <hr />

                            <h2>What do we exclude?</h2>

                            <p></p>

                            <hr />

                            <h2>Other questions</h2>

                            <h3>Share of shopping?</h3>

                            <p></p>

                        </div>
                    </div>
                    <div class="row mt-5 mb-5">
                        <div class="col-12">
                            <p class="text-center text-muted footer">
                                <a href="https://www.costs-to-expect.com">Costs to Expect</a> Copyright &copy; <a href="https://www.deanblackborough.com">Dean Blackborough 2018-2019</a><br />
                                <a href="https://api.costs-to-expect.com">Costs to Expect API</a> | <a class="disabled" href="/changelog">Changelog</a><br />
                                <small>v1.01.0 released 27th April 2019</small>
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
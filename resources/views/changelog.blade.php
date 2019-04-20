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
        <title>Changelog: Costs to Expect</title>
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
                            <a class="nav-link" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/changelog">Changelog</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 col-12 container-column container-right d-block">
                    <nav class="navbar navbar-light d-md-none">
                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('images/theme/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
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
                                    <a class="nav-link disabled" href="#">Jack</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="#">Pending</a>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-title">Costs to Expect</span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/changelog">Changelog</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="screen-intro">
                                <div class="icon">
                                    <img src="{{ asset('images/theme/logo.png') }}" width="50" height="50" alt="Screen icon" title="Dashboard" />
                                </div>
                                <div class="welcome">
                                    <small class="text-muted">Costs to Expect.com</small>
                                </div>
                                <div class="title">
                                    <h1>Changelog</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row content mt-3">
                        <div class="col-12">
                            <h2>Releases</h2>

                            <p>The changelog for the Costs to Expect service, we try not to say
                                <code>bug fixes and improvements</code>, we may on occasion not fully detail a
                                change or fix if we don't feel it is necessary, however, we will always try to be as
                                open as possible.</p>

                            <p>The changelog for the Costs to Expect API can be found over on
                                <a href="https://github.com/costs-to-expect/api/blob/master/CHANGELOG.md">GitHub</a>,
                                the API changelog details every change, the API is Open Source.</p>

                            <hr />

                            <h2>[v1.00.0] - 20th April 2019</h2>

                            <h3>Added</h3>

                            <ul>
                                <li>Release the initial design, fully responsive, mobile through to Desktop.</li>
                                <li>Simple dashboard to show overview of expenses [Sample data].</li>
                                <li>About page, to provide a little detail on the future service and website.</li>
                                <li>Changelog, this page, detail every little change.</li>
                            </ul>

                            <h3>Changed</h3>

                            <ul>
                                <li>Nothing this time.</li>
                            </ul>

                            <h3>Fixed</h3>

                            <ul>
                                <li>Nothing this time.</li>
                            </ul>

                            <h3>Removed</h3>

                            <ul>
                                <li>Nothing this time.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-5 mb-5">
                        <div class="col-12">
                            <p class="text-center text-muted footer">
                                <a href="https://www.costs-to-expect.com">Costs to Expect</a> Copyright &copy; <a href="https://www.deanblackborough.com">Dean Blackborough 2018-2019</a><br />
                                <a href="https://api.costs-to-expect.com">Costs to Expect API</a> | <a href="/changelog">Changelog</a><br />
                                <small>v1.00.0 released 20th April 2019</small>
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

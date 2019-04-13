<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Hello, world!</title>
    </head>
    <body>
        <div class="container-fluid container-cte">
            <div class="row container-row">
                <div class="col-xl-2 col-lg-3 col-md-3 container-column container-left d-none d-sm-none d-md-block">
                    <div class="logo">
                        <img src="{{ asset('images/theme/logo-128.png') }}" width="64" height="64" alt="Logo" title="Costs to Expect" />
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <span class="nav-title">The Blackborough Children</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Jack James</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled menu item</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 col-12 container-column container-right d-block">
                    <div class="row">
                        <div class="col-12">
                            <div class="screen-intro">
                                <div class="icon">
                                    <img src="{{ asset('images/theme/dashboard.png') }}" width="32" height="32" alt="Screen icon" title="Dashboard" />
                                </div>
                                <div class="welcome">
                                    <small class="text-muted">Welcome to Costs to Expect.com</small>
                                </div>
                                <div class="title">
                                    <h2>The Dashboard</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Total expenses to date</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="media summary-block shadow-sm rounded">
                                <img src="{{ asset('images/theme/dashboard.png') }}" class="mr-3" width="32" height="32" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">Jack James Blackborough</h4>
                                    <h6 class="mt-0">Total expenses <small class="text-muted">From birth 28th June 2013</small></h6>
                                    <p class="total">&pound;39,951.29</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="media summary-block shadow-sm rounded">
                                <img src="{{ asset('images/theme/dashboard.png') }}" class="mr-3" width="32" height="32" alt="icon">
                                <div class="media-body">
                                    <h4 class="mt-0">Pending Blackborough</h4>
                                    <h6 class="mt-0">Total expenses <small class="text-muted">From birth xx April/May 2019</small></h6>
                                    <p class="total">&pound;484.42</p>
                                </div>
                            </div>
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

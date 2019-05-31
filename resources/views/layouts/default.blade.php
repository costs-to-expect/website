<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="{{ $meta['description'] }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('images/theme/favicon.ico') }}">
        <link rel="icon" sizes="16x16 32x32 64x64" href="{{ asset('images/theme/favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('images/theme/favicon-192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/theme/favicon-180.png') }}">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="{{ asset('images/theme/favicon-144.png') }}">
        <title>{{ $meta['title'] }}: Costs to Expect</title>
        <meta name="twitter:image:src" content="{{ asset('images/theme/favicon-192.png') }}" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@DBlackborough" />
        <meta name="twitter:title" content="What does it costs to raise a child in the UK?" />
        <meta name="twitter:description" content="Costs to Expect is a service which will allow tracking and forecasting of any expenses, be they the costs to raise a child to the age of 18 or your Business account budget for the next financial year." />
        <meta property="og:image" content="{{ asset('images/theme/favicon-192.png') }}" />
        <meta property="og:site_name" content="Costs to Expect" />
        <meta property="og:type" content="object" />
        <meta property="og:title" content="Costs to Expect: What does it costs to raise a child in the UK?" />
        <meta property="og:url" content="https://www.costs-to-expect.com" />
        <meta property="og:description" content="Costs to Expect is a service which will allow tracking and forecasting of any expenses, be they the costs to raise a child to the age of 18 or your Business account budget for the next financial year." />
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
                                    <img src="{{ asset('images/theme/' . $welcome['image']['icon']) }}" width="50" height="50" alt="Screen icon" title="{{ $welcome['image']['title'] }}" />
                                </div>
                                <div class="welcome">
                                    <small class="text-muted">{{ $welcome['description'] }}</small>
                                </div>
                                <div class="title">
                                    <h1>{{ $welcome['title'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    @yield('content')

                    <div class="row mt-5 mb-5">
                        <div class="col-12">
                            <p class="text-center text-muted footer">
                                <a href="https://www.costs-to-expect.com">Costs to Expect</a> Copyright &copy; <a href="https://www.deanblackborough.com">{{ $footer['copyright'] }}</a><br />
                                <a href="{{ $footer['api-link'] }}">Costs to Expect API</a> | <a href="/changelog">Changelog</a><br />
                                <small>{{ $footer['release'] }} released {{ $footer['date'] }}</small>
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

<!doctype html>
<html lang="en">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-64736-11"></script>
        <script>
        _doNotTrack = (
            window.doNotTrack === "1" ||
            navigator.doNotTrack === "yes" ||
            navigator.doNotTrack === "1"
        );
        if (!_doNotTrack) {
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-64736-11');
            gtag('config', '<GA_MEASUREMENT_ID>', { 'anonymize_ip': true });
        }
        </script>
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
        <title>@if ($meta['title'] !== null){{ $meta['title'] . ': Costs to Expect' }} @else Costs to Expect @endif</title>
        <meta name="twitter:image:src" content="{{ asset('images/theme/favicon-192.png') }}" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@coststoexpect" />
        <meta name="twitter:title" content="What does it costs to raise a child in the UK?" />
        <meta name="twitter:description" content="What does it costs to raise a child in the UK? We are finding out." />
        <meta property="og:image" content="{{ asset('images/theme/favicon-192.png') }}" />
        <meta property="og:site_name" content="Costs to Expect" />
        <meta property="og:type" content="object" />
        <meta property="og:title" content="What does it costs to raise a child in the UK?" />
        <meta property="og:url" content="https://www.costs-to-expect.com" />
        <meta property="og:description" content="What does it costs to raise a child in the UK? We are finding out." />
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
                                    'component.site-menu',
                                    [
                                        'title' => $menus['children']['title'],
                                        'active' => $active,
                                        'items' => $menus['children']['items']
                                    ]
                                )
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

                    @if ($api_status === 503)
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                The Costs to Expect API is temporarily not available, there is a better than zero chance
                                that the API is down for maintenance, please try again later.<br />
                                If the error persists please reach out to us on
                                <a href="https://twitter.com/coststoexpect">Twitter</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($api_status === 404)
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                The Costs to Expect API is not available, as it is returning a 404 it is likely
                                we are performing an upgrade..<br />
                                If the error persists for more than a few hours, please reach out to us on
                                <a href="https://twitter.com/coststoexpect">Twitter</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @yield('content')

                    <div class="row mt-5 mb-5">
                        <div class="col-12">
                            <p class="text-center text-muted footer">
                                Copyright &copy; <a href="{{ $footer['copyright_url'] }}">{{ $footer['copyright'] }}</a><br />
                                Costs to Expect (The <a href="{{ $footer['api-link'] }}">API</a>, The <a href="{{ $footer['app-link'] }}">App</a>) | <a href="https://status.costs-to-expect.com">Status</a> | <a href="/changelog">Changelog</a> | <a href="/privacy-policy">Privacy policy</a><br />
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
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>

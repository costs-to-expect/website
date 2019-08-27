@extends('layouts.default', ['meta' => $meta, 'welcome' => $welcome])

@section('content')

<div class="row content mt-3">
    <div class="col-12">
        <h2>Our Privacy policy</h2>

        <p>This website uses Google Analytics, a service which transmits
            website traffic data to Google servers. This instance of Google
            Analytics does not identify individual users or associate your IP
            address with any other data held by Google. Reports provided by
            Google Analytics are used to help us understand website traffic
            and webpage usage.</p>

        <p>You may opt out of this tracking at any time by activating the
            "Do Not Track" setting in your browser.</p>

    </div>

    <div class="col-12">
        <p class="text-muted text-right">The Costs to Expect Team</p>
        <p class="text-muted small text-right">27th August 2019</p>
    </div>

    <div class="col-12">
        <p class="lead">Also, a big thank you from</p>
    </div>

    <div class="col-6">
        <h3>Jack</h3>
        <img src="{{ asset('images/theme/jack.jpg') }}" class="img-fluid rounded" alt="Jack">
    </div>
    <div class="col-6">
        <h3>Niall</h3>
        <img src="{{ asset('images/theme/niall.jpg') }}" class="img-fluid rounded" alt="Niall">
    </div>
</div>

@endsection

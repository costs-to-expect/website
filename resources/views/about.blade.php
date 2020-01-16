@extends('layouts.default', ['meta' => $meta, 'welcome' => $welcome])

@section('content')

<div class="row content mt-3">
    <div class="col-12">
        <h2>How much does it cost to raise a child in the UK.</h2>

        <p>Costs to Expect is a long-term project; my wife and I are tracking
            the expenses to raise our children to adulthood, 18.</p>

        <h3>Why?</h3>

        <p>There are two core reasons. Firstly,  I love data, the more then
            merrier. Secondly, for as long I remember, it appears to have
            become accepted knowledge that it costs approximately £250,000 to
            raise a child in the UK.</p>

        <p>If you think about that number, it becomes apparent very quickly
            that it just can't be correct for the majority of the UK, on
            average, over £10k a year?</p>

        <p>The website is part of the Costs to Expect service, our service
            focuses on tracking and forecasting expenses.</p>

        <hr />

        <h2>Service?</h2>

        <p>There are three parts to Costs to Expect, the Open Source API, the
            backbone, the app which contains our secret sauce and the website.
            The website gives a small example of the service; we are tracking
            the costs to raise our children to adulthood.</p>

        <hr />

        <h2>Short term goals</h2>

        <p>In early 2020, the app will open to the public; initially, it
            will provide budgeting features enabling you to manage your annual
            budgeting needs easily.</p>

        <p>Later in 2020, the service will expand in two core ways. The
            budgeting and forecasting features will be expanded to support
            much more complex account setups, for example, businesses.
            Secondly, we will enable customisation. With our personalisation,
            you will be able to set up the service to track any 'item'. You
            will be able to build your data structure rather than being limited
            to our primary data types?</p>

        <hr />

        <p class="text-muted text-right">Costs to Expect Team</p>
        <p class="text-muted small text-right">August 2019</p>
    </div>
</div>

@endsection

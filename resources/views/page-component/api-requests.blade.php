<div class="row">
    <div class="col-12">
        <hr />
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <h4>API Requests to Costs to Expect API</h4>

        <p>This page was generated using the data returned from the API requests shown below.</p>

        <div class="p-3 shadow-sm white-container">
            <table class="table table-borderless table-sm api-requests">
                <caption>API Requests made to <a href="https://api.costs-to-expect.com">https://api.costs-to-expect.com</a>/ to generate this page.</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Page section</th>
                        <th scope="col">Method</th>
                        <th scope="col">API request</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($api_requests as $k => $request)
                    <tr class="top">
                        <td>{{ ++$k }}</td>
                        <td>{{ $request['name'] }}</td>
                        <td>{{ $request['method'] }}</td>
                        <td><a href="https://api.costs-to-expect.com{{ $request['uri'] }}">{{ $request['uri'] }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

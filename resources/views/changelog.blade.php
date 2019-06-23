@extends('layouts.default', ['meta' => $meta, 'welcome' => $welcome])

@section('content')

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

        <h2>[v1.05.0] - xxth June 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>Category summary page for each child.</li>
            <li>Subcategory summary page for each child.</li>
            <li>An annual summary page each child.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Layout change to the child detail section; the order of values is not correct on mobile size screens.</li>
            <li>Meta details added to the changelog.</li>
            <li>Changed the order of the years in the last three years summary.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> N/A -
            <strong>Lines added:</strong> N/A -
            <strong>Lines removed:</strong> N/A
        </p>

        <h2>[v1.04.1] - 19th June 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>The Costs to Expect website checks the status of the Costs to Expect API, if it is down, a message is displayed to explain the lack of data.</li>
            <li>The website gracefully handles the Costs to Expect API being down.</li>
            <li>The website only calls a specific endpoint once per request, models retain state so that subsequent calls are free.</li>
            <li>Split the largest expense value; we now show the top expense per category.</li>
            <li>Minor layout changes to the intro section on the child pages, updates for all screen sizes.</li>
            <li>API requests section links to API calls.</li>
            <li>Code refactoring, getting everything in order to enable new feature.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Removed redundant horizontal line on the child detail page.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 28 -
            <strong>Lines added:</strong> 1,440 -
            <strong>Lines removed:</strong> 1,696
        </p>

        <h2>[v1.04.0] - 3rd June 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>The dashboard shows live data from the Costs to Expect API.</li>
            <li>The detail page for Jack shows live data from the Costs to Expect API.</li>
            <li>The detail page for Niall shows live data from the Costs to Expect API.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Minor content changes for mobile layout.</li>
            <li>Disabled the all years pages, I need to do some additional development before bringing them back.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 15 -
            <strong>Lines added:</strong> 1,246 -
            <strong>Lines removed:</strong> 780
        </p>

        <h2>[v1.03.2] - 31st May 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>Minor update to layout, added meta tags for social networks.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Altered the dashboard title.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Content update to 'What we count?' page.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 2 -
            <strong>Lines added:</strong> 2 -
            <strong>Lines removed:</strong> 2
        </p>

        <h2>[v1.03.1] - 29th May 2019</h2>

        <h3>Fixed</h3>

        <ul>
            <li>Pagination controls should not show the prefix text on mobile.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 3 -
            <strong>Lines added:</strong> 10 -
            <strong>Lines removed:</strong> 2
        </p>

        <h2>[v1.03.0] - 29th May 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>Summary block view component.</li>
            <li>Summary block container view component.</li>
            <li>Pagination view component.</li>
            <li>API requests page view component.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Opted not to add a border radius to inputs.</li>
            <li>Modified pagination layout for mobile, just show next and previous as well as page
                number, moved per page control onto the same line.</li>
            <li>The content pages now use a general layout file rather than defining everything in the view.</li>
            <li>Content updates for text before tables.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Minor spelling error in the text above the last 25 expenses on the dashboard.</li>
            <li>Removed the 100% height on elements, causing minor scrolling issues on some mobile devices.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 20 -
            <strong>Lines added:</strong> 819 -
            <strong>Lines removed:</strong> 987
        </p>

        <h2>[v1.02.0] - 9th May 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>The initial idea for years summary pages.</li>
            <li>What do we count? content page.</li>
            <li>Menu view components to generate the site menus.</li>
            <li>Content after headings to give a small overview of data.</li>
            <li>The initial idea for pagination.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>The child detail pages now show an expenses summary for the last three years, not three months.</li>
            <li>The initial work on making the site dynamic, controllers, layout files etc.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Typo, Niall's name incorrect on the detail page, shown as Jack.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 20 -
            <strong>Lines added:</strong> 1,641 -
            <strong>Lines removed:</strong> 326
        </p>

        <h2>[v1.01.0] - 27th April 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>The initial design for the detail pages for <code>Jack</code> and <code>Niall</code>.</li>
            <li>A <code>disabled</code> menu item to explain what expenses are counted.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Minor tweak to the mobile layout, the corner background image was too large.</li>
            <li>Desktop menu items may support icons.</li>
            <li>Update to the welcome section on mobile, I was showing the logo twice.</li>
            <li><code>Blackborough Children</code> menu missing from About and Changelog views.</li>
            <li>API requests breaking out of the table.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 14 -
            <strong>Lines added:</strong> 721 -
            <strong>Lines removed:</strong> 162
        </p>

        <h2>[v1.00.1] - 23rd April 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>Minor content update, added <code>Niall</code>.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 18 -
            <strong>Lines added:</strong> 1,062 -
            <strong>Lines removed:</strong> 68
        </p>

        <h2>[v1.00.0] - 20th April 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>Released the initial design, fully responsive, Mobile through to Desktop.</li>
            <li>Simple dashboard to show an overview of expenses [Sample data].</li>
            <li>About page, provides a little detail on the future service and website.</li>
            <li>Changelog, this page, detail every change to the website.</li>
        </ul>

        <hr />
        <p class="small text-muted text-right">
            <strong>Files changed:</strong> 14 -
            <strong>Lines added:</strong> 721 -
            <strong>Lines removed:</strong> 162
        </p>
    </div>
</div>

@endsection

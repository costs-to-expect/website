@extends('layouts.default', ['meta' => $meta, 'welcome' => $welcome])

@section('content')

<div class="row content mt-3">
    <div class="col-12">
        <h2>Releases</h2>

        <p>This is the changelog for the Costs to Expect Website. In our updates
            we try not to say <code>bug fixes and improvements</code>, however,
            we may on occasion list slightly less detail here
            if we don't feel it is necessary to mention a change.
            </p>
        <p>This website is Open Source so you can simply head on over to
            <a href="https://github.com/costs-to-expect/website/blob/master/CHANGELOG.md">GitHub</a>
            to see everything.</p>

        <p>The Costs to Expect Website consumes the Costs to Expect API, the full changelog for
            the Costs to Expect API can also be found on
            <a href="https://github.com/costs-to-expect/api/blob/master/CHANGELOG.md">GitHub</a>, both
            products are Open Source.</p>

        <hr />

        <h2>[v2.02.0] - 4th July 2023</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have added an additional link to Budget Pro.</li>
            <li>We have added links to our game scorers.</li>
            <li>We have updated all back end dependencies.</li>
        </ul>

        <h2>[v2.01.1] - 3rd February 2023</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated all back end dependencies.</li>
            <li>We have removed the app from the side panel and added links to Budget and Budget Pro.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>We have implemented a minor tweak to try and correct the occasional 500 error.</li>
        </ul>

        <h2>[v2.01.0] - 17th July 2022</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated the website to target v3 of the Costs to Expect API.</li>
        </ul>

        <h2>[v2.00.0] - 22nd June 2022</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated all our dependencies, front-end and back-end.</li>
            <li>We have adjusted the cache to three days.</li>
            <li>We have tweaked the docker setup.</li>
            <li>We have Upgraded to Laravel 9 and PHP 8.1.</li>
        </ul>

        <h2>[v1.13.2] - 16th February 2021</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have upgraded to version 7 of the Laravel framework.</li>
            <li>We have upgraded our environment to PHP8.0 and MySQL 8.0</li>
        </ul>

        <h2>[v1.13.1] - 8th October 2020</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated all our dependencies, front-end and back-end.</li>
            <li>We have updated the website to handle the new format of categories from the Costs to Expect API.</li>
            <li>We have slightly tweaked the look of categories in the expense tables.</li>
        </ul>

        <h2>[v1.13.0] - 27th September 2020</h2>

        <h3>Added</h3>

        <ul>
            <li>We have updated the Website to use the latest version of the Costs to Expect API, v2.14.0.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>We return additional information for failed API requests.</li>
        </ul>

        <h2>[v1.12.7] - 19th June 2020</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have switched to Redis for our caching.</li>
            <li>We have updated our cache to eight hours.</li>
        </ul>

        <h2>[v1.12.6] - 7th June 2020</h2>

        <h3>Fixed</h3>

        <ul>
            <li>We have updated the expense tables; it is possible for the category and subcategory values to
            be `null`.</li>
        </ul>

        <h2>[v1.12.5] - 6th June 2020</h2>

        <h3>Changed</h3>

        <ul>
            <li>We are updating the Website to run on PHP7.4.</li>
            <li>We have updated the Website to work with v2.11.0 of the Costs to Expect API. The format of the categories object was updated.</li>
            <li>We have tweaked the Docker setup, we have added a network.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>When we hastily added the caching, we did not cache the response headers, only the body. We have updated the Website to cache the response body and headers.</li>
            <li>We have removed a link that would direct the user to a page we know will not have content.</li>
        </ul>

        <h2>[v1.12.4] - 14th May 2020</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated the dependencies for our website, front-end and back-end dependencies.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>We have added a check to stop processing when we come across a subcategory or category id that is not formatted correctly.</li>
            <li>We have removed an invalid link on the child page; we were linking to the detail page for a year when there is no data.</li>
        </ul>

        <h2>[v1.12.3] - 12th April 2020</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated the font; the new font is the same font we use for the rest of the service.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>We have fixed the pagination on the all expenses page; the limit parameter was not set.</li>
        </ul>

        <h2>[v1.12.2] - 5th March 2020</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated the category descriptions.</li>
            <li>We have added a link to our blog.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>We have removed `expenses` from the subcategory descriptions.</li>
        </ul>

        <h2>[v1.12.1] - 26th February 2020</h2>

        <h3>Fixed</h3>

        <ul>
            <li>Search the name field rather than the description field.</li>
            <li>Selecting a subcategory will now jump you to the expenses table.</li>
        </ul>

        <h2>[v1.12.0] - 17th February 2020</h2>

        <h3>Added</h3>

        <ul>
            <li>We have added caching for the requests not covered in the v1.11.0 update.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>We have updated the back-end dependencies.</li>
            <li>We have updated the front-end dependencies and switch to using the slim and minified versions.</li>
            <li>We have refactored the 'Request/Api' class to remove code duplication.</li>
            <li>We have increased the cache lifetime to four hours.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>We have fixed a typo in the 'Request/Api' class.</li>
        </ul>

        <h2>[v1.11.0] - 3rd February 2020</h2>

        <h3>Added</h3>

        <ul>
            <li>We have updated the Docker configuration to include a MySQL database.</li>
            <li>We have added the 'migrations' table.</li>
            <li>We have added the `sessions` and `cache` table migrations.</li>
            <li>We have updated the website to cache some responses from the Costs to Expect API; API responses get cached for one hour. The caching solution is temporary and will be updated soon(tm).</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>We have updated the dependencies for the website.</li>
            <li>We have made a minor tweak to the `web.config` file.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>We have added the hover for menu items.</li>
            <li>We have corrected a date in the changelog.</li>
        </ul>

        <h2>[v1.10.9] - 16th January 2020</h2>

        <h3>Added</h3>

        <ul>
            <li>We have added a banner for the Costs to Expect app.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Minor SEO tweaks.</li>
            <li>We have added a link to the status page for the service.</li>
            <li>We have updated the copyright, now a personal project, not attached to G3D Development Limited.</li>
            <li>- We have tweaked the content on the about page.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>The date for current year on the dashboard is incorrect.</li>
        </ul>

        <h2>[v1.10.8] - 17th December 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have added links to the API and the App.</li>
        </ul>

        <h2>[v1.10.7] - 12th December 2019</h2>

        <h3>Fixed</h3>

        <ul>
            <li>LICENSE file missing.</li>
            <li>Updated dependencies.</li>
        </ul>

        <h2>[v1.10.6] - 12th November 2019</h2>

        <h3>Fixed</h3>

        <ul>
            <li>We have corrected the shown date of birth for Niall.</li>
            <li>The subcategories API request should return the entire collection.</li>
        </ul>

        <h2>[v1.10.5] - 4th October 2019</h2>

        <h3>Fixed</h3>

        <ul>
            <li>The website was asking the Costs to Expect API to search on the wrong field.</li>
        </ul>

        <h2>[v1.10.4] - 24th September 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>The format of the returned expense item has changed, we have updated all views to use `name` rather than `description`.</li>
        </ul>

        <h2>[v1.10.3] - 23rd September 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated a couple of calls to the API, category routes in the API have been moved.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>The expenses list errors when a filtered expense response contains no results.</li>
        </ul>

        <h2>[v1.10.2] - 17th September 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have added a `version` property to the `Uri` class so it will be simpler to switch to a newer version of the Costs to Expect API in the future.</li>
            <li>The Costs to Expect website consumes data from v2 of the Costs to Expect API.</li>
            <li>The website displays a warning if the root of the API returns a 404.</li>
        </ul>

        <h2>[v1.10.1] - 31st August 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>We have added a CHANGELOG file to the repo, it will contain full details of all changes post v1.10.0.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>We have updated the CHANGELOG and added links to the GitHub repositories for the
            Costs to Expect Website and API.</li>
        </ul>

        <h2>[v1.10.0] - 27th August 2019 (Open Source release)</h2>

        <h3>Added</h3>

        <ul>
            <li>We have added a README with a brief overview and set up instructions.</li>
            <li>We have added Google Analytics to the website, GPDR friendly.</li>
            <li>We have added a privacy policy page.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>New content for the Changelog content page ready for the Open Source release.</li>
            <li>New content for the About content page ready for the Open Source release.</li>
        </ul>

        <h3>Removed</h3>

        <ul>
            <li>We have removed the meta details for each release, they are no longer necessary
            now that the website has been Open Sourced.</li>
        </ul>

        <h2>[v1.09.2] - 21st August 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have updated the copyright for the website; it should have been my company and not me.</li>
            <li>We now send additional information for API request errors. The additional information is limited to HTTP verb, class and method names.</li>
            <li>We have added a check to redirect when an invalid category and subcategory are requested. The page correctly handled the request, but now we strip the subcategory from the URI.</li>
        </ul>

        <h2>[v1.09.1] - 9th August 2019</h2>

        <h3>Fixed</h3>

        <ul>
            <li>Year and month summary pages for Niall forwarding to Jack.</li>
            <li>Minor content correction.</li>
        </ul>

        <h2>[v1.09.0] - 31st July 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>The API request class logs unexpected responses from the Costs to Expect API.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>The filter summary displays when a search term is used to filter the expenses.</li>
            <li>Updated dependencies.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Upgraded to v1.00.3 of `deanblackborough/laravel-view-helpers`, corrects a small issue with the pagination URIs.</li>
            <li>Slightly better error pages.</li>
        </ul>

        <h2>[v1.08.0] - 23rd July 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>Filter summary added to the expenses view, whenever a filter is applied, you will get a summary for the filter.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Added pagination controls below the expenses table.</li>
            <li>Minor changes to the design.</li>
            <li>Minor changes to the text in some of the summary counts.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Month filter only being applied to request if year filter set.</li>
            <li>Subcategory filter not disabled when there are no selectable options.</li>
            <li>The subcategory filter cleared options when the category value changed; We now disable the element if we need to load new subcategories.</li>
        </ul>

        <h2>[v1.07.1] - 18th July 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>We have tweaked the mobile, and the main website menu, the active state is more evident, and the mobile menu matches the main site menu.</li>
            <li>Correction to the changelog.</li>
        </ul>

        <h2>[v1.07.0] - 18th July 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>Search added to the full expenses view, allows you to search on expense description.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Year no longer treated differently in the filter code.</li>
            <li>General code refactoring.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Under specific scenarios, the URI on the final assigned filter is incorrect.</li>
        </ul>

        <h2>[v1.06.2] - 15th July 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>Child details view component.</li>
            <li>Assigned filters view component.</li>
            <li>Filters view component.</li>
            <li>Expenses table view component.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Modified the Docker setup, moved composer into Docker and added Xdebug for local development.</li>
            <li>Icons in summary counts are clickable.</li>
            <li>We have created a separate <a href="https://packagist.org/packages/deanblackborough/laravel-view-helpers">view helpers</a> library.</li>
            <li>We have tweaked link colours and table heading colours.</li>
            <li>Refactoring in preparation for new development.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Total expenses count on child detail page.</li>
            <li>URLs on Niall's page.</li>
            <li>Spelling error on "<a href="/what-we-count">What we count?</a>" page</li>
        </ul>

        <h2>[v1.06.1] - 6th July 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>The URLs for the category details pages have changed, now referenced by category id, not the name; we may
                need to change the names in the future.</li>
            <li>Link colour darkened.</li>
            <li>The number of expenses count is now always the total, not for the section.</li>
            <li>The view all expenses links have been updated to filter the full expenses list based on the current context.</li>
            <li>The site now runs on PHP 7.3.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>Filtering the form now jumps you down to the expenses data table rather than the top of the page.</li>
            <li>Filtering the form does not respect the selected limit value.</li>
        </ul>

        <h2>[v1.06.0] - 5th July 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>An expenses page to allow viewing and filtering of all the expenses assigned to a child.</li>
            <li>A <code>head()</code> method added to the API request helper.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Added the API request method to the API requests table.</li>
            <li>We have updated the descriptive name of each API request.</li>
            <li>Minor layout change to the API requests table for phone and tablet sized screens.</li>
            <li>We have updated all the tables, now include links to the new expenses page.</li>
        </ul>

        <h3>Fixed</h3>

        <ul>
            <li>The current year links on the dashboard go to the relevant child year page.</li>
        </ul>

        <h2>[v1.05.0] - 24th June 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>A category summary page for each child.</li>
            <li>A subcategory summary page for each child.</li>
            <li>An annual summary page each child.</li>
            <li>A monthly summary page each child.</li>
        </ul>

        <h3>Changed</h3>

        <ul>
            <li>Layout change to the child detail section; the order of values is not correct on mobile size screens.</li>
            <li>Meta details added to the changelog.</li>
            <li>Changed the order of the years in the last three years summary.</li>
        </ul>

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

        <h2>[v1.03.1] - 29th May 2019</h2>

        <h3>Fixed</h3>

        <ul>
            <li>Pagination controls should not show the prefix text on mobile.</li>
        </ul>

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

        <h2>[v1.00.1] - 23rd April 2019</h2>

        <h3>Changed</h3>

        <ul>
            <li>Minor content update, added <code>Niall</code>.</li>
        </ul>

        <h2>[v1.00.0] - 20th April 2019</h2>

        <h3>Added</h3>

        <ul>
            <li>Released the initial design, fully responsive, Mobile through to Desktop.</li>
            <li>Simple dashboard to show an overview of expenses [Sample data].</li>
            <li>About page, provides a little detail on the future service and website.</li>
            <li>Changelog, this page, detail every change to the website.</li>
        </ul>
    </div>
</div>

@endsection

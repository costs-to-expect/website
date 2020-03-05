# Changelog

The complete changelog for the Costs to Expect Website, our changelog follows the format defined at https://keepachangelog.com/en/1.0.0/

## [v1.12.2] - 2020-03-05
### Changed 
- We have updated the category descriptions.
- We have added a link to our blog.

### Fixed
- We have removed `expenses` from the subcategory descriptions. 

## [v1.12.1] - 2020-02-26
### Fixed
- Search the name field rather than the description field.
- Selecting a subcategory will now jump you to the expenses table.

## [v1.12.0] - 2020-02-17
### Added
- We have added caching for the requests not covered in the v1.11.0 update.

### Changed
- We have updated the back-end dependencies.
- We have updated the front-end dependencies and switch to using the slim and minified versions.
- We have refactored the 'Request/Api' class to remove code duplication.
- We have increased the cache lifetime to four hours.

### Fixed
- We have fixed a typo in the 'Request/Api' class.

## [v1.11.0] - 2020-02-03
### Added
- We have updated the Docker configuration to include a MySQL database.
- We have added the 'migrations' table.
- We have added the `sessions` and `cache` table migrations.
- We have updated the website to cache some responses from the Costs to Expect API; API responses get cached for one hour. The caching solution is temporary and will be updated soon(tm).

### Changed
- We have updated the dependencies for the website. 
- We have made a minor tweak to the `web.config` file.

### Fixed
- We have added the hover for menu items.
- We have corrected a date in the changelog.

## [v1.10.9] - 2020-01-16
### Added 
- We have added a banner for the Costs to Expect app.

### Changed
- Minor SEO tweaks.
- We have added a link to the status page for the service.
- We have updated the copyright, now a personal project, not attached to G3D Development Limited.
- We have tweaked the content on the about page.

### Fixed
- The date for current year on the dashboard is incorrect.

## [v1.10.8] - 2019-12-17
### Changed
- We have added links to the API and the App.

## [v1.10.7] - 2019-12-12
### Fixed
- LICENSE file missing.
- Updated dependencies.

## [v1.10.6] - 2019-11-12

### Fixed
- We have corrected the shown date of birth for Niall.
- The subcategories API request should return the entire collection.

## [v1.10.5] - 2019-10-04

### Fixed
- The website was asking the Costs to Expect API to search on the wrong field.

## [v1.10.4] - 2019-09-24

### Changed
- The format of the returned expense item has changed, we have updated all views to use `name` rather than `description`.

## [v1.10.3] - 2019-09-23

### Changed
- We have updated a couple of calls to the API, category routes in the API have been moved.

### Fixed
- The expenses list errors when a filtered expense response contains no results.

## [v1.10.2] - 2019-09-17

### Changed
- We have added a `version` property to the `Uri` class so it will be simpler to switch to a newer version of the Costs to Expect API in the future.
- The Costs to Expect website consumes data from v2 of the Costs to Expect API.
- The website displays a warning if the root of the API returns a 404.

## [v1.10.1] - 2019-08-31

### Added 
- We have added a CHANGELOG file to the repo, it will contain full details of all changes post v1.10.0. 

### Changed
- We have updated the CHANGELOG and added links to the GitHub repositories for the Costs to Expect Website and API.

## [v1.10.0] - 2019-08-27

### Added 
- We have added a README with a brief overview and set up instructions.
- We have added Google Analytics to the website, GPDR friendly.
- We have added a privacy policy page.

### Changed
- New content for the Changelog content page ready for the Open Source release.
- New content for the About content page ready for the Open Source release.

### Removed
- We have removed the meta details for each release, they are no longer necessary now that the website has been Open Sourced.

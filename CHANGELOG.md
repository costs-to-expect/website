# Changelog

The complete changelog for the Costs to Expect Website, follows the format defined at https://keepachangelog.com/en/1.0.0/

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

# ZenQuotes.io API Challenge

## Setup

https://laravel.com/docs/10.x/installation#docker-installation-using-sail

### Requirements

https://laravel.com/docs/10.x/deployment#server-requirements

### Tests

To run the tests, you need to run the following command on terminal:
`./vendor/bin/pest`

### Time to Finish

It took me about 10 hours to complete this challenge.

## The Challenge

The API we want you to connect to is [https://zenquotes.io/](https://zenquotes.io/). Read the full documentation.

The application should have the following features:

### 1. Requirement: Code Repository
- [X] All code should be stored in a public GitHub repository.
- [X] You can get a free GitHub account, if you don’t have one.
- [X] There should be separate GIT commits that show progress of development.
- [X] There should be separate GIT commits for framework generated/included code.

### 2. Requirement: Datastore
- [X] All user information is stored in an SQLite database.
- [X] All quote information is stored in an SQLite database.
- [X] To make testing and review easier, MySQL, MariaDB, PostgreSQL, SQL Server, and/or Redis databases should not be used or be required to run the application.
- [X] Aside from the external API endpoint for quotes, the application should not rely on or use other external or network resources.

### 3. Feature: Datastore Initialization
- [X] Datastore should be initialized with 3 users.
- [X] Datastore should be initialized with a list containing 3 favorite quotes for each seeded user.
- [X] Datastore initialization should be handled via database migrations and seeders.

### 4. Feature: Cache
- [X] The application should use caching to improve performance.
- [X] Cache data should be stored in an SQLite database.
- [X] Results of an external API calls should be cached for 30 seconds by default.

### 5. Feature: Web/API Authentication
- [X] The application supports authentication and authorization.
- [X] Users can login with URI “/login” using username and password.
- [X] The username is in the form of a proper email address containing only alphanumeric characters plus at-sign (@), and dot (.).
- [X] Each user is assigned API login token.
- [X] The page is accessible to unauthenticated users.
- [X] The page is accessible to authenticated/logged in users.
- [X] The page allows for currently authenticated users to switch to another authenticated user (with correct credentials).
- [X] The login & logout process does not delete the list of favorites for a previously logged in user.

### 6. Feature: Web Registration for Users
- [X] The application supports user online registration at URI “/register”.
- [X] The username is in the form of a proper email address containing only alphanumeric characters plus at-sign (@), and dot (.).
- [X] Password must not be stored in clear text format.
- [X] The page is accessible to unauthenticated users only.
- [X] The page redirects to “/today” or login profile for authenticated/logged in users.

### 7. Feature: Quote of the Day
- [X] A web page with URI of “/today” that shows “quote of the day”.
- [X] The web page should display cached information, if available, by default
    - [X] If cache was used, the quote should be prefixed with an appropriate icon or “[cached]” keyword/tag.
- [X] The same page should also show a “random inspirational image”.
- [X] There should be a button to force a reload of the “quote of the day” with a “new” parameter (e.g., /today/new).
- [X] There should be a button to add the “quote of the day” to the list of favorites.
- [X] Default page when accessing “/” URI.
- [X] The page is accessible to unauthenticated users.
- [X] The page is accessible to authenticated/logged in users.

### 8. Feature: Five Random Quotes
- [X] A web page with URI of “/quotes” that shows 5 random quotes.
- [X] The web page should display cached information, if available, by default
    - [X] If cache was used, the quotes should be prefixed with an appropriate icon or “[cached]” keyword/tag.
- [X] There should be a button to force a reload of list of 5 random quotes with a “new” parameter (e.g., /quotes/new).
    - [X] The reload operation updates the cache.
- [X] The page is accessible to unauthenticated users only.
- [X] The page redirects to “/secure-quotes” for authenticated/logged in users.

### 9. Feature: Ten Secure Quotes
- [X] A web page with URI of “/secure-quotes” that shows 10 random quotes.
- [X] The web page should display cached information, if available, by default
    - [X] If cache was used, the quotes should be prefixed with an appropriate icon or “[cached]” keyword/tag.
- [X] There should be a button to force a reload of list of 10 random quotes with a “new” parameter (e.g., /secure-quotes/new).
- [X] There should be a button to add each quote to the list of favorites for the logged in user.
- [X] The page is accessible to authenticated/logged in users only.
- [X] The page redirects to “/quotes” for unauthenticated users.

### 10. Feature: Favorite Quotes
- [X] A web page with URI of “/favorite-quotes” that shows all quotes that have been added to the list of favorites.
- [X] There should be a button to delete each quote from the list of favorites.
- [X] The page is accessible to authenticated/logged in users only.
- [X] If the list of favorite quotes is empty, a message should be shown and suggest to the user how to add quotes to the list.
- [X] The page redirects to “/quotes” for unauthenticated users.

### 11. Feature: Report of Favorite Quotes
- [X] A web page with URI of “/report-favorite-quotes” that shows a list of registered users and favorite quotes they have added to their list.
- [X] There should be a button to delete each quote from the list of favorites for the logged in user only.
- [X] The usernames should be a link that points to the “/login” page with pre-filled username.
- [X] The page is accessible to authenticated/logged in users only.
- [X] The page redirects to “/quotes” for unauthenticated users.

### 12. Feature: REST API for Five Random Quotes
- [X] REST API GET endpoint with URI of “/api/quotes” for Feature: Five Random Quotes.
- [X] The API should return cached information, if available, by default
    - [X] If cache was used, each of the quotes should be prefixed with “[cached] ” keyword/tag.
    - [X] The API shares cache with the Feature: Five Random Quotes
- [X] The API can be forced to fetch and return fresh set of results (and update the cache) with a “new” parameter (e.g., “/api/quotes/new”)
- [X] The page is accessible to unauthenticated users.
- [X] The page is accessible to authenticated/logged in users.

### 13. Feature: REST API for Ten Secure Quotes
- [X] REST API GET and POST endpoint with URI of “/api/secure-quotes” for Feature: Ten Secure Quotes.
- [X] The API should return cached information, if available, by default
    - [X] If cache was used, each of the quotes should be prefixed with “[cached] ” keyword/tag.
    - [X] The API shares cache with the Feature: Ten Secure Quotes
- [X] The API can be forced to fetch and return fresh set of results (and update the cache) with a “new” parameter (e.g., “/api/secure-quotes/new”)
- [X] The API endpoint is secured with API login token.
- [X] The page is accessible to authenticated/logged in users only.
- [X] The page returns empty JSON for unauthenticated users.

### 14. Feature: Online API Test
- [X] A web page with URI of “/api-test” that allows us to test API endpoints.
- [X] REST API GET endpoints should have clickable links.
- [X] REST API POST endpoints should have a pre-filed form that can be submitted.
- [X] If a user is logged in, REST API GET endpoints should have additional clickable links with API login token.
- [X] If a user is logged in, REST API POST endpoints should have additional pre-filled form with the API login token.
- [X] The page is accessible to unauthenticated users.
- [X] The page is accessible to authenticated/logged in users.

### 15. Feature: Console/Shell Command for Five Random Quotes
- [X] Create a console/shell command “php artisan Get-FiveRandomQuotes” for Feature: Five Random Quotes.
- [X] The console/shell command should return cached information, if available, by default
    - [X] If cache was used, each of the quotes should be prefixed with “[cached] ” keyword/tag.
    - [X] The console/shell command shares cache with the Feature: Five Random Quotes
- [X] The console/shell command can be forced to fetch and return fresh set of results (and update the cache) with a “new” parameter (e.g., “php artisan Get-FiveRandomQuotes --new”)
- [X] The console/shell command is accessible to unauthenticated users.
- [X] The console/shell command is accessible to authenticated/logged in users.

### 16. Feature: PHP Automated Testing
- [X] All implemented features are tested.
- [X] Test each implemented feature with at least one Feature test.
- [X] Implement appropriate positive and negative Unit tests for core functionality of the application.

### 17. Feature: Documentation
- [X] Provide a README on how we can set up and test the application.
    - [X] Please list environment dependencies – e.g., PHP extensions, etc.
    - [X] We should be able to run the application on Windows, Mac, or Linux device with your instructions.
- [X] Include a navigation menu that allows to easily click between all features.
- [X] Include a tag [implemented] for implemented features in the README file.
- [ ] Include a tag [tested] for tested features in the README file.
- [X] Include a note about the amount of time it took to complete this challenge. We are just being mindful of the amount of time and effort required by the candidate to complete the assignment.
    - [X] This is not a race, and lower/higher number alone doesn’t change the outcome/decision.
    - [X] What matters is the quality of the code and completing all requirements thoroughly.

## Notes
- [X] API requests are restricted to 5 per 30 second period.
- [X] API vendor requires that you show attribution with a link back to [https://zenquotes.io/](https://zenquotes.io/) when using the free version of the API.
- [X] HTML/CSS/JS styling are not the primary objective of this coding challenge, but good styling is appreciated.
- [X] It is more important for your application to be feature-full and usable than have a pretty user interface.

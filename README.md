# Implementation

## Description
Implemented a small e-commerce application following a 100% REST API architecture.

Deployed the application on a server to test the functionality easily accessible
at https://oc.nterelis.me.

I have included a sample POSTMAN collection in the repository as well.

## Tech Stack
- PHP 8.1.25
- Laravel 9.6.0
- MariaDB 15.1


## Installation
- `git@github.com:nteath/oc_eshop.git`
- `composer install`
- `php artisan migrate --seed`
- `php artisan serve`

## Assumptions
- No UI is provided.
- Payment gateway is out of this project's scope.
- Email sending is out of this project's scope.
- Products have stock availability.
- User cannot add more than 10 copies of the same product.
- Cart data is persisted to database following stateless API practices.
- Simple token based authentication implemented.
- Product prices are stored in cents.
- User can checkout as guest.
- User can checkout and register.

## Areas for improvement
- Authentication system using sanctum/passport.
- Multi-lingual server errors/messages.
- API Versioning.

# Content Management System with CodeIgniter 4 Framework and Myth/Auth library
Template: 
- Backend ([Admin LTE 3](https://github.com/ColorlibHQ/AdminLTE))
- Frontend ([DevFolio](https://bootstrapmade.com/devfolio-bootstrap-portfolio-html-template/))

## Steps 
copy the env file into .env, then change the configuration that you needs like baseURL, or database
```sh
$ composer install
$ php spark migrate -all
$ php spark db:seed DatabaseSeeder
$ php spark serve
```

## Notes
The default dummy users :
| Username | Password | Groups |
|----------|----------|--------|
| admin@example.com | password | admin |
| maintainer@example.com | password | maintainer |
| writer@example.com | password | writer |
| member@example.com | password | member |

This myth-auth is configured without email activation.  So if you register a new user, it will automatically activated.


## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

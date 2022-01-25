# Content Management System with CodeIgniter 4 Framework and Myth/Auth library
Web Desain & Teknologi Internet

## Steps 
- copy the env file into .env, then change the configuration that you needs like baseURL, or database
- composer install
- exec in your shell `php spark migrate -all`
- exec in your shell `php spark db:seed DatabaseSeeder`
- exec in your shell `php spark serve`

## Notes
The default dummy users :
- Admin Groups
    username -> adjiekrazz@example.com
    password -> password
- Member Groups
    username -> fathur@example.com
    password -> password

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

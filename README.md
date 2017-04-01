MailChimp API
=============

Super easy PHP based MailChimp 3.0 API.

Installation
------------

Using Composer:

```
composer require brabia/mailchimp-api
composer install
```

You will then need to:
* add the autoloader to your application.

Or just download the `MailChimp.php` file and include it to your project:

```php
require('MailChimp.php'); 
```

Examples
--------
```
$mailChimp = new MailChimp(array(
	'apiKey' => 'apiKey'
));

Get user details:

$mailChimp->getUserDetails(array(
	'user' => 'user@gmail.com', // user email
	'listId' => 'listId' // Your MailChimp listId
));
```
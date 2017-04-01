MailChimp API
=============

Super easy PHP MailChimp 3.0 API based.

Installation
------------

Using Composer:

```
composer require brabia/mailchimp-api
composer install
```

You will then need to:
* add the autoloader to your application.

Or just download the `MailChimp.php` file and include it:

```php
include('./MailChimp.php'); 
```

Examples
--------

```
$mailChimp = new MailChimp(
	array(
		'apiKey' => 'apiKey'
	)
);
$mailChimp->getUserDetails(array(
	'user' => 'user@gmail.com', // user email
	'listId' => 'listId' // Your MailChimp listId
));
```
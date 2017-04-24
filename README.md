# Laravel-random-string
it is for laravel 5+

## Installation

Begin by installing this package through Composer. Just run following command to terminal-

```
composer require nirmal/random=dev-master
```

Once this operation completes, the final step is to add the service provider & aliases. Open `config/app.php`, and add a new item to the providers array.

```php
'providers' => [
    ...
    Nirmal\Random\RandomServiceProvider::class,
    ...
]
```

Now add the alias.

```php
'aliases' => [
    ...
    'Ndom' => Nirmal\Random\Facades\RandomFacade::class,
    ...
]
```


This package provide various type of commands like random number, random captcha image etc.

generator in html

```php
Route::get('/', function () {
	$x = Ndom::create();
	echo "<img src='$x' />"; 
	die;
    return view('welcome');
});
```

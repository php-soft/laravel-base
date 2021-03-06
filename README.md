# Laravel Base
[![Build Status](https://travis-ci.org/php-soft/laravel-base.svg)](https://travis-ci.org/php-soft/laravel-base)

Somes utilities for Laravel 5.x

1. Middleware convert input camelCase to snakecase
2.  Middleware validate

## I. Installation

Install via composer - edit your `composer.json` to require the package.

```js
"require": {
    // ...
    "php-soft/laravel-base": "dev-master",
}
```

Then run `composer update` in your terminal to pull it in.
Once this has finished, you will need to add the service provider to the `providers` array in your `app.php` config as follows:

```php
'providers' => [
    // ...
    PhpSoft\Base\Providers\BaseServiceProvider::class,
]
```


## II. Usage

### 1.  Middleware convert input camelCase to snakecase

To use the middlewares you will have to register them in app/Http/Kernel.php under the ```$routeMiddleware``` property:


```php
protected $routeMiddleware = [
    ...
    'camelToSnake'       => \PhpSoft\Base\Middleware\CamelToSnake::class,
];

```
Add routes in `app/Http/routes.php`

```php
Route::group(['middleware'=>'camelToSnake'], function() {

   // Your route
});
```
### 2. Validate

This middleware is used to check validate for fields on different applications which use this package.

Add route middlewares in app/Http/Kernel.php

```php
protected $routeMiddleware = [
    // ...
    'validate'   => \PhpSoft\Base\Middleware\Validation::class,
];
```

Usage

```php
Route::post('/user', ['middleware'=>'validate: App\Http\Validators\UserValidate',
    function () {
        //
    }
]);
```
With `App\Http\Validators\UserValidate`, it's class which you need to declare in route. This class is used to declare rules to validate.

You can also use other class to declare rules for validate in your application but It have to implements `PhpSoft\Base\Validation\Contract` class.

For example, I declared rules in `App\Http\Validators\UserValidate` class as follows:

```php
use PhpSoft\Base\Validation\Contract;

/**
 * User Validate
 *
 * return array
 */
class UserValidate implements Contract
{
    /**
     * Custom validator
     * 
     * @return boolean
     */
    public static function boot($request)
    {

        IlluminateValidator::extend('validate_name', function($attribute, $value, $parameters) {

                return $value == 'validate_name';
            }, 'The name is in valid.'
        );
    }

    /**
     * Declare rules
     * 
     * @return array
     */
    public static function rules()
    {
        return [
            'name'     => 'required|max:255|validate_name',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6'
        ];
    }
}
```

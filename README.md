# Very short description of the package

This Package provides validation for correct sort position values for arrays.

## Installation

You can install the package via composer:

```bash
composer require elbgoods/laravel-sort-positions-validation
```

if you want to adjust the error message translation you can add the translation files to your project:
```bash
php artisan vendor:publish --provider="Elbgoods\LaravelSortPositionsValidation\LaravelSortPositionsValidationServiceProvider" --tag=lang
```

## Usage

An example array to validate
```php
[
    [
        'id' => 1,
        'sort_position' => 1,
        'name' => 'foo'
    ], [
        'id' => 2,
        'sort_position' => 2,
        'name' => 'bar'
    ]
];
```

To validate the sort position values you have to add the `SortPositionsRule` rule to your rule set for the whole array.
You must pass in the array key for the sort position in the first parameter (`sort_position` in the example array).
Optionally you can pass a start value in the second parameter if you don't want to start your sort position values with 1.

```php
use Elbgoods\LaravelSortPositionsValidation\Rules\SortPositionsRule;

// ...

$rules = [
    // ...
    'array_with_sortable_data' => ['array', new SortPositionsRule('sort_position', 0)],
    // ...
];

```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Credits

- [Niclas Schirrmeister](https://github.com/eisfeuer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

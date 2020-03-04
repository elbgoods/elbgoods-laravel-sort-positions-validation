# Sort position rule for Laravel

This Package provides validation for correct sort position values for arrays.

## Installation

You can install the package via composer:

```bash
composer require elbgoods/laravel-sort-positions-rule
```

if you want to adjust the error message translation you can add the translation files to your project:
```bash
php artisan vendor:publish --provider="Elbgoods\SortPositionsRule\SortPositionsRuleServiceProvider" --tag=lang
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
use Elbgoods\SortPositionsRule\Rules\SortPositionsRule;

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

## Treeware

You're free to use this package, but if it makes it to your production environment we would highly appreciate you buying or planting the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at https://offset.earth/treeware

Read more about Treeware at https://treeware.earth

[![We offset our carbon footprint via Offset Earth](https://toolkit.offset.earth/carbonpositiveworkforce/badge/5e186e68516eb60018c5172b?black=true&landscape=true)](https://offset.earth/treeware)

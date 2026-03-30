# Strictness for Laravel
A small Laravel package that adds **strict, validated accessors** for configuration values. It complements Laravel’s config layer - where values are usually defined in `config/*.php` and filled from **environment variables** - so mistakes surface as clear `InvalidArgumentException`s instead of subtle type or shape bugs later.

## Requirements
- PHP 8.2+
- Laravel `^11.0` or `^12.0`

## Installation
```bash
composer require enmaboya/strictness-for-laravel
```

## Usage
Config keys work as usual; strict methods **read** those keys and enforce types and optional constraints.

**Strings** (`Enmaboya\StrictnessForLaravel\Enums\StringType`):
- `DEFAULT` - value must be a `string`
- `NON_EMPTY` - non-empty after `trim`
- `NON_FALSY` - non-empty string that is truthy in a PHP boolean sense
- `LOWERCASE` / `UPPERCASE` - exact case match

**Integers** (`Enmaboya\StrictnessForLaravel\Enums\IntType`):
- `DEFAULT`  - value must be an `int`
- `POSITIVE` / `NEGATIVE` / `NON_ZERO` / `NON_NEGATIVE` / `NON_POSITIVE` - as named

```php
use Enmaboya\StrictnessForLaravel\Enums\StringType;
use Enmaboya\StrictnessForLaravel\Enums\IntType;
use Enmaboya\StrictnessForLaravel\Facades\StrictConfig;

// Facade (same underlying `config` binding after extend)
$apiUrl = StrictConfig::string('services.api.url', type: StringType::NON_EMPTY);
$timeout = StrictConfig::integer('services.api.timeout', default: 30, type: IntType::NON_NEGATIVE);

// Helper (PHPDoc assumes StrictConfigRepository)
$region = strict_config()->string('app.region', type: StringType::LOWERCASE);
```

Values like `config('app.name')` populated from `env('APP_NAME')` are read through the same keys; the strict layer only cares that the **resolved** config value matches the expected type and constraint.

## Feature checklist

- [x] Strict `string()` reads with optional `StringType` validation
- [x] Strict `integer()` reads with optional `IntType` validation
- [ ] Strict `validatedString()` reads with optional `IntType` validation
- [ ] Strict `validatedInteger()` reads with optional `IntType` validation
- [ ] Strict `env()`

## License
MIT

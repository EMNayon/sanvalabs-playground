# Sanvalabs Playground

A Laravel app that shows the Sanvalabs packages for Bangladesh working live: convert numbers and dates to Bangla, and validate Bangladeshi mobile numbers.

| Package | What it does | Links |
|---|---|---|
| [`sanvalabs/bangla-converter`](https://github.com/EMNayon/bangla-converter) | Numbers to Bangla digits and words, dates with Bangla month and day names | [Packagist](https://packagist.org/packages/sanvalabs/bangla-converter) |
| [`sanvalabs/bd-phone-validator`](https://github.com/EMNayon/bd-phone-validator) | Validates BD mobile numbers, detects the operator, normalizes the format | [Packagist](https://packagist.org/packages/sanvalabs/bd-phone-validator) |

## Pages

### Home: `/`
One card per package, with live examples and the install command.

### Bangla Converter: `/bangla`
- **Number:** type any number (English or Bangla digits) and see it as Bangla digits and words.
  `1250000` → `১২৫০০০০` → `বারো লক্ষ পঞ্চাশ হাজার`
- **Date:** pick a date and time, write any [PHP date format](https://www.php.net/manual/en/datetime.format.php), and compare six preset formats side by side.
  `l, j F Y, h:i A` → `মঙ্গলবার, ১০ নভেম্বর ২০২৬, ০৮:০৩ অপরাহ্ণ`
- **Blade helpers:** `bn_number()`, `bn_words()` and `bn_date()` in action.

### Phone Validator: `/phone`
- Validate a number with the `ValidBdPhone` rule. Sample numbers fill the field with one click.
- Allow only some operators (Grameenphone, Banglalink, Teletalk, Airtel, Robi).
- Switch error messages between English and Bangla.
- See the operator, the normalized number and the international format for a valid number.

| Input | Result |
|---|---|
| `+880 1812-345678` | ✓ Robi · `01812345678` · `+8801812345678` |
| `12345` | ✗ The mobile number must be a valid Bangladeshi mobile number. |
| `8801912345678` with only Grameenphone allowed, in Bangla | ✗ মোবাইল নম্বর অবশ্যই Grameenphone নম্বর হতে হবে। |

The UI follows the system light or dark theme and works on mobile.

## Requirements

- PHP 8.3 or newer
- Composer 2

No database, Node.js or build step is needed.

## Getting started

```bash
git clone https://github.com/EMNayon/sanvalabs-playground.git
```

```bash
cd sanvalabs-playground
```

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
php artisan serve
```

Open http://localhost:8000.

## How the packages are used

Both packages register themselves through Laravel package auto-discovery, so there is no provider or alias to add.

**Bangla Converter** in Blade ([`resources/views/bangla.blade.php`](resources/views/bangla.blade.php)):

```blade
{{ BanglaNumber::toWords($number) }}
{{ BanglaDate::format($date, 'l, j F Y') }}
{{ bn_number(1250) }} টাকা
```

**Phone Validator** in a route ([`routes/web.php`](routes/web.php)):

```php
use Sanvalabs\BdPhone\Facades\BdPhone;
use Sanvalabs\BdPhone\Rules\ValidBdPhone;

$request->validate([
    'phone' => ['required', new ValidBdPhone(['Grameenphone', 'Robi'])],
]);

BdPhone::operator($request->phone);       // Grameenphone
BdPhone::international($request->phone);  // +8801712345678
```

## Project structure

```
routes/web.php                      All routes: /, /bangla, /phone
resources/views/
├── layouts/app.blade.php           Shared layout: header, footer, styles
├── home.blade.php                  Home page
├── bangla.blade.php                Bangla Converter demo
└── phone.blade.php                 Phone Validator demo
config/app.php                      Timezone set to Asia/Dhaka
```

## Notes

- The timezone is `Asia/Dhaka`, so times show in Bangladesh time.
- Sessions and cache use files (`SESSION_DRIVER=file`, `CACHE_STORE=file`), which is why no database is needed.

## License

MIT

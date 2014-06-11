# Laravel YAML Translations
Snazzy intro coming soon...

[![Build Status](https://travis-ci.org/akuzemchak/laravel-yaml-translations.svg?branch=master)](https://travis-ci.org/akuzemchak/laravel-yaml-translations)

## Requirements

* PHP 5.3+
* Laravel 4.1+

## Installation

First, add the package to your `composer.json` dependencies:

```
{
    "require": {
        "kuz/laravel-yaml-translations": "0.*"
    }
}
```

Next, you'll need to **replace** the default service provider with the new one in `app/config/app.php`:

```
// 'Illuminate\Translation\TranslationServiceProvider',
'Kuz\Translation\TranslationServiceProvider',
```

That should be it! You can now name your language files with a `.yml` extension, and use valid YAML arrays for your translations, like so:

```
name_label: Your Name
email_label: Your Email Address
password_label: Choose a Password
```

**Also worth noting:** If a language file with a `.yml` extension is not found, the loader will fall back to using the PHP language file if one exists. This means you don't have to convert the stock language files, like `validation.php`!

## Support

Use the [issue tracker](https://github.com/akuzemchak/laravel-yaml-translations/issues).
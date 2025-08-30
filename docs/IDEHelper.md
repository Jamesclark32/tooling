## Laravel IDE Helper

Generates helper files and PHPDoc to improve IDE autocompletion and developer experience for Laravel facades, Eloquent models, and magic properties/methods.

https://github.com/barryvdh/laravel-ide-helper

```bash 
composer require --dev barryvdh/laravel-ide-helper
php artisan vendor:publish --provider="Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider" --tag=config
```

- Generate base helper: `php artisan ide-helper:generate` creates `_ide_helper.php`.
- Generate model docs: `php artisan ide-helper:models --nowrite` creates `_ide_helper_models.php`.
- Generate meta for PhpStorm: `php artisan ide-helper:meta` creates `.phpstorm.meta.php`.

- `--nowrite` controls writing a standalone file rather than modifying models, etc. directly.
- Regenerate these files after upgrading Laravel or packages that change facades or model relations/casts.
- Add `_ide_helper.php, _ide_helper_models.php, and .phpstorm.meta.php` files to .gitignore. They are for local development assistance only and should not be considered part of the codebase.


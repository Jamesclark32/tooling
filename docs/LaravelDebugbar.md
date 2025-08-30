## Laravel Debugbar

Visual toolbar for runtime profiling in Laravel apps. Shows timing, queries, exceptions, logs, routes, views, and more.

https://github.com/barryvdh/laravel-debugbar

  ```bash
  composer require --dev barryvdh/laravel-debugbar
  php artisan vendor:publish --provider="Barryvdh\\Debugbar\\ServiceProvider"
  ```

- Enable/disable with env/config:
  - Driven by `APP_DEBUG=true`, or override with explicit `DEBUGBAR_ENABLED=true`.
- Never enable in production or public-facing environments. Sensitive information is exposed.

Usage tips:
- Open any web route in a browser while running your app; the bar appears at the bottom.
- The panel is interactive with many tabs; explore and get familiar with it.
- Adds overhead and will impact performance.
- Ensure production environments have `APP_DEBUG=false` and `DEBUGBAR_ENABLED=false`.



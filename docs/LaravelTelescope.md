## Laravel Telescope

Debug assistant and application insights for Laravel. Provides a dashboard to inspect a wealth of information about the application, including requests, jobs, queues, exceptions, logs, cache, queries, dumps, notifications, mail, schedule, and more.

- https://github.com/laravel/telescope
- https://laravel.com/docs/telescope

```bash
composer require --dev laravel/telescope
php artisan telescope:install
php artisan migrate
```

Access:
- Dashboard: /telescope
- Authorization is enforced via TelescopeServiceProvider::gate(). By default, the local environment is allowed. Update the gate to allow specific users/emails in non-local environments.

Notes:
- Avoid enabling in production. It exposes sensitive data and adds significant resource overhead.
- Include a safety check in your non-local .envs: `TELESCOPE_ENABLED=false`
- Configuration lives in config/telescope.php (published by install). Common toggles:
  - Storage driver, watched entries, and recorders (requests, queries, logs, cache, redis, queue, mail, notifications, exceptions, dumps, events, schedule, etc.).
  - You can disable specific watchers to reduce overhead.
- Typical enablement is environment-based (APP_ENV=local). If you add a custom toggle, prefer an env like TELESCOPE_ENABLED and read it in config/telescope.php.

- As with Debugbar, there is a lot of information here. Spend time getting familiar with it.
- Keep it disabled in tests and CI to reduce overhead.
- Telescope writes a lot of data (database by default). Prune regularly to control growth.

- Configure pruning in app/Console/Kernel.php via the schedule helper:
  ```php
  use Laravel\Telescope\Telescope;

  // in schedule(Schedule $schedule):
  $schedule->command('telescope:prune --hours=168')->daily();
  ```
- Adjust 168 as appropriate for your needs.

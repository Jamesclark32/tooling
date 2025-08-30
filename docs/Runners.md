## Runners

Where and how to run all these tools?

### GitHub Actions
- Preferred place for definitive runs with a consistent environment.
- Link results to specific commits/PRs.
- Try not to merge code without seeing a healthy set of GitHub Actions fully pass for those changes.

Typical commands used in CI:
```bash
php artisan test --coverage
./vendor/bin/phpstan analyse --memory-limit=2G
./vendor/bin/pint --dirty --test
```

## Dev Audit

I wrote dev-audit to provide a tool to quickly and easily run these tools locally and ensure all intended checks have been run as expected.

https://github.com/jamesclark32/dev-audit
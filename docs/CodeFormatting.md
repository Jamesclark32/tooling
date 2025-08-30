## Code Formatting

Automatically enforce stylistic and formatting rules.

### Pint

Automatic code formatting for PHP code. Highly configurable, but in general should be used to enforce (in order)

https://github.com/laravel/pint

- [PSR-12](https://www.php-fig.org/psr/psr-12/)
- Laravel’s community style, captured by Pint’s `laravel` preset.
- Team coding standards
- Your own personal preferences

Notes:
- Scope to changed files with `--dirty`.
- Default behavior modifies files; use `--test` to report only.
- Highly configurable.

---

### Prettier

Automatic code formatting for Javascript and Typescript. 

https://github.com/prettier/prettier

Notes:
- Scope to changed files with the provided script: `npm run format:dirty` (see package.json).
- Default behavior formats files; use `--dry-run` to report only.
- Highly configurable.
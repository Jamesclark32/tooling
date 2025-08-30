## Static Analysis

Static analysis inspects code without executing it to catch bugs, type mismatches, unreachable code, and consistency issues early.

---

### PHPStan / Larastan

- PHPStan analyzes PHP code for potential issues and type problems.
- Larastan adds Laravel-specific insights on top of PHPStan.
- Robust and highly configurable.

Install:

`composer require larastan/larastan --dev`

Guidance:
- Use static analysis to keep code clean and consistent.
- Prefer targeted ignore rules over awkward code changes.
- Treat findings as a guide to better practices.

Rule level:
- Levels range from 0 (least strict) to 10 (most strict).
- Start high (max/10), then dial back to a practical 7–8 if needed.

Example phpstan.neon:

```neon
includes:
  - vendor/larastan/larastan/extension.neon
  - vendor/nesbot/carbon/extension.neon

parameters:
  paths:
    - app/
  level: 8
  tips:
    treatPhpDocTypesAsCertain: false
  ignoreErrors:
    - identifier: missingType.generics
    - identifier: missingType.iterableValue
    - identifier: larastan.noUnnecessaryCollectionCall
    - identifier: argument.templateType
    - identifier: instanceof.alwaysFalse
```

---

### ESLint

ESLint provides static analysis for JavaScript/TypeScript to detect code issues and enforce best practices.

https://eslint.org/


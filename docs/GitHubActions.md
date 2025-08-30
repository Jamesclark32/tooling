## GitHub Actions

Use GitHub Actions to automate repository health checks and CI.

https://docs.github.com/en/actions

### Tooling runs
- Run tests, static analysis, and format checks on every push/PR.
- Provides consistent environments and traceable results linked to commits/PRs.

### Dependabot
- Built-in automated dependency updates for GitHub repositories.
- Keeps third-party packages current and flags security issues.

GitHub Actions are powerful and versatile. They are also often fragile and problematic. Keep configuration and processes as simple as possible.

A change to the codebase requiring changes or additional complication to GitHub Actions is often an early indicator that the change is overly complex and problematic.
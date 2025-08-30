## Dependency Checks

Monitor third-party packages for updates and vulnerabilities.

```bash
composer audit
npm audit
```

I recommend automating upgrades in [GitHubActions](GitHubActions.md), but also highly recommend adding these to your list of regularly run commands to drive awareness of current status. 
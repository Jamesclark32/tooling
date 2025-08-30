## Spell Check
Peck is a simple tool to detect spelling errors in your codebase.

https://github.com/peckphp/peck

Example (aligned with src/peck.json):

```json
{
  "preset": "laravel",
  "ignore": {
    "words": [
      "apis",
      "barryvdh",
      "composables",
      "debugbar",
      "dropdown",
      "dto",
      "eslint",
      "favicon",
      "filesystems",
      "inertiajs",
      "js",
      "nav",
      "php",
      "rss",
      "ssr",
      "tooltip",
      "tsconfig",
      "upsertable",
      "utils",
      "uuid",
      "viewport",
      "wayfinder"
    ],
    "paths": []
  }
}
```

Notes:
- Keep this list minimal and project-specific.
- Prefer fixing typos over adding ignore words.
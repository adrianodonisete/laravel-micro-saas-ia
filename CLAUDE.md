<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.4
- laravel/framework (LARAVEL) - v13
- laravel/prompts (PROMPTS) - v0
- laravel/sanctum (SANCTUM) - v4
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== tests rules ===

# Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test --compact` with a specific filename or filter.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- The `{name}` argument should not include the test suite directory. Use `php artisan make:test --pest SomeFeatureTest` instead of `php artisan make:test --pest Feature/SomeFeatureTest`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>

<!-- rtk-instructions v2 -->
# RTK (Rust Token Killer) - Token-Optimized Commands

## Golden Rule

**Always prefix commands with `.\rtk.cmd`** (project-local WSL bridge). If RTK has a dedicated filter, it uses it. If not, it passes through unchanged. This means RTK is always safe to use.

**Important**: Even in command chains with PowerShell semicolons, use RTK:
```powershell
# ❌ Wrong
git add .; if ($?) { git commit -m "msg" }; if ($?) { git push }

# ✅ Correct
.\rtk.cmd git add .; if ($?) { .\rtk.cmd git commit -m "msg" }; if ($?) { .\rtk.cmd git push }
```

## RTK Commands by Workflow

### Build & Compile (80-90% savings)
```bash
.\rtk.cmd cargo build         # Cargo build output
.\rtk.cmd cargo check         # Cargo check output
.\rtk.cmd cargo clippy        # Clippy warnings grouped by file (80%)
.\rtk.cmd tsc                 # TypeScript errors grouped by file/code (83%)
.\rtk.cmd lint                # ESLint/Biome violations grouped (84%)
.\rtk.cmd prettier --check    # Files needing format only (70%)
.\rtk.cmd next build          # Next.js build with route metrics (87%)
```

### Test (60-99% savings)
```bash
.\rtk.cmd cargo test          # Cargo test failures only (90%)
.\rtk.cmd go test             # Go test failures only (90%)
.\rtk.cmd jest                # Jest failures only (99.5%)
.\rtk.cmd vitest              # Vitest failures only (99.5%)
.\rtk.cmd playwright test     # Playwright failures only (94%)
.\rtk.cmd pytest              # Python test failures only (90%)
.\rtk.cmd rake test           # Ruby test failures only (90%)
.\rtk.cmd rspec               # RSpec test failures only (60%)
.\rtk.cmd test <cmd>          # Generic test wrapper - failures only
```

### Git (59-80% savings)
```bash
.\rtk.cmd git status          # Compact status
.\rtk.cmd git log             # Compact log (works with all git flags)
.\rtk.cmd git diff            # Compact diff (80%)
.\rtk.cmd git show            # Compact show (80%)
.\rtk.cmd git add             # Ultra-compact confirmations (59%)
.\rtk.cmd git commit          # Ultra-compact confirmations (59%)
.\rtk.cmd git push            # Ultra-compact confirmations
.\rtk.cmd git pull            # Ultra-compact confirmations
.\rtk.cmd git branch          # Compact branch list
.\rtk.cmd git fetch           # Compact fetch
.\rtk.cmd git stash           # Compact stash
.\rtk.cmd git worktree        # Compact worktree
```

Note: Git passthrough works for ALL subcommands, even those not explicitly listed.

### GitHub (26-87% savings)
```bash
.\rtk.cmd gh pr view <num>    # Compact PR view (87%)
.\rtk.cmd gh pr checks        # Compact PR checks (79%)
.\rtk.cmd gh run list         # Compact workflow runs (82%)
.\rtk.cmd gh issue list       # Compact issue list (80%)
.\rtk.cmd gh api              # Compact API responses (26%)
```

### JavaScript/TypeScript Tooling (70-90% savings)
```bash
.\rtk.cmd pnpm list           # Compact dependency tree (70%)
.\rtk.cmd pnpm outdated       # Compact outdated packages (80%)
.\rtk.cmd pnpm install        # Compact install output (90%)
.\rtk.cmd npm run <script>    # Compact npm script output
.\rtk.cmd npx <cmd>           # Compact npx command output
.\rtk.cmd prisma              # Prisma without ASCII art (88%)
```

### Files & Search (60-75% savings)
```bash
.\rtk.cmd ls <path>           # Tree format, compact (65%)
.\rtk.cmd read <file>         # Code reading with filtering (60%)
.\rtk.cmd grep <pattern>      # Search grouped by file (75%). Format flags (-c, -l, -L, -o, -Z) run raw.
.\rtk.cmd find <pattern>      # Find grouped by directory (70%)
```

### Analysis & Debug (70-90% savings)
```bash
.\rtk.cmd err <cmd>           # Filter errors only from any command
.\rtk.cmd log <file>          # Deduplicated logs with counts
.\rtk.cmd json <file>         # JSON structure without values
.\rtk.cmd deps                # Dependency overview
.\rtk.cmd env                 # Environment variables compact
.\rtk.cmd summary <cmd>       # Smart summary of command output
.\rtk.cmd diff                # Ultra-compact diffs
```

### Infrastructure (85% savings)
```bash
.\rtk.cmd docker ps           # Compact container list
.\rtk.cmd docker images       # Compact image list
.\rtk.cmd docker logs <c>     # Deduplicated logs
.\rtk.cmd kubectl get         # Compact resource list
.\rtk.cmd kubectl logs        # Deduplicated pod logs
```

### Network (65-70% savings)
```bash
.\rtk.cmd curl <url>          # Compact HTTP responses (70%)
.\rtk.cmd wget <url>          # Compact download output (65%)
```

### Meta Commands
```bash
.\rtk.cmd gain                # View token savings statistics
.\rtk.cmd gain --history      # View command history with savings
.\rtk.cmd discover            # Analyze Claude Code sessions for missed RTK usage
.\rtk.cmd proxy <cmd>         # Run command without filtering (for debugging)
.\rtk.cmd init                # Add RTK instructions to CLAUDE.md
.\rtk.cmd init --global       # Add RTK to ~/.claude/CLAUDE.md
```

## Token Savings Overview

| Category | Commands | Typical Savings |
|----------|----------|-----------------|
| Tests | vitest, playwright, cargo test | 90-99% |
| Build | next, tsc, lint, prettier | 70-87% |
| Git | status, log, diff, add, commit | 59-80% |
| GitHub | gh pr, gh run, gh issue | 26-87% |
| Package Managers | pnpm, npm, npx | 70-90% |
| Files | ls, read, grep, find | 60-75% |
| Infrastructure | docker, kubectl | 85% |
| Network | curl, wget | 65-70% |

Overall average: **60-90% token reduction** on common development operations.
<!-- /rtk-instructions -->
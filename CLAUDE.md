# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

`forxer/gravatar` is a standalone PHP library for generating Gravatar image and profile URLs. It provides a fluent API with type-safe enums. Requires PHP 8.4+.

## Commands

```bash
# All checks at once (lint + analyse + test)
composer check

# Individual commands
composer test       # Run tests (Pest)
composer lint       # Check code style (Pint)
composer fix        # Fix code style
composer analyse    # Static analysis (PHPStan level max)
composer refactor   # Rector (PHP 8.4 modernization + code quality)

# Rector dry-run (preview changes)
vendor/bin/rector process --dry-run
```

## Architecture

The library uses a trait-based composition pattern with PHP 8.4 property hooks for validation:

- **`Gravatar`** — Base class: static factory (`::image()`, `::images()`, `::profile()`, `::profiles()`), shared constructor, `copy()`, and `hash()` method. Uses `HasEmail` trait.
- **`Image extends Gravatar implements GravatarInterface`** — Builds avatar URLs via `url()`. Composes traits for each URL parameter.
- **`Profile extends Gravatar implements GravatarInterface`** — Builds profile API v3 URLs (`api.gravatar.com/v3/profiles/{sha256}`), has `getData()` for fetching profile data. Overrides `hash()` to use SHA-256 instead of MD5.

**Concerns (traits)** use a dual getter/setter pattern: `->method()` returns value, `->method($val)` sets and returns `$this`. Properties with validation use PHP 8.4 **property hooks** (`set` hooks with union type acceptance like `set(Extension|string|null $value)`). Hookless properties use **asymmetric visibility** (`public private(set)`).

- `HasEmail` — shared, with set hook for trim/lowercase normalization, `private(set)`
- `ImageHasDefault` — composes `ImageForceDefault` + `ImageHasInitials`, property hook with enum validation
- `ImageHasSize` — property hook with size range validation
- `ImageHasExtension`, `ImageHasMaxRating` — property hooks with enum validation via `tryFrom()`
- `ImageForceDefault`, `ImageHasInitials` — `private(set)` properties

**Interfaces:**
- `GravatarInterface extends Stringable` — contract for `url()` and `copy()`, implemented by Image and Profile
- `GravatarExceptionInterface` — marker interface implemented by all 5 exceptions

**Enums** (`src/Enum/`) — Backed string enums: `DefaultImage`, `Extension`, `Rating`. Each has `values()` and `tryFromString()` helpers.

**Exceptions** (`src/Exception/`) — One per validation rule. `MissingEmailException` extends `LogicException`, all others extend `DomainException`. All implement `GravatarExceptionInterface`.

## Code Style

- Laravel Pint preset with `native_function_invocation` (backslash-prefixed: `\in_array`, `\sprintf`, etc.)
- PHPStan at level max — zero errors
- Rector configured for PHP 8.4 sets + deadCode, codeQuality, codingStyle, typeDeclarations, instanceOf, earlyReturn
- 4 spaces indentation, UTF-8, LF line endings (see `.editorconfig`)

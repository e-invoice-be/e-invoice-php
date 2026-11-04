# Contributing

e-invoice.be maintains this SDK. All changes to the code are manual: no code generator writes to this repository.

## Setting up the environment

The SDK supports PHP 8.1 and higher, but the development tools (Pest, PHPUnit 11) need PHP 8.2 or higher. You also need [Composer](https://getcomposer.org).

```sh
./scripts/bootstrap
```

## Making a change

1. Make a branch from `main`.
2. Change the code and add or update the tests.
3. Run the checks (see below).
4. Open a pull request to `main`. The CI workflow runs these jobs on each pull request:
   - `lint` (PHP 8.3): `composer validate --strict`, `composer audit`, PHPStan and the format check.
   - `test`: Pest on PHP 8.2, 8.3, 8.4 and 8.5, plus one job on PHP 8.2 with the lowest versions that `composer.json` allows (`composer update --prefer-lowest --prefer-stable`).
   - `coverage` (PHP 8.3 with PCOV): Pest with a minimum line coverage of 95% (`composer test:coverage`). The report is uploaded as the `coverage` artifact.
   - `syntax` (PHP 8.1, the lowest supported version): `php -l` on each file in `src/`, because the test tools do not run on 8.1.

## Running the checks

```sh
composer lint           # PHPStan
composer test           # Pest
composer test:coverage  # Pest with line coverage, fails below 95% (needs PCOV or Xdebug)
composer format:check   # php-cs-fixer, report only (./scripts/format --check)
composer format         # php-cs-fixer, fix the files (./scripts/format)
```

The coverage run writes `build/coverage/clover.xml` and `build/coverage/coverage.txt`. When a coverage driver is loaded, PHPUnit collects coverage on every run; run `composer test -- --no-coverage` to skip it.

CI fails when `composer format:check` finds a file to fix, so run `composer format` before you push.

To check that the lowest allowed dependency versions still work, as the CI job does:

```sh
composer update --prefer-lowest --prefer-stable
composer test
composer update   # back to the newest versions
```

The tests need no network and no mock server. The service tests in `tests/Services/` use `Tests\Support\MockClient`, a PSR-18 client that records each request and replies with the queued responses. A test for an endpoint must make assertions on the request method, the path, the query and the body.

## Releasing

Releases are manual. The package on Packagist is [`e-invoice/e-invoice-api`](https://packagist.org/packages/e-invoice/e-invoice-api). Packagist reads new tags through the GitHub webhook of this repository, so a publish step is not necessary.

1. Select the new version. This package follows [SemVer](https://semver.org/spec/v2.0.0.html). While the major version is `0`, a breaking change increases the minor version.
2. Change `Client::VERSION` in `src/Client.php`. The `User-Agent` header uses this constant.
3. Add the entry for the new version at the top of `CHANGELOG.md`. Put breaking changes in a `⚠ BREAKING CHANGES` section.
4. Merge these changes to `main` through a pull request. They can be a pull request of their own (`release: X.Y.Z`) or part of the last pull request of the release.
5. Make the tag on the merge commit and push it:

   ```sh
   git checkout main && git pull
   git tag vX.Y.Z
   git push origin vX.Y.Z
   ```

6. Make the GitHub release from the tag, with the changelog entry as the text:

   ```sh
   gh release create vX.Y.Z --title vX.Y.Z --notes-file <file with the changelog entry>
   ```

7. Make sure that the new version shows on [Packagist](https://packagist.org/packages/e-invoice/e-invoice-api).

## Reporting security problems

See [SECURITY.md](SECURITY.md).

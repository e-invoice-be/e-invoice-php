# Contributing

e-invoice.be maintains this SDK. All changes to the code are manual: no code generator writes to this repository.

## Setting up the environment

You need PHP 8.1 or higher and [Composer](https://getcomposer.org).

```sh
./scripts/bootstrap
```

## Making a change

1. Make a branch from `main`.
2. Change the code and add or update the tests.
3. Run the checks (see below).
4. Open a pull request to `main`. The CI workflow runs the lint and test jobs on each pull request.

## Running the checks

```sh
composer lint      # PHPStan
composer test      # Pest
./scripts/format   # php-cs-fixer
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

# e-invoice.be PHP API library

This library provides convenient access to the e-invoice REST API from any PHP 8.1.0+ application.

To get an API key, [make a free account](https://app.e-invoice.be/register?ref=php) and register your company.

## Documentation

The full REST API documentation can be found on [api.e-invoice.be](https://api.e-invoice.be).

## Installation

To use this package, install via Composer by adding the following to your application's `composer.json`:

<!-- x-release-please-start-version -->

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:e-invoice-be/e-invoice-php.git"
    }
  ],
  "require": {
    "e-invoice-be/e-invoice": "dev-main"
  }
}
```

<!-- x-release-please-end -->

## Usage

This library uses named parameters to specify optional arguments.
Parameters with a default value must be set by name.

```php
<?php

use EInvoiceAPI\Client;

$client = new Client(apiKey: getenv("E_INVOICE_API_KEY") ?: "My API Key");

$documentResponse = $client->documents->create();

var_dump($documentResponse->id);
```

### Value Objects

It is recommended to use the static `with` constructor `DocumentAttachmentCreate::with(fileName: "file_name", ...)`
and named parameters to initialize value objects.

However, builders are also provided `(new DocumentAttachmentCreate)->withFileName("file_name")`.

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `EInvoiceAPI\Errors\APIError` will be thrown:

```php
<?php

use EInvoiceAPI\Errors\APIConnectionError;

try {
  $documentResponse = $client->documents->create();
} catch (APIConnectionError $e) {
  echo "The server could not be reached", PHP_EOL;
  var_dump($e->getPrevious());
} catch (RateLimitError $_) {
  echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusError $e) {
  echo "Another non-200-range status code was received", PHP_EOL;
  echo $e->getMessage();
}
```

Error codes are as follows:

| Cause            | Error Type                 |
| ---------------- | -------------------------- |
| HTTP 400         | `BadRequestError`          |
| HTTP 401         | `AuthenticationError`      |
| HTTP 403         | `PermissionDeniedError`    |
| HTTP 404         | `NotFoundError`            |
| HTTP 409         | `ConflictError`            |
| HTTP 422         | `UnprocessableEntityError` |
| HTTP 429         | `RateLimitError`           |
| HTTP >= 500      | `InternalServerError`      |
| Other HTTP error | `APIStatusError`           |
| Timeout          | `APITimeoutError`          |
| Network error    | `APIConnectionError`       |

### Retries

Certain errors will be automatically retried 2 times by default, with a short exponential backoff.

Connection errors (for example, due to a network connectivity problem), 408 Request Timeout, 409 Conflict, 429 Rate Limit, >=500 Internal errors, and timeouts will all be retried by default.

You can use the `max_retries` option to configure or disable this:

```php
<?php

use EInvoiceAPI\Client;
use EInvoiceAPI\RequestOptions;

// Configure the default for all requests:
$client = new Client(maxRetries: 0);

// Or, configure per-request:
$result = $client->documents->create(new RequestOptions(maxRetries: 5));
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Note: the `extra_` parameters of the same name overrides the documented parameters.

```php
<?php

use EInvoiceAPI\RequestOptions;

$documentResponse = $client->documents->create(
  new RequestOptions(
    extraQueryParams: ["my_query_parameter" => "value"],
    extraBodyParams: ["my_body_parameter" => "value"],
    extraHeaders: ["my-header" => "value"],
  ),
);

var_dump($documentResponse["my_undocumented_property"]);
```

#### Undocumented request params

If you want to explicitly send an extra param, you can do so with the `extra_query`, `extra_body`, and `extra_headers` under the `request_options:` parameter when making a request, as seen in the examples above.

#### Undocumented endpoints

To make requests to undocumented endpoints while retaining the benefit of auth, retries, and so on, you can make requests using `client.request`, like so:

```php
<?php

$response = $client->request(
  method: "post",
  path: '/undocumented/endpoint',
  query: ['dog' => 'woof'],
  headers: ['useful-header' => 'interesting-value'],
  body: ['hello' => 'world']
);
```

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

This package considers improvements to the (non-runtime) PHPDoc type definitions to be non-breaking changes.

## Requirements

PHP 8.1.0 or higher.

## Contributing

See [the contributing documentation](https://github.com/e-invoice-be/e-invoice-php/tree/main/CONTRIBUTING.md).

<?php

declare(strict_types=1);

namespace EInvoiceAPI;

use EInvoiceAPI\Core\BaseClient;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Services\DocumentsService;
use EInvoiceAPI\Services\InboxService;
use EInvoiceAPI\Services\LookupService;
use EInvoiceAPI\Services\MeService;
use EInvoiceAPI\Services\OutboxService;
use EInvoiceAPI\Services\ValidateService;
use EInvoiceAPI\Services\WebhooksService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \EInvoiceAPI\Core\BaseClient
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public DocumentsService $documents;

    /**
     * @api
     */
    public InboxService $inbox;

    /**
     * @api
     */
    public OutboxService $outbox;

    /**
     * @api
     */
    public ValidateService $validate;

    /**
     * @api
     */
    public LookupService $lookup;

    /**
     * @api
     */
    public MeService $me;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? Util::getenv('E_INVOICE_API_KEY'));

        $baseUrl ??= Util::getenv(
            'E_INVOICE_BASE_URL'
        ) ?: 'https://api.e-invoice.be';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('e-invoice/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => '0.0.1',
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('E_INVOICE_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options
        );

        $this->documents = new DocumentsService($this);
        $this->inbox = new InboxService($this);
        $this->outbox = new OutboxService($this);
        $this->validate = new ValidateService($this);
        $this->lookup = new LookupService($this);
        $this->me = new MeService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}

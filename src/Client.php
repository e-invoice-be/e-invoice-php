<?php

declare(strict_types=1);

namespace EInvoiceAPI;

use EInvoiceAPI\Core\BaseClient;
use EInvoiceAPI\Services\DocumentsService;
use EInvoiceAPI\Services\InboxService;
use EInvoiceAPI\Services\LookupService;
use EInvoiceAPI\Services\OutboxService;
use EInvoiceAPI\Services\ValidateService;
use EInvoiceAPI\Services\WebhooksService;

class Client extends BaseClient
{
    public string $apiKey;

    public DocumentsService $documents;

    public InboxService $inbox;

    public OutboxService $outbox;

    public ValidateService $validate;

    public LookupService $lookup;

    public WebhooksService $webhooks;

    public function __construct(?string $apiKey = null, ?string $baseUrl = null)
    {
        $this->apiKey = (string) ($apiKey ?? getenv('E_INVOICE_API_KEY'));

        $base = $baseUrl ?? getenv(
            'E_INVOICE_BASE_URL'
        ) ?: 'https://api.e-invoice.be';

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json', 'Accept' => 'application/json',
            ],
            baseUrl: $base,
            options: new RequestOptions,
        );

        $this->documents = new DocumentsService($this);
        $this->inbox = new InboxService($this);
        $this->outbox = new OutboxService($this);
        $this->validate = new ValidateService($this);
        $this->lookup = new LookupService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /** @return array<string, string> */
    protected function authHeaders(): array
    {
        if (!$this->apiKey) {
            return [];
        }

        return ['Authorization' => "Bearer {$this->apiKey}"];
    }
}

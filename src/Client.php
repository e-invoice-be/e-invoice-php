<?php

declare(strict_types=1);

namespace EInvoiceAPI;

use EInvoiceAPI\Core\BaseClient;
use EInvoiceAPI\Resources\Documents;
use EInvoiceAPI\Resources\Inbox;
use EInvoiceAPI\Resources\Lookup;
use EInvoiceAPI\Resources\Outbox;
use EInvoiceAPI\Resources\Validate;
use EInvoiceAPI\Resources\Webhooks;

class Client extends BaseClient
{
    public string $apiKey;

    public Documents $documents;

    public Inbox $inbox;

    public Outbox $outbox;

    public Validate $validate;

    public Lookup $lookup;

    public Webhooks $webhooks;

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
            options: new RequestOptions(),
        );

        $this->documents = new Documents($this);
        $this->inbox = new Inbox($this);
        $this->outbox = new Outbox($this);
        $this->validate = new Validate($this);
        $this->lookup = new Lookup($this);
        $this->webhooks = new Webhooks($this);
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

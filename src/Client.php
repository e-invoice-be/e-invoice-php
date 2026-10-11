<?php

declare(strict_types=1);

namespace EInvoiceAPI;

use EInvoiceAPI\Core\BaseClient;
use EInvoiceAPI\Services\ConversionService;
use EInvoiceAPI\Services\DocumentsService;
use EInvoiceAPI\Services\DraftsService;
use EInvoiceAPI\Services\InboxService;
use EInvoiceAPI\Services\LookupService;
use EInvoiceAPI\Services\MailboxService;
use EInvoiceAPI\Services\MeService;
use EInvoiceAPI\Services\OutboxService;
use EInvoiceAPI\Services\StatsService;
use EInvoiceAPI\Services\ValidateService;
use EInvoiceAPI\Services\WebhooksService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

class Client extends BaseClient
{
    public const VERSION = '0.7.0';

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
    public DraftsService $drafts;

    /**
     * @api
     */
    public MailboxService $mailbox;

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
    public ConversionService $conversion;

    /**
     * @api
     */
    public MeService $me;

    /**
     * @api
     */
    public StatsService $stats;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    public function __construct(?string $apiKey = null, ?string $baseUrl = null)
    {
        $this->apiKey = (string) ($apiKey ?? getenv('E_INVOICE_API_KEY'));

        $baseUrl ??= getenv('E_INVOICE_BASE_URL') ?: 'https://api.e-invoice.be';

        $options = RequestOptions::with(
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            transporter: Psr18ClientDiscovery::find(),
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('e-invoice/PHP %s', self::VERSION),
            ],
            baseUrl: $baseUrl,
            options: $options,
        );

        $this->documents = new DocumentsService($this);
        $this->inbox = new InboxService($this);
        $this->outbox = new OutboxService($this);
        $this->drafts = new DraftsService($this);
        $this->mailbox = new MailboxService($this);
        $this->validate = new ValidateService($this);
        $this->lookup = new LookupService($this);
        $this->conversion = new ConversionService($this);
        $this->me = new MeService($this);
        $this->stats = new StatsService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }
}

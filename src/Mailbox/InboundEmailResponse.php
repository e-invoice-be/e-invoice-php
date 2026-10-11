<?php

declare(strict_types=1);

namespace EInvoiceAPI\Mailbox;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Mailbox\InboundEmailResponse\Attachment;

/**
 * @phpstan-type InboundEmailResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   messageID: string,
 *   senderEmail: string,
 *   attachmentCount?: int|null,
 *   attachments?: list<Attachment>|null,
 *   bccAddresses?: string|null,
 *   ccAddresses?: string|null,
 *   documentID?: string|null,
 *   errorMessage?: string|null,
 *   processed?: bool|null,
 *   processedAt?: \DateTimeInterface|null,
 *   receivedAt?: \DateTimeInterface|null,
 *   senderName?: string|null,
 *   subject?: string|null,
 *   toAddresses?: string|null,
 * }
 */
final class InboundEmailResponse implements BaseModel
{
    /** @use SdkModel<InboundEmailResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('message_id')]
    public string $messageID;

    #[Required('sender_email')]
    public string $senderEmail;

    #[Optional('attachment_count')]
    public ?int $attachmentCount;

    /** @var list<Attachment>|null $attachments */
    #[Optional(list: Attachment::class)]
    public ?array $attachments;

    #[Optional('bcc_addresses', nullable: true)]
    public ?string $bccAddresses;

    #[Optional('cc_addresses', nullable: true)]
    public ?string $ccAddresses;

    #[Optional('document_id', nullable: true)]
    public ?string $documentID;

    #[Optional('error_message', nullable: true)]
    public ?string $errorMessage;

    #[Optional]
    public ?bool $processed;

    #[Optional('processed_at', nullable: true)]
    public ?\DateTimeInterface $processedAt;

    #[Optional('received_at', nullable: true)]
    public ?\DateTimeInterface $receivedAt;

    #[Optional('sender_name', nullable: true)]
    public ?string $senderName;

    #[Optional(nullable: true)]
    public ?string $subject;

    #[Optional('to_addresses', nullable: true)]
    public ?string $toAddresses;

    /**
     * `new InboundEmailResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundEmailResponse::with(
     *   id: ..., createdAt: ..., messageID: ..., senderEmail: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundEmailResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withMessageID(...)
     *   ->withSenderEmail(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Attachment|array{
     *   filename: string, contentType?: string|null, size?: int|null
     * }>|null $attachments
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        string $messageID,
        string $senderEmail,
        ?int $attachmentCount = null,
        ?array $attachments = null,
        ?string $bccAddresses = null,
        ?string $ccAddresses = null,
        ?string $documentID = null,
        ?string $errorMessage = null,
        ?bool $processed = null,
        ?\DateTimeInterface $processedAt = null,
        ?\DateTimeInterface $receivedAt = null,
        ?string $senderName = null,
        ?string $subject = null,
        ?string $toAddresses = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['messageID'] = $messageID;
        $self['senderEmail'] = $senderEmail;

        null !== $attachmentCount && $self['attachmentCount'] = $attachmentCount;
        null !== $attachments && $self['attachments'] = $attachments;
        null !== $bccAddresses && $self['bccAddresses'] = $bccAddresses;
        null !== $ccAddresses && $self['ccAddresses'] = $ccAddresses;
        null !== $documentID && $self['documentID'] = $documentID;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $processed && $self['processed'] = $processed;
        null !== $processedAt && $self['processedAt'] = $processedAt;
        null !== $receivedAt && $self['receivedAt'] = $receivedAt;
        null !== $senderName && $self['senderName'] = $senderName;
        null !== $subject && $self['subject'] = $subject;
        null !== $toAddresses && $self['toAddresses'] = $toAddresses;

        return $self;
    }

    public function withId(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }

    public function withSenderEmail(string $senderEmail): self
    {
        $self = clone $this;
        $self['senderEmail'] = $senderEmail;

        return $self;
    }

    public function withAttachmentCount(int $attachmentCount): self
    {
        $self = clone $this;
        $self['attachmentCount'] = $attachmentCount;

        return $self;
    }

    /**
     * @param list<Attachment|array{
     *   filename: string, contentType?: string|null, size?: int|null
     * }> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }

    public function withBccAddresses(?string $bccAddresses): self
    {
        $self = clone $this;
        $self['bccAddresses'] = $bccAddresses;

        return $self;
    }

    public function withCcAddresses(?string $ccAddresses): self
    {
        $self = clone $this;
        $self['ccAddresses'] = $ccAddresses;

        return $self;
    }

    public function withDocumentID(?string $documentID): self
    {
        $self = clone $this;
        $self['documentID'] = $documentID;

        return $self;
    }

    public function withErrorMessage(?string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }

    public function withProcessed(bool $processed): self
    {
        $self = clone $this;
        $self['processed'] = $processed;

        return $self;
    }

    public function withProcessedAt(?\DateTimeInterface $processedAt): self
    {
        $self = clone $this;
        $self['processedAt'] = $processedAt;

        return $self;
    }

    public function withReceivedAt(?\DateTimeInterface $receivedAt): self
    {
        $self = clone $this;
        $self['receivedAt'] = $receivedAt;

        return $self;
    }

    public function withSenderName(?string $senderName): self
    {
        $self = clone $this;
        $self['senderName'] = $senderName;

        return $self;
    }

    public function withSubject(?string $subject): self
    {
        $self = clone $this;
        $self['subject'] = $subject;

        return $self;
    }

    public function withToAddresses(?string $toAddresses): self
    {
        $self = clone $this;
        $self['toAddresses'] = $toAddresses;

        return $self;
    }
}

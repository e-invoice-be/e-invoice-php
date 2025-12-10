<?php

declare(strict_types=1);

namespace EInvoiceAPI\Me;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Me\MeGetResponse\Plan;

/**
 * @phpstan-type MeGetResponseShape = array{
 *   creditBalance: int,
 *   name: string,
 *   plan: value-of<Plan>,
 *   bccRecipientEmail?: string|null,
 *   companyAddress?: string|null,
 *   companyCity?: string|null,
 *   companyCountry?: string|null,
 *   companyEmail?: string|null,
 *   companyName?: string|null,
 *   companyNumber?: string|null,
 *   companyTaxID?: string|null,
 *   companyZip?: string|null,
 *   description?: string|null,
 *   ibans?: list<string>|null,
 *   peppolIDs?: list<string>|null,
 *   smpRegistration?: bool|null,
 *   smpRegistrationDate?: \DateTimeInterface|null,
 * }
 */
final class MeGetResponse implements BaseModel
{
    /** @use SdkModel<MeGetResponseShape> */
    use SdkModel;

    /**
     * Credit balance of the tenant.
     */
    #[Required('credit_balance')]
    public int $creditBalance;

    #[Required]
    public string $name;

    /**
     * Plan of the tenant.
     *
     * @var value-of<Plan> $plan
     */
    #[Required(enum: Plan::class)]
    public string $plan;

    /**
     * BCC recipient email to deliver documents.
     */
    #[Optional('bcc_recipient_email', nullable: true)]
    public ?string $bccRecipientEmail;

    /**
     * Address of the company. Must be in the form of `Street Name Street Number`.
     */
    #[Optional('company_address', nullable: true)]
    public ?string $companyAddress;

    /**
     * City of the company.
     */
    #[Optional('company_city', nullable: true)]
    public ?string $companyCity;

    /**
     * Country of the company.
     */
    #[Optional('company_country', nullable: true)]
    public ?string $companyCountry;

    /**
     * Email of the company.
     */
    #[Optional('company_email', nullable: true)]
    public ?string $companyEmail;

    /**
     * Name of the company. Must include the company type. For example: `BV`, `NV`, `CVBA`, `VOF`.
     */
    #[Optional('company_name', nullable: true)]
    public ?string $companyName;

    /**
     * Company number. For Belgium this is the CBE number or their EUID (European Unique Identifier) number.
     */
    #[Optional('company_number', nullable: true)]
    public ?string $companyNumber;

    /**
     * Company tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    #[Optional('company_tax_id', nullable: true)]
    public ?string $companyTaxID;

    /**
     * Zip code of the company.
     */
    #[Optional('company_zip', nullable: true)]
    public ?string $companyZip;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * IBANs of the tenant.
     *
     * @var list<string>|null $ibans
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $ibans;

    /**
     * Peppol IDs of the tenant.
     *
     * @var list<string>|null $peppolIDs
     */
    #[Optional('peppol_ids', list: 'string', nullable: true)]
    public ?array $peppolIDs;

    /**
     * Whether the tenant is registered on our SMP.
     */
    #[Optional('smp_registration', nullable: true)]
    public ?bool $smpRegistration;

    /**
     * Date when the tenant was registered on SMP.
     */
    #[Optional('smp_registration_date', nullable: true)]
    public ?\DateTimeInterface $smpRegistrationDate;

    /**
     * `new MeGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MeGetResponse::with(creditBalance: ..., name: ..., plan: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MeGetResponse)->withCreditBalance(...)->withName(...)->withPlan(...)
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
     * @param Plan|value-of<Plan> $plan
     * @param list<string>|null $ibans
     * @param list<string>|null $peppolIDs
     */
    public static function with(
        int $creditBalance,
        string $name,
        Plan|string $plan,
        ?string $bccRecipientEmail = null,
        ?string $companyAddress = null,
        ?string $companyCity = null,
        ?string $companyCountry = null,
        ?string $companyEmail = null,
        ?string $companyName = null,
        ?string $companyNumber = null,
        ?string $companyTaxID = null,
        ?string $companyZip = null,
        ?string $description = null,
        ?array $ibans = null,
        ?array $peppolIDs = null,
        ?bool $smpRegistration = null,
        ?\DateTimeInterface $smpRegistrationDate = null,
    ): self {
        $self = new self;

        $self['creditBalance'] = $creditBalance;
        $self['name'] = $name;
        $self['plan'] = $plan;

        null !== $bccRecipientEmail && $self['bccRecipientEmail'] = $bccRecipientEmail;
        null !== $companyAddress && $self['companyAddress'] = $companyAddress;
        null !== $companyCity && $self['companyCity'] = $companyCity;
        null !== $companyCountry && $self['companyCountry'] = $companyCountry;
        null !== $companyEmail && $self['companyEmail'] = $companyEmail;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $companyNumber && $self['companyNumber'] = $companyNumber;
        null !== $companyTaxID && $self['companyTaxID'] = $companyTaxID;
        null !== $companyZip && $self['companyZip'] = $companyZip;
        null !== $description && $self['description'] = $description;
        null !== $ibans && $self['ibans'] = $ibans;
        null !== $peppolIDs && $self['peppolIDs'] = $peppolIDs;
        null !== $smpRegistration && $self['smpRegistration'] = $smpRegistration;
        null !== $smpRegistrationDate && $self['smpRegistrationDate'] = $smpRegistrationDate;

        return $self;
    }

    /**
     * Credit balance of the tenant.
     */
    public function withCreditBalance(int $creditBalance): self
    {
        $self = clone $this;
        $self['creditBalance'] = $creditBalance;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Plan of the tenant.
     *
     * @param Plan|value-of<Plan> $plan
     */
    public function withPlan(Plan|string $plan): self
    {
        $self = clone $this;
        $self['plan'] = $plan;

        return $self;
    }

    /**
     * BCC recipient email to deliver documents.
     */
    public function withBccRecipientEmail(?string $bccRecipientEmail): self
    {
        $self = clone $this;
        $self['bccRecipientEmail'] = $bccRecipientEmail;

        return $self;
    }

    /**
     * Address of the company. Must be in the form of `Street Name Street Number`.
     */
    public function withCompanyAddress(?string $companyAddress): self
    {
        $self = clone $this;
        $self['companyAddress'] = $companyAddress;

        return $self;
    }

    /**
     * City of the company.
     */
    public function withCompanyCity(?string $companyCity): self
    {
        $self = clone $this;
        $self['companyCity'] = $companyCity;

        return $self;
    }

    /**
     * Country of the company.
     */
    public function withCompanyCountry(?string $companyCountry): self
    {
        $self = clone $this;
        $self['companyCountry'] = $companyCountry;

        return $self;
    }

    /**
     * Email of the company.
     */
    public function withCompanyEmail(?string $companyEmail): self
    {
        $self = clone $this;
        $self['companyEmail'] = $companyEmail;

        return $self;
    }

    /**
     * Name of the company. Must include the company type. For example: `BV`, `NV`, `CVBA`, `VOF`.
     */
    public function withCompanyName(?string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

        return $self;
    }

    /**
     * Company number. For Belgium this is the CBE number or their EUID (European Unique Identifier) number.
     */
    public function withCompanyNumber(?string $companyNumber): self
    {
        $self = clone $this;
        $self['companyNumber'] = $companyNumber;

        return $self;
    }

    /**
     * Company tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    public function withCompanyTaxID(?string $companyTaxID): self
    {
        $self = clone $this;
        $self['companyTaxID'] = $companyTaxID;

        return $self;
    }

    /**
     * Zip code of the company.
     */
    public function withCompanyZip(?string $companyZip): self
    {
        $self = clone $this;
        $self['companyZip'] = $companyZip;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * IBANs of the tenant.
     *
     * @param list<string>|null $ibans
     */
    public function withIbans(?array $ibans): self
    {
        $self = clone $this;
        $self['ibans'] = $ibans;

        return $self;
    }

    /**
     * Peppol IDs of the tenant.
     *
     * @param list<string>|null $peppolIDs
     */
    public function withPeppolIDs(?array $peppolIDs): self
    {
        $self = clone $this;
        $self['peppolIDs'] = $peppolIDs;

        return $self;
    }

    /**
     * Whether the tenant is registered on our SMP.
     */
    public function withSmpRegistration(?bool $smpRegistration): self
    {
        $self = clone $this;
        $self['smpRegistration'] = $smpRegistration;

        return $self;
    }

    /**
     * Date when the tenant was registered on SMP.
     */
    public function withSmpRegistrationDate(
        ?\DateTimeInterface $smpRegistrationDate
    ): self {
        $self = clone $this;
        $self['smpRegistrationDate'] = $smpRegistrationDate;

        return $self;
    }
}

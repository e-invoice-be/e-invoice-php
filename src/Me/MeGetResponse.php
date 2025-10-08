<?php

declare(strict_types=1);

namespace EInvoiceAPI\Me;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;
use EInvoiceAPI\Me\MeGetResponse\Plan;

/**
 * @phpstan-type me_get_response = array{
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
 *   companyZip?: string|null,
 *   description?: string|null,
 *   ibans?: list<string>|null,
 *   peppolIDs?: list<string>|null,
 *   smpRegistration?: bool|null,
 *   smpRegistrationDate?: \DateTimeInterface|null,
 * }
 */
final class MeGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<me_get_response> */
    use SdkModel;

    use SdkResponse;

    /**
     * Credit balance of the tenant.
     */
    #[Api('credit_balance')]
    public int $creditBalance;

    #[Api]
    public string $name;

    /**
     * Plan of the tenant.
     *
     * @var value-of<Plan> $plan
     */
    #[Api(enum: Plan::class)]
    public string $plan;

    /**
     * BCC recipient email to deliver documents.
     */
    #[Api('bcc_recipient_email', nullable: true, optional: true)]
    public ?string $bccRecipientEmail;

    /**
     * Address of the company.
     */
    #[Api('company_address', nullable: true, optional: true)]
    public ?string $companyAddress;

    /**
     * City of the company.
     */
    #[Api('company_city', nullable: true, optional: true)]
    public ?string $companyCity;

    /**
     * Country of the company.
     */
    #[Api('company_country', nullable: true, optional: true)]
    public ?string $companyCountry;

    /**
     * Email of the company.
     */
    #[Api('company_email', nullable: true, optional: true)]
    public ?string $companyEmail;

    /**
     * Name of the company.
     */
    #[Api('company_name', nullable: true, optional: true)]
    public ?string $companyName;

    /**
     * Company number.
     */
    #[Api('company_number', nullable: true, optional: true)]
    public ?string $companyNumber;

    /**
     * Zip code of the company.
     */
    #[Api('company_zip', nullable: true, optional: true)]
    public ?string $companyZip;

    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * IBANs of the tenant.
     *
     * @var list<string>|null $ibans
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $ibans;

    /**
     * Peppol IDs of the tenant.
     *
     * @var list<string>|null $peppolIDs
     */
    #[Api('peppol_ids', list: 'string', nullable: true, optional: true)]
    public ?array $peppolIDs;

    /**
     * Whether the tenant is registered on our SMP.
     */
    #[Api('smp_registration', nullable: true, optional: true)]
    public ?bool $smpRegistration;

    /**
     * Date when the tenant was registered on SMP.
     */
    #[Api('smp_registration_date', nullable: true, optional: true)]
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
        ?string $companyZip = null,
        ?string $description = null,
        ?array $ibans = null,
        ?array $peppolIDs = null,
        ?bool $smpRegistration = null,
        ?\DateTimeInterface $smpRegistrationDate = null,
    ): self {
        $obj = new self;

        $obj->creditBalance = $creditBalance;
        $obj->name = $name;
        $obj['plan'] = $plan;

        null !== $bccRecipientEmail && $obj->bccRecipientEmail = $bccRecipientEmail;
        null !== $companyAddress && $obj->companyAddress = $companyAddress;
        null !== $companyCity && $obj->companyCity = $companyCity;
        null !== $companyCountry && $obj->companyCountry = $companyCountry;
        null !== $companyEmail && $obj->companyEmail = $companyEmail;
        null !== $companyName && $obj->companyName = $companyName;
        null !== $companyNumber && $obj->companyNumber = $companyNumber;
        null !== $companyZip && $obj->companyZip = $companyZip;
        null !== $description && $obj->description = $description;
        null !== $ibans && $obj->ibans = $ibans;
        null !== $peppolIDs && $obj->peppolIDs = $peppolIDs;
        null !== $smpRegistration && $obj->smpRegistration = $smpRegistration;
        null !== $smpRegistrationDate && $obj->smpRegistrationDate = $smpRegistrationDate;

        return $obj;
    }

    /**
     * Credit balance of the tenant.
     */
    public function withCreditBalance(int $creditBalance): self
    {
        $obj = clone $this;
        $obj->creditBalance = $creditBalance;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Plan of the tenant.
     *
     * @param Plan|value-of<Plan> $plan
     */
    public function withPlan(Plan|string $plan): self
    {
        $obj = clone $this;
        $obj['plan'] = $plan;

        return $obj;
    }

    /**
     * BCC recipient email to deliver documents.
     */
    public function withBccRecipientEmail(?string $bccRecipientEmail): self
    {
        $obj = clone $this;
        $obj->bccRecipientEmail = $bccRecipientEmail;

        return $obj;
    }

    /**
     * Address of the company.
     */
    public function withCompanyAddress(?string $companyAddress): self
    {
        $obj = clone $this;
        $obj->companyAddress = $companyAddress;

        return $obj;
    }

    /**
     * City of the company.
     */
    public function withCompanyCity(?string $companyCity): self
    {
        $obj = clone $this;
        $obj->companyCity = $companyCity;

        return $obj;
    }

    /**
     * Country of the company.
     */
    public function withCompanyCountry(?string $companyCountry): self
    {
        $obj = clone $this;
        $obj->companyCountry = $companyCountry;

        return $obj;
    }

    /**
     * Email of the company.
     */
    public function withCompanyEmail(?string $companyEmail): self
    {
        $obj = clone $this;
        $obj->companyEmail = $companyEmail;

        return $obj;
    }

    /**
     * Name of the company.
     */
    public function withCompanyName(?string $companyName): self
    {
        $obj = clone $this;
        $obj->companyName = $companyName;

        return $obj;
    }

    /**
     * Company number.
     */
    public function withCompanyNumber(?string $companyNumber): self
    {
        $obj = clone $this;
        $obj->companyNumber = $companyNumber;

        return $obj;
    }

    /**
     * Zip code of the company.
     */
    public function withCompanyZip(?string $companyZip): self
    {
        $obj = clone $this;
        $obj->companyZip = $companyZip;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * IBANs of the tenant.
     *
     * @param list<string>|null $ibans
     */
    public function withIbans(?array $ibans): self
    {
        $obj = clone $this;
        $obj->ibans = $ibans;

        return $obj;
    }

    /**
     * Peppol IDs of the tenant.
     *
     * @param list<string>|null $peppolIDs
     */
    public function withPeppolIDs(?array $peppolIDs): self
    {
        $obj = clone $this;
        $obj->peppolIDs = $peppolIDs;

        return $obj;
    }

    /**
     * Whether the tenant is registered on our SMP.
     */
    public function withSmpRegistration(?bool $smpRegistration): self
    {
        $obj = clone $this;
        $obj->smpRegistration = $smpRegistration;

        return $obj;
    }

    /**
     * Date when the tenant was registered on SMP.
     */
    public function withSmpRegistrationDate(
        ?\DateTimeInterface $smpRegistrationDate
    ): self {
        $obj = clone $this;
        $obj->smpRegistrationDate = $smpRegistrationDate;

        return $obj;
    }
}

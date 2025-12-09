<?php

declare(strict_types=1);

namespace EInvoiceAPI\Me;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Me\MeGetResponse\Plan;

/**
 * @phpstan-type MeGetResponseShape = array{
 *   credit_balance: int,
 *   name: string,
 *   plan: value-of<Plan>,
 *   bcc_recipient_email?: string|null,
 *   company_address?: string|null,
 *   company_city?: string|null,
 *   company_country?: string|null,
 *   company_email?: string|null,
 *   company_name?: string|null,
 *   company_number?: string|null,
 *   company_tax_id?: string|null,
 *   company_zip?: string|null,
 *   description?: string|null,
 *   ibans?: list<string>|null,
 *   peppol_ids?: list<string>|null,
 *   smp_registration?: bool|null,
 *   smp_registration_date?: \DateTimeInterface|null,
 * }
 */
final class MeGetResponse implements BaseModel
{
    /** @use SdkModel<MeGetResponseShape> */
    use SdkModel;

    /**
     * Credit balance of the tenant.
     */
    #[Api]
    public int $credit_balance;

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
    #[Api(nullable: true, optional: true)]
    public ?string $bcc_recipient_email;

    /**
     * Address of the company. Must be in the form of `Street Name Street Number`.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $company_address;

    /**
     * City of the company.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $company_city;

    /**
     * Country of the company.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $company_country;

    /**
     * Email of the company.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $company_email;

    /**
     * Name of the company. Must include the company type. For example: `BV`, `NV`, `CVBA`, `VOF`.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $company_name;

    /**
     * Company number. For Belgium this is the CBE number or their EUID (European Unique Identifier) number.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $company_number;

    /**
     * Company tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $company_tax_id;

    /**
     * Zip code of the company.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $company_zip;

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
     * @var list<string>|null $peppol_ids
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $peppol_ids;

    /**
     * Whether the tenant is registered on our SMP.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $smp_registration;

    /**
     * Date when the tenant was registered on SMP.
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $smp_registration_date;

    /**
     * `new MeGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MeGetResponse::with(credit_balance: ..., name: ..., plan: ...)
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
     * @param list<string>|null $peppol_ids
     */
    public static function with(
        int $credit_balance,
        string $name,
        Plan|string $plan,
        ?string $bcc_recipient_email = null,
        ?string $company_address = null,
        ?string $company_city = null,
        ?string $company_country = null,
        ?string $company_email = null,
        ?string $company_name = null,
        ?string $company_number = null,
        ?string $company_tax_id = null,
        ?string $company_zip = null,
        ?string $description = null,
        ?array $ibans = null,
        ?array $peppol_ids = null,
        ?bool $smp_registration = null,
        ?\DateTimeInterface $smp_registration_date = null,
    ): self {
        $obj = new self;

        $obj['credit_balance'] = $credit_balance;
        $obj['name'] = $name;
        $obj['plan'] = $plan;

        null !== $bcc_recipient_email && $obj['bcc_recipient_email'] = $bcc_recipient_email;
        null !== $company_address && $obj['company_address'] = $company_address;
        null !== $company_city && $obj['company_city'] = $company_city;
        null !== $company_country && $obj['company_country'] = $company_country;
        null !== $company_email && $obj['company_email'] = $company_email;
        null !== $company_name && $obj['company_name'] = $company_name;
        null !== $company_number && $obj['company_number'] = $company_number;
        null !== $company_tax_id && $obj['company_tax_id'] = $company_tax_id;
        null !== $company_zip && $obj['company_zip'] = $company_zip;
        null !== $description && $obj['description'] = $description;
        null !== $ibans && $obj['ibans'] = $ibans;
        null !== $peppol_ids && $obj['peppol_ids'] = $peppol_ids;
        null !== $smp_registration && $obj['smp_registration'] = $smp_registration;
        null !== $smp_registration_date && $obj['smp_registration_date'] = $smp_registration_date;

        return $obj;
    }

    /**
     * Credit balance of the tenant.
     */
    public function withCreditBalance(int $creditBalance): self
    {
        $obj = clone $this;
        $obj['credit_balance'] = $creditBalance;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

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
        $obj['bcc_recipient_email'] = $bccRecipientEmail;

        return $obj;
    }

    /**
     * Address of the company. Must be in the form of `Street Name Street Number`.
     */
    public function withCompanyAddress(?string $companyAddress): self
    {
        $obj = clone $this;
        $obj['company_address'] = $companyAddress;

        return $obj;
    }

    /**
     * City of the company.
     */
    public function withCompanyCity(?string $companyCity): self
    {
        $obj = clone $this;
        $obj['company_city'] = $companyCity;

        return $obj;
    }

    /**
     * Country of the company.
     */
    public function withCompanyCountry(?string $companyCountry): self
    {
        $obj = clone $this;
        $obj['company_country'] = $companyCountry;

        return $obj;
    }

    /**
     * Email of the company.
     */
    public function withCompanyEmail(?string $companyEmail): self
    {
        $obj = clone $this;
        $obj['company_email'] = $companyEmail;

        return $obj;
    }

    /**
     * Name of the company. Must include the company type. For example: `BV`, `NV`, `CVBA`, `VOF`.
     */
    public function withCompanyName(?string $companyName): self
    {
        $obj = clone $this;
        $obj['company_name'] = $companyName;

        return $obj;
    }

    /**
     * Company number. For Belgium this is the CBE number or their EUID (European Unique Identifier) number.
     */
    public function withCompanyNumber(?string $companyNumber): self
    {
        $obj = clone $this;
        $obj['company_number'] = $companyNumber;

        return $obj;
    }

    /**
     * Company tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    public function withCompanyTaxID(?string $companyTaxID): self
    {
        $obj = clone $this;
        $obj['company_tax_id'] = $companyTaxID;

        return $obj;
    }

    /**
     * Zip code of the company.
     */
    public function withCompanyZip(?string $companyZip): self
    {
        $obj = clone $this;
        $obj['company_zip'] = $companyZip;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

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
        $obj['ibans'] = $ibans;

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
        $obj['peppol_ids'] = $peppolIDs;

        return $obj;
    }

    /**
     * Whether the tenant is registered on our SMP.
     */
    public function withSmpRegistration(?bool $smpRegistration): self
    {
        $obj = clone $this;
        $obj['smp_registration'] = $smpRegistration;

        return $obj;
    }

    /**
     * Date when the tenant was registered on SMP.
     */
    public function withSmpRegistrationDate(
        ?\DateTimeInterface $smpRegistrationDate
    ): self {
        $obj = clone $this;
        $obj['smp_registration_date'] = $smpRegistrationDate;

        return $obj;
    }
}

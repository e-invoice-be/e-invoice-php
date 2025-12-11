<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentCreateParams\Allowance\ReasonCode;
use EInvoiceAPI\Documents\DocumentCreateParams\Allowance\TaxCode;
use EInvoiceAPI\Documents\DocumentCreateParams\Vatex;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Documents\UnitOfMeasureCode;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\DocumentsContract;
use EInvoiceAPI\Services\Documents\AttachmentsService;
use EInvoiceAPI\Services\Documents\UblService;
use EInvoiceAPI\Validate\UblDocumentValidation;

final class DocumentsService implements DocumentsContract
{
    /**
     * @api
     */
    public DocumentsRawService $raw;

    /**
     * @api
     */
    public AttachmentsService $attachments;

    /**
     * @api
     */
    public UblService $ubl;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DocumentsRawService($client);
        $this->attachments = new AttachmentsService($client);
        $this->ubl = new UblService($client);
    }

    /**
     * @api
     *
     * Create a new invoice or credit note
     *
     * @param list<array{
     *   amount?: float|string|null,
     *   baseAmount?: float|string|null,
     *   multiplierFactor?: float|string|null,
     *   reason?: string|null,
     *   reasonCode?: '41'|'42'|'60'|'62'|'63'|'64'|'65'|'66'|'67'|'68'|'70'|'71'|'88'|'95'|'100'|'102'|'103'|'104'|'105'|ReasonCode|null,
     *   taxCode?: 'AE'|'E'|'S'|'Z'|'G'|'O'|'K'|'L'|'M'|'B'|TaxCode,
     *   taxRate?: float|string|null,
     * }>|null $allowances
     * @param float|string|null $amountDue The amount due for payment. Must be positive and rounded to maximum 2 decimals
     * @param list<array{
     *   fileName: string, fileData?: string|null, fileSize?: int, fileType?: string
     * }|DocumentAttachmentCreate>|null $attachments
     * @param string|null $billingAddress The billing address (if different from customer address)
     * @param string|null $billingAddressRecipient The recipient name at the billing address
     * @param list<array{
     *   amount?: float|string|null,
     *   baseAmount?: float|string|null,
     *   multiplierFactor?: float|string|null,
     *   reason?: string|null,
     *   reasonCode?: 'AA'|'AAA'|'AAC'|'AAD'|'AAE'|'AAF'|'AAH'|'AAI'|'AAS'|'AAT'|'AAV'|'AAY'|'AAZ'|'ABA'|'ABB'|'ABC'|'ABD'|'ABF'|'ABK'|'ABL'|'ABN'|'ABR'|'ABS'|'ABT'|'ABU'|'ACF'|'ACG'|'ACH'|'ACI'|'ACJ'|'ACK'|'ACL'|'ACM'|'ACS'|'ADC'|'ADE'|'ADJ'|'ADK'|'ADL'|'ADM'|'ADN'|'ADO'|'ADP'|'ADQ'|'ADR'|'ADT'|'ADW'|'ADY'|'ADZ'|'AEA'|'AEB'|'AEC'|'AED'|'AEF'|'AEH'|'AEI'|'AEJ'|'AEK'|'AEL'|'AEM'|'AEN'|'AEO'|'AEP'|'AES'|'AET'|'AEU'|'AEV'|'AEW'|'AEX'|'AEY'|'AEZ'|'AJ'|'AU'|'CA'|'CAB'|'CAD'|'CAE'|'CAF'|'CAI'|'CAJ'|'CAK'|'CAL'|'CAM'|'CAN'|'CAO'|'CAP'|'CAQ'|'CAR'|'CAS'|'CAT'|'CAU'|'CAV'|'CAW'|'CAX'|'CAY'|'CAZ'|'CD'|'CG'|'CS'|'CT'|'DAB'|'DAC'|'DAD'|'DAF'|'DAG'|'DAH'|'DAI'|'DAJ'|'DAK'|'DAL'|'DAM'|'DAN'|'DAO'|'DAP'|'DAQ'|'DL'|'EG'|'EP'|'ER'|'FAA'|'FAB'|'FAC'|'FC'|'FH'|'FI'|'GAA'|'HAA'|'HD'|'HH'|'IAA'|'IAB'|'ID'|'IF'|'IR'|'IS'|'KO'|'L1'|'LA'|'LAA'|'LAB'|'LF'|'MAE'|'MI'|'ML'|'NAA'|'OA'|'PA'|'PAA'|'PC'|'PL'|'PRV'|'RAB'|'RAC'|'RAD'|'RAF'|'RE'|'RF'|'RH'|'RV'|'SA'|'SAA'|'SAD'|'SAE'|'SAI'|'SG'|'SH'|'SM'|'SU'|'TAB'|'TAC'|'TT'|'TV'|'V1'|'V2'|'WH'|'XAA'|'YY'|'ZZZ'|\EInvoiceAPI\Documents\DocumentCreateParams\Charge\ReasonCode|null,
     *   taxCode?: 'AE'|'E'|'S'|'Z'|'G'|'O'|'K'|'L'|'M'|'B'|\EInvoiceAPI\Documents\DocumentCreateParams\Charge\TaxCode|null,
     *   taxRate?: float|string|null,
     * }>|null $charges
     * @param 'EUR'|'USD'|'GBP'|'JPY'|'CHF'|'CAD'|'AUD'|'NZD'|'CNY'|'INR'|'SEK'|'NOK'|'DKK'|'SGD'|'HKD'|CurrencyCode $currency Currency of the invoice (ISO 4217 currency code)
     * @param string|null $customerAddress The address of the customer/buyer
     * @param string|null $customerAddressRecipient The recipient name at the customer address
     * @param string|null $customerCompanyID Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     * @param string|null $customerEmail The email address of the customer
     * @param string|null $customerID The unique identifier for the customer in your system
     * @param string|null $customerName The company name of the customer/buyer
     * @param string|null $customerTaxID Customer tax ID. For Belgium this is the VAT number. Must include the country prefix
     * @param 'INBOUND'|'OUTBOUND'|DocumentDirection $direction The direction of the document: INBOUND (purchases) or OUTBOUND (sales)
     * @param 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|DocumentType $documentType The type of document: INVOICE, CREDIT_NOTE, or DEBIT_NOTE
     * @param string|null $dueDate The date when payment is due
     * @param string|null $invoiceDate The date when the invoice was issued
     * @param string|null $invoiceID The unique invoice identifier/number
     * @param float|string|null $invoiceTotal The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals
     * @param list<array{
     *   allowances?: list<array{
     *     amount?: float|string|null,
     *     baseAmount?: float|string|null,
     *     multiplierFactor?: float|string|null,
     *     reason?: string|null,
     *     reasonCode?: '41'|'42'|'60'|'62'|'63'|'64'|'65'|'66'|'67'|'68'|'70'|'71'|'88'|'95'|'100'|'102'|'103'|'104'|'105'|\EInvoiceAPI\Documents\DocumentCreateParams\Item\Allowance\ReasonCode|null,
     *     taxCode?: 'AE'|'E'|'S'|'Z'|'G'|'O'|'K'|'L'|'M'|'B'|\EInvoiceAPI\Documents\DocumentCreateParams\Item\Allowance\TaxCode,
     *     taxRate?: float|string|null,
     *   }>|null,
     *   amount?: float|string|null,
     *   charges?: list<array{
     *     amount?: float|string|null,
     *     baseAmount?: float|string|null,
     *     multiplierFactor?: float|string|null,
     *     reason?: string|null,
     *     reasonCode?: 'AA'|'AAA'|'AAC'|'AAD'|'AAE'|'AAF'|'AAH'|'AAI'|'AAS'|'AAT'|'AAV'|'AAY'|'AAZ'|'ABA'|'ABB'|'ABC'|'ABD'|'ABF'|'ABK'|'ABL'|'ABN'|'ABR'|'ABS'|'ABT'|'ABU'|'ACF'|'ACG'|'ACH'|'ACI'|'ACJ'|'ACK'|'ACL'|'ACM'|'ACS'|'ADC'|'ADE'|'ADJ'|'ADK'|'ADL'|'ADM'|'ADN'|'ADO'|'ADP'|'ADQ'|'ADR'|'ADT'|'ADW'|'ADY'|'ADZ'|'AEA'|'AEB'|'AEC'|'AED'|'AEF'|'AEH'|'AEI'|'AEJ'|'AEK'|'AEL'|'AEM'|'AEN'|'AEO'|'AEP'|'AES'|'AET'|'AEU'|'AEV'|'AEW'|'AEX'|'AEY'|'AEZ'|'AJ'|'AU'|'CA'|'CAB'|'CAD'|'CAE'|'CAF'|'CAI'|'CAJ'|'CAK'|'CAL'|'CAM'|'CAN'|'CAO'|'CAP'|'CAQ'|'CAR'|'CAS'|'CAT'|'CAU'|'CAV'|'CAW'|'CAX'|'CAY'|'CAZ'|'CD'|'CG'|'CS'|'CT'|'DAB'|'DAC'|'DAD'|'DAF'|'DAG'|'DAH'|'DAI'|'DAJ'|'DAK'|'DAL'|'DAM'|'DAN'|'DAO'|'DAP'|'DAQ'|'DL'|'EG'|'EP'|'ER'|'FAA'|'FAB'|'FAC'|'FC'|'FH'|'FI'|'GAA'|'HAA'|'HD'|'HH'|'IAA'|'IAB'|'ID'|'IF'|'IR'|'IS'|'KO'|'L1'|'LA'|'LAA'|'LAB'|'LF'|'MAE'|'MI'|'ML'|'NAA'|'OA'|'PA'|'PAA'|'PC'|'PL'|'PRV'|'RAB'|'RAC'|'RAD'|'RAF'|'RE'|'RF'|'RH'|'RV'|'SA'|'SAA'|'SAD'|'SAE'|'SAI'|'SG'|'SH'|'SM'|'SU'|'TAB'|'TAC'|'TT'|'TV'|'V1'|'V2'|'WH'|'XAA'|'YY'|'ZZZ'|\EInvoiceAPI\Documents\DocumentCreateParams\Item\Charge\ReasonCode|null,
     *     taxCode?: 'AE'|'E'|'S'|'Z'|'G'|'O'|'K'|'L'|'M'|'B'|\EInvoiceAPI\Documents\DocumentCreateParams\Item\Charge\TaxCode|null,
     *     taxRate?: float|string|null,
     *   }>|null,
     *   date?: null|null,
     *   description?: string|null,
     *   productCode?: string|null,
     *   quantity?: float|string|null,
     *   tax?: float|string|null,
     *   taxRate?: float|string|null,
     *   unit?: '10'|'11'|'13'|'14'|'15'|'20'|'21'|'22'|'23'|'24'|'25'|'27'|'28'|'33'|'34'|'35'|'37'|'38'|'40'|'41'|'56'|'57'|'58'|'59'|'60'|'61'|'74'|'77'|'80'|'81'|'85'|'87'|'89'|'91'|'1I'|'EA'|'E01'|'E07'|'E09'|'E10'|'E12'|'E14'|'E17'|'E20'|'E23'|'E25'|'E27'|'E31'|'E34'|'E35'|'E36'|'E37'|'E38'|'E39'|'E40'|'E41'|'E42'|'E43'|'E44'|'E45'|'E46'|'E47'|'E48'|'E49'|'E50'|'E51'|'E52'|'E53'|'E54'|'E55'|'E56'|'E57'|'E58'|'E60'|'E62'|'E65'|'E66'|'E67'|'E69'|'E70'|'E71'|'E73'|'E75'|'E76'|'2A'|'2B'|'2C'|'2G'|'2H'|'2I'|'2J'|'2K'|'2L'|'2M'|'2N'|'2P'|'2Q'|'2R'|'2U'|'2X'|'2Y'|'2Z'|'3B'|'3C'|'4C'|'4G'|'4H'|'4K'|'4L'|'4M'|'4N'|'4O'|'4P'|'4Q'|'4R'|'4T'|'4U'|'4W'|'4X'|'5A'|'5B'|'5E'|'5J'|'A10'|'A11'|'A12'|'A13'|'A14'|'A15'|'A16'|'A17'|'A18'|'A19'|'A2'|'A20'|'A21'|'A22'|'A23'|'A24'|'A26'|'A27'|'A28'|'A29'|'A3'|'A30'|'A31'|'A32'|'A33'|'A34'|'A35'|'A36'|'A37'|'A38'|'A39'|'A4'|'A40'|'A41'|'A42'|'A43'|'A44'|'A45'|'A46'|'A47'|'A48'|'A49'|'A5'|'A50'|'A51'|'A52'|'A53'|'A54'|'A55'|'A56'|'A57'|'A58'|'A59'|'A6'|'A60'|'A61'|'A62'|'A63'|'A64'|'A65'|'A66'|'A67'|'A68'|'A69'|'A7'|'A70'|'A71'|'A72'|'A73'|'A74'|'A75'|'A76'|'A77'|'A78'|'A79'|'A8'|'A80'|'A81'|'A82'|'A83'|'A84'|'A85'|'A86'|'A87'|'A88'|'A89'|'A9'|'A90'|'A91'|'A92'|'A93'|'A94'|'A95'|'A96'|'A97'|'A98'|'A99'|'ACR'|'AH'|'AI'|'AK'|'AMH'|'AMT'|'ANN'|'B1'|'B11'|'B12'|'B13'|'B14'|'B15'|'B16'|'B17'|'B18'|'B19'|'B20'|'B21'|'B22'|'B23'|'B24'|'B25'|'B26'|'B27'|'B28'|'B29'|'B3'|'B30'|'B31'|'B32'|'B33'|'B34'|'B35'|'B36'|'B37'|'B38'|'B39'|'B4'|'B40'|'B41'|'B42'|'B43'|'B44'|'B45'|'B46'|'B47'|'B48'|'B49'|'B5'|'B50'|'B52'|'B53'|'B54'|'B55'|'B56'|'B57'|'B58'|'B59'|'B6'|'B60'|'B61'|'B62'|'B63'|'B64'|'B65'|'B66'|'B67'|'B68'|'B69'|'B7'|'B70'|'B71'|'B72'|'B73'|'B74'|'B75'|'B76'|'B77'|'B78'|'B79'|'B8'|'B80'|'B81'|'B82'|'B83'|'B84'|'B85'|'B86'|'B87'|'B88'|'B89'|'B9'|'B90'|'B91'|'B92'|'B93'|'B94'|'B95'|'B96'|'B97'|'B98'|'B99'|'BAR'|'BB'|'BFT'|'BHP'|'BIL'|'BLD'|'BLL'|'BUA'|'BUI'|'C0'|'C10'|'C11'|'C12'|'C13'|'C14'|'C15'|'C16'|'C17'|'C18'|'C19'|'C20'|'C21'|'C22'|'C23'|'C24'|'C25'|'C26'|'C27'|'C28'|'C29'|'C30'|'C31'|'C32'|'C33'|'C34'|'C35'|'C36'|'C37'|'C38'|'C39'|'C40'|'C41'|'C42'|'C43'|'C44'|'C45'|'C46'|'C47'|'C48'|'C49'|'C50'|'C51'|'C52'|'C53'|'C54'|'C55'|'C56'|'C57'|'C58'|'C59'|'C60'|'C61'|'C63'|'C64'|'C65'|'C66'|'C67'|'C68'|'C69'|'C70'|'C71'|'C72'|'C73'|'C74'|'C75'|'C76'|'C77'|'C78'|'C79'|'C80'|'C81'|'C82'|'C83'|'C84'|'C85'|'C86'|'C87'|'C88'|'C89'|'C90'|'C91'|'C92'|'C93'|'C94'|'C95'|'C96'|'C97'|'C98'|'C99'|'CDL'|'CEL'|'CHU'|'CIU'|'CLT'|'CMK'|'CMQ'|'CMT'|'CNP'|'CNT'|'COU'|'CTG'|'CTN'|'CUR'|'CWA'|'CWI'|'DAN'|'DAY'|'DB'|'DD'|'DG'|'DI'|'DLT'|'DMK'|'DMQ'|'DMT'|'DPC'|'DPT'|'DRA'|'DZN'|'DZP'|'FOT'|'GLL'|'GLI'|'GRM'|'GRO'|'HUR'|'HTZ'|'INH'|'KGM'|'KMT'|'MTR'|'SMI'|'MIN'|'MON'|'ONZ'|'LBR'|'QT'|'SEC'|'FTK'|'INK'|'MTK'|'YDK'|'TNE'|'VLT'|'WTT'|'YRD'|'FTQ'|'INQ'|'MTQ'|'YDQ'|'HAR'|'KLT'|'MLT'|'MMT'|'KMK'|'MMK'|'XAA'|'XAB'|'XAC'|'XAD'|'XAE'|'XAF'|'XAG'|'XAH'|'XAI'|'XAJ'|'XAL'|'XAM'|'XAP'|'XAT'|'XAV'|'XB4'|'XBA'|'XBB'|'XBC'|'XBD'|'XBE'|'XBF'|'XBG'|'XBH'|'XBI'|'XBJ'|'XBK'|'XBL'|'XBM'|'XBN'|'XBO'|'XBP'|'XBQ'|'XBR'|'XBS'|'XBT'|'XBU'|'XBV'|'XBW'|'XBX'|'XBY'|'XBZ'|'XCA'|'XCB'|'XCC'|'XCD'|'XCE'|'XCF'|'XCG'|'XCH'|'XCI'|'XCJ'|'XCK'|'XCL'|'XCM'|'XCN'|'XCO'|'XCP'|'XCQ'|'XCR'|'XCS'|'XCT'|'XCU'|'XCV'|'XCW'|'XCX'|'XCY'|'XCZ'|'XDA'|'XDB'|'XDC'|'XDD'|'XDE'|'XDF'|'XDG'|'XDH'|'XDI'|'XDJ'|'XDK'|'XDL'|'XDM'|'XDN'|'XDP'|'XDQ'|'XDR'|'XDS'|'XDT'|'XDU'|'XDV'|'XDW'|'XDX'|'XDY'|'XDZ'|'XEA'|'XEB'|'XEC'|'XED'|'XEE'|'XEF'|'XEG'|'XEH'|'XEI'|'XEJ'|'XEK'|'XEL'|'XEM'|'XEN'|'XEP'|'XEQ'|'XER'|'XES'|'XET'|'XEU'|'XEV'|'XEW'|'XEX'|'XEY'|'XFB'|'XFC'|'XFD'|'XFE'|'XFF'|'XFG'|'XFH'|'XFI'|'XFJ'|'XFK'|'XFL'|'XFM'|'XFN'|'XFO'|'XFP'|'XFQ'|'XFR'|'XFS'|'XFT'|'XFU'|'XFV'|'XFW'|'XFX'|'XFY'|'XFZ'|'XGA'|'XGB'|'XGC'|'XGD'|'XGE'|'XGF'|'XGG'|'XGH'|'XGI'|'XGJ'|'XGK'|'XGL'|'XGM'|'XGN'|'XGO'|'XGP'|'XGQ'|'XGR'|'XGS'|'XGT'|'XGU'|'XGV'|'XGW'|'XGX'|'XGY'|'XGZ'|'XHA'|'XHB'|'XHC'|'XHD'|'XHE'|'XHF'|'XHG'|'XHH'|'XHI'|'XHJ'|'XHK'|'XHL'|'XHM'|'XHN'|'XHP'|'XHQ'|'XHR'|'XHS'|'XHT'|'XHU'|'XHV'|'XHW'|'XHX'|'XHY'|'XHZ'|'XIA'|'XIB'|'XIC'|'XID'|'XIE'|'XIF'|'XIG'|'XIH'|'XII'|'XIJ'|'XIK'|'XIL'|'XIM'|'XIN'|'XIO'|'XJA'|'XJB'|'XJC'|'XJD'|'XJE'|'XJF'|'XJG'|'XJH'|'XJI'|'XJJ'|'XJK'|'XJL'|'XJM'|'XJN'|'XJO'|'XJP'|'XJQ'|'XJR'|'XJS'|'XJT'|'XJU'|'XJV'|'XJW'|'XJX'|'XJY'|'XJZ'|'XLA'|'XLB'|'XLC'|'XLD'|'XLE'|'XLF'|'XLG'|'XLH'|'XLI'|'XLJ'|'XLK'|'XLL'|'XLM'|'XLN'|'XLO'|'XLP'|'XLQ'|'XLR'|'XLS'|'XLT'|'XLU'|'XLV'|'XLW'|'XLX'|'XLY'|'XLZ'|'XMA'|'XMB'|'XMC'|'XMD'|'XME'|'XMF'|'XMG'|'XMH'|'XMI'|'XMJ'|'XMK'|'XML'|'XMM'|'XMN'|'XMO'|'XMP'|'XMQ'|'XMR'|'XMS'|'XMT'|'XMU'|'XMV'|'XMW'|'XMX'|'XMY'|'XMZ'|'XNA'|'XNB'|'XNC'|'XND'|'XNE'|'XNF'|'XNG'|'XNH'|'XNI'|'XNJ'|'XNK'|'XNL'|'XNM'|'XOA'|'XOB'|'XOC'|'XOD'|'XOE'|'XOF'|'XOG'|'XOH'|'XOI'|'XOJ'|'XOK'|'XOL'|'XOM'|'XON'|'XOO'|'XOP'|'XOQ'|'XOR'|'XOS'|'XOT'|'XOU'|'XOV'|'XOW'|'XOX'|'XOY'|'XOZ'|'XP1'|'XP2'|'XP3'|'XP4'|'XPA'|'XPB'|'XPC'|'XPD'|'XPE'|'XPF'|'XPG'|'XPH'|'XPI'|'XPJ'|'XPK'|'XPL'|'XPM'|'XPN'|'XPO'|'XPP'|'XPQ'|'XPR'|'XPS'|'XPT'|'XPU'|'XPV'|'XPW'|'XPX'|'XPY'|'XPZ'|'XQA'|'XQB'|'XQC'|'XQD'|'XQE'|'XQF'|'XQG'|'XQH'|'XQI'|'XQJ'|'XQK'|'XQL'|'XQM'|'XQN'|'XQO'|'XQP'|'XQQ'|'XQR'|'XQS'|'XRD'|'XRE'|'XRF'|'XRG'|'XRH'|'XRI'|'XRJ'|'XRK'|'XRL'|'XRM'|'XRN'|'XRO'|'XRP'|'XRQ'|'XRR'|'XRS'|'XRT'|'XRU'|'XRV'|'XRW'|'XRX'|'XRY'|'XRZ'|'XSA'|'XSB'|'XSC'|'XSD'|'XSE'|'XSF'|'XSG'|'XSH'|'XSI'|'XSJ'|'XSK'|'XSL'|'XSM'|'XSN'|'XSO'|'XSP'|'XSQ'|'XSR'|'XSS'|'XST'|'XSU'|'XSV'|'XSW'|'XSX'|'XSY'|'XSZ'|'XTA'|'XTB'|'XTC'|'XTD'|'XTE'|'XTF'|'XTG'|'XTI'|'XTJ'|'XTK'|'XTL'|'XTM'|'XTN'|'XTO'|'XTR'|'XTS'|'XTT'|'XTU'|'XTV'|'XTW'|'XTX'|'XTY'|'XTZ'|'XUC'|'XUN'|'XVA'|'XVG'|'XVI'|'XVK'|'XVL'|'XVN'|'XVO'|'XVP'|'XVQ'|'XVR'|'XVS'|'XVY'|'XWA'|'XWB'|'XWC'|'XWD'|'XWF'|'XWG'|'XWH'|'XWJ'|'XWK'|'XWL'|'XWM'|'XWN'|'XWP'|'XWQ'|'XWR'|'XWS'|'XWT'|'XWU'|'XWV'|'XWW'|'XWX'|'XWY'|'XWZ'|'XXA'|'XXB'|'XXC'|'XXD'|'XXF'|'XXG'|'XXH'|'XXJ'|'XXK'|'XYA'|'XYB'|'XYC'|'XYD'|'XYF'|'XYG'|'XYH'|'XYJ'|'XYK'|'XYL'|'XYM'|'XYN'|'XYP'|'XYQ'|'XYR'|'XYS'|'XYT'|'XYV'|'XYW'|'XYX'|'XYY'|'XYZ'|'XZA'|'XZB'|'XZC'|'XZD'|'XZF'|'XZG'|'XZH'|'XZJ'|'XZK'|'XZL'|'XZM'|'XZN'|'XZP'|'XZQ'|'XZR'|'XZS'|'XZT'|'XZU'|'XZV'|'XZW'|'XZX'|'XZY'|'XZZ'|'ZZ'|'NAR'|'C62'|'LTR'|'H87'|UnitOfMeasureCode|null,
     *   unitPrice?: float|string|null,
     * }> $items At least one line item is required
     * @param string|null $note Additional notes or comments for the invoice
     * @param list<array{
     *   bankAccountNumber?: string|null,
     *   iban?: string|null,
     *   paymentReference?: string|null,
     *   swift?: string|null,
     * }|PaymentDetailCreate>|null $paymentDetails
     * @param string|null $paymentTerm The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30')
     * @param float|string|null $previousUnpaidBalance The previous unpaid balance from prior invoices, if any. Must be positive and rounded to maximum 2 decimals
     * @param string|null $purchaseOrder The purchase order reference number
     * @param string|null $remittanceAddress The address where payment should be sent or remitted to
     * @param string|null $remittanceAddressRecipient The recipient name at the remittance address
     * @param string|null $serviceAddress The address where services were performed or goods were delivered
     * @param string|null $serviceAddressRecipient The recipient name at the service address
     * @param string|null $serviceEndDate The end date of the service period or delivery period
     * @param string|null $serviceStartDate The start date of the service period or delivery period
     * @param string|null $shippingAddress The shipping/delivery address
     * @param string|null $shippingAddressRecipient The recipient name at the shipping address
     * @param 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState $state The current state of the document: DRAFT, TRANSIT, FAILED, SENT, or RECEIVED
     * @param float|string|null $subtotal The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals
     * @param 'AE'|'E'|'S'|'Z'|'G'|'O'|'K'|'L'|'M'|'B'|\EInvoiceAPI\Documents\DocumentCreateParams\TaxCode $taxCode Tax category code of the invoice (e.g., S for standard rate, Z for zero rate, E for exempt)
     * @param list<array{
     *   amount?: float|string|null, rate?: string|null
     * }>|null $taxDetails
     * @param float|string|null $totalDiscount The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals
     * @param float|string|null $totalTax The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals
     * @param 'VATEX-EU-79-C'|'VATEX-EU-132'|'VATEX-EU-132-1A'|'VATEX-EU-132-1B'|'VATEX-EU-132-1C'|'VATEX-EU-132-1D'|'VATEX-EU-132-1E'|'VATEX-EU-132-1F'|'VATEX-EU-132-1G'|'VATEX-EU-132-1H'|'VATEX-EU-132-1I'|'VATEX-EU-132-1J'|'VATEX-EU-132-1K'|'VATEX-EU-132-1L'|'VATEX-EU-132-1M'|'VATEX-EU-132-1N'|'VATEX-EU-132-1O'|'VATEX-EU-132-1P'|'VATEX-EU-132-1Q'|'VATEX-EU-143'|'VATEX-EU-143-1A'|'VATEX-EU-143-1B'|'VATEX-EU-143-1C'|'VATEX-EU-143-1D'|'VATEX-EU-143-1E'|'VATEX-EU-143-1F'|'VATEX-EU-143-1FA'|'VATEX-EU-143-1G'|'VATEX-EU-143-1H'|'VATEX-EU-143-1I'|'VATEX-EU-143-1J'|'VATEX-EU-143-1K'|'VATEX-EU-143-1L'|'VATEX-EU-144'|'VATEX-EU-146-1E'|'VATEX-EU-148'|'VATEX-EU-148-A'|'VATEX-EU-148-B'|'VATEX-EU-148-C'|'VATEX-EU-148-D'|'VATEX-EU-148-E'|'VATEX-EU-148-F'|'VATEX-EU-148-G'|'VATEX-EU-151'|'VATEX-EU-151-1A'|'VATEX-EU-151-1AA'|'VATEX-EU-151-1B'|'VATEX-EU-151-1C'|'VATEX-EU-151-1D'|'VATEX-EU-151-1E'|'VATEX-EU-159'|'VATEX-EU-309'|'VATEX-EU-AE'|'VATEX-EU-D'|'VATEX-EU-F'|'VATEX-EU-G'|'VATEX-EU-I'|'VATEX-EU-IC'|'VATEX-EU-O'|'VATEX-EU-J'|'VATEX-FR-FRANCHISE'|'VATEX-FR-CNWVAT'|Vatex|null $vatex VATEX code list for VAT exemption reasons
     *
     * Agency: CEF
     * Identifier: vatex
     * @param string|null $vatexNote Textual explanation for VAT exemption
     * @param string|null $vendorAddress The address of the vendor/seller
     * @param string|null $vendorAddressRecipient The recipient name at the vendor address
     * @param string|null $vendorCompanyID Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     * @param string|null $vendorEmail The email address of the vendor
     * @param string|null $vendorName The name of the vendor/seller/supplier
     * @param string|null $vendorTaxID Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix
     *
     * @throws APIException
     */
    public function create(
        ?array $allowances = null,
        float|string|null $amountDue = null,
        ?array $attachments = null,
        ?string $billingAddress = null,
        ?string $billingAddressRecipient = null,
        ?array $charges = null,
        string|CurrencyCode|null $currency = null,
        ?string $customerAddress = null,
        ?string $customerAddressRecipient = null,
        ?string $customerCompanyID = null,
        ?string $customerEmail = null,
        ?string $customerID = null,
        ?string $customerName = null,
        ?string $customerTaxID = null,
        string|DocumentDirection|null $direction = null,
        string|DocumentType|null $documentType = null,
        ?string $dueDate = null,
        ?string $invoiceDate = null,
        ?string $invoiceID = null,
        float|string|null $invoiceTotal = null,
        ?array $items = null,
        ?string $note = null,
        ?array $paymentDetails = null,
        ?string $paymentTerm = null,
        float|string|null $previousUnpaidBalance = null,
        ?string $purchaseOrder = null,
        ?string $remittanceAddress = null,
        ?string $remittanceAddressRecipient = null,
        ?string $serviceAddress = null,
        ?string $serviceAddressRecipient = null,
        ?string $serviceEndDate = null,
        ?string $serviceStartDate = null,
        ?string $shippingAddress = null,
        ?string $shippingAddressRecipient = null,
        string|DocumentState|null $state = null,
        float|string|null $subtotal = null,
        string|\EInvoiceAPI\Documents\DocumentCreateParams\TaxCode $taxCode = 'S',
        ?array $taxDetails = null,
        float|string|null $totalDiscount = null,
        float|string|null $totalTax = null,
        string|Vatex|null $vatex = null,
        ?string $vatexNote = null,
        ?string $vendorAddress = null,
        ?string $vendorAddressRecipient = null,
        ?string $vendorCompanyID = null,
        ?string $vendorEmail = null,
        ?string $vendorName = null,
        ?string $vendorTaxID = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        $params = Util::removeNulls(
            [
                'allowances' => $allowances,
                'amountDue' => $amountDue,
                'attachments' => $attachments,
                'billingAddress' => $billingAddress,
                'billingAddressRecipient' => $billingAddressRecipient,
                'charges' => $charges,
                'currency' => $currency,
                'customerAddress' => $customerAddress,
                'customerAddressRecipient' => $customerAddressRecipient,
                'customerCompanyID' => $customerCompanyID,
                'customerEmail' => $customerEmail,
                'customerID' => $customerID,
                'customerName' => $customerName,
                'customerTaxID' => $customerTaxID,
                'direction' => $direction,
                'documentType' => $documentType,
                'dueDate' => $dueDate,
                'invoiceDate' => $invoiceDate,
                'invoiceID' => $invoiceID,
                'invoiceTotal' => $invoiceTotal,
                'items' => $items,
                'note' => $note,
                'paymentDetails' => $paymentDetails,
                'paymentTerm' => $paymentTerm,
                'previousUnpaidBalance' => $previousUnpaidBalance,
                'purchaseOrder' => $purchaseOrder,
                'remittanceAddress' => $remittanceAddress,
                'remittanceAddressRecipient' => $remittanceAddressRecipient,
                'serviceAddress' => $serviceAddress,
                'serviceAddressRecipient' => $serviceAddressRecipient,
                'serviceEndDate' => $serviceEndDate,
                'serviceStartDate' => $serviceStartDate,
                'shippingAddress' => $shippingAddress,
                'shippingAddressRecipient' => $shippingAddressRecipient,
                'state' => $state,
                'subtotal' => $subtotal,
                'taxCode' => $taxCode,
                'taxDetails' => $taxDetails,
                'totalDiscount' => $totalDiscount,
                'totalTax' => $totalTax,
                'vatex' => $vatex,
                'vatexNote' => $vatexNote,
                'vendorAddress' => $vendorAddress,
                'vendorAddressRecipient' => $vendorAddressRecipient,
                'vendorCompanyID' => $vendorCompanyID,
                'vendorEmail' => $vendorEmail,
                'vendorName' => $vendorName,
                'vendorTaxID' => $vendorTaxID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get an invoice or credit note by ID
     *
     * @throws APIException
     */
    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($documentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete an invoice or credit note
     *
     * @throws APIException
     */
    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($documentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a new invoice or credit note from a PDF file. If the 'ubl_document' field is set in the response, it indicates that sufficient details were extracted from the PDF to automatically generate a valid UBL document ready for sending. If 'ubl_document' is not set, human intervention may be required to ensure compliance.
     *
     * @param string $file Body param:
     * @param string|null $customerTaxID Query param:
     * @param string|null $vendorTaxID Query param:
     *
     * @throws APIException
     */
    public function createFromPdf(
        string $file,
        ?string $customerTaxID = null,
        ?string $vendorTaxID = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentNewFromPdfResponse {
        $params = Util::removeNulls(
            [
                'file' => $file,
                'customerTaxID' => $customerTaxID,
                'vendorTaxID' => $vendorTaxID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createFromPdf(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send an invoice or credit note via Peppol
     *
     * @throws APIException
     */
    public function send(
        string $documentID,
        ?string $email = null,
        ?string $receiverPeppolID = null,
        ?string $receiverPeppolScheme = null,
        ?string $senderPeppolID = null,
        ?string $senderPeppolScheme = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        $params = Util::removeNulls(
            [
                'email' => $email,
                'receiverPeppolID' => $receiverPeppolID,
                'receiverPeppolScheme' => $receiverPeppolScheme,
                'senderPeppolID' => $senderPeppolID,
                'senderPeppolScheme' => $senderPeppolScheme,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->send($documentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Validate a UBL document according to Peppol BIS Billing 3.0
     *
     * @throws APIException
     */
    public function validate(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->validate($documentID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentCreateParams\Allowance\ReasonCode;
use EInvoiceAPI\Documents\DocumentCreateParams\Allowance\TaxCode;
use EInvoiceAPI\Documents\DocumentCreateParams\Vatex;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Documents\UnitOfMeasureCode;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Validate\UblDocumentValidation;

interface DocumentsContract
{
    /**
     * @api
     *
     * @param list<array{
     *   amount?: float|string|null,
     *   baseAmount?: float|string|null,
     *   multiplierFactor?: float|string|null,
     *   reason?: string|null,
     *   reasonCode?: '41'|'42'|'60'|'62'|'63'|'64'|'65'|'66'|'67'|'68'|'70'|'71'|'88'|'95'|'100'|'102'|'103'|'104'|'105'|ReasonCode|null,
     *   taxCode?: 'AE'|'E'|'S'|'Z'|'G'|'O'|'K'|'L'|'M'|'B'|TaxCode,
     *   taxRate?: float|string|null,
     * }>|null $allowances Body param:
     * @param float|string|null $amountDue Body param: The amount due for payment. Must be positive and rounded to maximum 2 decimals
     * @param list<array{
     *   fileName: string, fileData?: string|null, fileSize?: int, fileType?: string
     * }|DocumentAttachmentCreate>|null $attachments Body param:
     * @param string|null $billingAddress Body param: The billing address (if different from customer address)
     * @param string|null $billingAddressRecipient Body param: The recipient name at the billing address
     * @param list<array{
     *   amount?: float|string|null,
     *   baseAmount?: float|string|null,
     *   multiplierFactor?: float|string|null,
     *   reason?: string|null,
     *   reasonCode?: 'AA'|'AAA'|'AAC'|'AAD'|'AAE'|'AAF'|'AAH'|'AAI'|'AAS'|'AAT'|'AAV'|'AAY'|'AAZ'|'ABA'|'ABB'|'ABC'|'ABD'|'ABF'|'ABK'|'ABL'|'ABN'|'ABR'|'ABS'|'ABT'|'ABU'|'ACF'|'ACG'|'ACH'|'ACI'|'ACJ'|'ACK'|'ACL'|'ACM'|'ACS'|'ADC'|'ADE'|'ADJ'|'ADK'|'ADL'|'ADM'|'ADN'|'ADO'|'ADP'|'ADQ'|'ADR'|'ADT'|'ADW'|'ADY'|'ADZ'|'AEA'|'AEB'|'AEC'|'AED'|'AEF'|'AEH'|'AEI'|'AEJ'|'AEK'|'AEL'|'AEM'|'AEN'|'AEO'|'AEP'|'AES'|'AET'|'AEU'|'AEV'|'AEW'|'AEX'|'AEY'|'AEZ'|'AJ'|'AU'|'CA'|'CAB'|'CAD'|'CAE'|'CAF'|'CAI'|'CAJ'|'CAK'|'CAL'|'CAM'|'CAN'|'CAO'|'CAP'|'CAQ'|'CAR'|'CAS'|'CAT'|'CAU'|'CAV'|'CAW'|'CAX'|'CAY'|'CAZ'|'CD'|'CG'|'CS'|'CT'|'DAB'|'DAC'|'DAD'|'DAF'|'DAG'|'DAH'|'DAI'|'DAJ'|'DAK'|'DAL'|'DAM'|'DAN'|'DAO'|'DAP'|'DAQ'|'DL'|'EG'|'EP'|'ER'|'FAA'|'FAB'|'FAC'|'FC'|'FH'|'FI'|'GAA'|'HAA'|'HD'|'HH'|'IAA'|'IAB'|'ID'|'IF'|'IR'|'IS'|'KO'|'L1'|'LA'|'LAA'|'LAB'|'LF'|'MAE'|'MI'|'ML'|'NAA'|'OA'|'PA'|'PAA'|'PC'|'PL'|'PRV'|'RAB'|'RAC'|'RAD'|'RAF'|'RE'|'RF'|'RH'|'RV'|'SA'|'SAA'|'SAD'|'SAE'|'SAI'|'SG'|'SH'|'SM'|'SU'|'TAB'|'TAC'|'TT'|'TV'|'V1'|'V2'|'WH'|'XAA'|'YY'|'ZZZ'|\EInvoiceAPI\Documents\DocumentCreateParams\Charge\ReasonCode|null,
     *   taxCode?: 'AE'|'E'|'S'|'Z'|'G'|'O'|'K'|'L'|'M'|'B'|\EInvoiceAPI\Documents\DocumentCreateParams\Charge\TaxCode|null,
     *   taxRate?: float|string|null,
     * }>|null $charges Body param:
     * @param string|null $buyerReference Body param: The buyer reference (BT-10), e.g. a cost centre or accounting reference requested by the buyer
     * @param bool $constructPdf query param: If true, generate a constructed PDF from the document and include it both as document attachment and embedded in the UBL
     * @param 'EUR'|'USD'|'GBP'|'JPY'|'CHF'|'CAD'|'AUD'|'NZD'|'CNY'|'INR'|'SEK'|'NOK'|'DKK'|'SGD'|'HKD'|CurrencyCode|null $currency Body param: Currency of the invoice (ISO 4217 currency code). Null leaves the field out, so the server applies its default
     * @param string|null $customerAddress Body param: The address of the customer/buyer
     * @param string|null $customerAddressRecipient Body param: The recipient name at the customer address. Also the customer contact name (BT-56) in the UBL
     * @param string|null $customerCompanyID Body param: Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     * @param string|null $customerEmail Body param: The email address of the customer
     * @param string|null $customerID Body param: The unique identifier for the customer in your system
     * @param string|null $customerName Body param: The company name of the customer/buyer
     * @param string|null $customerPeppolID Body param: Customer Peppol ID
     * @param string|null $customerPhone Body param: The telephone number of the customer contact (BT-57)
     * @param string|null $customerTaxID Body param: Customer tax ID. For Belgium this is the VAT number. Must include the country prefix
     * @param 'INBOUND'|'OUTBOUND'|DocumentDirection|null $direction Body param: The direction of the document: INBOUND (purchases) or OUTBOUND (sales). Null leaves the field out, so the server applies its default
     * @param 'INVOICE'|'CREDIT_NOTE'|'DEBIT_NOTE'|'SELFBILLING_INVOICE'|'SELFBILLING_CREDIT_NOTE'|DocumentType|null $documentType Body param: The type of document: INVOICE, CREDIT_NOTE, or DEBIT_NOTE. Null leaves the field out, so the server applies its default
     * @param string|\DateTimeInterface|null $dueDate Body param: The date when payment is due
     * @param string|\DateTimeInterface|null $invoiceDate Body param: The date when the invoice was issued
     * @param string|null $invoiceID Body param: The unique invoice identifier/number
     * @param float|string|null $invoiceTotal Body param: The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals
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
     *   date?: string|\DateTimeInterface|null,
     *   description?: string|null,
     *   itemAttributes?: list<array{name: string, value?: string|null}>|null,
     *   name?: string|null,
     *   priceBaseQuantity?: float|string,
     *   productCode?: string|null,
     *   quantity?: float|string|null,
     *   tax?: float|string|null,
     *   taxRate?: float|string|null,
     *   unit?: '10'|'11'|'13'|'14'|'15'|'20'|'21'|'22'|'23'|'24'|'25'|'27'|'28'|'33'|'34'|'35'|'37'|'38'|'40'|'41'|'56'|'57'|'58'|'59'|'60'|'61'|'74'|'77'|'80'|'81'|'85'|'87'|'89'|'91'|'1I'|'EA'|'E01'|'E07'|'E09'|'E10'|'E12'|'E14'|'E17'|'E20'|'E23'|'E25'|'E27'|'E31'|'E34'|'E35'|'E36'|'E37'|'E38'|'E39'|'E40'|'E41'|'E42'|'E43'|'E44'|'E45'|'E46'|'E47'|'E48'|'E49'|'E50'|'E51'|'E52'|'E53'|'E54'|'E55'|'E56'|'E57'|'E58'|'E60'|'E62'|'E65'|'E66'|'E67'|'E69'|'E70'|'E71'|'E73'|'E75'|'E76'|'2A'|'2B'|'2C'|'2G'|'2H'|'2I'|'2J'|'2K'|'2L'|'2M'|'2N'|'2P'|'2Q'|'2R'|'2U'|'2X'|'2Y'|'2Z'|'3B'|'3C'|'4C'|'4G'|'4H'|'4K'|'4L'|'4M'|'4N'|'4O'|'4P'|'4Q'|'4R'|'4T'|'4U'|'4W'|'4X'|'5A'|'5B'|'5E'|'5J'|'A10'|'A11'|'A12'|'A13'|'A14'|'A15'|'A16'|'A17'|'A18'|'A19'|'A2'|'A20'|'A21'|'A22'|'A23'|'A24'|'A26'|'A27'|'A28'|'A29'|'A3'|'A30'|'A31'|'A32'|'A33'|'A34'|'A35'|'A36'|'A37'|'A38'|'A39'|'A4'|'A40'|'A41'|'A42'|'A43'|'A44'|'A45'|'A46'|'A47'|'A48'|'A49'|'A5'|'A50'|'A51'|'A52'|'A53'|'A54'|'A55'|'A56'|'A57'|'A58'|'A59'|'A6'|'A60'|'A61'|'A62'|'A63'|'A64'|'A65'|'A66'|'A67'|'A68'|'A69'|'A7'|'A70'|'A71'|'A72'|'A73'|'A74'|'A75'|'A76'|'A77'|'A78'|'A79'|'A8'|'A80'|'A81'|'A82'|'A83'|'A84'|'A85'|'A86'|'A87'|'A88'|'A89'|'A9'|'A90'|'A91'|'A92'|'A93'|'A94'|'A95'|'A96'|'A97'|'A98'|'A99'|'ACR'|'AH'|'AI'|'AK'|'AMH'|'AMT'|'ANN'|'B1'|'B11'|'B12'|'B13'|'B14'|'B15'|'B16'|'B17'|'B18'|'B19'|'B20'|'B21'|'B22'|'B23'|'B24'|'B25'|'B26'|'B27'|'B28'|'B29'|'B3'|'B30'|'B31'|'B32'|'B33'|'B34'|'B35'|'B36'|'B37'|'B38'|'B39'|'B4'|'B40'|'B41'|'B42'|'B43'|'B44'|'B45'|'B46'|'B47'|'B48'|'B49'|'B5'|'B50'|'B52'|'B53'|'B54'|'B55'|'B56'|'B57'|'B58'|'B59'|'B6'|'B60'|'B61'|'B62'|'B63'|'B64'|'B65'|'B66'|'B67'|'B68'|'B69'|'B7'|'B70'|'B71'|'B72'|'B73'|'B74'|'B75'|'B76'|'B77'|'B78'|'B79'|'B8'|'B80'|'B81'|'B82'|'B83'|'B84'|'B85'|'B86'|'B87'|'B88'|'B89'|'B9'|'B90'|'B91'|'B92'|'B93'|'B94'|'B95'|'B96'|'B97'|'B98'|'B99'|'BAR'|'BB'|'BFT'|'BHP'|'BIL'|'BLD'|'BLL'|'BUA'|'BUI'|'C0'|'C10'|'C11'|'C12'|'C13'|'C14'|'C15'|'C16'|'C17'|'C18'|'C19'|'C20'|'C21'|'C22'|'C23'|'C24'|'C25'|'C26'|'C27'|'C28'|'C29'|'C30'|'C31'|'C32'|'C33'|'C34'|'C35'|'C36'|'C37'|'C38'|'C39'|'C40'|'C41'|'C42'|'C43'|'C44'|'C45'|'C46'|'C47'|'C48'|'C49'|'C50'|'C51'|'C52'|'C53'|'C54'|'C55'|'C56'|'C57'|'C58'|'C59'|'C60'|'C61'|'C63'|'C64'|'C65'|'C66'|'C67'|'C68'|'C69'|'C70'|'C71'|'C72'|'C73'|'C74'|'C75'|'C76'|'C77'|'C78'|'C79'|'C80'|'C81'|'C82'|'C83'|'C84'|'C85'|'C86'|'C87'|'C88'|'C89'|'C90'|'C91'|'C92'|'C93'|'C94'|'C95'|'C96'|'C97'|'C98'|'C99'|'CDL'|'CEL'|'CHU'|'CIU'|'CLT'|'CMK'|'CMQ'|'CMT'|'CNP'|'CNT'|'COU'|'CTG'|'CTN'|'CUR'|'CWA'|'CWI'|'DAN'|'DAY'|'DB'|'DD'|'DG'|'DI'|'DLT'|'DMK'|'DMQ'|'DMT'|'DPC'|'DPT'|'DRA'|'DZN'|'DZP'|'FOT'|'GLL'|'GLI'|'GRM'|'GRO'|'HUR'|'HTZ'|'INH'|'KGM'|'KMT'|'MTR'|'SMI'|'MIN'|'MON'|'ONZ'|'LBR'|'QT'|'SEC'|'FTK'|'INK'|'MTK'|'YDK'|'TNE'|'VLT'|'WTT'|'YRD'|'FTQ'|'INQ'|'MTQ'|'YDQ'|'HAR'|'KLT'|'MLT'|'MMT'|'KMK'|'MMK'|'XAA'|'XAB'|'XAC'|'XAD'|'XAE'|'XAF'|'XAG'|'XAH'|'XAI'|'XAJ'|'XAL'|'XAM'|'XAP'|'XAT'|'XAV'|'XB4'|'XBA'|'XBB'|'XBC'|'XBD'|'XBE'|'XBF'|'XBG'|'XBH'|'XBI'|'XBJ'|'XBK'|'XBL'|'XBM'|'XBN'|'XBO'|'XBP'|'XBQ'|'XBR'|'XBS'|'XBT'|'XBU'|'XBV'|'XBW'|'XBX'|'XBY'|'XBZ'|'XCA'|'XCB'|'XCC'|'XCD'|'XCE'|'XCF'|'XCG'|'XCH'|'XCI'|'XCJ'|'XCK'|'XCL'|'XCM'|'XCN'|'XCO'|'XCP'|'XCQ'|'XCR'|'XCS'|'XCT'|'XCU'|'XCV'|'XCW'|'XCX'|'XCY'|'XCZ'|'XDA'|'XDB'|'XDC'|'XDD'|'XDE'|'XDF'|'XDG'|'XDH'|'XDI'|'XDJ'|'XDK'|'XDL'|'XDM'|'XDN'|'XDP'|'XDQ'|'XDR'|'XDS'|'XDT'|'XDU'|'XDV'|'XDW'|'XDX'|'XDY'|'XDZ'|'XEA'|'XEB'|'XEC'|'XED'|'XEE'|'XEF'|'XEG'|'XEH'|'XEI'|'XEJ'|'XEK'|'XEL'|'XEM'|'XEN'|'XEP'|'XEQ'|'XER'|'XES'|'XET'|'XEU'|'XEV'|'XEW'|'XEX'|'XEY'|'XFB'|'XFC'|'XFD'|'XFE'|'XFF'|'XFG'|'XFH'|'XFI'|'XFJ'|'XFK'|'XFL'|'XFM'|'XFN'|'XFO'|'XFP'|'XFQ'|'XFR'|'XFS'|'XFT'|'XFU'|'XFV'|'XFW'|'XFX'|'XFY'|'XFZ'|'XGA'|'XGB'|'XGC'|'XGD'|'XGE'|'XGF'|'XGG'|'XGH'|'XGI'|'XGJ'|'XGK'|'XGL'|'XGM'|'XGN'|'XGO'|'XGP'|'XGQ'|'XGR'|'XGS'|'XGT'|'XGU'|'XGV'|'XGW'|'XGX'|'XGY'|'XGZ'|'XHA'|'XHB'|'XHC'|'XHD'|'XHE'|'XHF'|'XHG'|'XHH'|'XHI'|'XHJ'|'XHK'|'XHL'|'XHM'|'XHN'|'XHP'|'XHQ'|'XHR'|'XHS'|'XHT'|'XHU'|'XHV'|'XHW'|'XHX'|'XHY'|'XHZ'|'XIA'|'XIB'|'XIC'|'XID'|'XIE'|'XIF'|'XIG'|'XIH'|'XII'|'XIJ'|'XIK'|'XIL'|'XIM'|'XIN'|'XIO'|'XJA'|'XJB'|'XJC'|'XJD'|'XJE'|'XJF'|'XJG'|'XJH'|'XJI'|'XJJ'|'XJK'|'XJL'|'XJM'|'XJN'|'XJO'|'XJP'|'XJQ'|'XJR'|'XJS'|'XJT'|'XJU'|'XJV'|'XJW'|'XJX'|'XJY'|'XJZ'|'XLA'|'XLB'|'XLC'|'XLD'|'XLE'|'XLF'|'XLG'|'XLH'|'XLI'|'XLJ'|'XLK'|'XLL'|'XLM'|'XLN'|'XLO'|'XLP'|'XLQ'|'XLR'|'XLS'|'XLT'|'XLU'|'XLV'|'XLW'|'XLX'|'XLY'|'XLZ'|'XMA'|'XMB'|'XMC'|'XMD'|'XME'|'XMF'|'XMG'|'XMH'|'XMI'|'XMJ'|'XMK'|'XML'|'XMM'|'XMN'|'XMO'|'XMP'|'XMQ'|'XMR'|'XMS'|'XMT'|'XMU'|'XMV'|'XMW'|'XMX'|'XMY'|'XMZ'|'XNA'|'XNB'|'XNC'|'XND'|'XNE'|'XNF'|'XNG'|'XNH'|'XNI'|'XNJ'|'XNK'|'XNL'|'XNM'|'XOA'|'XOB'|'XOC'|'XOD'|'XOE'|'XOF'|'XOG'|'XOH'|'XOI'|'XOJ'|'XOK'|'XOL'|'XOM'|'XON'|'XOO'|'XOP'|'XOQ'|'XOR'|'XOS'|'XOT'|'XOU'|'XOV'|'XOW'|'XOX'|'XOY'|'XOZ'|'XP1'|'XP2'|'XP3'|'XP4'|'XPA'|'XPB'|'XPC'|'XPD'|'XPE'|'XPF'|'XPG'|'XPH'|'XPI'|'XPJ'|'XPK'|'XPL'|'XPM'|'XPN'|'XPO'|'XPP'|'XPQ'|'XPR'|'XPS'|'XPT'|'XPU'|'XPV'|'XPW'|'XPX'|'XPY'|'XPZ'|'XQA'|'XQB'|'XQC'|'XQD'|'XQE'|'XQF'|'XQG'|'XQH'|'XQI'|'XQJ'|'XQK'|'XQL'|'XQM'|'XQN'|'XQO'|'XQP'|'XQQ'|'XQR'|'XQS'|'XRD'|'XRE'|'XRF'|'XRG'|'XRH'|'XRI'|'XRJ'|'XRK'|'XRL'|'XRM'|'XRN'|'XRO'|'XRP'|'XRQ'|'XRR'|'XRS'|'XRT'|'XRU'|'XRV'|'XRW'|'XRX'|'XRY'|'XRZ'|'XSA'|'XSB'|'XSC'|'XSD'|'XSE'|'XSF'|'XSG'|'XSH'|'XSI'|'XSJ'|'XSK'|'XSL'|'XSM'|'XSN'|'XSO'|'XSP'|'XSQ'|'XSR'|'XSS'|'XST'|'XSU'|'XSV'|'XSW'|'XSX'|'XSY'|'XSZ'|'XTA'|'XTB'|'XTC'|'XTD'|'XTE'|'XTF'|'XTG'|'XTI'|'XTJ'|'XTK'|'XTL'|'XTM'|'XTN'|'XTO'|'XTR'|'XTS'|'XTT'|'XTU'|'XTV'|'XTW'|'XTX'|'XTY'|'XTZ'|'XUC'|'XUN'|'XVA'|'XVG'|'XVI'|'XVK'|'XVL'|'XVN'|'XVO'|'XVP'|'XVQ'|'XVR'|'XVS'|'XVY'|'XWA'|'XWB'|'XWC'|'XWD'|'XWF'|'XWG'|'XWH'|'XWJ'|'XWK'|'XWL'|'XWM'|'XWN'|'XWP'|'XWQ'|'XWR'|'XWS'|'XWT'|'XWU'|'XWV'|'XWW'|'XWX'|'XWY'|'XWZ'|'XXA'|'XXB'|'XXC'|'XXD'|'XXF'|'XXG'|'XXH'|'XXJ'|'XXK'|'XYA'|'XYB'|'XYC'|'XYD'|'XYF'|'XYG'|'XYH'|'XYJ'|'XYK'|'XYL'|'XYM'|'XYN'|'XYP'|'XYQ'|'XYR'|'XYS'|'XYT'|'XYV'|'XYW'|'XYX'|'XYY'|'XYZ'|'XZA'|'XZB'|'XZC'|'XZD'|'XZF'|'XZG'|'XZH'|'XZJ'|'XZK'|'XZL'|'XZM'|'XZN'|'XZP'|'XZQ'|'XZR'|'XZS'|'XZT'|'XZU'|'XZV'|'XZW'|'XZX'|'XZY'|'XZZ'|'ZZ'|'NAR'|'C62'|'LTR'|'H87'|'AA'|'AB'|'ACT'|'AD'|'AE'|'AL'|'AMP'|'APZ'|'AQ'|'AS'|'ASM'|'ASU'|'ATM'|'AWG'|'AY'|'AZ'|'B10'|'BP'|'BPM'|'BQL'|'BTU'|'C3'|'C7'|'C8'|'C9'|'CCT'|'CEN'|'CG'|'CGM'|'CKG'|'CLF'|'CTM'|'D03'|'D04'|'D1'|'D10'|'D11'|'D12'|'D13'|'D15'|'D16'|'D17'|'D18'|'D19'|'D2'|'D20'|'D21'|'D22'|'D23'|'D24'|'D25'|'D26'|'D27'|'D29'|'D30'|'D31'|'D32'|'D33'|'D34'|'D36'|'D41'|'D42'|'D43'|'D44'|'D45'|'D46'|'D47'|'D48'|'D49'|'D5'|'D50'|'D51'|'D52'|'D53'|'D54'|'D55'|'D56'|'D57'|'D58'|'D59'|'D6'|'D60'|'D61'|'D62'|'D63'|'D65'|'D68'|'D69'|'D73'|'D74'|'D77'|'D78'|'D80'|'D81'|'D82'|'D83'|'D85'|'D86'|'D87'|'D88'|'D89'|'D91'|'D93'|'D94'|'D95'|'DAA'|'DAD'|'DBM'|'DBW'|'DEC'|'DJ'|'DMA'|'DMO'|'DN'|'DPR'|'DRI'|'DRL'|'DT'|'DTN'|'DWT'|'E08'|'E15'|'E16'|'E18'|'E19'|'E21'|'E22'|'E28'|'E30'|'E32'|'E33'|'E4'|'E59'|'E61'|'E63'|'E64'|'E68'|'E72'|'E74'|'E77'|'E78'|'E79'|'E80'|'E81'|'E82'|'E83'|'E84'|'E85'|'E86'|'E87'|'E88'|'E89'|'E90'|'E91'|'E92'|'E93'|'E94'|'E95'|'E96'|'E97'|'E98'|'E99'|'EB'|'EQ'|'F01'|'F02'|'F03'|'F04'|'F05'|'F06'|'F07'|'F08'|'F10'|'F11'|'F12'|'F13'|'F14'|'F15'|'F16'|'F17'|'F18'|'F19'|'F20'|'F21'|'F22'|'F23'|'F24'|'F25'|'F26'|'F27'|'F28'|'F29'|'F30'|'F31'|'F32'|'F33'|'F34'|'F35'|'F36'|'F37'|'F38'|'F39'|'F40'|'F41'|'F42'|'F43'|'F44'|'F45'|'F46'|'F47'|'F48'|'F49'|'F50'|'F51'|'F52'|'F53'|'F54'|'F55'|'F56'|'F57'|'F58'|'F59'|'F60'|'F61'|'F62'|'F63'|'F64'|'F65'|'F66'|'F67'|'F68'|'F69'|'F70'|'F71'|'F72'|'F73'|'F74'|'F75'|'F76'|'F77'|'F78'|'F79'|'F80'|'F81'|'F82'|'F83'|'F84'|'F85'|'F86'|'F87'|'F88'|'F89'|'F90'|'F91'|'F92'|'F93'|'F94'|'F95'|'F96'|'F97'|'F98'|'F99'|'FAH'|'FAR'|'FBM'|'FC'|'FF'|'FH'|'FIT'|'FL'|'FNU'|'FP'|'FR'|'FS'|'G01'|'G04'|'G05'|'G06'|'G08'|'G09'|'G10'|'G11'|'G12'|'G13'|'G14'|'G15'|'G16'|'G17'|'G18'|'G19'|'G2'|'G20'|'G21'|'G23'|'G24'|'G25'|'G26'|'G27'|'G28'|'G29'|'G3'|'G30'|'G31'|'G32'|'G33'|'G34'|'G35'|'G36'|'G37'|'G38'|'G39'|'G40'|'G41'|'G42'|'G43'|'G44'|'G45'|'G46'|'G47'|'G48'|'G49'|'G50'|'G51'|'G52'|'G53'|'G54'|'G55'|'G56'|'G57'|'G58'|'G59'|'G60'|'G61'|'G62'|'G63'|'G64'|'G65'|'G66'|'G67'|'G68'|'G69'|'G70'|'G71'|'G72'|'G73'|'G74'|'G75'|'G76'|'G77'|'G78'|'G79'|'G80'|'G81'|'G82'|'G83'|'G84'|'G85'|'G86'|'G87'|'G88'|'G89'|'G90'|'G91'|'G92'|'G93'|'G94'|'G95'|'G96'|'G97'|'G98'|'G99'|'GB'|'GBQ'|'GDW'|'GE'|'GF'|'GFI'|'GGR'|'GIA'|'GIC'|'GII'|'GIP'|'GJ'|'GL'|'GLD'|'GM'|'GO'|'GP'|'GQ'|'GRN'|'GV'|'GWH'|'H03'|'H04'|'H05'|'H06'|'H07'|'H08'|'H09'|'H10'|'H11'|'H12'|'H13'|'H14'|'H15'|'H16'|'H18'|'H19'|'H20'|'H21'|'H22'|'H23'|'H24'|'H25'|'H26'|'H27'|'H28'|'H29'|'H30'|'H31'|'H32'|'H33'|'H34'|'H35'|'H36'|'H37'|'H38'|'H39'|'H40'|'H41'|'H42'|'H43'|'H44'|'H45'|'H46'|'H47'|'H48'|'H49'|'H50'|'H51'|'H52'|'H53'|'H54'|'H55'|'H56'|'H57'|'H58'|'H59'|'H60'|'H61'|'H62'|'H63'|'H64'|'H65'|'H66'|'H67'|'H68'|'H69'|'H70'|'H71'|'H72'|'H73'|'H74'|'H75'|'H76'|'H77'|'H79'|'H80'|'H81'|'H82'|'H83'|'H84'|'H85'|'H88'|'H89'|'H90'|'H91'|'H92'|'H93'|'H94'|'H95'|'H96'|'H98'|'H99'|'HA'|'HAD'|'HBA'|'HBX'|'HC'|'HDW'|'HEA'|'HGM'|'HH'|'HIU'|'HKM'|'HLT'|'HM'|'HMO'|'HMQ'|'HMT'|'HPA'|'HWE'|'IA'|'IE'|'ISD'|'IU'|'IUG'|'IV'|'J10'|'J12'|'J13'|'J14'|'J15'|'J16'|'J17'|'J18'|'J19'|'J2'|'J20'|'J21'|'J22'|'J23'|'J24'|'J25'|'J26'|'J27'|'J28'|'J29'|'J30'|'J31'|'J32'|'J33'|'J34'|'J35'|'J36'|'J38'|'J39'|'J40'|'J41'|'J42'|'J43'|'J44'|'J45'|'J46'|'J47'|'J48'|'J49'|'J50'|'J51'|'J52'|'J53'|'J54'|'J55'|'J56'|'J57'|'J58'|'J59'|'J60'|'J61'|'J62'|'J63'|'J64'|'J65'|'J66'|'J67'|'J68'|'J69'|'J70'|'J71'|'J72'|'J73'|'J74'|'J75'|'J76'|'J78'|'J79'|'J81'|'J82'|'J83'|'J84'|'J85'|'J87'|'J90'|'J91'|'J92'|'J93'|'J95'|'J96'|'J97'|'J98'|'J99'|'JE'|'JK'|'JM'|'JNT'|'JOU'|'JPS'|'JWL'|'K1'|'K10'|'K11'|'K12'|'K13'|'K14'|'K15'|'K16'|'K17'|'K18'|'K19'|'K2'|'K20'|'K21'|'K22'|'K23'|'K26'|'K27'|'K28'|'K3'|'K30'|'K31'|'K32'|'K33'|'K34'|'K35'|'K36'|'K37'|'K38'|'K39'|'K40'|'K41'|'K42'|'K43'|'K45'|'K46'|'K47'|'K48'|'K49'|'K50'|'K51'|'K52'|'K53'|'K54'|'K55'|'K58'|'K59'|'K6'|'K60'|'K61'|'K62'|'K63'|'K64'|'K65'|'K66'|'K67'|'K68'|'K69'|'K70'|'K71'|'K73'|'K74'|'K75'|'K76'|'K77'|'K78'|'K79'|'K80'|'K81'|'K82'|'K83'|'K84'|'K85'|'K86'|'K87'|'K88'|'K89'|'K90'|'K91'|'K92'|'K93'|'K94'|'K95'|'K96'|'K97'|'K98'|'K99'|'KA'|'KAT'|'KB'|'KBA'|'KCC'|'KDW'|'KEL'|'KGS'|'KHY'|'KHZ'|'KI'|'KIC'|'KIP'|'KJ'|'KJO'|'KL'|'KLK'|'KLX'|'KMA'|'KMH'|'KMQ'|'KNI'|'KNM'|'KNS'|'KNT'|'KO'|'KPA'|'KPH'|'KPO'|'KPP'|'KR'|'KSD'|'KSH'|'KT'|'KTN'|'KUR'|'KVA'|'KVR'|'KVT'|'KW'|'KWH'|'KWN'|'KWO'|'KWS'|'KWT'|'KWY'|'KX'|'L10'|'L11'|'L12'|'L13'|'L14'|'L15'|'L16'|'L17'|'L18'|'L19'|'L2'|'L20'|'L21'|'L23'|'L24'|'L25'|'L26'|'L27'|'L28'|'L29'|'L30'|'L31'|'L32'|'L33'|'L34'|'L35'|'L36'|'L37'|'L38'|'L39'|'L40'|'L41'|'L42'|'L43'|'L44'|'L45'|'L46'|'L47'|'L48'|'L49'|'L50'|'L51'|'L52'|'L53'|'L54'|'L55'|'L56'|'L57'|'L58'|'L59'|'L60'|'L63'|'L64'|'L65'|'L66'|'L67'|'L68'|'L69'|'L70'|'L71'|'L72'|'L73'|'L74'|'L75'|'L76'|'L77'|'L78'|'L79'|'L80'|'L81'|'L82'|'L83'|'L84'|'L85'|'L86'|'L87'|'L88'|'L89'|'L90'|'L91'|'L92'|'L93'|'L94'|'L95'|'L96'|'L98'|'L99'|'LA'|'LAC'|'LBT'|'LD'|'LEF'|'LF'|'LH'|'LK'|'LM'|'LN'|'LO'|'LP'|'LPA'|'LR'|'LS'|'LTN'|'LUB'|'LUM'|'LUX'|'LY'|'M1'|'M10'|'M11'|'M12'|'M13'|'M14'|'M15'|'M16'|'M17'|'M18'|'M19'|'M20'|'M21'|'M22'|'M23'|'M24'|'M25'|'M26'|'M27'|'M29'|'M30'|'M31'|'M32'|'M33'|'M34'|'M35'|'M36'|'M37'|'M38'|'M39'|'M4'|'M40'|'M41'|'M42'|'M43'|'M44'|'M45'|'M46'|'M47'|'M48'|'M49'|'M5'|'M50'|'M51'|'M52'|'M53'|'M55'|'M56'|'M57'|'M58'|'M59'|'M60'|'M61'|'M62'|'M63'|'M64'|'M65'|'M66'|'M67'|'M68'|'M69'|'M7'|'M70'|'M71'|'M72'|'M73'|'M74'|'M75'|'M76'|'M77'|'M78'|'M79'|'M80'|'M81'|'M82'|'M83'|'M84'|'M85'|'M86'|'M87'|'M88'|'M89'|'M9'|'M90'|'M91'|'M92'|'M93'|'M94'|'M95'|'M96'|'M97'|'M98'|'M99'|'MAH'|'MAL'|'MAM'|'MAR'|'MAW'|'MBE'|'MBF'|'MBR'|'MC'|'MCU'|'MD'|'MGM'|'MHZ'|'MIK'|'MIL'|'MIO'|'MIU'|'MKD'|'MKM'|'MKW'|'MLD'|'MMQ'|'MND'|'MNJ'|'MPA'|'MQD'|'MQH'|'MQM'|'MQS'|'MQW'|'MRD'|'MRM'|'MRW'|'MSK'|'MTS'|'MTZ'|'MVA'|'MWH'|'N1'|'N10'|'N11'|'N12'|'N13'|'N14'|'N15'|'N16'|'N17'|'N18'|'N19'|'N20'|'N21'|'N22'|'N23'|'N24'|'N25'|'N26'|'N27'|'N28'|'N29'|'N3'|'N30'|'N31'|'N32'|'N33'|'N34'|'N35'|'N36'|'N37'|'N38'|'N39'|'N40'|'N41'|'N42'|'N43'|'N44'|'N45'|'N46'|'N47'|'N48'|'N49'|'N50'|'N51'|'N52'|'N53'|'N54'|'N55'|'N56'|'N57'|'N58'|'N59'|'N60'|'N61'|'N62'|'N63'|'N64'|'N65'|'N66'|'N67'|'N68'|'N69'|'N70'|'N71'|'N72'|'N73'|'N74'|'N75'|'N76'|'N77'|'N78'|'N79'|'N80'|'N81'|'N82'|'N83'|'N84'|'N85'|'N86'|'N87'|'N88'|'N89'|'N90'|'N91'|'N92'|'N93'|'N94'|'N95'|'N96'|'N97'|'N98'|'N99'|'NA'|'NCL'|'NEW'|'NF'|'NIL'|'NIU'|'NL'|'NM3'|'NMI'|'NMP'|'NPT'|'NT'|'NTU'|'NU'|'NX'|'OA'|'ODE'|'ODG'|'ODK'|'ODM'|'OHM'|'ON'|'OPM'|'OT'|'OZA'|'OZI'|'P1'|'P10'|'P11'|'P12'|'P13'|'P14'|'P15'|'P16'|'P17'|'P18'|'P19'|'P2'|'P20'|'P21'|'P22'|'P23'|'P24'|'P25'|'P26'|'P27'|'P28'|'P29'|'P30'|'P31'|'P32'|'P33'|'P34'|'P35'|'P36'|'P37'|'P38'|'P39'|'P40'|'P41'|'P42'|'P43'|'P44'|'P45'|'P46'|'P47'|'P48'|'P49'|'P5'|'P50'|'P51'|'P52'|'P53'|'P54'|'P55'|'P56'|'P57'|'P58'|'P59'|'P60'|'P61'|'P62'|'P63'|'P64'|'P65'|'P66'|'P67'|'P68'|'P69'|'P70'|'P71'|'P72'|'P73'|'P74'|'P75'|'P76'|'P77'|'P78'|'P79'|'P80'|'P81'|'P82'|'P83'|'P84'|'P85'|'P86'|'P87'|'P88'|'P89'|'P90'|'P91'|'P92'|'P93'|'P94'|'P95'|'P96'|'P97'|'P98'|'P99'|'PAL'|'PD'|'PFL'|'PGL'|'PI'|'PLA'|'PO'|'PQ'|'PR'|'PS'|'PTD'|'PTI'|'PTL'|'PTN'|'Q10'|'Q11'|'Q12'|'Q13'|'Q14'|'Q15'|'Q16'|'Q17'|'Q18'|'Q19'|'Q20'|'Q21'|'Q22'|'Q23'|'Q24'|'Q25'|'Q26'|'Q27'|'Q28'|'Q29'|'Q3'|'Q30'|'Q31'|'Q32'|'Q33'|'Q34'|'Q35'|'Q36'|'Q37'|'Q38'|'Q39'|'Q40'|'Q41'|'Q42'|'QA'|'QAN'|'QB'|'QR'|'QTD'|'QTI'|'QTL'|'QTR'|'R1'|'R9'|'RH'|'RM'|'ROM'|'RP'|'RPM'|'RPS'|'RT'|'S3'|'S4'|'SAN'|'SCO'|'SCR'|'SET'|'SG'|'SIE'|'SM3'|'SQ'|'SQR'|'SR'|'STC'|'STI'|'STK'|'STL'|'STN'|'STW'|'SW'|'SX'|'SYR'|'T0'|'T3'|'TAH'|'TAN'|'TI'|'TIC'|'TIP'|'TKM'|'TMS'|'TP'|'TPI'|'TPR'|'TQD'|'TRL'|'TST'|'TTS'|'U1'|'U2'|'UB'|'UC'|'VA'|'VP'|'W2'|'WA'|'WB'|'WCD'|'WE'|'WEB'|'WEE'|'WG'|'WHR'|'WM'|'WSD'|'X1'|'Z11'|'Z9'|'ZP'|'X1A'|'X1B'|'X1D'|'X1F'|'X1G'|'X1W'|'X2C'|'X3A'|'X3H'|'X43'|'X44'|'X4A'|'X4B'|'X4C'|'X4D'|'X4F'|'X4G'|'X4H'|'X5H'|'X5L'|'X5M'|'X6H'|'X6P'|'X7A'|'X7B'|'X8A'|'X8B'|'X8C'|'XIZ'|'XKG'|'XKI'|'XNS'|'XNT'|'XNU'|'XNV'|'XO1'|'XO2'|'XO3'|'XO4'|'XO5'|'XO6'|'XO7'|'XO8'|'XO9'|'XT1'|UnitOfMeasureCode|null,
     *   unitPrice?: float|string|null,
     * }> $items Body param: At least one line item is required
     * @param string|null $note Body param: Additional notes or comments for the invoice
     * @param list<array{
     *   bankAccountNumber?: string|null,
     *   iban?: string|null,
     *   paymentReference?: string|null,
     *   swift?: string|null,
     * }|PaymentDetailCreate>|null $paymentDetails Body param:
     * @param string|null $paymentTerm Body param: The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30')
     * @param string|\DateTimeInterface|null $precedingInvoiceDate Body param: The preceding invoice issue date (BT-26)
     * @param string|null $precedingInvoiceID Body param: The preceding invoice reference (BT-25): the number of the invoice this document corrects, for example the invoice a credit note credits
     * @param float|string|null $previousUnpaidBalance Body param: The previous unpaid balance from prior invoices, if any. Must be positive and rounded to maximum 2 decimals
     * @param string|null $purchaseOrder Body param: The purchase order reference number (BT-13)
     * @param string|null $remittanceAddress Body param: The address where payment should be sent or remitted to
     * @param string|null $remittanceAddressRecipient Body param: The recipient name at the remittance address
     * @param float|string|null $roundingAmount Body param: The amount added to the invoice total to round the amount for payment (BT-114), for example to whole kronor (amount_due = invoice_total + rounding_amount when nothing is prepaid). Can be negative. Between -5.00 and 5.00, rounded to maximum 2 decimals
     * @param string|null $salesOrder Body param: The sales order reference (BT-14) assigned by the seller
     * @param string|null $serviceAddress Body param: The address where services were performed or goods were delivered
     * @param string|null $serviceAddressRecipient Body param: The recipient name at the service address
     * @param string|\DateTimeInterface|null $serviceEndDate Body param: The end date of the service period or delivery period
     * @param string|\DateTimeInterface|null $serviceStartDate Body param: The start date of the service period or delivery period
     * @param string|null $shippingAddress Body param: The shipping/delivery address
     * @param string|null $shippingAddressRecipient Body param: The name of the deliver-to party (BT-70)
     * @param 'DRAFT'|'TRANSIT'|'FAILED'|'SENT'|'RECEIVED'|DocumentState|null $state Body param: The current state of the document: DRAFT, TRANSIT, FAILED, SENT, or RECEIVED. Null leaves the field out, so the server applies its default
     * @param float|string|null $subtotal Body param: The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals
     * @param 'AE'|'E'|'S'|'Z'|'G'|'O'|'K'|'L'|'M'|'B'|\EInvoiceAPI\Documents\DocumentCreateParams\TaxCode $taxCode Body param: Tax category code of the invoice (e.g., S for standard rate, Z for zero rate, E for exempt)
     * @param list<array{
     *   amount?: float|string|null, rate?: string|null
     * }>|null $taxDetails Body param:
     * @param string|null $taxCurrency Body param: The VAT accounting currency (BT-6, ISO 4217 currency code), when VAT is accounted in a currency other than the invoice currency. Must differ from currency and requires total_tax_in_tax_currency
     * @param float|string|null $totalDiscount Body param: The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals
     * @param float|string|null $totalTax Body param: The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals
     * @param float|string|null $totalTaxInTaxCurrency Body param: The total VAT amount in the VAT accounting currency tax_currency (BT-111). Does not add to invoice_total. Requires tax_currency. Rounded to maximum 2 decimals
     * @param 'VATEX-EU-79-C'|'VATEX-EU-132'|'VATEX-EU-132-1A'|'VATEX-EU-132-1B'|'VATEX-EU-132-1C'|'VATEX-EU-132-1D'|'VATEX-EU-132-1E'|'VATEX-EU-132-1F'|'VATEX-EU-132-1G'|'VATEX-EU-132-1H'|'VATEX-EU-132-1I'|'VATEX-EU-132-1J'|'VATEX-EU-132-1K'|'VATEX-EU-132-1L'|'VATEX-EU-132-1M'|'VATEX-EU-132-1N'|'VATEX-EU-132-1O'|'VATEX-EU-132-1P'|'VATEX-EU-132-1Q'|'VATEX-EU-135-1'|'VATEX-EU-143'|'VATEX-EU-143-1A'|'VATEX-EU-143-1B'|'VATEX-EU-143-1C'|'VATEX-EU-143-1D'|'VATEX-EU-143-1E'|'VATEX-EU-143-1F'|'VATEX-EU-143-1FA'|'VATEX-EU-143-1G'|'VATEX-EU-143-1H'|'VATEX-EU-143-1I'|'VATEX-EU-143-1J'|'VATEX-EU-143-1K'|'VATEX-EU-143-1L'|'VATEX-EU-144'|'VATEX-EU-146-1E'|'VATEX-EU-148'|'VATEX-EU-148-A'|'VATEX-EU-148-B'|'VATEX-EU-148-C'|'VATEX-EU-148-D'|'VATEX-EU-148-E'|'VATEX-EU-148-F'|'VATEX-EU-148-G'|'VATEX-EU-151'|'VATEX-EU-151-1A'|'VATEX-EU-151-1AA'|'VATEX-EU-151-1B'|'VATEX-EU-151-1C'|'VATEX-EU-151-1D'|'VATEX-EU-151-1E'|'VATEX-EU-153'|'VATEX-EU-159'|'VATEX-EU-309'|'VATEX-EU-AE'|'VATEX-EU-D'|'VATEX-EU-F'|'VATEX-EU-G'|'VATEX-EU-I'|'VATEX-EU-IC'|'VATEX-EU-O'|'VATEX-EU-J'|'VATEX-FR-298SEXDECIESA'|'VATEX-FR-AE'|'VATEX-FR-CGI261-1'|'VATEX-FR-CGI261-2'|'VATEX-FR-CGI261-3'|'VATEX-FR-CGI261-4'|'VATEX-FR-CGI261-5'|'VATEX-FR-CGI261-7'|'VATEX-FR-CGI261-8'|'VATEX-FR-CGI261A'|'VATEX-FR-CGI261B'|'VATEX-FR-CGI261C-1'|'VATEX-FR-CGI261C-2'|'VATEX-FR-CGI261C-3'|'VATEX-FR-CGI261D-1'|'VATEX-FR-CGI261D-1BIS'|'VATEX-FR-CGI261D-2'|'VATEX-FR-CGI261D-3'|'VATEX-FR-CGI261D-4'|'VATEX-FR-CGI261E-1'|'VATEX-FR-CGI261E-2'|'VATEX-FR-CGI275'|'VATEX-FR-CGI277A'|'VATEX-FR-CGI295'|'VATEX-FR-FRANCHISE'|'VATEX-FR-CNWVAT'|Vatex|null $vatex Body param: VAT exemption reason code (BT-121), from the VATEX code list. An exemption reason (vatex or vatex_note) is required for tax_code E, AE, K, G and O, and not allowed for S, Z, L and M
     * @param string|null $vatexNote Body param: VAT exemption reason text (BT-120). An exemption reason (vatex or vatex_note) is required for tax_code E, AE, K, G and O, and not allowed for S, Z, L and M
     * @param string|null $vendorAddress Body param: The address of the vendor/seller
     * @param string|null $vendorAddressRecipient Body param: The recipient name at the vendor address. Also the vendor contact name (BT-41) in the UBL, required when vendor and customer are both in Germany (DE-R-005)
     * @param string|null $vendorCompanyID Body param: Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     * @param string|null $vendorEmail Body param: The email address of the vendor
     * @param string|null $vendorName Body param: The name of the vendor/seller/supplier
     * @param string|null $vendorPhone Body param: The telephone number of the vendor contact (BT-42). Required when vendor and customer are both in Germany (DE-R-006); it must then hold at least 3 digits (DE-R-027, a warning)
     * @param string|null $vendorTaxID Body param: Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix
     *
     * @throws APIException
     */
    public function create(
        ?array $allowances = null,
        float|string|null $amountDue = null,
        ?array $attachments = null,
        ?string $billingAddress = null,
        ?string $billingAddressRecipient = null,
        ?string $buyerReference = null,
        ?array $charges = null,
        ?bool $constructPdf = null,
        string|CurrencyCode|null $currency = CurrencyCode::EUR,
        ?string $customerAddress = null,
        ?string $customerAddressRecipient = null,
        ?string $customerCompanyID = null,
        ?string $customerEmail = null,
        ?string $customerID = null,
        ?string $customerName = null,
        ?string $customerPeppolID = null,
        ?string $customerPhone = null,
        ?string $customerTaxID = null,
        string|DocumentDirection|null $direction = DocumentDirection::OUTBOUND,
        string|DocumentType|null $documentType = DocumentType::INVOICE,
        string|\DateTimeInterface|null $dueDate = null,
        string|\DateTimeInterface|null $invoiceDate = null,
        ?string $invoiceID = null,
        float|string|null $invoiceTotal = null,
        ?array $items = null,
        ?string $note = null,
        ?array $paymentDetails = null,
        ?string $paymentTerm = null,
        string|\DateTimeInterface|null $precedingInvoiceDate = null,
        ?string $precedingInvoiceID = null,
        float|string|null $previousUnpaidBalance = null,
        ?string $purchaseOrder = null,
        ?string $remittanceAddress = null,
        ?string $remittanceAddressRecipient = null,
        float|string|null $roundingAmount = null,
        ?string $salesOrder = null,
        ?string $serviceAddress = null,
        ?string $serviceAddressRecipient = null,
        string|\DateTimeInterface|null $serviceEndDate = null,
        string|\DateTimeInterface|null $serviceStartDate = null,
        ?string $shippingAddress = null,
        ?string $shippingAddressRecipient = null,
        string|DocumentState|null $state = DocumentState::DRAFT,
        float|string|null $subtotal = null,
        string|\EInvoiceAPI\Documents\DocumentCreateParams\TaxCode $taxCode = \EInvoiceAPI\Documents\DocumentCreateParams\TaxCode::S,
        ?string $taxCurrency = null,
        ?array $taxDetails = null,
        float|string|null $totalDiscount = null,
        float|string|null $totalTax = null,
        float|string|null $totalTaxInTaxCurrency = null,
        string|Vatex|null $vatex = null,
        ?string $vatexNote = null,
        ?string $vendorAddress = null,
        ?string $vendorAddressRecipient = null,
        ?string $vendorCompanyID = null,
        ?string $vendorEmail = null,
        ?string $vendorName = null,
        ?string $vendorPhone = null,
        ?string $vendorTaxID = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentDeleteResponse;

    /**
     * @api
     *
     * @param string|FileParam $file Body param:
     * @param string|null $customerTaxID Query param:
     * @param string|null $vendorTaxID Query param:
     *
     * @throws APIException
     */
    public function createFromPdf(
        string|FileParam $file,
        ?string $customerTaxID = null,
        ?string $vendorTaxID = null,
        ?RequestOptions $requestOptions = null,
    ): DocumentNewFromPdfResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveLifecycle(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentGetLifecycleResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveTimeline(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentGetTimelineResponse;

    /**
     * @api
     *
     * @param string|null $email (Deprecated)
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
    ): DocumentResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function validate(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation;
}

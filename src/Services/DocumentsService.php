<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentCreateFromPdfParams;
use EInvoiceAPI\Documents\DocumentCreateParams;
use EInvoiceAPI\Documents\DocumentCreateParams\Vatex;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentSendParams;
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
        $this->attachments = new AttachmentsService($client);
        $this->ubl = new UblService($client);
    }

    /**
     * @api
     *
     * Create a new invoice or credit note
     *
     * @param array{
     *   allowances?: list<array{
     *     amount?: float|string|null,
     *     base_amount?: float|string|null,
     *     multiplier_factor?: float|string|null,
     *     reason?: string|null,
     *     reason_code?: string|null,
     *     tax_code?: "AE"|"E"|"S"|"Z"|"G"|"O"|"K"|"L"|"M"|"B"|null,
     *     tax_rate?: string|null,
     *   }>|null,
     *   amount_due?: float|string|null,
     *   attachments?: list<array{
     *     file_name: string,
     *     file_data?: string|null,
     *     file_size?: int,
     *     file_type?: string,
     *   }|DocumentAttachmentCreate>|null,
     *   billing_address?: string|null,
     *   billing_address_recipient?: string|null,
     *   charges?: list<array{
     *     amount?: float|string|null,
     *     base_amount?: float|string|null,
     *     multiplier_factor?: float|string|null,
     *     reason?: string|null,
     *     reason_code?: string|null,
     *     tax_code?: "AE"|"E"|"S"|"Z"|"G"|"O"|"K"|"L"|"M"|"B"|null,
     *     tax_rate?: string|null,
     *   }>|null,
     *   currency?: value-of<CurrencyCode>,
     *   customer_address?: string|null,
     *   customer_address_recipient?: string|null,
     *   customer_company_id?: string|null,
     *   customer_email?: string|null,
     *   customer_id?: string|null,
     *   customer_name?: string|null,
     *   customer_tax_id?: string|null,
     *   direction?: "INBOUND"|"OUTBOUND"|DocumentDirection,
     *   document_type?: "INVOICE"|"CREDIT_NOTE"|"DEBIT_NOTE"|DocumentType,
     *   due_date?: string|\DateTimeInterface|null,
     *   invoice_date?: string|\DateTimeInterface|null,
     *   invoice_id?: string|null,
     *   invoice_total?: float|string|null,
     *   items?: list<array{
     *     allowances?: list<array<mixed>>|null,
     *     amount?: float|string|null,
     *     charges?: list<array<mixed>>|null,
     *     date?: null|null,
     *     description?: string|null,
     *     product_code?: string|null,
     *     quantity?: float|string|null,
     *     tax?: float|string|null,
     *     tax_rate?: string|null,
     *     unit?: "10"|"11"|"13"|"14"|"15"|"20"|"21"|"22"|"23"|"24"|"25"|"27"|"28"|"33"|"34"|"35"|"37"|"38"|"40"|"41"|"56"|"57"|"58"|"59"|"60"|"61"|"74"|"77"|"80"|"81"|"85"|"87"|"89"|"91"|"1I"|"EA"|"E01"|"E07"|"E09"|"E10"|"E12"|"E14"|"E17"|"E20"|"E23"|"E25"|"E27"|"E31"|"E34"|"E35"|"E36"|"E37"|"E38"|"E39"|"E40"|"E41"|"E42"|"E43"|"E44"|"E45"|"E46"|"E47"|"E48"|"E49"|"E50"|"E51"|"E52"|"E53"|"E54"|"E55"|"E56"|"E57"|"E58"|"E60"|"E62"|"E65"|"E66"|"E67"|"E69"|"E70"|"E71"|"E73"|"E75"|"E76"|"2A"|"2B"|"2C"|"2G"|"2H"|"2I"|"2J"|"2K"|"2L"|"2M"|"2N"|"2P"|"2Q"|"2R"|"2U"|"2X"|"2Y"|"2Z"|"3B"|"3C"|"4C"|"4G"|"4H"|"4K"|"4L"|"4M"|"4N"|"4O"|"4P"|"4Q"|"4R"|"4T"|"4U"|"4W"|"4X"|"5A"|"5B"|"5E"|"5J"|"A10"|"A11"|"A12"|"A13"|"A14"|"A15"|"A16"|"A17"|"A18"|"A19"|"A2"|"A20"|"A21"|"A22"|"A23"|"A24"|"A26"|"A27"|"A28"|"A29"|"A3"|"A30"|"A31"|"A32"|"A33"|"A34"|"A35"|"A36"|"A37"|"A38"|"A39"|"A4"|"A40"|"A41"|"A42"|"A43"|"A44"|"A45"|"A46"|"A47"|"A48"|"A49"|"A5"|"A50"|"A51"|"A52"|"A53"|"A54"|"A55"|"A56"|"A57"|"A58"|"A59"|"A6"|"A60"|"A61"|"A62"|"A63"|"A64"|"A65"|"A66"|"A67"|"A68"|"A69"|"A7"|"A70"|"A71"|"A72"|"A73"|"A74"|"A75"|"A76"|"A77"|"A78"|"A79"|"A8"|"A80"|"A81"|"A82"|"A83"|"A84"|"A85"|"A86"|"A87"|"A88"|"A89"|"A9"|"A90"|"A91"|"A92"|"A93"|"A94"|"A95"|"A96"|"A97"|"A98"|"A99"|"ACR"|"AH"|"AI"|"AK"|"AMH"|"AMT"|"ANN"|"B1"|"B11"|"B12"|"B13"|"B14"|"B15"|"B16"|"B17"|"B18"|"B19"|"B20"|"B21"|"B22"|"B23"|"B24"|"B25"|"B26"|"B27"|"B28"|"B29"|"B3"|"B30"|"B31"|"B32"|"B33"|"B34"|"B35"|"B36"|"B37"|"B38"|"B39"|"B4"|"B40"|"B41"|"B42"|"B43"|"B44"|"B45"|"B46"|"B47"|"B48"|"B49"|"B5"|"B50"|"B52"|"B53"|"B54"|"B55"|"B56"|"B57"|"B58"|"B59"|"B6"|"B60"|"B61"|"B62"|"B63"|"B64"|"B65"|"B66"|"B67"|"B68"|"B69"|"B7"|"B70"|"B71"|"B72"|"B73"|"B74"|"B75"|"B76"|"B77"|"B78"|"B79"|"B8"|"B80"|"B81"|"B82"|"B83"|"B84"|"B85"|"B86"|"B87"|"B88"|"B89"|"B9"|"B90"|"B91"|"B92"|"B93"|"B94"|"B95"|"B96"|"B97"|"B98"|"B99"|"BAR"|"BB"|"BFT"|"BHP"|"BIL"|"BLD"|"BLL"|"BUA"|"BUI"|"C0"|"C10"|"C11"|"C12"|"C13"|"C14"|"C15"|"C16"|"C17"|"C18"|"C19"|"C20"|"C21"|"C22"|"C23"|"C24"|"C25"|"C26"|"C27"|"C28"|"C29"|"C30"|"C31"|"C32"|"C33"|"C34"|"C35"|"C36"|"C37"|"C38"|"C39"|"C40"|"C41"|"C42"|"C43"|"C44"|"C45"|"C46"|"C47"|"C48"|"C49"|"C50"|"C51"|"C52"|"C53"|"C54"|"C55"|"C56"|"C57"|"C58"|"C59"|"C60"|"C61"|"C63"|"C64"|"C65"|"C66"|"C67"|"C68"|"C69"|"C70"|"C71"|"C72"|"C73"|"C74"|"C75"|"C76"|"C77"|"C78"|"C79"|"C80"|"C81"|"C82"|"C83"|"C84"|"C85"|"C86"|"C87"|"C88"|"C89"|"C90"|"C91"|"C92"|"C93"|"C94"|"C95"|"C96"|"C97"|"C98"|"C99"|"CDL"|"CEL"|"CHU"|"CIU"|"CLT"|"CMK"|"CMQ"|"CMT"|"CNP"|"CNT"|"COU"|"CTG"|"CTN"|"CUR"|"CWA"|"CWI"|"DAN"|"DAY"|"DB"|"DD"|"DG"|"DI"|"DLT"|"DMK"|"DMQ"|"DMT"|"DPC"|"DPT"|"DRA"|"DZN"|"DZP"|"FOT"|"GLL"|"GLI"|"GRM"|"GRO"|"HUR"|"HTZ"|"INH"|"KGM"|"KMT"|"MTR"|"SMI"|"MIN"|"MON"|"ONZ"|"PCE"|"LBR"|"QT"|"SEC"|"FTK"|"INK"|"MTK"|"YDK"|"TNE"|"VLT"|"WTT"|"YRD"|"FTQ"|"INQ"|"MTQ"|"YDQ"|"HAR"|"KLT"|"MLT"|"MMT"|"KMK"|"MMK"|"XAA"|"XAB"|"XAC"|"XAD"|"XAE"|"XAF"|"XAG"|"XAH"|"XAI"|"XAJ"|"XAL"|"XAM"|"XAP"|"XAT"|"XAV"|"XB4"|"XBA"|"XBB"|"XBC"|"XBD"|"XBE"|"XBF"|"XBG"|"XBH"|"XBI"|"XBJ"|"XBK"|"XBL"|"XBM"|"XBN"|"XBO"|"XBP"|"XBQ"|"XBR"|"XBS"|"XBT"|"XBU"|"XBV"|"XBW"|"XBX"|"XBY"|"XBZ"|"XCA"|"XCB"|"XCC"|"XCD"|"XCE"|"XCF"|"XCG"|"XCH"|"XCI"|"XCJ"|"XCK"|"XCL"|"XCM"|"XCN"|"XCO"|"XCP"|"XCQ"|"XCR"|"XCS"|"XCT"|"XCU"|"XCV"|"XCW"|"XCX"|"XCY"|"XCZ"|"XDA"|"XDB"|"XDC"|"XDD"|"XDE"|"XDF"|"XDG"|"XDH"|"XDI"|"XDJ"|"XDK"|"XDL"|"XDM"|"XDN"|"XDP"|"XDQ"|"XDR"|"XDS"|"XDT"|"XDU"|"XDV"|"XDW"|"XDX"|"XDY"|"XDZ"|"XEA"|"XEB"|"XEC"|"XED"|"XEE"|"XEF"|"XEG"|"XEH"|"XEI"|"XEJ"|"XEK"|"XEL"|"XEM"|"XEN"|"XEP"|"XEQ"|"XER"|"XES"|"XET"|"XEU"|"XEV"|"XEW"|"XEX"|"XEY"|"XFB"|"XFC"|"XFD"|"XFE"|"XFF"|"XFG"|"XFH"|"XFI"|"XFJ"|"XFK"|"XFL"|"XFM"|"XFN"|"XFO"|"XFP"|"XFQ"|"XFR"|"XFS"|"XFT"|"XFU"|"XFV"|"XFW"|"XFX"|"XFY"|"XFZ"|"XGA"|"XGB"|"XGC"|"XGD"|"XGE"|"XGF"|"XGG"|"XGH"|"XGI"|"XGJ"|"XGK"|"XGL"|"XGM"|"XGN"|"XGO"|"XGP"|"XGQ"|"XGR"|"XGS"|"XGT"|"XGU"|"XGV"|"XGW"|"XGX"|"XGY"|"XGZ"|"XHA"|"XHB"|"XHC"|"XHD"|"XHE"|"XHF"|"XHG"|"XHH"|"XHI"|"XHJ"|"XHK"|"XHL"|"XHM"|"XHN"|"XHP"|"XHQ"|"XHR"|"XHS"|"XHT"|"XHU"|"XHV"|"XHW"|"XHX"|"XHY"|"XHZ"|"XIA"|"XIB"|"XIC"|"XID"|"XIE"|"XIF"|"XIG"|"XIH"|"XII"|"XIJ"|"XIK"|"XIL"|"XIM"|"XIN"|"XIO"|"XJA"|"XJB"|"XJC"|"XJD"|"XJE"|"XJF"|"XJG"|"XJH"|"XJI"|"XJJ"|"XJK"|"XJL"|"XJM"|"XJN"|"XJO"|"XJP"|"XJQ"|"XJR"|"XJS"|"XJT"|"XJU"|"XJV"|"XJW"|"XJX"|"XJY"|"XJZ"|"XLA"|"XLB"|"XLC"|"XLD"|"XLE"|"XLF"|"XLG"|"XLH"|"XLI"|"XLJ"|"XLK"|"XLL"|"XLM"|"XLN"|"XLO"|"XLP"|"XLQ"|"XLR"|"XLS"|"XLT"|"XLU"|"XLV"|"XLW"|"XLX"|"XLY"|"XLZ"|"XMA"|"XMB"|"XMC"|"XMD"|"XME"|"XMF"|"XMG"|"XMH"|"XMI"|"XMJ"|"XMK"|"XML"|"XMM"|"XMN"|"XMO"|"XMP"|"XMQ"|"XMR"|"XMS"|"XMT"|"XMU"|"XMV"|"XMW"|"XMX"|"XMY"|"XMZ"|"XNA"|"XNB"|"XNC"|"XND"|"XNE"|"XNF"|"XNG"|"XNH"|"XNI"|"XNJ"|"XNK"|"XNL"|"XNM"|"XOA"|"XOB"|"XOC"|"XOD"|"XOE"|"XOF"|"XOG"|"XOH"|"XOI"|"XOJ"|"XOK"|"XOL"|"XOM"|"XON"|"XOO"|"XOP"|"XOQ"|"XOR"|"XOS"|"XOT"|"XOU"|"XOV"|"XOW"|"XOX"|"XOY"|"XOZ"|"XP1"|"XP2"|"XP3"|"XP4"|"XPA"|"XPB"|"XPC"|"XPD"|"XPE"|"XPF"|"XPG"|"XPH"|"XPI"|"XPJ"|"XPK"|"XPL"|"XPM"|"XPN"|"XPO"|"XPP"|"XPQ"|"XPR"|"XPS"|"XPT"|"XPU"|"XPV"|"XPW"|"XPX"|"XPY"|"XPZ"|"XQA"|"XQB"|"XQC"|"XQD"|"XQE"|"XQF"|"XQG"|"XQH"|"XQI"|"XQJ"|"XQK"|"XQL"|"XQM"|"XQN"|"XQO"|"XQP"|"XQQ"|"XQR"|"XQS"|"XRD"|"XRE"|"XRF"|"XRG"|"XRH"|"XRI"|"XRJ"|"XRK"|"XRL"|"XRM"|"XRN"|"XRO"|"XRP"|"XRQ"|"XRR"|"XRS"|"XRT"|"XRU"|"XRV"|"XRW"|"XRX"|"XRY"|"XRZ"|"XSA"|"XSB"|"XSC"|"XSD"|"XSE"|"XSF"|"XSG"|"XSH"|"XSI"|"XSJ"|"XSK"|"XSL"|"XSM"|"XSN"|"XSO"|"XSP"|"XSQ"|"XSR"|"XSS"|"XST"|"XSU"|"XSV"|"XSW"|"XSX"|"XSY"|"XSZ"|"XTA"|"XTB"|"XTC"|"XTD"|"XTE"|"XTF"|"XTG"|"XTI"|"XTJ"|"XTK"|"XTL"|"XTM"|"XTN"|"XTO"|"XTR"|"XTS"|"XTT"|"XTU"|"XTV"|"XTW"|"XTX"|"XTY"|"XTZ"|"XUC"|"XUN"|"XVA"|"XVG"|"XVI"|"XVK"|"XVL"|"XVN"|"XVO"|"XVP"|"XVQ"|"XVR"|"XVS"|"XVY"|"XWA"|"XWB"|"XWC"|"XWD"|"XWF"|"XWG"|"XWH"|"XWJ"|"XWK"|"XWL"|"XWM"|"XWN"|"XWP"|"XWQ"|"XWR"|"XWS"|"XWT"|"XWU"|"XWV"|"XWW"|"XWX"|"XWY"|"XWZ"|"XXA"|"XXB"|"XXC"|"XXD"|"XXF"|"XXG"|"XXH"|"XXJ"|"XXK"|"XYA"|"XYB"|"XYC"|"XYD"|"XYF"|"XYG"|"XYH"|"XYJ"|"XYK"|"XYL"|"XYM"|"XYN"|"XYP"|"XYQ"|"XYR"|"XYS"|"XYT"|"XYV"|"XYW"|"XYX"|"XYY"|"XYZ"|"XZA"|"XZB"|"XZC"|"XZD"|"XZF"|"XZG"|"XZH"|"XZJ"|"XZK"|"XZL"|"XZM"|"XZN"|"XZP"|"XZQ"|"XZR"|"XZS"|"XZT"|"XZU"|"XZV"|"XZW"|"XZX"|"XZY"|"XZZ"|"ZZ"|"NAR"|"C62"|"LTR"|UnitOfMeasureCode|null,
     *     unit_price?: float|string|null,
     *   }>,
     *   note?: string|null,
     *   payment_details?: list<array{
     *     bank_account_number?: string|null,
     *     iban?: string|null,
     *     payment_reference?: string|null,
     *     swift?: string|null,
     *   }|PaymentDetailCreate>|null,
     *   payment_term?: string|null,
     *   previous_unpaid_balance?: float|string|null,
     *   purchase_order?: string|null,
     *   remittance_address?: string|null,
     *   remittance_address_recipient?: string|null,
     *   service_address?: string|null,
     *   service_address_recipient?: string|null,
     *   service_end_date?: string|\DateTimeInterface|null,
     *   service_start_date?: string|\DateTimeInterface|null,
     *   shipping_address?: string|null,
     *   shipping_address_recipient?: string|null,
     *   state?: "DRAFT"|"TRANSIT"|"FAILED"|"SENT"|"RECEIVED"|DocumentState,
     *   subtotal?: float|string|null,
     *   tax_code?: "AE"|"E"|"S"|"Z"|"G"|"O"|"K"|"L"|"M"|"B",
     *   tax_details?: list<array{
     *     amount?: float|string|null, rate?: string|null
     *   }>|null,
     *   total_discount?: float|string|null,
     *   total_tax?: float|string|null,
     *   vatex?: value-of<Vatex>,
     *   vatex_note?: string|null,
     *   vendor_address?: string|null,
     *   vendor_address_recipient?: string|null,
     *   vendor_company_id?: string|null,
     *   vendor_email?: string|null,
     *   vendor_name?: string|null,
     *   vendor_tax_id?: string|null,
     * }|DocumentCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|DocumentCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        [$parsed, $options] = DocumentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'api/documents/',
            body: (object) $parsed,
            options: $options,
            convert: DocumentResponse::class,
        );
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
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
            convert: DocumentResponse::class,
        );
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
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
            convert: DocumentDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Create a new invoice or credit note from a PDF file. If the 'ubl_document' field is set in the response, it indicates that sufficient details were extracted from the PDF to automatically generate a valid UBL document ready for sending. If 'ubl_document' is not set, human intervention may be required to ensure compliance.
     *
     * @param array{
     *   file: string, customer_tax_id?: string|null, vendor_tax_id?: string|null
     * }|DocumentCreateFromPdfParams $params
     *
     * @throws APIException
     */
    public function createFromPdf(
        array|DocumentCreateFromPdfParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentNewFromPdfResponse {
        [$parsed, $options] = DocumentCreateFromPdfParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['customer_tax_id', 'vendor_tax_id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'api/documents/pdf',
            query: array_diff_key($parsed, $query_params),
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: DocumentNewFromPdfResponse::class,
        );
    }

    /**
     * @api
     *
     * Send an invoice or credit note via Peppol
     *
     * @param array{
     *   email?: string|null,
     *   receiver_peppol_id?: string|null,
     *   receiver_peppol_scheme?: string|null,
     *   sender_peppol_id?: string|null,
     *   sender_peppol_scheme?: string|null,
     * }|DocumentSendParams $params
     *
     * @throws APIException
     */
    public function send(
        string $documentID,
        array|DocumentSendParams $params,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = DocumentSendParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/send', $documentID],
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
        );
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
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/validate', $documentID],
            options: $requestOptions,
            convert: UblDocumentValidation::class,
        );
    }
}

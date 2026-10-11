<?php

namespace Tests\Services;

use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
#[CoversNothing]
final class ValidateTest extends ServiceTestCase
{
    #[Test]
    public function testValidateJson(): void
    {
        $this->http->queueJson(self::validationResponse());

        $result = $this->client->validate->validateJson(requestOptions: $this->options());

        // The service sends the default tax code of the API specification.
        $this->assertRequest('POST', '/api/validate/json', body: ['tax_code' => 'S']);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
        $this->assertSame('val_123', $result->id);
        $this->assertTrue($result->isValid);
        $this->assertSame([], $result->issues);
    }

    #[Test]
    public function testValidatePeppolID(): void
    {
        $this->http->queueJson([
            'business_card_valid' => true,
            'dns_valid' => true,
            'is_valid' => true,
            'supported_document_types' => ['urn:oasis:names:specification:ubl:schema:xsd:Invoice-2::Invoice'],
        ]);

        $result = $this->client->validate->validatePeppolID(
            peppolID: 'peppol_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/validate/peppol-id', ['peppol_id' => 'peppol_id']);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ValidateValidatePeppolIDResponse::class, $result);
        $this->assertTrue($result->isValid);
        $this->assertTrue($result->dnsValid);
        $this->assertTrue($result->businessCardValid);
        $this->assertSame(
            ['urn:oasis:names:specification:ubl:schema:xsd:Invoice-2::Invoice'],
            $result->supportedDocumentTypes,
        );
        $this->assertNull($result->businessCard);
    }

    #[Test]
    public function testValidatePeppolIDWithOptionalParams(): void
    {
        $this->http->queueJson([
            'business_card_valid' => true,
            'dns_valid' => true,
            'is_valid' => false,
            'supported_document_types' => [],
            'business_card' => [
                'country_code' => 'BE',
                'name' => 'Acme',
                'registration_date' => '2024-01-15T00:00:00Z',
            ],
        ]);

        $result = $this->client->validate->validatePeppolID(
            peppolID: 'peppol_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/validate/peppol-id', ['peppol_id' => 'peppol_id']);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ValidateValidatePeppolIDResponse::class, $result);
        $this->assertFalse($result->isValid);
        $this->assertSame([], $result->supportedDocumentTypes);
        $this->assertNotNull($result->businessCard);
        $this->assertSame('Acme', $result->businessCard->name);
        $this->assertSame('BE', $result->businessCard->countryCode);
        $this->assertNotNull($result->businessCard->registrationDate);
        $this->assertSame('2024-01-15', $result->businessCard->registrationDate->format('Y-m-d'));
    }

    #[Test]
    public function testValidateUbl(): void
    {
        $this->http->queueJson(self::validationResponse(['file_name' => 'upload']));

        $result = $this->client->validate->validateUbl(
            file: 'file',
            requestOptions: $this->options(),
        );

        $this->assertMultipartFileRequest('/api/validate/ubl', 'file', 'upload', 'file');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
        $this->assertSame('val_123', $result->id);
        $this->assertSame('upload', $result->fileName);
        $this->assertTrue($result->isValid);
    }

    #[Test]
    public function testValidateUblWithOptionalParams(): void
    {
        $this->http->queueJson(self::validationResponse([
            'is_valid' => false,
            'issues' => [
                [
                    'message' => 'An Invoice shall have a Seller name (BT-27).',
                    'schematron' => 'CEN-EN16931-UBL',
                    'type' => 'error',
                    'flag' => 'fatal',
                    'location' => '/Invoice',
                    'rule_id' => 'BR-06',
                    'test' => 'normalize-space(cbc:Name) != \'\'',
                ],
            ],
            'ubl_document' => null,
        ]));

        $result = $this->client->validate->validateUbl(
            file: 'file',
            requestOptions: $this->options(),
        );

        $this->assertMultipartFileRequest('/api/validate/ubl', 'file', 'upload', 'file');
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
        $this->assertFalse($result->isValid);
        $this->assertCount(1, $result->issues);
        $this->assertSame('error', $result->issues[0]->type);
        $this->assertSame('BR-06', $result->issues[0]->ruleID);
        $this->assertSame('CEN-EN16931-UBL', $result->issues[0]->schematron);
        $this->assertNull($result->ublDocument);
    }

    #[Test]
    public function testValidateJsonWithCustomerPeppolID(): void
    {
        $this->http->queueJson(self::validationResponse());

        $result = $this->client->validate->validateJson(
            customerPeppolID: '0208:0123456789',
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'POST',
            '/api/validate/json',
            body: ['customer_peppol_id' => '0208:0123456789', 'tax_code' => 'S'],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
        $this->assertTrue($result->isValid);
        $this->assertSame('<Invoice/>', $result->ublDocument);
    }

    #[Test]
    public function testValidateJsonWithItemAttributes(): void
    {
        $this->http->queueJson(self::validationResponse());

        $result = $this->client->validate->validateJson(
            items: [
                ['itemAttributes' => [['name' => 'color', 'value' => 'red']]],
            ],
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'POST',
            '/api/validate/json',
            body: [
                'items' => [
                    ['item_attributes' => [['name' => 'color', 'value' => 'red']]],
                ],
                'tax_code' => 'S',
            ],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UblDocumentValidation::class, $result);
        $this->assertTrue($result->isValid);
    }

    /**
     * Asserts on a multipart request that holds one file part.
     */
    private function assertMultipartFileRequest(
        string $path,
        string $fieldName,
        string $fileName,
        string $content,
    ): void {
        $this->assertCount(1, $this->http->requests);
        $request = $this->http->requests[0];

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($path, $request->getUri()->getPath());
        $this->assertSame('', $request->getUri()->getQuery());
        $this->assertSame('Bearer My API Key', $request->getHeaderLine('Authorization'));
        $this->assertStringStartsWith('multipart/form-data; boundary=', $request->getHeaderLine('Content-Type'));

        $body = (string) $request->getBody();
        $this->assertStringContainsString(
            sprintf('Content-Disposition: form-data; name="%s"; filename="%s"', $fieldName, $fileName),
            $body,
        );
        $this->assertStringContainsString("\r\n\r\n{$content}\r\n--", $body);
    }

    /**
     * @param array<string,mixed> $overrides
     *
     * @return array<string,mixed>
     */
    private static function validationResponse(array $overrides = []): array
    {
        return [
            'id' => 'val_123',
            'file_name' => null,
            'is_valid' => true,
            'issues' => [],
            'ubl_document' => '<Invoice/>',
            ...$overrides,
        ];
    }
}

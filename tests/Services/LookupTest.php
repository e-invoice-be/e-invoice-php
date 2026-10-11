<?php

namespace Tests\Services;

use EInvoiceAPI\Lookup\LookupGetParticipantsResponse;
use EInvoiceAPI\Lookup\LookupGetResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;

/**
 * @internal
 */
#[CoversNothing]
final class LookupTest extends ServiceTestCase
{
    #[Test]
    public function testRetrieve(): void
    {
        $this->http->queueJson(self::lookupResponse());

        $result = $this->client->lookup->retrieve(
            peppolID: 'peppol_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/lookup', ['peppol_id' => 'peppol_id']);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LookupGetResponse::class, $result);
        $this->assertSame('success', $result->status);
        $this->assertSame(123.4, $result->executionTimeMs);
        $this->assertSame([], $result->errors);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $this->http->queueJson(self::lookupResponse());

        $result = $this->client->lookup->retrieve(
            peppolID: 'peppol_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/lookup', ['peppol_id' => 'peppol_id']);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LookupGetResponse::class, $result);
        $this->assertSame('0208', $result->queryMetadata->identifierScheme);
        $this->assertSame('0123456789', $result->queryMetadata->identifierValue);
        $this->assertSame('Acme', $result->businessCard->entities[0]->name);
        $this->assertSame('BE', $result->businessCard->entities[0]->countryCode);
        $this->assertSame('valid', $result->certificates[0]->status);

        $endpoint = $result->serviceMetadata->endpoints[0];
        $this->assertSame('busdox-docid-qns', $endpoint->documentTypes[0]->scheme);
        $this->assertNotNull($endpoint->processes);
        $this->assertSame(
            'urn:fdc:peppol.eu:2017:poacc:billing:01:1.0',
            $endpoint->processes[0]->processID->value,
        );
        $this->assertSame(
            'https://ap.example.com/as4',
            $endpoint->processes[0]->endpoints[0]->address,
        );
    }

    #[Test]
    public function testRetrieveParticipants(): void
    {
        $this->http->queueJson(self::participantsResponse());

        $result = $this->client->lookup->retrieveParticipants(
            query: 'query',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/lookup/participants', ['query' => 'query']);
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LookupGetParticipantsResponse::class, $result);
        $this->assertSame('query', $result->queryTerms);
        $this->assertSame(1, $result->totalCount);
        $this->assertSame(1, $result->usedCount);
    }

    #[Test]
    public function testRetrieveParticipantsWithOptionalParams(): void
    {
        $this->http->queueJson(self::participantsResponse());

        $result = $this->client->lookup->retrieveParticipants(
            query: 'query',
            countryCode: 'country_code',
            requestOptions: $this->options(),
        );

        $this->assertRequest(
            'GET',
            '/api/lookup/participants',
            ['query' => 'query', 'country_code' => 'country_code'],
        );
        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LookupGetParticipantsResponse::class, $result);
        $this->assertNotNull($result->participants);
        $this->assertCount(1, $result->participants);

        $participant = $result->participants[0];
        $this->assertSame('0208:0123456789', $participant->peppolID);
        $this->assertSame('iso6523-actorid-upis', $participant->peppolScheme);
        $this->assertNotNull($participant->documentTypes);
        $this->assertSame('busdox-docid-qns', $participant->documentTypes[0]->scheme);
        $this->assertNotNull($participant->entities);
        $this->assertSame('Acme', $participant->entities[0]->name);
        $this->assertSame('BE', $participant->entities[0]->countryCode);
        $this->assertNotNull($participant->entities[0]->identifiers);
        $this->assertSame('BE0123456789', $participant->entities[0]->identifiers[0]->value);
    }

    #[Test]
    public function testRetrieveReturnsDNSLookupDetails(): void
    {
        $this->http->queueJson(self::lookupResponse());

        $result = $this->client->lookup->retrieve(
            peppolID: 'peppol_id',
            requestOptions: $this->options(),
        );

        $this->assertRequest('GET', '/api/lookup', ['peppol_id' => 'peppol_id']);
        $this->assertIsString($result->dnsInfo->lookupMethod);
        $this->assertIsString($result->dnsInfo->smpHostname);
        $this->assertSame('naptr', $result->dnsInfo->lookupMethod);
        $this->assertSame('smp.example.com', $result->dnsInfo->smpHostname);
        $this->assertSame('B-abc.iso6523-actorid-upis.edelivery.tech.ec.europa.eu', $result->dnsInfo->smlHostname);
        $this->assertSame('192.0.2.1', $result->dnsInfo->dnsRecords[0]->ip);
    }

    /**
     * @return array<string,mixed>
     */
    private static function lookupResponse(): array
    {
        return [
            'businessCard' => [
                'entities' => [
                    [
                        'additionalInformation' => ['Peppol participant'],
                        'countryCode' => 'BE',
                        'name' => 'Acme',
                        'registrationDate' => '2024-01-15',
                    ],
                ],
                'queryTimeMs' => 12.5,
                'status' => 'success',
                'error' => null,
            ],
            'certificates' => [
                ['status' => 'valid', 'details' => ['issuer' => 'PEPPOL ACCESS POINT CA - G2'], 'error' => null],
            ],
            'dnsInfo' => [
                'dnsRecords' => [['ip' => '192.0.2.1']],
                'smlHostname' => 'B-abc.iso6523-actorid-upis.edelivery.tech.ec.europa.eu',
                'status' => 'success',
                'error' => null,
                'lookupMethod' => 'naptr',
                'smpHostname' => 'smp.example.com',
            ],
            'errors' => [],
            'executionTimeMs' => 123.4,
            'queryMetadata' => [
                'identifierScheme' => '0208',
                'identifierValue' => '0123456789',
                'smlDomain' => 'edelivery.tech.ec.europa.eu',
                'timestamp' => '2026-10-11T10:00:00Z',
                'version' => '1.0.0',
            ],
            'serviceMetadata' => [
                'endpoints' => [
                    [
                        'documentTypes' => [
                            [
                                'scheme' => 'busdox-docid-qns',
                                'value' => 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2::Invoice',
                            ],
                        ],
                        'status' => 'success',
                        'url' => 'https://smp.example.com/iso6523-actorid-upis%3A%3A0208%3A0123456789',
                        'error' => null,
                        'processes' => [
                            [
                                'endpoints' => [
                                    [
                                        'address' => 'https://ap.example.com/as4',
                                        'transportProfile' => 'peppol-transport-as4-v2_0',
                                    ],
                                ],
                                'processId' => [
                                    'scheme' => 'cenbii-procid-ubl',
                                    'value' => 'urn:fdc:peppol.eu:2017:poacc:billing:01:1.0',
                                ],
                            ],
                        ],
                    ],
                ],
                'queryTimeMs' => 45.6,
                'status' => 'success',
                'error' => null,
            ],
            'status' => 'success',
        ];
    }

    /**
     * @return array<string,mixed>
     */
    private static function participantsResponse(): array
    {
        return [
            'query_terms' => 'query',
            'search_date' => '2026-10-11',
            'total_count' => 1,
            'used_count' => 1,
            'participants' => [
                [
                    'peppol_id' => '0208:0123456789',
                    'peppol_scheme' => 'iso6523-actorid-upis',
                    'document_types' => [
                        [
                            'scheme' => 'busdox-docid-qns',
                            'value' => 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2::Invoice',
                        ],
                    ],
                    'entities' => [
                        [
                            'name' => 'Acme',
                            'country_code' => 'BE',
                            'identifiers' => [['scheme' => 'VAT', 'value' => 'BE0123456789']],
                            'registration_date' => '2024-01-15',
                        ],
                    ],
                ],
            ],
        ];
    }
}

<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\CancelReportRequestsResponseParser;

class CancelReportRequestsResponseParserTest extends TestCase
{

    /** @test */
    public function it_can_get_result_accessor()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchCancelReportRequests.xml';
        $xmlString = file_get_contents($file);
        $xml = simplexml_load_string($xmlString);

        $resultAccessor = (new CancelReportRequestsResponseParser($xml) )->getResultAccessor();

        $this->assertEquals($resultAccessor, 'CancelReportRequestsResult');
    }

    /** @test */
    public function it_can_parse_report_request_count_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchCancelReportRequests.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals('a720f9d6-83e9-4684-bc35-065b41ed5ca4', $response->get('RequestId'));
        $this->assertEquals('1', $response['Count']);

        $reportRequestInfo = $response['ReportRequestInfo'];
        $this->assertEquals('2291326454', $reportRequestInfo['ReportRequestId']);
        $this->assertEquals('_GET_MERCHANT_LISTINGS_DATA_', $reportRequestInfo['ReportType']);
        $this->assertEquals('2009-01-21T02:10:39+00:00', $reportRequestInfo['StartDate']);
    }
}

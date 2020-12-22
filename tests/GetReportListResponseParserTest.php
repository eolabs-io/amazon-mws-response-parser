<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetReportListResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;

class GetReportListResponseParserTest extends TestCase
{

    /** @test */
    public function it_can_get_result_accessor()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetReportList.xml';
        $xmlString = file_get_contents($file);
        $xml = simplexml_load_string($xmlString);

        $resultAccessor = (new GetReportListResponseParser($xml) )->getResultAccessor();

        $this->assertEquals($resultAccessor, 'GetReportListResult');
    }

    /** @test */
    public function it_can_parse_order_list_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetReportList.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals('fbf677c1-dcee-4110-bc88-2ba3702e331b', $response->get('RequestId'));
        $this->assertEquals('true', $response->get('HasNext'));
        $this->assertEquals('2YgYW55IPQhvu5hbCBwbGVhc3VyZS4=', $response->get('NextToken'));

        $reportInfo = $response['ReportInfo'];

        $this->assertEquals('898899473', $reportInfo['ReportId']);
        $this->assertEquals('_GET_MERCHANT_LISTINGS_DATA_', $reportInfo['ReportType']);
        $this->assertEquals('2278662938', $reportInfo['ReportRequestId']);
        $this->assertEquals('2009-02-10T09:22:33+00:00', $reportInfo['AvailableDate']);
        $this->assertEquals('false', $reportInfo['Acknowledged']);
    }
}

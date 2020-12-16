<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use EolabsIo\AmazonMwsResponseParser\Parsers\RequestReportResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;

class RequestReportResponseParserTest extends TestCase
{

    /** @test */
    public function it_can_get_result_accessor()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchRequestReport.xml';
        $xmlString = file_get_contents($file);
        $xml = simplexml_load_string($xmlString);

        $resultAccessor = (new RequestReportResponseParser($xml) )->getResultAccessor();

        $this->assertEquals($resultAccessor, 'RequestReportResult');
    }

    /** @test */
    public function it_can_parse_order_list_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchRequestReport.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals($response->get('RequestId'), "88faca76-b600-46d2-b53c-0c8c4533e43a");
        $this->assertNull($response->get('NextToken'));

        $this->assertEquals($response['ReportRequestInfo']['ReportRequestId'], "2291326454");
        $this->assertEquals($response['ReportRequestInfo']['ReportType'], "_GET_MERCHANT_LISTINGS_DATA_");
        $this->assertEquals($response['ReportRequestInfo']['StartDate'], "2009-01-21T02:10:39+00:00");
        $this->assertEquals($response['ReportRequestInfo']['ReportProcessingStatus'], "_SUBMITTED_");
    }
}

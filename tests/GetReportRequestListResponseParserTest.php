<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetReportRequestListResponseParser;

class GetReportRequestListResponseParserTest extends TestCase
{

    /** @test */
    public function it_can_get_result_accessor()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetReportRequestList.xml';
        $xmlString = file_get_contents($file);
        $xml = simplexml_load_string($xmlString);

        $resultAccessor = (new GetReportRequestListResponseParser($xml) )->getResultAccessor();

        $this->assertEquals($resultAccessor, 'GetReportRequestListResult');
    }

    /** @test */
    public function it_can_parse_order_list_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetReportRequestList.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals('732480cb-84a8-4c15-9084-a46bd9a0889b', $response->get('RequestId'));
        $this->assertEquals('true', $response->get('HasNext'));
        $this->assertEquals('2YgYW55IPQhcm5hbCBwbGVhc3VyZS4=', $response->get('NextToken'));

        $reportRequestInfo = $response['ReportRequestInfo'];

        $this->assertEquals('2291326454', $reportRequestInfo['ReportRequestId']);
        $this->assertEquals('_GET_MERCHANT_LISTINGS_DATA_', $reportRequestInfo['ReportType']);
        $this->assertEquals('2011-01-21T02:10:39+00:00', $reportRequestInfo['StartDate']);
        $this->assertEquals('2011-02-13T02:10:39+00:00', $reportRequestInfo['EndDate']);
        $this->assertEquals('false', $reportRequestInfo['Scheduled']);
        $this->assertEquals('2011-02-17T23:44:09+00:00', $reportRequestInfo['SubmittedDate']);
        $this->assertEquals('_DONE_', $reportRequestInfo['ReportProcessingStatus']);

        $this->assertEquals('3538561173', $reportRequestInfo['GeneratedReportId']);
        $this->assertEquals('2011-02-17T23:44:43+00:00', $reportRequestInfo['StartedProcessingDate']);
        $this->assertEquals('2011-02-17T23:44:48+00:00', $reportRequestInfo['CompletedDate']);
    }
}

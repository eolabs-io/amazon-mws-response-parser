<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetReportRequestListByNextTokenResponseParser;

class GetReportRequestListByNextTokenResponseParserTest extends TestCase
{

    /** @test */
    public function it_can_get_result_accessor()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetReportRequestListByNextToken.xml';
        $xmlString = file_get_contents($file);
        $xml = simplexml_load_string($xmlString);

        $resultAccessor = (new GetReportRequestListByNextTokenResponseParser($xml) )->getResultAccessor();

        $this->assertEquals($resultAccessor, 'GetReportRequestListByNextTokenResult');
    }

    /** @test */
    public function it_can_parse_order_list_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetReportRequestListByNextToken.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals('732480cb-84a8-4c15-9084-a46bd9a0889b', $response->get('RequestId'));
        $this->assertEquals('false', $response->get('HasNext'));
        $this->assertEquals('none', $response->get('NextToken'));

        $reportRequestInfo = $response['ReportRequestInfo'];

        $this->assertEquals('2291326454', $reportRequestInfo['ReportRequestId']);
        $this->assertEquals('_GET_MERCHANT_LISTINGS_DATA_', $reportRequestInfo['ReportType']);
        $this->assertEquals('2009-01-21T02:10:39+00:00', $reportRequestInfo['StartDate']);
        $this->assertEquals('2009-02-13T02:10:39+00:00', $reportRequestInfo['EndDate']);
        $this->assertEquals('false', $reportRequestInfo['Scheduled']);
        $this->assertEquals('2009-02-20T02:10:39+00:00', $reportRequestInfo['SubmittedDate']);
        $this->assertEquals('_SUBMITTED_', $reportRequestInfo['ReportProcessingStatus']);
    }
}

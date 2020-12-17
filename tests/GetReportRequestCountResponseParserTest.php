<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetReportRequestCountResponseParser;

class GetReportRequestCountResponseParserTest extends TestCase
{

    /** @test */
    public function it_can_get_result_accessor()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetReportRequestCount.xml';
        $xmlString = file_get_contents($file);
        $xml = simplexml_load_string($xmlString);

        $resultAccessor = (new GetReportRequestCountResponseParser($xml) )->getResultAccessor();

        $this->assertEquals($resultAccessor, 'GetReportRequestCountResult');
    }

    /** @test */
    public function it_can_parse_report_request_count_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetReportRequestCount.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals('7e155027-3741-4422-95a7-1de12703c13e', $response->get('RequestId'));
        $this->assertEquals('1276', $response['Count']);
    }
}

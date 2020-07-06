<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListFinancialEventsByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;

class ListFinancialEventsByNextTokenResponseParserTest extends TestCase
{
	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListFinancialEventsToken2.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListFinancialEventsByNextTokenResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListFinancialEventsByNextTokenResult');	
	}
	
    /** @test */
	public function it_can_parse_list_financial_events_by_next_token_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListFinancialEventsToken2.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "c07d1dd2-12f9-415f-a167-8ab5f7726dbf");
		$this->assertEquals($response['FinancialEvents']['SellerDealPaymentEventList'][0]['PostedDate'], "2016-11-21T16:18:15.000Z");
		$this->assertNull($response->get('NextToken'));
	}

}
<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListOrderItemsByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;


class ListOrderItemsByNextTokenResponseParserTest extends TestCase
{
	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrderItemsToken2.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListOrderItemsByNextTokenResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListOrderItemsByNextTokenResult');	
	}
	
    /** @test */
	public function it_can_parse_list_orders_by_next_token_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrderItemsToken2.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "88faca76-b600-46d2-b53c-0c8c4533e43a");
		$this->assertEquals($response['OrderItems'][0]['ASIN'], "BCTU1104UEFB");
		$this->assertEquals($response['OrderItems'][0]['OrderItemId'], "79039765272157");
		$this->assertNull($response->get('NextToken'));
	}

}
<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListOrderItemsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use SimpleXMLElement;


class ListOrderItemsResponseParserTest extends TestCase
{

	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrderItems.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListOrderItemsResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListOrderItemsResult');	
	}

	/** @test */
	public function it_can_parse_order_item_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrderItems.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "88faca76-b600-46d2-b53c-0c8c4533e43a");

		$this->assertEquals($response['OrderItems'][0]['ASIN'], "BT0093TELA");
		$this->assertEquals($response['OrderItems'][0]['OrderItemId'], "68828574383266");

		$this->assertEquals($response['OrderItems'][1]['ASIN'], "BCTU1104UEFB");
		$this->assertEquals($response['OrderItems'][1]['OrderItemId'], "79039765272157");
		
		$this->assertEquals($response['OrderItems'][1]['PromotionIds'][0], "US Core Free Shipping Promotion A3JU1FCINF5SD0");
	}	

}
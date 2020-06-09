<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListOrdersResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use SimpleXMLElement;


class ListOrdersResponseParserTest extends TestCase
{

	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrders.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListOrdersResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListOrdersResult');	
	}

	/** @test */
	public function it_can_parse_list_inventory_supply_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrders.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "88faca76-b600-46d2-b53c-0c8c4533e43a");
    	$this->assertEquals($response->get('NextToken'), "2YgYW55IGNhcm5hbCBwbGVhc3VyZS4=");

		$this->assertEquals($response['Orders']['Order'][0]['AmazonOrderId'], "902-3159896-1390916");
		$this->assertEquals($response['Orders']['Order'][0]['LastUpdateDate'], "2017-02-20T19:49:35Z");

		$this->assertEquals($response['Orders']['Order'][1]['AmazonOrderId'], "483-3488972-0896720");
		$this->assertEquals($response['Orders']['Order'][1]['OrderStatus'], "Unshipped");
	}	

}
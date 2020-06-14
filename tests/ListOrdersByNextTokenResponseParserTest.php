<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListOrdersByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;


class ListOrdersByNextTokenResponseParserTest extends TestCase
{
	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrdersToken2.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListOrdersByNextTokenResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListOrdersByNextTokenResult');	
	}
	
    /** @test */
	public function it_can_parse_list_orders_by_next_token_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrdersToken2.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "88faca76-b600-46d2-b53c-0c8c4533e43a");
		$this->assertEquals($response['Orders'][0]['AmazonOrderId'], "902-3159896-1390916");
		$this->assertEquals($response['Orders'][0]['PaymentMethodDetails'][0], "CreditCard");
		$this->assertEquals($response['Orders'][0]['PaymentMethodDetails'][1], "GiftCerificate");
		$this->assertNull($response->get('NextToken'));
	}

}
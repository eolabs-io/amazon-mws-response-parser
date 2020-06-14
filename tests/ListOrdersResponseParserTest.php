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
	public function it_can_parse_order_list_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrders.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "88faca76-b600-46d2-b53c-0c8c4533e43a");
    	$this->assertEquals($response->get('NextToken'), "2YgYW55IGNhcm5hbCBwbGVhc3VyZS4=");

		$this->assertEquals($response['Orders'][0]['AmazonOrderId'], "902-3159896-1390916");
		$this->assertEquals($response['Orders'][0]['LastUpdateDate'], "2017-02-20T19:49:35Z");

		$this->assertEquals($response['Orders'][1]['AmazonOrderId'], "483-3488972-0896720");
		$this->assertEquals($response['Orders'][1]['OrderStatus'], "Unshipped");
	}	

	/** @test */
	public function it_can_parse_order_list_removes_elements_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListOrders.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	// It removes the child label 'Order'
		$this->assertEquals($response['Orders'][0]['AmazonOrderId'], "902-3159896-1390916");
		$this->assertEquals($response['Orders'][0]['LastUpdateDate'], "2017-02-20T19:49:35Z");
		$this->assertEquals($response['Orders'][1]['AmazonOrderId'], "483-3488972-0896720");
		$this->assertEquals($response['Orders'][1]['OrderStatus'], "Unshipped");

    	// It removes the child label 'PaymentExecutionDetailItem'
		$this->assertEquals($response['Orders'][2]['PaymentExecutionDetail'][1]['PaymentMethod'], "GC");
		$this->assertEquals($response['Orders'][2]['PaymentExecutionDetail'][1]['Payment']['Amount'], "317.00");
		$this->assertEquals($response['Orders'][3]['PaymentExecutionDetail'][0]['PaymentMethod'], "PointsAccount");
		$this->assertEquals($response['Orders'][3]['PaymentExecutionDetail'][0]['Payment']['Amount'], "10.00");

		// It removes the child label 'TaxClassification'
		$this->assertEquals($response['Orders'][0]['BuyerTaxInfo']['TaxClassifications'][0]['Name'], "VATNumber");
		$this->assertEquals($response['Orders'][0]['BuyerTaxInfo']['TaxClassifications'][0]['Value'], "XXX123");
		$this->assertEquals($response['Orders'][0]['BuyerTaxInfo']['TaxClassifications'][1]['Name'], "VATNumber");
		$this->assertEquals($response['Orders'][0]['BuyerTaxInfo']['TaxClassifications'][1]['Value'], "XXX456");

		// PaymentMethodDetail|final
		$this->assertEquals($response['Orders'][1]['PaymentMethodDetails'][0], "CreditCard");

	}

}
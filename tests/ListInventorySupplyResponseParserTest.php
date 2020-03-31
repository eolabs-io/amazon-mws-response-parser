<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListInventorySupplyResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use SimpleXMLElement;


class ListInventorySupplyResponseParserTest extends TestCase
{

	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchInventoryList.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListInventorySupplyResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListInventorySupplyResult');	
	}

	/** @test */
	public function it_can_parse_list_inventory_supply_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchInventoryList.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "e8698ffa-8e59-11df-9acb-230ae7a8b736");
		$this->assertEquals($response['InventorySupplyList'][0]['SellerSKU'], "SampleSKU1");
		$this->assertEquals($response['InventorySupplyList'][0]['SupplyDetail'][0]['SupplyType'], "Normal");
		$this->assertEquals($response['InventorySupplyList'][1]['SellerSKU'], "SampleSKU2");
		$this->assertEquals($response['InventorySupplyList'][1]['SupplyDetail'], []);		
		$this->assertNull($response->get('NextToken'));
	}	
    
    /** @test */
	public function it_can_parse_list_inventory_supply_with_token_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchInventoryListToken.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "e8698ffa-8e59-11df-9acb-230ae7a8b736");
		$this->assertEquals($response['InventorySupplyList'][0]['SellerSKU'], "SampleSKU1");
		$this->assertEquals($response->get('NextToken'), 'Token!');
	}

}
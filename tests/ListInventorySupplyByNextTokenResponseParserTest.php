<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;


class ListInventorySupplyByNextTokenResponseParserTest extends TestCase
{
    
    /** @test */
	public function it_can_parse_list_inventory_supply_by_next_token_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchInventoryListToken2.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "e8698ffa-8e59-11df-9acb-230ae7a8b736");
		$this->assertEquals($response['InventorySupplyList'][0]['SellerSKU'], "SampleSKU2");
		$this->assertNull($response->get('NextToken'));
	}

}
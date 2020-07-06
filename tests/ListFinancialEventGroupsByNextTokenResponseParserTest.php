<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListFinancialEventGroupsByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;

class ListFinancialEventGroupsByNextTokenResponseParserTest extends TestCase
{
	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListFinancialEventGroupsToken2.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListFinancialEventGroupsByNextTokenResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListFinancialEventGroupsByNextTokenResult');	
	}
	
    /** @test */
	public function it_can_parse_list_inventory_supply_by_next_token_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListFinancialEventGroupsToken2.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "1105b931-6f1c-4480-8e97-f3b46EXAMPLE");
		$this->assertEquals($response['FinancialEventGroupList'][0]['FinancialEventGroupId'], "22YgYW55IGNhcm5hbCBwbGVhEXAMPLE");
		$this->assertNull($response->get('NextToken'));
	}

}
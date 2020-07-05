<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListFinancialEventGroupsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use SimpleXMLElement;


class ListFinancialEventGroupsResponseParserTest extends TestCase
{

	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListFinancialEventGroups.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListFinancialEventGroupsResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListFinancialEventGroupsResult');	
	}

	/** @test */
	public function it_can_parse_order_list_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListFinancialEventGroups.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "1105b931-6f1c-4480-8e97-f3b46EXAMPLE");
    	$this->assertEquals($response->get('NextToken'), "2YgYW55IGNhcm5hbCBwbGVhcEXAMPLE");

		$this->assertEquals($response['FinancialEventGroupList'][0]['FinancialEventGroupId'], "22YgYW55IGNhcm5hbCBwbGVhEXAMPLE");
		$this->assertEquals($response['FinancialEventGroupList'][0]['ProcessingStatus'], "Closed");
	}	
	
}
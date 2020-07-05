<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListFinancialEventsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use SimpleXMLElement;


class ListFinancialEventsResponseParserTest extends TestCase
{

	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListFinancialEvents.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListFinancialEventsResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListFinancialEventsResult');	
	}

	/** @test */
	public function it_can_parse_order_list_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListFinancialEvents.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "6a2929e5-5c77-470e-ad71-36f30bfaffcc");
    	$this->assertEquals($response->get('NextToken'), "e21hcmtldHBsYWNlSWQ6b");

		$this->assertEquals($response['FinancialEvents']['SellerDealPaymentEventList'][0]['DealDescription'], "test fees");
		$this->assertEquals($response['FinancialEvents']['ProductAdsPaymentEventList'][0]['transactionType'], "Charge");
	}	
	
}
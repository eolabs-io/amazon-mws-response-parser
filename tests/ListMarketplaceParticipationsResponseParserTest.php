<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListMarketplaceParticipationsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use SimpleXMLElement;


class ListMarketplaceParticipationsResponseParserTest extends TestCase
{

	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListMarketplaceParticipations.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new ListMarketplaceParticipationsResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'ListMarketplaceParticipationsResult');	
	}

	/** @test */
	public function it_can_parse_list_marketplace_participations_response_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchListMarketplaceParticipations.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "efeab958-74e2-45d4-9018-2323084413b5");

    	$listParticipation = $response['ListParticipations'][0];
		$this->assertEquals($listParticipation['MarketplaceId'], "ATVPDKIKX0DER");
		$this->assertEquals($listParticipation['SellerId'], "A135KKEKJAIBJ56");
		$this->assertEquals($listParticipation['HasSellerSuspendedListings'], 'No');

    	$listMarketplace = $response['ListMarketplaces'][0];
		$this->assertEquals($listMarketplace['MarketplaceId'], "ATVPDKIKX0DER");
		$this->assertEquals($listMarketplace['Name'], "Amazon.com");
		$this->assertEquals($listMarketplace['DefaultCountryCode'], 'US');
		$this->assertEquals($listMarketplace['DefaultCurrencyCode'], 'USD');
		$this->assertEquals($listMarketplace['DefaultLanguageCode'], 'en_US');
		$this->assertEquals($listMarketplace['DomainName'], 'www.amazon.com');
	}	
	
}
<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Parsers\GetMatchingProductResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use SimpleXMLElement;


class GetMatchingProductResponseParserTest extends TestCase
{

	/** @test */
	public function it_can_get_result_accessor()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchGetMatchingProduct.xml';
    	$xmlString = file_get_contents($file);
		$xml = simplexml_load_string($xmlString);

		$resultAccessor = (new GetMatchingProductResponseParser($xml) )->getResultAccessor();

		$this->assertEquals($resultAccessor, 'GetMatchingProductResult');	
	}

	/** @test */
	public function it_can_parse_get_matching_product_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchGetMatchingProduct.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "b12caada-d330-4d87-a789-EXAMPLE35872");
		$this->assertEquals($response['Product']['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XRQ");
		$this->assertEquals($response['Product']['AttributeSets']['ItemAttributes'][4], "86 percent nylon, 14% spandex, 9-Inch inseam");
		$this->assertEquals($response['Product']['Relationships']['VariationChild'][0]['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XQC");
		$this->assertEquals($response['Product']['SalesRankings']['SalesRank'][1]['ProductCategoryId'], "2420095011");
	}	
	
}
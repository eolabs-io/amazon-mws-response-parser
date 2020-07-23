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

    	$product = $response['Products'][0]['Product'];
		$this->assertEquals($product['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XRQ");
		$this->assertEquals($product['AttributeSets']['ItemAttributes']['Feature'][4], "86 percent nylon, 14% spandex, 9-Inch inseam");
		$this->assertEquals($product['AttributeSets']['ItemAttributes']['Binding'], 'Apparel');
		$this->assertEquals($product['Relationships']['VariationChild'][0]['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XQC");
		$this->assertEquals($product['SalesRankings']['SalesRank'][1]['ProductCategoryId'], "2420095011");

		$this->assertEquals($response['Products'][0]['@attributes']['ASIN'], "B002KT3XRQ");
	}	
	
	/** @test */
	public function it_can_parse_get_matching_products_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchGetMatchingProducts.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "b12caada-d330-4d87-a789-EXAMPLE35872");

    	$product0 = $response['Products'][0]['Product'];
    	$product1 = $response['Products'][1]['Product'];
		$this->assertEquals($product0['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XRQ");
		$this->assertEquals($product0['AttributeSets']['ItemAttributes']['Feature'][4], "86 percent nylon, 14% spandex, 9-Inch inseam");
		$this->assertEquals($product0['Relationships']['VariationChild'][0]['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XQC");
		$this->assertEquals($product0['SalesRankings']['SalesRank'][1]['ProductCategoryId'], "2420095011");
		
		$this->assertEquals($response['Products'][0]['@attributes']['ASIN'], "B002KT3XRQ");

		$this->assertEquals($product1['Identifiers']['MarketplaceASIN']['ASIN'], "B007WP3DER");
		$this->assertEquals($product1['AttributeSets']['ItemAttributes']['Feature'][0], "Select transfer fabric sets the benchmark for moisture transfer and four-way performance stretch");
		$this->assertEquals($product1['Relationships']['VariationChild'][1]['Identifiers']['MarketplaceASIN']['ASIN'], "B002KT3XQW");
		$this->assertEquals($product1['SalesRankings']['SalesRank'][1]['ProductCategoryId'], "2420095011");
		
		$this->assertEquals($response['Products'][1]['@attributes']['ASIN'], "B007WP3DER");
	}
}
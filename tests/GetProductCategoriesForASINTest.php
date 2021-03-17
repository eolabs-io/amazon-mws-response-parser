<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetProductCategoriesForASINResponseParser;

class GetProductCategoriesForASINTest extends TestCase
{

    /** @test */
    public function it_can_get_result_accessor()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetProductCategoriesForASIN.xml';
        $xmlString = file_get_contents($file);
        $xml = simplexml_load_string($xmlString);

        $resultAccessor = (new GetProductCategoriesForASINResponseParser($xml) )->getResultAccessor();

        $this->assertEquals($resultAccessor, 'GetProductCategoriesForASINResult');
    }

    /** @test */
    public function it_can_parse_product_categories_for_asin_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetProductCategoriesForASIN.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals('fbce5b62-67cc-4ab8-86f3-EXAMPLE22e4e', $response->get('RequestId'));
        $this->assertNull($response->get('NextToken'));

        $categories = $response['Self'];

        $this->assertEquals(2420095011, $categories['ProductCategoryId']);
        $this->assertEquals('Compression Shorts', $categories['ProductCategoryName']);
        $this->assertCount(3, $categories['Parent']);
    }
}

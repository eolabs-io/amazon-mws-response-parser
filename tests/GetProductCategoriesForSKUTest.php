<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetProductCategoriesForSKUResponseParser;

class GetProductCategoriesForSKUTest extends TestCase
{

    /** @test */
    public function it_can_get_result_accessor()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetProductCategoriesForSKU.xml';
        $xmlString = file_get_contents($file);
        $xml = simplexml_load_string($xmlString);

        $resultAccessor = (new GetProductCategoriesForSKUResponseParser($xml) )->getResultAccessor();

        $this->assertEquals($resultAccessor, 'GetProductCategoriesForSKUResult');
    }

    /** @test */
    public function it_can_parse_product_categories_for_sku_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetProductCategoriesForSKU.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals('e058aabd-b4c3-48ba-9bfa-EXAMPLE9a267', $response->get('RequestId'));
        $this->assertNull($response->get('NextToken'));

        $skuCategories = $response['Self'];
        $this->assertCount(2, $skuCategories);

        $categories = $skuCategories[0];

        $this->assertEquals(271578011, $categories['ProductCategoryId']);
        $this->assertEquals('Project Management', $categories['ProductCategoryName']);
        $this->assertCount(3, $categories['Parent']);
    }

    /** @test */
    public function it_can_parse_product_categories_for_sku_single_response()
    {
        $file = __DIR__ . '/Stubs/Responses/fetchGetProductCategoriesForSKUSingle.xml';
        $xmlString = file_get_contents($file);

        $response = AmazonMwsResponseParser::fromString($xmlString);

        $this->assertEquals('e058aabd-b4c3-48ba-9bfa-EXAMPLE9a267', $response->get('RequestId'));
        $this->assertNull($response->get('NextToken'));

        $skuCategories = $response['Self'];
        $this->assertCount(1, $skuCategories);

        $categories = $skuCategories[0];

        $this->assertEquals(271578011, $categories['ProductCategoryId']);
        $this->assertEquals('Project Management', $categories['ProductCategoryName']);
        $this->assertCount(3, $categories['Parent']);
    }
}

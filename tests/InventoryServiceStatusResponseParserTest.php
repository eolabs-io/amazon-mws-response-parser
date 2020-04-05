<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;


class InventoryServiceStatusResponseParserTest extends TestCase
{
	
    /** @test */
	public function it_can_parse_inventory_service_status_response()
	{
        $file = __DIR__ . '/Stubs/Responses/fetchGetServiceStatus.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "d80c6c7b-f7c7-4fa7-bdd7-854711cb3bcc");
		$this->assertEquals($response['GetServiceStatusResult']['Status'], "GREEN");
		$this->assertEquals($response['GetServiceStatusResult']['Timestamp'], "2010-11-01T21:38:09.676Z");
	}

}
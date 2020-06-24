<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;


class ErrorResponseParserTest extends TestCase
{
	
    /** @test */
	public function it_can_parse_error_response()
	{
        $file = __DIR__ . '/Stubs/Responses/ErrorResponse.xml';
    	$xmlString = file_get_contents($file);

    	$response = AmazonMwsResponseParser::fromString($xmlString);

    	$this->assertEquals($response->get('RequestId'), "b7afc6c3-6f75-4707-bcf4-0475ad23162c");
		$this->assertEquals($response['Error']['Type'], "Sender");
		$this->assertEquals($response['Error']['Code'], "InvalidParameterValue");
		$this->assertEquals($response['Error']['Message'], "The input you have submitted is not valid. Please check your input and try again.");
	}

}
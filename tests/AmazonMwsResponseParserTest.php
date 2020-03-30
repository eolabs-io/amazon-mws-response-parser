<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsResponseParser\Exceptions\AmazonMwsResponseParserException;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Tests\TestCase;
use SimpleXMLElement;

class AmazonMwsResponseParserTest extends TestCase
{

	/** @test */
	public function it_throws_an_exception_if_an_invalid_response_type_is_provided()
	{
		$this->expectException(AmazonMwsResponseParserException::class);

        $file = __DIR__ . '/Stubs/Responses/fetchUnsupportedResponse.xml';
    	$xmlString = file_get_contents($file);

    	$parameters = AmazonMwsResponseParser::fromString($xmlString);
	}	

}
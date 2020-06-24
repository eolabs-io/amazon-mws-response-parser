<?php

namespace EolabsIo\AmazonMwsResponseParser;

use EolabsIo\AmazonMwsResponseParser\Exceptions\AmazonMwsResponseParserException;
use EolabsIo\AmazonMwsResponseParser\Parsers\ErrorResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetServiceStatusResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListInventorySupplyByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListInventorySupplyResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListOrderItemsByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListOrderItemsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListOrdersByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListOrdersResponseParser;
use EolabsIo\AmazonMwsResponseParser\Support\XMLParser;
use Illuminate\Support\Collection;
use SimpleXMLElement;

class AmazonMwsResponseParser extends XMLParser
{

	public function getParsers(): array
	{
		return [
			'ListInventorySupplyResponse' => ListInventorySupplyResponseParser::class,
			'ListInventorySupplyByNextTokenResponse' => ListInventorySupplyByNextTokenResponseParser::class,
			'GetServiceStatusResponse' => GetServiceStatusResponseParser::class,
			'ListOrdersResponse' => ListOrdersResponseParser::class,
			'ListOrdersByNextTokenResponse' => ListOrdersByNextTokenResponseParser::class,
			'ListOrderItemsResponse' => ListOrderItemsResponseParser::class,
			'ListOrderItemsByNextTokenResponse' => ListOrderItemsByNextTokenResponseParser::class,
			'ErrorResponse' => ErrorResponseParser::class,
		];
	}


}

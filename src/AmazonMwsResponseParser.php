<?php

namespace EolabsIo\AmazonMwsResponseParser;

use EolabsIo\AmazonMwsResponseParser\Exceptions\AmazonMwsResponseParserException;
use EolabsIo\AmazonMwsResponseParser\Parsers\ErrorResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetMatchingProductResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\GetServiceStatusResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListFinancialEventGroupsByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListFinancialEventGroupsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListFinancialEventsByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListFinancialEventsResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListInventorySupplyByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListInventorySupplyResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListMarketplaceParticipationsByNextTokenResponseParser;
use EolabsIo\AmazonMwsResponseParser\Parsers\ListMarketplaceParticipationsResponseParser;
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
			'ListFinancialEventGroupsResponse' => ListFinancialEventGroupsResponseParser::class,
			'ListFinancialEventGroupsByNextTokenResponse' => ListFinancialEventGroupsByNextTokenResponseParser::class,
			'ListFinancialEventsResponse' => ListFinancialEventsResponseParser::class,
			'ListFinancialEventsByNextTokenResponse' => ListFinancialEventsByNextTokenResponseParser::class,
			'GetMatchingProductResponse' => GetMatchingProductResponseParser::class,
			'ListMarketplaceParticipationsResponse' => ListMarketplaceParticipationsResponseParser::class,
			'ListMarketplaceParticipationsByNextTokenResponse' => ListMarketplaceParticipationsByNextTokenResponseParser::class,
			'ErrorResponse' => ErrorResponseParser::class,
		];
	}


}

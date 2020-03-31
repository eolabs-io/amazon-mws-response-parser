<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class ListInventorySupplyResponseParser extends BaseParser
{

	public function getContentAccessor(): string
	{
		return 'InventorySupplyList';
	}

}
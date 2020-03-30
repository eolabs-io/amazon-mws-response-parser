<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\ListInventorySupplyResponseParser;


class ListInventorySupplyByNextTokenResponseParser extends ListInventorySupplyResponseParser
{

	public function getResponseResult()
	{
		return $this->getElement('ListInventorySupplyByNextTokenResult');
	}

}
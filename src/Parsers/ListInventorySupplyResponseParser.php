<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Collection;

class ListInventorySupplyResponseParser extends BaseParser
{

	public function handle(): Collection
	{
		return collect(['RequestId' => $this->getRequestId(),
						'InventorySupplyList' => $this->getInventorySupplyList(),
						'NextToken' => $this->getNextToken(),
						]);
	}

	public function getResponseResult()
	{
		return $this->getElement('ListInventorySupplyResult');
	}

	public function getInventorySupplyList()
	{
		return $this->getElement('InventorySupplyList', $this->getResponseResult());
	}

}
<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Collection;

class ListFinancialEventGroupsResponseParser extends BaseParser
{

	public function getElementsToRemove(): Collection
	{
		$element = parent::getElementsToRemove();

		return $element->merge(['FinancialEventGroup',]);
	}

	public function getContentAccessor(): string
	{
		return 'FinancialEventGroupList';
	}

}
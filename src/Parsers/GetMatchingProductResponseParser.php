<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Collection;
use SimpleXMLElement;

class GetMatchingProductResponseParser extends BaseParser
{

	public function getElementsToRemove(): Collection
	{
		$element = parent::getElementsToRemove();

		return $element->merge(['Feature|final', ]);
	}

	public function getContentAccessor(): string
	{
		return 'Product';
	}

}
<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use SimpleXMLElement;


class ListMarketplaceParticipationsResponseParser extends BaseParser
{

	public function getElementsToRemove(): Collection
	{
		$element = parent::getElementsToRemove();

		return $element->merge(['Participation', 'Marketplace',]);
	}

	public function getContentAccessor(): string
	{
		return '';
	}

	public function handle(): Collection
	{
		return collect(['RequestId' => $this->getRequestId()])
					->merge($this->getResponseResult());
	}



}
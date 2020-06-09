<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Collection;

class ListOrdersResponseParser extends BaseParser
{

	public function getContentAccessor(): string
	{
		return 'Orders';
	}

	public function getLastUpdatedBefore(): ?string
	{
		return $this->getElement('LastUpdatedBefore', $this->getResponseResult());
	}

	public function handle(): Collection
	{
		$parsedResponse = parent::handle();

		return $parsedResponse->merge(['LastUpdatedBefore' => $this->getLastUpdatedBefore()]);
	}

}
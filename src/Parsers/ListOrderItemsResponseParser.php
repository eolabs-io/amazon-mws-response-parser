<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Collection;

class ListOrderItemsResponseParser extends BaseParser
{

	public function getElementsToRemove(): Collection
	{
		$element = parent::getElementsToRemove();

		return $element->merge(['OrderItem', 
								'PromotionId|final', ]);
	}

	public function getContentAccessor(): string
	{
		return 'OrderItems';
	}

	public function getAmazonOrderId(): ?string
	{
		return $this->getElement('AmazonOrderId', $this->getResponseResult());
	}

	public function handle(): Collection
	{
		$parsedResponse = parent::handle();

		return $parsedResponse->merge(['AmazonOrderId' => $this->getAmazonOrderId()]);
	}

}
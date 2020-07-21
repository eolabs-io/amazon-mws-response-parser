<?php declare(strict_types=1);

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Arr;
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
		return 'GetMatchingProduct';
	}

	public function handle(): Collection
	{
		$responseResult = ($this->shouldWrapInArray()) 
							? [$this->getResponseResult()] 
							: $this->getResponseResult();

		return collect(['RequestId' => $this->getRequestId(),
						'Products' => $responseResult,
						]);
	}

	public function shouldWrapInArray(): bool
	{
		$xml = $this->getData();
		return $xml->GetMatchingProductResult->count() == 1;
	}


}
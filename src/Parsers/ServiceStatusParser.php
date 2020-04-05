<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Collection;

abstract class ServiceStatusParser extends BaseParser
{
	public function handle(): Collection
	{
		return collect(['RequestId' => $this->getRequestId(),
						'GetServiceStatusResult' => $this->getResponseResult(),
						]);
	}

	public function getContentAccessor(): string
	{
		// return 'GetServiceStatusResult';
	}
}
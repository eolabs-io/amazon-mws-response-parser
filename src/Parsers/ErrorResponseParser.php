<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class ErrorResponseParser extends BaseParser
{

	public function getContentAccessor(): string
	{
		return 'Error';
	}

	public function getRequestId(): ?string
	{
		return $this->getElement('RequestID');
	}

}
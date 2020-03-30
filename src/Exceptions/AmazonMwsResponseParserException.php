<?php

namespace EolabsIo\AmazonMwsResponseParser\Exceptions;

use Exception;


class AmazonMwsResponseParserException extends Exception
{
	public function __construct() {
		parent::__construct('The Amazon Response provided is not supported with this Parser');
	}
}
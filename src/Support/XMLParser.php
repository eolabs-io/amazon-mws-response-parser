<?php

namespace EolabsIo\AmazonMwsResponseParser\Support;

use EolabsIo\AmazonMwsResponseParser\Contracts\Parser;
use EolabsIo\AmazonMwsResponseParser\Exceptions\AmazonMwsResponseParserException;
use Illuminate\Support\Collection;
use SimpleXMLElement;

abstract class XMLParser implements Parser
{
	/** @var SimpleXMLElement */
	private $xml;


	public function fromString(string $xml): Collection
	{
		return $this->fromXml(simplexml_load_string($xml));
	}

	public function fromXml(SimpleXMLElement $xml): Collection
	{
		return $this->setXml($xml)
					->parse();
	}

	private function parse(): Collection
	{
		$xml = $this->getXml();
		$responseType = $xml->getName();
		$parsers = $this->getParsers();
		$responseParser = data_get($parsers, $responseType);

		throw_if(! filled($responseParser), AmazonMwsResponseParserException::class);

		return (new $responseParser($xml))->handle();
	}

	abstract public function getParsers(): array;

	private function setXml(SimpleXMLElement $xml)
	{
		$this->xml = $xml;

		return $this;
	}

	private function getXml(): SimpleXMLElement
	{	
		return $this->xml;
	}

}

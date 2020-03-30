<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use Illuminate\Support\Collection;
use SimpleXMLElement;

abstract class BaseParser
{
	/** @var array */
	private $data;

	/** @var array */
	private $parsedData;


	public function __construct(SimpleXMLElement $xml)
	{
		$this->setData($xml)
			 ->parse();
	}

	public function parse()
	{
		$xml = $this->getData();
    	$xmlArray = json_decode(json_encode($xml));
    	$this->setParsedData($this->recurseResolve($xmlArray));
	}

//=================
	public function recurseResolve($data, $array = []) 
	{
		foreach($data as $key => $value){
			if($key == 'member'){
				$array = array_merge($array, $this->removeMember($value));
			}else{
				$array[$key] = $this->resolve($value);
			}
		}

		return $array;
	}

	public function resolve($value)
	{
		return (is_array($value) || is_object($value))
				 ? $this->recurseResolve($value)
				 : $value;
	}

	public function removeMember($value)
	{
		return (is_object($value)) ? [$this->recurseResolve($value)] : $this->recurseResolve($value);
	}
//=================

	abstract public function handle(): Collection;

	abstract public function getResponseResult();

	public function getNextToken(): ?string
	{
		return $this->getElement('NextToken', $this->getResponseResult());
	}

	public function getResponseMetadata()
	{
		return $this->getElement('ResponseMetadata');
	}

	public function getRequestId(): string
	{
		return $this->getElement('RequestId', $this->getResponseMetadata());
	}

	public function getElement($key, $data = null)
	{
		$data = $data ?? $this->getParsedData();
		return data_get($data, $key);
	}

	public function setData(SimpleXMLElement $data): self
	{
		$this->data = $data;

		return $this;
	}

	public function getData(): SimpleXMLElement
	{	
		return $this->data;
	}

	public function setParsedData($data): self
	{
		$this->parsedData = $data;

		return $this;
	}

	public function getParsedData()
	{	
		return $this->parsedData;
	}

}
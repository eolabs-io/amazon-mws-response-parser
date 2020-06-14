<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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

	public function getElementsToRemove(): Collection
	{
		return collect(['member']);
	}

	public function recurseResolve($data, $array = []) 
	{
		$elementsToRemove = $this->getElementsToRemove();

		foreach($data as $key => $value){

			if($elementsToRemove->contains($key."|final")) {
				return is_array($value) ? $value : [$value];
			}
			
			if($elementsToRemove->contains($key)) {
				$array = array_merge($array, $this->removeElement($value));
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

	public function removeElement($value)
	{		
		return (is_object($value)) ? [$this->recurseResolve($value)] : $this->recurseResolve($value);
	}
//=================

	public function handle(): Collection
	{
		$contentKey = $this->getContentAccessor();

		return collect(['RequestId' => $this->getRequestId(),
						$contentKey => $this->getContent(),
						'NextToken' => $this->getNextToken(),
						]);
	}

	abstract public function getContentAccessor(): string;

	public function getContent()
	{
		$contentAccessor = $this->getContentAccessor();
		
		return $this->getElement($contentAccessor, $this->getResponseResult());
	}

	public function getResultAccessor(): string
	{
		return Str::replaceLast( 'ResponseParser', 'Result' ,class_basename(static::class));
	}

	protected function getResponseResult()
	{
		return $this->getElement($this->getResultAccessor());
	}

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
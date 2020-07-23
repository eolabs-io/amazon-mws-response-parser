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

	/** @var string */
	public $lastRemovedKey;


	public function __construct(SimpleXMLElement $xml)
	{		
		$this->setData($xml)
			 ->beforeParse($xml)
			 ->parse()
			 ->afterParse( $this->getParsedData(), $xml);
	}

	protected function beforeParse(SimpleXMLElement $data): self
	{
		return $this;
	}

	public function parse()
	{
		$xml = $this->getData();
    	$xmlArray = json_decode(json_encode($xml));

    	$this->setParsedData($this->recurseResolve($xmlArray));

    	return $this;
	}

	protected function afterParse(array $parsedData, SimpleXMLElement $orignalData): self
	{
		return $this;
	}

//=================

	public function getElementsToRemove(): Collection
	{
		return collect(['member']);
	}

	public function getElementsToIgnore(): Collection
	{
		return collect();
	}

	public function recurseResolve($data, $array = []) 
	{

		if(! $this->canBeIterated($data) ) {
			return [$data];
		}

		foreach($data as $key => $value){

			if($this->shouldStopIterating($key)) {
				return is_array($value) ? $value : [$value];
			}
			
			if($this->shouldRemoveElement($key)) {
				$this->lastRemovedKey = $key;
				$array = array_merge($array, $this->removeElement($value));
			}else{
				$array[Str::ucfirst($key)] = $this->resolve($value);
			}
		}

		return $array;
	}

	public function shouldStopIterating($key): bool
	{
		$elementsToRemove = $this->getElementsToRemove();
		return $elementsToRemove->contains($key."|final");
	}

	public function shouldRemoveElement($key): bool
	{
		if($this->shouldIgnoreElement($key)) {
			return false;
		}

		$elementsToRemove = $this->getElementsToRemove();

		return $elementsToRemove->contains($key);
	}

	public function shouldIgnoreElement($key): bool
	{
		$elementsToIgnore = $this->getElementsToIgnore();

		return $elementsToIgnore->contains($this->lastRemovedKey."|".$key);
	}

	public function canBeIterated($item): bool
	{
		return is_array($item) || is_object($item);
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
		return Str::replaceLast( 'ResponseParser', 'Result', class_basename(static::class));
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

	public function getRequestId(): ?string
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
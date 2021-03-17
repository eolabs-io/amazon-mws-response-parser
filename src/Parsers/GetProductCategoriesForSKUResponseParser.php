<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use Illuminate\Support\Collection;
use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class GetProductCategoriesForSKUResponseParser extends BaseParser
{
    public function getContentAccessor(): string
    {
        return 'Self';
    }

    public function handle(): Collection
    {
        $responseResult = ($this->shouldWrapInArray())
                            ? [$this->getResponseResult()['Self']]
                            : $this->getResponseResult()['Self'];

        return collect(['RequestId' => $this->getRequestId(),
                        'Self' => $responseResult,
                        ]);
    }

    public function shouldWrapInArray(): bool
    {
        $xml = $this->getData();
        return $xml->GetProductCategoriesForSKUResult->children()->count() == 1;
    }
}

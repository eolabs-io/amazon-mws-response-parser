<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\GetProductCategoriesForSKUResponseParser;

class GetProductCategoriesForASINResponseParser extends GetProductCategoriesForSKUResponseParser
{
    public function getContentAccessor(): string
    {
        return 'Self';
    }

    public function shouldWrapInArray(): bool
    {
        $xml = $this->getData();
        return $xml->GetProductCategoriesForASINResult->children()->count() == 1;
    }
}

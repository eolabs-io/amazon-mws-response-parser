<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class GetProductCategoriesForASINResponseParser extends BaseParser
{
    public function getContentAccessor(): string
    {
        return 'Self';
    }
}

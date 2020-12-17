<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class GetReportRequestCountResponseParser extends BaseParser
{
    public function getContentAccessor(): string
    {
        return 'Count';
    }
}

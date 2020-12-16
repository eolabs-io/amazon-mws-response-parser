<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class RequestReportResponseParser extends BaseParser
{
    public function getContentAccessor(): string
    {
        return 'ReportRequestInfo';
    }
}

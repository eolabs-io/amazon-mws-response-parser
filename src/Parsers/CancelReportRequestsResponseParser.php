<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use Illuminate\Support\Collection;
use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class CancelReportRequestsResponseParser extends BaseParser
{
    public function getContentAccessor(): string
    {
        return 'ReportRequestInfo';
    }

    public function handle(): Collection
    {
        return parent::handle()->merge(['Count' => $this->getCount()]);
    }

    public function getCount()
    {
        return $this->getElement('Count', $this->getResponseResult());
    }
}

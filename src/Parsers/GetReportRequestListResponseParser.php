<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use Illuminate\Support\Collection;
use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class GetReportRequestListResponseParser extends BaseParser
{
    public function getContentAccessor(): string
    {
        return 'ReportRequestInfo';
    }

    public function handle(): Collection
    {
        return parent::handle()->merge(['HasNext' => $this->getHasNext()]);
    }

    public function getHasNext(): ?string
    {
        return $this->getElement('HasNext', $this->getResponseResult());
    }
}

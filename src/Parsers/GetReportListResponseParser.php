<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use Illuminate\Support\Collection;
use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;

class GetReportListResponseParser extends BaseParser
{
    public function getContentAccessor(): string
    {
        return 'ReportInfo';
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

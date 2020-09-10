<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use DOMDocument;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use EolabsIo\AmazonMwsResponseParser\Support\HttpParser;

class ReviewRatingResponseParser extends HttpParser
{
    public function handle(DOMDocument $dom): Collection
    {
        return collect()
                ->merge($this->getRatings($dom))
                ->merge($this->getAverageStarsRating($dom))
                ->merge($this->getAllReviewsLink($dom));
    }

    public function getRatings(DOMDocument $dom): Collection
    {
        $tagValue = $dom->getElementById('acrCustomerReviewText')->nodeValue;
        $rating = Str::of($tagValue)
                    ->before('ratings')
                    ->replace(',', '')
                    ->trim();

        return collect(['ratings' => intval((string)$rating)]);
    }

    public function getAverageStarsRating(DOMDocument $dom): Collection
    {
        $tagTitleValue = $dom->getElementById('acrPopover')->getAttribute('title');
        $averageStarsRating = Str::of($tagTitleValue)
                                ->before('out of 5')
                                ->trim();

        return collect(['averageStarsRating' => floatval((string)$averageStarsRating)]);
    }

    public function getAllReviewsLink(DOMDocument $dom): Collection
    {
        $url = '';
        $anchors = $dom->getElementById('cr-pagination-footer-0')->getElementsByTagName('a');
        foreach ($anchors as $anchor) {
            foreach ($anchor->attributes as $attribute) {
                if ($attribute->name == 'href') {
                    $url = $attribute->value;
                }
            }
        }
        return collect(['allReviewsLink' => $url]);
    }
}

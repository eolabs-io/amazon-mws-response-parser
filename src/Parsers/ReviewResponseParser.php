<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use EolabsIo\AmazonMwsResponseParser\Support\DomParser;
use Symfony\Component\DomCrawler\Crawler;

class ReviewResponseParser extends DomParser
{
    public function handle(Crawler $domCrawler): Collection
    {
        return collect()
                ->merge($this->getAverageStarsRating($domCrawler))
                ->merge($this->getNumberOfRatingsAndReviews($domCrawler))
                ->merge($this->getReviews($domCrawler));
    }

    public function getAverageStarsRating(Crawler $domCrawler): Collection
    {
        $ratingOutOfText = $domCrawler->filter('span[data-hook="rating-out-of-text"]')->text();
        $averageStarsRating = Str::of($ratingOutOfText)
                                ->before('out of 5')
                                ->trim();

        return collect(['averageStarsRating' => floatval((string)$averageStarsRating)]);
    }

    public function getNumberOfRatingsAndReviews(Crawler $domCrawler): Collection
    {
        $filterInfoSection = $domCrawler->filter('div[data-hook="cr-filter-info-review-rating-count"]')->text();
        $ratingsAndReviews = Str::of($filterInfoSection)->trim()->explode('|');
        $numberOfRatings = Str::of($ratingsAndReviews[0])->trim()->explode(' ')->first();
        $numberOfReviews = Str::of($ratingsAndReviews[1])->trim()->explode(' ')->first();

        return collect(['numberOfReviews' => intval($numberOfReviews), 'numberOfRatings' => intval($numberOfRatings)]);
    }

    public function getReviews(Crawler $domCrawler): Collection
    {
        $reviews = $domCrawler->filter('#cm_cr-review_list div[data-hook="review"]')
            ->each(function (Crawler $review, $i) {
                return [
                    'reviewId' => $this->getReviewId($review),
                    'profileName' => $this->getProfileName($review),
                    'starRating' => $this->getStarRating($review),
                    'title' => $this->getTitle($review),
                    'date' => $this->getDate($review),
                    'verifiedPurchase' => $this->getVerifiedPurchase($review),
                    'earlyReviewerRewards' => $this->getEarlyReviewerRewards($review),
                    'vineVoice' => $this->getVineVoice($review),
                    'body' => $this->getBody($review),
                    'images' => $this->getImages($review),
                ];
            });

        return collect(['reviews' => $reviews]);
    }

    public function getReviewId(Crawler $review): string
    {
        return $review->attr('id');
    }

    public function getProfileName(Crawler $review): string
    {
        return $review->filter('div[data-hook="genome-widget"] span[class="a-profile-name"]')->text();
    }

    public function getStarRating(Crawler $review): string
    {
        $reviewStarRating = $review->filter('i[data-hook="review-star-rating"]')->text();

        return Str::of($reviewStarRating)
            ->before('out of 5')
            ->trim();
    }

    public function getTitle(Crawler $review): string
    {
        return $review->filter('a[data-hook="review-title"]')->text();
    }

    public function getDate(Crawler $review): string
    {
        $tagDateValue = $review->filter('span[data-hook="review-date"]')->text();

        return Str::of($tagDateValue)
            ->after('on')
            ->trim();
    }

    public function getVerifiedPurchase(Crawler $review): bool
    {
        $span = $review->filter('span[data-hook="avp-badge"]');
        return Str::of($span->text(''))->contains('Verified Purchase');
    }

    public function getEarlyReviewerRewards(Crawler $review): bool
    {
        // There is no data-hook for 'Early Reviewer Rewards' so search the whole review
        $span = $review->text('');
        return Str::of($span)->lower()->contains('early reviewer rewards');
    }

    public function getVineVoice(Crawler $review): bool
    {
        // There is no data-hook for 'Vine Voice' so search the whole review
        $span = $review->text('');
        return Str::of($span)->lower()->contains('vine voice');
    }

    public function getBody(Crawler $review): string
    {
        return $review->filter('span[data-hook="review-body"]')->text();
    }

    public function getImages(Crawler $review): array
    {
        return $review->filter('img[data-hook="review-image-tile"]')
            ->each(function (Crawler $reviewImage, $i) {
                return $reviewImage->attr('src');
            });
    }
}

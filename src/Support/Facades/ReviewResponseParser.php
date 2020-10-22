<?php

namespace EolabsIo\AmazonMwsResponseParser\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EolabsIo\AmazonMwsResponseParser\Skeleton\SkeletonClass
 */
class ReviewResponseParser extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'amazon-review-response-parser';
    }
}

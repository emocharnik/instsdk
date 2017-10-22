<?php

namespace InstagramApp\Request\Interfaces;

use InstagramApp\Model\Media\Collection\MediaCollection;
use InstagramApp\Model\Media\UserMedia;

/**
 * Interface MediaResource
 * @package InstagramApp\Request\Interfaces
 */
interface MediaResource
{
    /**
     * Search media by its location
     *
     * @param float $lat      Latitude of the center search coordinate
     * @param float $lng      Longitude of the center search coordinate
     * @param int   $distance [optional] Distance in metres (default is 1km (distance=1000), max. is 5km)
     * @param int   $minTime  [optional] Media taken later than this timestamp (default: 5 days ago)
     * @param int   $maxTime  [optional] Media taken earlier than this timestamp (default: now)
     *
     * @return MediaCollection
     */
    public function searchMedia($lat, $lng, $distance = 1000, $minTime = null, $maxTime = null): MediaCollection;

    /**
     * Get media by its id
     *
     * @param string $id Instagram media ID
     *
     * @return UserMedia
     */
    public function getMedia(string $id): UserMedia;

    /**
     * Get the most popular media
     *
     * @param string $shortCode
     *
     * @return MediaCollection
     */
    public function getPopularMedia(string $shortCode): MediaCollection;
}

<?php

namespace InstagramApp\Request;

use InstagramApp\Core\Request;
use InstagramApp\Model\Media\Collection\MediaCollection;

/**
 * Class Media
 * @package InstagramApp\Request
 */
class Media extends Request
{
    private const ACTION_SEARCH    = 'search';
    private const ACTION_SHORTCODE = 'shortcode';

    /** @var string */
    protected $controllerName = 'media';

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
    public function searchMedia($lat, $lng, $distance = 1000, $minTime = null, $maxTime = null): MediaCollection
    {
        $params = [
            'lat'           => $lat,
            'lng'           => $lng,
            'distance'      => $distance,
            'min_timestamp' => $minTime,
            'max_timestamp' => $maxTime,
        ];

        $response = $this->makeRequest(self::ACTION_SEARCH, false, $params);

        return new MediaCollection($response);
    }

    /**
     * Get media by its id
     *
     * @param int $id Instagram media ID
     *
     * @return MediaCollection
     */
    public function getMedia($id): MediaCollection
    {
        $this->resolveUserId($id);

        $response = $this->makeRequest($id, $this->isAuthRequired());

        return new MediaCollection($response);
    }

    /**
     * Get the most popular media
     *
     * @param string $shortCode
     *
     * @return MediaCollection
     */
    public function getPopularMedia(string $shortCode): MediaCollection
    {
        $response = $this->makeRequest(self::ACTION_SHORTCODE . '/' . $shortCode);

        return new MediaCollection($response);
    }
}

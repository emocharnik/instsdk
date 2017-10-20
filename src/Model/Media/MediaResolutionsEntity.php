<?php

namespace InstagramApp\Model\Media;

use InstagramApp\Model\AbstractModel;

/**
 * Class ImageMediaEntity
 * @package InstagramApp\Model\User
 */
class MediaResolutionsEntity extends AbstractModel
{
    /** @var MediaEntity */
    protected $low_resolution;

    /** @var MediaEntity */
    protected $standard_resolution;

    /** @var MediaEntity */
    protected $thumbnail;

    /**
     * @return MediaEntity
     */
    public function getLowResolution(): MediaEntity
    {
        return $this->low_resolution;
    }

    /**
     * @param MediaEntity | array $lowResolution
     */
    public function setLowResolution($lowResolution)
    {
        if (!$lowResolution instanceof MediaEntity) {
            $lowResolution = new MediaEntity($lowResolution);
        }

        $this->low_resolution = $lowResolution;
    }

    /**
     * @return MediaEntity
     */
    public function getStandardResolution(): MediaEntity
    {
        return $this->standard_resolution;
    }

    /**
     * @param MediaEntity | array $standardResolution
     */
    public function setStandardResolution($standardResolution)
    {
        if (!$standardResolution instanceof MediaEntity) {
            $standardResolution = new MediaEntity($standardResolution);
        }

        $this->standard_resolution = $standardResolution;
    }

    /**
     * @return MediaEntity
     */
    public function getThumbnail(): MediaEntity
    {
        return $this->thumbnail;
    }

    /**
     * @param MediaEntity | array $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        if (!$thumbnail instanceof MediaEntity) {
            $thumbnail = new MediaEntity($thumbnail);
        }

        $this->thumbnail = $thumbnail;
    }
}

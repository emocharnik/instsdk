<?php

namespace InstagramApp\Model\User;

use InstagramApp\Model\AbstractModel;

/**
 * Class UserCommonStatEntity
 * @package InstagramApp\Model\User
 */
class UserCommonStatEntity extends AbstractModel
{
    /** @var int */
    protected $media;

    /** @var int */
    protected $follows;

    /** @var int */
    protected $followed_by;

    /**
     * @return int
     */
    public function getMedia(): int
    {
        return $this->media;
    }

    /**
     * @param int $media
     */
    public function setMedia(int $media)
    {
        $this->media = $media;
    }

    /**
     * @return int
     */
    public function getFollows(): int
    {
        return $this->follows;
    }

    /**
     * @param int $follows
     */
    public function setFollows(int $follows)
    {
        $this->follows = $follows;
    }

    /**
     * @return int
     */
    public function getFollowedBy(): int
    {
        return $this->followed_by;
    }

    /**
     * @param int $followed_by
     */
    public function setFollowedBy(int $followed_by)
    {
        $this->followed_by = $followed_by;
    }
}

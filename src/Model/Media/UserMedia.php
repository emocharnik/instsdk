<?php

namespace InstagramApp\Model\Media;

use DateTime;
use InstagramApp\Model\AbstractModel;
use InstagramApp\Model\Location\LocationEntity;
use InstagramApp\Model\User\Caption\MediaCaptionEntity;
use InstagramApp\Model\User\Collection\UsersMarkedCollection;
use InstagramApp\Model\User\UserShortInfoEntity;

/**
 * Class UserMedia
 * @package InstagramApp\Model\User
 */
class UserMedia extends AbstractModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $link;

    /** @var DateTime */
    protected $created_time;

    /** @var MediaCaptionEntity */
    protected $caption;

    /** @var UserShortInfoEntity */
    protected $user;

    /** @var MediaResolutionsEntity */
    protected $images;

    /** @var LocationEntity */
    protected $location;

    /** @var MediaResolutionsEntity */
    protected $videos;

    /** @var  string */
    protected $type;

    /** @var string */
    protected $filter;

    /** @var int */
    protected $comments = 0;

    /** @var int */
    protected $likes = 0;

    /** @var array */
    protected $tags = [];

    /** @var UsersMarkedCollection */
    protected $users_in_photo;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $id       = intval($id);
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * @return DateTime
     */
    public function getCreatedTime(): DateTime
    {
        return $this->created_time;
    }

    /**
     * @param DateTime | int $created_time
     */
    public function setCreatedTime($created_time)
    {
        if (is_numeric($created_time)) {
            $created_time = new DateTime(date(DATE_ISO8601, $created_time));
        }

        $this->created_time = $created_time;
    }

    /**
     * @return MediaCaptionEntity
     */
    public function getCaption(): MediaCaptionEntity
    {
        return $this->caption;
    }

    /**
     * @param MediaCaptionEntity $caption
     */
    public function setCaption(MediaCaptionEntity $caption)
    {
        $this->caption = $caption;
    }

    /**
     * @return UserShortInfoEntity
     */
    public function getUser(): UserShortInfoEntity
    {
        return $this->user;
    }

    /**
     * @param UserShortInfoEntity | array $user
     */
    public function setUser($user)
    {
        if (!$user instanceof UserShortInfoEntity) {
            $user = new UserShortInfoEntity($user);
        }

        $this->user = $user;
    }

    /**
     * @return MediaResolutionsEntity
     */
    public function getImages(): MediaResolutionsEntity
    {
        return $this->images;
    }

    /**
     * @param MediaResolutionsEntity $images
     */
    public function setImages($images)
    {
        if (!$images instanceof MediaResolutionsEntity) {
            $images = new MediaResolutionsEntity($images);
        }

        $this->images = $images;
    }

    /**
     * @return LocationEntity
     */
    public function getLocation(): LocationEntity
    {
        return $this->location;
    }

    /**
     * @param LocationEntity $location
     */
    public function setLocation($location)
    {
        if (!$location instanceof LocationEntity) {
            $location = new LocationEntity($location);
        }

        $this->location = $location;
    }

    /**
     * @return MediaResolutionsEntity
     */
    public function getVideos(): MediaResolutionsEntity
    {
        return $this->videos;
    }

    /**
     * @param MediaResolutionsEntity $videos
     */
    public function setVideos($videos)
    {
        if (!$videos instanceof MediaResolutionsEntity) {
            $videos = new MediaResolutionsEntity($videos);
        }

        $this->videos = $videos;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getFilter(): string
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     */
    public function setFilter(string $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return int
     */
    public function getComments(): int
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     */
    public function setComments(array $comments)
    {
        $this->comments = $comments['count'];
    }

    /**
     * @return int
     */
    public function getLikes(): int
    {
        return $this->likes;
    }

    /**
     * @param array $likes
     */
    public function setLikes(array $likes)
    {
        $this->likes = $likes['count'];
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return UsersMarkedCollection
     */
    public function getUsersInPhoto(): UsersMarkedCollection
    {
        return $this->users_in_photo;
    }

    /**
     * @param UsersMarkedCollection | array $usersInPhoto
     */
    public function setUsersInPhoto($usersInPhoto)
    {
        if (!$usersInPhoto instanceof UsersMarkedCollection) {
            if (is_null($usersInPhoto)) {
                $usersInPhoto = [];
            }

            $usersInPhoto = new UsersMarkedCollection($usersInPhoto);
        }

        $this->users_in_photo = $usersInPhoto;
    }
}

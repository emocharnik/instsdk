<?php

namespace InstagramApp;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Request\Interfaces\LikesResource;
use InstagramApp\Request\Interfaces\MediaResource;
use InstagramApp\Request\Interfaces\RequestsInterface;
use InstagramApp\Request\Interfaces\UserResource;
use InstagramApp\Request\Likes;
use InstagramApp\Request\Media;
use InstagramApp\Request\User;

/**
 * Class InstagramApp
 * @package InstagramApp
 */
class InstagramApp implements RequestsInterface
{
    /** @var Requester */
    protected $requester;

    /**
     * InstagramApp constructor.
     *
     * @param Requester $requester
     */
    public function __construct(Requester $requester)
    {
        $this->setRequester($requester);
    }

    /**
     * @return LikesResource
     */
    public function getLikes(): LikesResource
    {
        $likes = new Likes($this->getRequester());

        return $likes;
    }

    /**
     * @return MediaResource
     */
    public function getMedia(): MediaResource
    {
        $media = new Media($this->getRequester());

        return $media;
    }

    /**
     * @return UserResource
     */
    public function getUser(): UserResource
    {
        $user = new User($this->getRequester());

        return $user;
    }

    /**
     * @return Requester
     */
    public function getRequester(): Requester
    {
        return $this->requester;
    }

    /**
     * @param Requester $requester
     */
    public function setRequester(Requester $requester)
    {
        $this->requester = $requester;
    }
}

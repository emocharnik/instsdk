<?php

namespace InstagramApp;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\BaseConfig;
use InstagramApp\Request\Auth;
use InstagramApp\Request\Interfaces\AuthResource;
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
    /** @var BaseConfig */
    protected $config;

    /** @var Requester */
    protected $requester;

    /** @var string */
    protected $token;

    /**
     * InstagramApp constructor.
     *
     * @param array     $config
     * @param Requester $requester
     * @param string    $token
     */
    public function __construct(array $config, Requester $requester, string $token = '')
    {
        $this->config = new BaseConfig($config);
        $this->setRequester($requester);
        $this->token = $token;
    }

    /**
     * @return AuthResource
     */
    public function getAuth(): AuthResource
    {
        $resource = new Auth($this->getConfig(), $this->getRequester());
        $resource->setAccessToken($this->getToken());

        return $resource;
    }

    /**
     * @return LikesResource
     */
    public function getLikes(): LikesResource
    {
        $likes = new Likes($this->getConfig(), $this->getRequester());
        $likes->setAccessToken($this->getToken());

        return $likes;
    }

    /**
     * @return MediaResource
     */
    public function getMedia(): MediaResource
    {
        $media = new Media($this->getConfig(), $this->getRequester());
        $media->setAccessToken($this->getToken());

        return $media;
    }

    /**
     * @return UserResource
     */
    public function getUser(): UserResource
    {
        $user = new User($this->getConfig(), $this->getRequester());
        $user->setAccessToken($this->getToken());

        return $user;
    }

    /**
     * @return BaseConfig
     */
    public function getConfig(): BaseConfig
    {
        return $this->config;
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

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}

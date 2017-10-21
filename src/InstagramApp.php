<?php

namespace InstagramApp;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\BaseConfig;
use InstagramApp\Request\Auth;
use InstagramApp\Request\Interfaces\RequestsInterface;
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
     * @return Auth
     */
    public function getAuth(): Auth
    {
        $resource = new Auth($this->getConfig(), $this->getRequester());
        $resource->setAccessToken($this->getToken());

        return $resource;
    }

    /**
     * @return Likes
     */
    public function getLikes(): Likes
    {
        $likes = new Likes($this->getConfig(), $this->getRequester());
        $likes->setAccessToken($this->getToken());

        return $likes;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        $media = new Media($this->getConfig(), $this->getRequester());
        $media->setAccessToken($this->getToken());

        return $media;
    }

    /**
     * @return User
     */
    public function getUser(): User
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

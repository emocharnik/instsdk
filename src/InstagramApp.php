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

    /**
     * InstagramApp constructor.
     *
     * @param array     $config
     * @param Requester $requester
     */
    public function __construct(array $config, Requester $requester)
    {
        $this->config = new BaseConfig($config);
        $this->setRequester($requester);
    }

    /**
     * @return Auth
     */
    public function getAuth(): Auth
    {
        return new Auth($this->getConfig(), $this->getRequester());
    }

    /**
     * @return Likes
     */
    public function getLikes(): Likes
    {
        return new Likes($this->getConfig(), $this->getRequester());
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return new Media($this->getConfig(), $this->getRequester());
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return new User($this->getConfig(), $this->getRequester());
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
}

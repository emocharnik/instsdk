<?php

namespace InstagramApp\Factory;

use InstagramApp\Core\Component\InstagramRequester;
use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\InstagramApp;
use InstagramApp\Request\Interfaces\RequestsInterface;

/**
 * Class InstagramAppFactory
 * @package InstagramApp\Factory
 */
class InstagramAppFactory
{
    /**
     * @param array  $config
     * @param string $token
     *
     * @return RequestsInterface
     */
    public static function createResources(array $config, string $token): RequestsInterface
    {
        $requester = new InstagramRequester($config);
        $requester->setAccessToken($token);

        return new InstagramApp($requester);
    }

    /**
     * @param array $config
     *
     * @return Requester
     */
    public static function getAuthResource(array $config): Requester
    {
        $requester = new InstagramRequester($config);

        return $requester;
    }
}

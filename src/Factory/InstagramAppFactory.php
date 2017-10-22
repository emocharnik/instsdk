<?php

namespace InstagramApp\Factory;

use InstagramApp\Core\Component\InstagramRequester;
use InstagramApp\InstagramApp;
use InstagramApp\Request\Interfaces\AuthResource;
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
        $requester = new InstagramRequester();

        return new InstagramApp($config, $requester, $token);
    }

    /**
     * @param array $config
     *
     * @return AuthResource
     */
    public static function getAuthResource(array $config): AuthResource
    {
        $requester = new InstagramRequester();
        $app       = new InstagramApp($config, $requester);

        return $app->getAuth();
    }
}

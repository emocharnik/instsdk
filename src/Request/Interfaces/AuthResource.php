<?php

namespace InstagramApp\Request\Interfaces;

use InstagramApp\Core\InstagramException;
use InstagramApp\Core\Request;
use InstagramApp\Model\User\Login\LoginDataEntity;

/**
 * Interface AuthResource
 * @package InstagramApp\Request\Interfaces
 */
interface AuthResource
{
    /**
     * @param array $scope [optional] $scope       Requesting additional permissions
     *
     * @return string
     * @throws InstagramException
     */
    public function getLoginUrl($scope = [Request::SCOPE_PUBLIC_CONTENT]): string;

    /**
     * @param string $code
     *
     * @return LoginDataEntity
     */
    public function login(string $code): LoginDataEntity;
}

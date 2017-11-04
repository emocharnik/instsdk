<?php

namespace InstagramApp\Core\Interfaces;

use InstagramApp\Model\User\Login\LoginDataEntity;

/**
 * Interface Requester
 * @package InstagramApp\Core\Interfaces
 */
interface Requester
{
    const DEFAULT_GRANT_TYPE = 'authorization_code';

    const REQUEST_TYPE_DELETE = 'DELETE';
    const REQUEST_TYPE_GET    = 'GET';
    const REQUEST_TYPE_POST   = 'POST';

    const SCOPE_LIKES          = 'likes';
    const SCOPE_PUBLIC_CONTENT = 'public_content';

    /**
     * @param string $action
     * @param string $method
     * @param array  $params
     *
     * @return array
     */
    public function makeRequest(string $action, string $method, array $params = []): array;

    /**
     * @param string $code
     *
     * @return LoginDataEntity
     */
    public function createAccessCode(string $code): LoginDataEntity;

    /**
     * @param array $scope
     *
     * @return mixed
     */
    public function getLoginUrl($scope = [self::SCOPE_PUBLIC_CONTENT]);
}

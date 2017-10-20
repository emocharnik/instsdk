<?php

namespace InstagramApp\Core\Interfaces;

use InstagramApp\Core\Request;

/**
 * Interface Requester
 * @package InstagramApp\Core\Interfaces
 */
interface Requester
{
    const REQUEST_TYPE_DELETE = 'DELETE';
    const REQUEST_TYPE_GET    = 'GET';
    const REQUEST_TYPE_POST   = 'POST';

    /**
     * @param string $action
     * @param string $method
     *
     * @param bool   $auth
     * @param array  $params
     *
     * @return array
     */
    public function makeRequest(string $action, string $method, bool $auth = false, array $params = []): array;

    /**
     * @param string $apiUrl
     * @param array  $apiData
     *
     * @return array
     */
    public function login(string $apiUrl, array $apiData): array;

    /**
     * @param Request $request
     */
    public function setRequest(Request $request);
}

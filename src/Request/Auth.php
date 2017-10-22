<?php

namespace InstagramApp\Request;

use InstagramApp\Core\InstagramException;
use InstagramApp\Core\Request;
use InstagramApp\Model\User\Login\LoginDataEntity;
use InstagramApp\Request\Interfaces\AuthResource;

/**
 * Class Auth
 * @package InstagramApp\Request
 */
class Auth extends Request implements AuthResource
{
    private const API_OAUTH_URL       = 'https://api.instagram.com/oauth/authorize';
    private const API_OAUTH_TOKEN_URL = 'https://api.instagram.com/oauth/access_token';

    private const DEFAULT_RESPONSE_TYPE = 'code';
    private const LOGIN_URL_PATTERN     = '%s?client_id=%s&redirect_uri=%s&scope=%s&response_type=%s';

    /**
     * @param array $scope [optional] $scope       Requesting additional permissions
     *
     * @return string
     * @throws InstagramException
     */
    public function getLoginUrl($scope = [self::SCOPE_PUBLIC_CONTENT]): string
    {
        if (is_array($scope) && count(array_intersect($scope, $this->getScopes())) === count($scope)) {
            return vsprintf(self::LOGIN_URL_PATTERN, $this->getLoginParams($scope));
        } else {
            $message = 'Error: getLoginUrl() - The parameter isn\'t an array or invalid scope permissions used.';
            throw new InstagramException($message);
        }
    }

    /**
     * @param string $code
     *
     * @return LoginDataEntity
     */
    public function login(string $code): LoginDataEntity
    {
        $loginData = $this->getRequester()->login(self::API_OAUTH_TOKEN_URL, $code);

        return new LoginDataEntity($loginData);
    }

    /**
     * @param $scope
     *
     * @return array
     */
    private function getLoginParams($scope): array
    {
        $params = [
            self::API_OAUTH_URL,
            $this->getApiKey(),
            urlencode($this->getCallbackUrl()),
            implode('+', $scope),
            self::DEFAULT_RESPONSE_TYPE,
        ];

        return $params;
    }
}

<?php

namespace InstagramApp\Core\Component;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use InstagramApp\Core\InstagramException;
use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\BaseConfig;
use InstagramApp\Model\User\Login\LoginDataEntity;

/**
 * Class InstagramRequester
 * @package InstagramApp\Core\Component
 */
class InstagramRequester implements Requester
{
    const API_URL = 'https://api.instagram.com/v1/';

    private const API_OAUTH_TOKEN_URL   = 'https://api.instagram.com/oauth/access_token';
    private const API_OAUTH_URL         = 'https://api.instagram.com/oauth/authorize';
    private const LOGIN_URL_PATTERN     = '%s?client_id=%s&redirect_uri=%s&scope=%s&response_type=%s';
    private const DEFAULT_RESPONSE_TYPE = 'code';

    /** @var BaseConfig */
    protected $config;

    /** @var string */
    protected $accessToken;

    /**
     * Available scopes
     *
     * @var array
     */
    private $scopes = [
        self::SCOPE_PUBLIC_CONTENT,
        self::SCOPE_LIKES,
    ];

    /**
     * InstagramRequester constructor.
     *
     * @param array  $config
     * @param string $accessToken
     */
    public function __construct(array $config, string $accessToken = '')
    {
        $config = new BaseConfig($config);
        $this->setConfig($config);
        $this->setAccessToken($accessToken);
    }

    /**
     * The call operator
     *
     * @param string $action API resource path
     * @param string $method
     *
     * @param array  $params Additional request parameters  [optional]
     *
     * @return array
     * @throws InstagramException
     */
    public function makeRequest(string $action, string $method, array $params = []): array
    {
        $request = $this->getRequest($action, $method, $params);

        $jsonData = curl_exec($ch);

        if (false == $jsonData) {
            throw new InstagramException("Error: makeRequest() - cURL error: " . curl_error($ch));
        }

        curl_close($ch);

        $result = json_decode($jsonData, 1);

        if (isset($result['meta']['code']) && $result['meta']['code'] != 200) {
            throw new InstagramException($result['meta']['error_message']);
        }

        return $result;
    }

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
     * @param $scope
     *
     * @return array
     */
    private function getLoginParams($scope): array
    {
        $params = [
            self::API_OAUTH_URL,
            $this->getConfig()->getApiKey(),
            urlencode($this->getConfig()->getApiCallback()),
            implode('+', $scope),
            self::DEFAULT_RESPONSE_TYPE,
        ];

        return $params;
    }

    /**
     * @param string $code
     *
     * @return LoginDataEntity
     */
    public function createAccessCode(string $code): LoginDataEntity
    {
        $loginData = $this->login(self::API_OAUTH_TOKEN_URL, $code);

        return new LoginDataEntity($loginData);
    }

    /**
     * The OAuth call operator
     *
     * @param string $apiUrl
     * @param string $code The post API data
     *
     * @return array
     * @throws InstagramException
     */
    public function login(string $apiUrl, string $code): array
    {
        $apiData = [
            'client_id'     => $this->getConfig()->getApiKey(),
            'client_secret' => $this->getConfig()->getApiSecret(),
            'redirect_uri'  => $this->getConfig()->getApiCallback(),
            'grant_type'    => Requester::DEFAULT_GRANT_TYPE,
            'code'          => $code,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, count($apiData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $jsonData = curl_exec($ch);

        if (false === $jsonData) {
            throw new InstagramException("Error: login() - cURL error: " . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($jsonData, 1);
    }

    /**
     * @param string $function
     * @param string $method
     * @param array  $params
     *
     * @return string
     * @throws InstagramException
     */
    private function getRequest(string $function, string $method, array $params): string
    {
        if ($this->getConfig()->isOnlyPublicAccess()) {
            // if the call doesn't requires authentication
            $authMethod = '?client_id=' . $this->getConfig()->getApiKey();
        } else {
            // if the call needs an authenticated user
            if ($this->getAccessToken()) {
                $authMethod = '?access_token=' . $this->getAccessToken();
            } else {
                $str = "Error: makeRequest() | $function - This method requires an authenticated users access token.";
                throw new InstagramException($str);
            }
        }

        if (!empty($params) && is_array($params)) {
            $params = '&' . http_build_query($params);
        }

        // signed header of POST/DELETE requests
        $headerData = ['Accept: application/json'];

        if (self::REQUEST_TYPE_DELETE == $method) {
            $headerData[] = 'X-Insta-Forwarded-For: ' . $this->signHeader();
        }

        $params = (Requester::REQUEST_TYPE_GET === $method) ? $params : null;

        if (self::REQUEST_TYPE_POST === $method) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, ltrim($paramString, '&'));
        } else if (self::REQUEST_TYPE_DELETE === $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::REQUEST_TYPE_DELETE);
        }

        $uri     = new Uri(self::API_URL);
        $request = new Request($method, $uri, $headerData, ltrim($params, '&'));

        $apiCall = self::API_URL . $function . $authMethod . $params;

        return $apiCall;
    }

    /**
     * Sign header by using the app's IP and its API secret
     *
     * @return string
     */
    private function signHeader(): string
    {
        $ipAddress = $_SERVER['SERVER_ADDR'];
        $signature = hash_hmac('sha256', $ipAddress, $this->getConfig()->getApiSecret());

        return join('|', [$ipAddress, $signature]);
    }

    /**
     * @return array
     */
    protected function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @return BaseConfig
     */
    public function getConfig(): BaseConfig
    {
        return $this->config;
    }

    /**
     * @param BaseConfig $config
     */
    public function setConfig(BaseConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}

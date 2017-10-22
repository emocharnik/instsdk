<?php

namespace InstagramApp\Core\Component;

use InstagramApp\Core\InstagramException;
use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Core\Request;

/**
 * Class InstagramRequester
 * @package InstagramApp\Core\Component
 */
class InstagramRequester implements Requester
{
    const API_URL = 'https://api.instagram.com/v1/';

    /** @var Request */
    protected $request;

    /**
     * @return Request
     * @throws InstagramException
     */
    public function getRequest(): Request
    {
        if (!$this->request) {
            throw new InstagramException(Request::class . ' should be assigned');
        }

        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * The call operator
     *
     * @param string $action API resource path
     * @param string $method
     *
     * @param bool   $auth
     * @param array  $params Additional request parameters  [optional]
     *
     * @return array
     * @throws InstagramException
     */
    public function makeRequest(string $action, string $method, bool $auth = false, array $params = []): array
    {
        $request = $this->getRequest()->getController() . '/' . $action;

        if (false === $auth) {
            // if the call doesn't requires authentication
            $authMethod = '?client_id=' . $this->getRequest()->getApiKey();
        } else {
            // if the call needs an authenticated user
            if ($this->getRequest()->getAccessToken()) {
                $authMethod = '?access_token=' . $this->getRequest()->getAccessToken();
            } else {
                $str = "Error: makeRequest() | $request - This method requires an authenticated users access token.";
                throw new InstagramException($str);
            }
        }

        $paramString = null;

        if (!empty($params) && is_array($params)) {
            $paramString = '&' . http_build_query($params);
        }

        $apiCall = $this->composeUrl($request, $method, $authMethod, $paramString);

        // signed header of POST/DELETE requests
        $headerData = ['Accept: application/json'];

        if (true === $this->getRequest()->isSignedHeader() && self::REQUEST_TYPE_POST !== $method) {
            $headerData[] = 'X-Insta-Forwarded-For: ' . $this->signHeader();
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiCall);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if (self::REQUEST_TYPE_POST === $method) {
            curl_setopt($ch, CURLOPT_POST, count($params));
            curl_setopt($ch, CURLOPT_POSTFIELDS, ltrim($paramString, '&'));
        } else if (self::REQUEST_TYPE_DELETE === $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::REQUEST_TYPE_DELETE);
        }

        $jsonData = curl_exec($ch);

        if (false === $jsonData) {
            throw new InstagramException("Error: makeRequest() - cURL error: " . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($jsonData);
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
            'client_id'     => $this->getRequest()->getApiKey(),
            'client_secret' => $this->getRequest()->getApiSecret(),
            'redirect_uri'  => $this->getRequest()->getCallbackUrl(),
            'grant_type'    => Requester::DEFAULT_GRANT_TYPE,
            'code'          => $code,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, count($apiData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($code));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $jsonData = curl_exec($ch);

        if (false === $jsonData) {
            throw new InstagramException("Error: login() - cURL error: " . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($jsonData);
    }

    /**
     * @param string $function
     * @param string $method
     * @param string $authMethod
     * @param string $paramString
     *
     * @return string
     */
    private function composeUrl(string $function, string $method, string $authMethod, string $paramString): string
    {
        $params  = (Requester::REQUEST_TYPE_GET === $method) ? $paramString : null;
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
        $signature = hash_hmac('sha256', $ipAddress, $this->getRequest()->getApiSecret());

        return join('|', [$ipAddress, $signature]);
    }
}

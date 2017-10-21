<?php

namespace InstagramApp\Core;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\BaseConfig;

/**
 * Class Request
 * @package InstagramApp\Core
 */
abstract class Request
{
    const ACTION_APPROVE = 'approve';

    const ACTION_BLOCK    = 'block';
    const ACTION_FOLLOW   = 'follow';
    const ACTION_DENY     = 'deny';
    const ACTION_UNBLOCK  = 'unblock';
    const ACTION_UNFOLLOW = 'unfollow';

    const SCOPE_PUBLIC_CONTENT = 'public_content';

    const RESPONSE_CODE_COMPLETED = 200;

    private const ID_SELF = 'self';

    /** @var bool */
    protected $authRequired = false;

    /** @var string */
    private $accessToken;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $apiSecret;

    /** @var string */
    private $callbackUrl;

    /** @var string */
    protected $controllerName;

    /** @var Requester */
    protected $requester;

    /** @var bool */
    private $signedHeader = false;

    /**
     * Available scopes
     *
     * @var array
     */
    private $scopes = [
        self::SCOPE_PUBLIC_CONTENT,
    ];

    /**
     * Default constructor
     *
     * @param BaseConfig $config Instagram configuration data
     * @param Requester  $requester
     */
    public function __construct(BaseConfig $config, Requester $requester)
    {
        if (!$config->isOnlyPublicAccess()) {
            // if you want to access user data
            $this->setApiKey($config->getApiKey());
            $this->setApiSecret($config->getApiSecret());
            $this->setCallbackUrl($config->getApiCallback());
        } else {
            // if you only want to access public data
            $this->setApiKey($config->getApiKey());
        }

        $this->setRequester($requester);
        $requester->setRequest($this);
    }

    /**
     * @param mixed  $action
     * @param bool   $auth
     * @param array  $params
     * @param string $method
     *
     * @return array
     */
    public function makeRequest(
        $action,
        bool $auth = false,
        array $params = [],
        string $method = Requester::REQUEST_TYPE_GET
    ): array {
        return $this->getRequester()->makeRequest($action, $method, $auth, $params);
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

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }

    /**
     * @param string $apiSecret
     */
    public function setApiSecret(string $apiSecret)
    {
        $this->apiSecret = $apiSecret;
    }

    /**
     * @return string
     */
    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl(string $callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return string
     * @throws InstagramException
     */
    public function getController(): string
    {
        if (!$this->controllerName) {
            throw new InstagramException('Controller should be defined');
        }

        return $this->controllerName;
    }

    /**
     * @return bool
     */
    public function isSignedHeader(): bool
    {
        return $this->signedHeader;
    }

    /**
     * @param bool $signedHeader
     */
    public function setSignedHeader(bool $signedHeader)
    {
        $this->signedHeader = $signedHeader;
    }


    /**
     * @return Requester
     * @throws InstagramException
     */
    protected function getRequester(): Requester
    {
        if (!$this->requester) {
            throw new InstagramException(Requester::class . ' should be injected');
        }

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
     * @return array
     */
    protected function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @return bool
     */
    protected function isAuthRequired(): bool
    {
        return $this->authRequired;
    }

    /**
     * @param bool $authRequired
     */
    protected function setAuthRequired(bool $authRequired)
    {
        $this->authRequired = $authRequired;
    }

    /**
     * @param $id
     *
     * @return string
     */
    protected function resolveUserId($id): string
    {
        if ($id === 0 && $this->getAccessToken()) {
            $id = self::ID_SELF;
            $this->setAuthRequired(true);
        }

        return $id;
    }
}

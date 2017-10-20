<?php

namespace InstagramApp\Model;

use InstagramApp\Core\InstagramException;

/**
 * Class BaseConfig
 * @package InstagramApp\Core
 */
class BaseConfig extends AbstractModel
{
    /** @var string */
    protected $apiCallback;

    /** @var string */
    protected $apiKey;

    /** @var string */
    protected $apiSecret;

    /** @var bool */
    public $onlyPublicAccess = false;

    /**
     * BaseConfig constructor.
     *
     * @param array $data
     *
     * @throws InstagramException
     */
    public function __construct($data = [])
    {
        if (is_array($data)) {
            parent::__construct($data);
        } elseif (is_string($data)) {
            $this->setApiKey($data);
            $this->setOnlyPublicAccess(true);
        } else {
            throw new InstagramException('Unexpected data has been transmitted');
        }
    }


    /**
     * @return string
     * @throws InstagramException
     */
    public function getApiCallback(): string
    {
        if (!$this->apiCallback) {
            throw new InstagramException('API callback should been provided');
        }

        return $this->apiCallback;
    }

    /**
     * @param string $apiCallback
     */
    public function setApiCallback(string $apiCallback)
    {
        $this->apiCallback = $apiCallback;
    }

    /**
     * @return string
     * @throws InstagramException
     */
    public function getApiKey(): string
    {
        if (!$this->apiKey) {
            throw new InstagramException('API key should been provided');
        }

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
     * @throws InstagramException
     */
    public function getApiSecret(): string
    {
        if (!$this->apiSecret) {
            throw new InstagramException('API secret should been provided');
        }

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
     * @return bool
     */
    public function isOnlyPublicAccess(): bool
    {
        return $this->onlyPublicAccess;
    }

    /**
     * @param bool $onlyPublicAccess
     */
    public function setOnlyPublicAccess(bool $onlyPublicAccess)
    {
        $this->onlyPublicAccess = $onlyPublicAccess;
    }
}

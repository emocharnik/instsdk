<?php

namespace InstagramApp\Model\User\Login;

use InstagramApp\Model\AbstractModel;
use InstagramApp\Model\User\UserDefaultEntity;

/**
 * Class UserLoginEntity
 * @package InstagramApp\Model\User\Login
 */
class LoginDataEntity extends AbstractModel
{
    /** @var string */
    protected $accessToken;

    /** @var UserDefaultEntity */
    protected $user;

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
     * @return UserDefaultEntity
     */
    public function getUser(): UserDefaultEntity
    {
        return $this->user;
    }

    /**
     * @param UserDefaultEntity | array $user
     */
    public function setUser($user)
    {
        if (!$user instanceof UserDefaultEntity) {
            $user = new UserDefaultEntity($user);
        }

        $this->user = $user;
    }
}

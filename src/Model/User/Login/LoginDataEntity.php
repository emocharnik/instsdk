<?php

namespace InstagramApp\Model\User\Login;

use InstagramApp\Model\AbstractModel;
use InstagramApp\Model\User\Marked\UserMarkedEntity;

/**
 * Class UserLoginEntity
 * @package InstagramApp\Model\User\Login
 */
class LoginDataEntity extends AbstractModel
{
    /** @var string */
    protected $accessToken;

    /** @var UserMarkedEntity */
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
     * @return UserMarkedEntity
     */
    public function getUser(): UserMarkedEntity
    {
        return $this->user;
    }

    /**
     * @param UserMarkedEntity | array $user
     */
    public function setUser($user)
    {
        if (!$user instanceof UserMarkedEntity) {
            $user = new UserMarkedEntity($user);
        }

        $this->user = $user;
    }
}

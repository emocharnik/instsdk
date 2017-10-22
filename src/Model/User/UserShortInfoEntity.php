<?php

namespace InstagramApp\Model\User;

use InstagramApp\Model\AbstractInstagramModel;

/**
 * Class UserShortIntoEntity
 * @package InstagramApp\Model\User
 */
class UserShortInfoEntity extends AbstractInstagramModel
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $username;

    /** @var string */
    protected $profile_picture;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getProfilePicture(): string
    {
        return $this->profile_picture;
    }

    /**
     * @param string $profilePicture
     */
    public function setProfilePicture(string $profilePicture)
    {
        $this->profile_picture = $profilePicture;
    }
}

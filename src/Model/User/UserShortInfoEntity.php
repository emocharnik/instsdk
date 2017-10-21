<?php

namespace InstagramApp\Model\User;

use InstagramApp\Model\AbstractInstagramModel;

/**
 * Class UserShortIntoEntity
 * @package InstagramApp\Model\User
 */
class UserShortInfoEntity extends AbstractInstagramModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $username;

    /** @var string */
    protected $profile_picture;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
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

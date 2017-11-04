<?php

namespace InstagramApp\Model\User;

use InstagramApp\Model\AbstractInstagramModel;

/**
 * Class UserSearchEntity
 * @package InstagramApp\Model\User
 */
class UserSearchEntity extends AbstractInstagramModel
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $full_name;

    /** @var string */
    protected $profile_picture;

    /** @var string */
    protected $username;

    /** @var string */
    protected $bio;

    /** @var string */
    protected $website;

    /** @var bool */
    protected $is_business;

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
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name)
    {
        $this->full_name = $full_name;
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
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * @param string $bio
     */
    public function setBio(string $bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * @return bool
     */
    public function isBusiness(): bool
    {
        return $this->is_business;
    }

    /**
     * @param bool $is_business
     */
    public function setIsBusiness(bool $is_business)
    {
        $this->is_business = $is_business;
    }
}

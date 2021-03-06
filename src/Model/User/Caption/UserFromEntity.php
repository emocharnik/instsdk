<?php

namespace InstagramApp\Model\User\Caption;

use InstagramApp\Model\AbstractInstagramModel;

/**
 * Class UserFromEntity
 * @package InstagramApp\Model\User\Caption
 */
class UserFromEntity extends AbstractInstagramModel
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $username;

    /** @var string */
    protected $full_name;

    /** @var string */
    protected $type;

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
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName)
    {
        $this->full_name = $fullName;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}

<?php

namespace InstagramApp\Model\User\Marked;

use InstagramApp\Model\User\UserShortInfoEntity;

/**
 * Class UserMarkedEntity
 * @package InstagramApp\Model\User\Marked
 */
class UserMarkedEntity extends UserShortInfoEntity
{
    /** @var string */
    protected $full_name;

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
}

<?php

namespace InstagramApp\Model\User\Marked;

use InstagramApp\Model\AbstractInstagramModel;
use InstagramApp\Model\User\UserDefaultEntity;

/**
 * Class MarkEntity
 * @package InstagramApp\Model\User\Marked
 */
class MarkEntity extends AbstractInstagramModel
{
    /** @var UserDefaultEntity */
    protected $user;

    /** @var PositionEntity */
    protected $position;

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

    /**
     * @return PositionEntity
     */
    public function getPosition(): PositionEntity
    {
        return $this->position;
    }

    /**
     * @param PositionEntity | array $position
     */
    public function setPosition($position)
    {
        if (!$position instanceof PositionEntity) {
            $position = new PositionEntity($position);
        }

        $this->position = $position;
    }
}

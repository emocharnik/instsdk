<?php

namespace InstagramApp\Model\User\Marked;

use InstagramApp\Model\AbstractModel;

/**
 * Class MarkEntity
 * @package InstagramApp\Model\User\Marked
 */
class MarkEntity extends AbstractModel
{
    /** @var UserMarkedEntity */
    protected $user;

    /** @var PositionEntity */
    protected $position;

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

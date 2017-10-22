<?php

namespace InstagramApp\Model\User\Collection;

use InstagramApp\Model\AbstractInstagramCollection;
use InstagramApp\Model\User\Marked\MarkEntity;
use InstagramApp\Model\User\UserDefaultEntity;

/**
 * Class UsersMarkedCollection
 * @package InstagramApp\Model\User\Marked
 */
class UsersMarkedCollection extends AbstractInstagramCollection
{
    /** @var MarkEntity[] */
    protected $users = [];

    /**
     * @param MarkEntity $user
     */
    public function add(MarkEntity $user)
    {
        $this->users[] = $user;
    }

    /**
     * @param array $data
     */
    public function append(array $data)
    {
        $user = new MarkEntity($data);
        $this->add($user);
    }

    /**
     * @return MarkEntity[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}

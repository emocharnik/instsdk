<?php

namespace InstagramApp\Model\User\Collection;

use InstagramApp\Model\AbstractInstagramCollection;
use InstagramApp\Model\User\UserDefaultEntity;

/**
 * Class UsersMarkedCollection
 * @package InstagramApp\Model\User\Marked
 */
class UsersMarkedCollection extends AbstractInstagramCollection
{
    /** @var UserDefaultEntity[] */
    protected $users;

    /**
     * @param UserDefaultEntity $user
     */
    public function add(UserDefaultEntity $user)
    {
        $this->users[] = $user;
    }

    /**
     * @param array $data
     */
    public function append(array $data)
    {
        $user = new UserDefaultEntity($data);
        $this->add($user);
    }

    /**
     * @return UserDefaultEntity[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}

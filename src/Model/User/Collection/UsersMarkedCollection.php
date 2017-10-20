<?php

namespace InstagramApp\Model\User\Collection;

use InstagramApp\Model\AbstractInstagramCollection;
use InstagramApp\Model\User\Marked\UserMarkedEntity;

/**
 * Class UsersMarkedCollection
 * @package InstagramApp\Model\User\Marked
 */
class UsersMarkedCollection extends AbstractInstagramCollection
{
    /** @var UserMarkedEntity[] */
    protected $users;

    /**
     * @param UserMarkedEntity $user
     */
    public function add(UserMarkedEntity $user)
    {
        $this->users[] = $user;
    }

    /**
     * @param array $data
     */
    public function append(array $data)
    {
        $user = new UserMarkedEntity($data);
        $this->add($user);
    }

    /**
     * @return UserMarkedEntity[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}

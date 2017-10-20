<?php

namespace InstagramApp\Model\User\Collection;

use InstagramApp\Model\AbstractInstagramCollection;
use InstagramApp\Model\User\UserSearchEntity;

/**
 * Class UsersSearch
 * @package InstagramApp\Model\User\Collection
 */
class UsersSearch extends AbstractInstagramCollection
{
    /** @var UserSearchEntity[] */
    protected $users;

    /**
     * @param UserSearchEntity $user
     */
    public function add(UserSearchEntity $user)
    {
        $this->users[] = $user;
    }

    /**
     * @param array $data
     */
    public function append(array $data)
    {
        $user = new UserSearchEntity($data);
        $this->add($user);
    }

    /**
     * @return UserSearchEntity[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}

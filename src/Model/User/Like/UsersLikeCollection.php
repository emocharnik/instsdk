<?php

namespace InstagramApp\Model\User\Like;

use InstagramApp\Model\AbstractInstagramCollection;

/**
 * Class UsersLikeCollection
 * @package InstagramApp\Model\User\Like
 */
class UsersLikeCollection extends AbstractInstagramCollection
{
    /** @var UserLikeEntity [] */
    protected $users = [];

    /**
     * @param UserLikeEntity $user
     */
    public function add(UserLikeEntity $user)
    {
        $this->users[] = $user;
    }

    /**
     * @param array $data
     */
    public function append(array $data)
    {
        $this->add(new UserLikeEntity($data));
    }

    /**
     * @return UserLikeEntity[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}

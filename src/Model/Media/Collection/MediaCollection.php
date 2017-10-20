<?php

namespace InstagramApp\Model\Media\Collection;

use InstagramApp\Model\AbstractInstagramCollection;
use InstagramApp\Model\Media\UserMedia;

/**
 * Class UsersResent
 * @package InstagramApp\Model\User\Collection
 */
class MediaCollection extends AbstractInstagramCollection
{
    /** @var UserMedia[] */
    protected $userMedia;

    /**
     * @param UserMedia $user
     */
    public function add(UserMedia $user)
    {
        $this->userMedia[] = $user;
    }

    /**
     * @param array $data
     */
    public function append(array $data)
    {
        $user = new UserMedia($data);
        $this->add($user);
    }

    /**
     * @return UserMedia[]
     */
    public function getUserMedia(): array
    {
        return $this->userMedia;
    }
}

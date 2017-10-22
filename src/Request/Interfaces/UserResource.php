<?php

namespace InstagramApp\Request\Interfaces;

use InstagramApp\Model\Media\Collection\MediaCollection;
use InstagramApp\Model\User\Collection\UsersSearch;
use InstagramApp\Model\User\UserExtendedEntity;

/**
 * Interface UserResource
 * @package InstagramApp\Request\Interfaces
 */
interface UserResource
{
    /**
     * Search for a user
     *
     * @param string  $name  Instagram username
     * @param int $limit Limit of returned results [optional]
     *
     * @return UsersSearch
     */
    public function searchUser(string $name, int $limit = 10): UsersSearch;

    /**
     * Get user info
     *
     * @param int [optional] $id Instagram user ID
     *
     * @return UserExtendedEntity
     */
    public function getUser(int $id = 0): UserExtendedEntity;

    /**
     * Get user activity feed
     *
     * @param int $id
     * @param int $limit
     *
     * @return MediaCollection
     */
    public function getUserRecentMedia(int $id = 0, $limit = 0): MediaCollection;
}

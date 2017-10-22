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
     * @param integer $limit Limit of returned results [optional]
     *
     * @return UsersSearch
     */
    public function searchUser($name, $limit = 10): UsersSearch;

    /**
     * Get user info
     *
     * @param integer [optional] $id Instagram user ID
     *
     * @return UserExtendedEntity
     */
    public function getUser($id = 0): UserExtendedEntity;

    /**
     * Get user activity feed
     *
     * @param int $id
     * @param int $limit
     *
     * @return MediaCollection
     */
    public function getUserRecentMedia($id = 0, $limit = 0): MediaCollection;
}

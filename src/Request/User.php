<?php

namespace InstagramApp\Request;

use InstagramApp\Core\Request;
use InstagramApp\Model\Media\Collection\MediaCollection;
use InstagramApp\Model\User\Collection\UsersSearch;
use InstagramApp\Model\User\UserEntity;

/**
 * Class User
 * @package InstagramApp\Request
 */
class User extends Request
{
    private const ACTION_SEARCH = 'search';
    private const ACTION_FEED   = 'feed';

    protected const CONTROLLER_NAME = 'users';

    /**
     * Search for a user
     *
     * @param string  $name  Instagram username
     * @param integer $limit Limit of returned results [optional]
     *
     * @return UsersSearch
     */
    final public function searchUser($name, $limit = 10): UsersSearch
    {
        $params = ['q' => $name, 'count' => $limit];

        return new UsersSearch($this->makeRequest(self::ACTION_SEARCH, false, $params));
    }

    /**
     * Get user info
     *
     * @param integer [optional] $id Instagram user ID
     *
     * @return UserEntity
     */
    public function getUser($id = 0): UserEntity
    {
        $id = $this->resolveUserId($id);

        return new UserEntity($this->makeRequest($id, $this->isAuthRequired()));
    }

    /**
     * Get user activity feed
     *
     * @param int $id
     * @param int $limit
     *
     * @return MediaCollection
     */
    public function getUserRecentMedia($id = 0, $limit = 0): MediaCollection
    {
        $id       = $this->resolveUserId($id);
        $response = $this->makeRequest($id . '/' . self::ACTION_FEED, $this->isAuthRequired(), ['count' => $limit]);

        return new MediaCollection($response);
    }
}

<?php

namespace InstagramApp\Request;

use InstagramApp\Core\Request;
use InstagramApp\Model\Media\Collection\MediaCollection;
use InstagramApp\Model\User\Collection\UsersSearch;
use InstagramApp\Model\User\UserExtendedEntity;
use InstagramApp\Request\Interfaces\UserResource;

/**
 * Class User
 * @package InstagramApp\Request
 */
class User extends Request implements UserResource
{
    private const ACTION_SEARCH       = 'search';
    private const ACTION_MEDIA_RECENT = 'media/recent';

    protected $controllerName = 'users';

    /**
     * Search for a user
     *
     * @param string  $name  Instagram username
     * @param integer $limit Limit of returned results [optional]
     *
     * @return UsersSearch
     */
    public function searchUser(string $name, int $limit = 10): UsersSearch
    {
        $params = ['q' => $name, 'count' => $limit];

        return new UsersSearch($this->makeRequest(self::ACTION_SEARCH, $params));
    }

    /**
     * Get user info
     *
     * @param integer [optional] $id Instagram user ID
     *
     * @return UserExtendedEntity
     */
    public function getUser(int $id = 0): UserExtendedEntity
    {
        $id = $this->resolveUserId($id);

        return new UserExtendedEntity($this->makeRequest($id, []));
    }

    /**
     * Get user activity feed
     *
     * @param int $id
     * @param int $limit
     *
     * @return MediaCollection
     */
    public function getUserRecentMedia(int $id = 0, $limit = 0): MediaCollection
    {
        $id       = $this->resolveUserId($id);
        $action   = $id . '/' . self::ACTION_MEDIA_RECENT;
        $response = $this->makeRequest($action, ['count' => $limit]);

        return new MediaCollection($response);
    }
}

<?php

namespace InstagramApp\Request;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\User\Like\UsersLikeCollection;

/**
 * Class Likes
 * @package InstagramApp\Request
 */
class Likes extends Media
{
    private const ACTION_LIKES = 'likes';

    /**
     * Get a list of users who have liked this media
     *
     * @param int $id Instagram media ID
     *
     * @return UsersLikeCollection
     */
    public function getMediaLikes(int $id): UsersLikeCollection
    {
        $str      = $id . '/' . self::ACTION_LIKES;
        $response = $this->makeRequest($str, true);

        return new UsersLikeCollection($response);
    }

    /**
     * Set user like on a media
     *
     * @param int $id Instagram media ID
     *
     * @return bool
     */
    public function likeMedia(int $id)
    {
        $action   = $id . self::ACTION_LIKES;
        $response = $this->makeRequest($action, true, [], Requester::REQUEST_TYPE_POST);

        return $response['code'] == self::RESPONSE_CODE_COMPLETED;
    }

    /**
     * Remove user like on a media
     *
     * @param int $id Instagram media ID
     *
     * @return bool
     */
    public function deleteLikedMedia(int $id)
    {
        $action   = $id . self::ACTION_LIKES;
        $response = $this->makeRequest($action, true, [], Requester::REQUEST_TYPE_DELETE);

        return $response['code'] == self::RESPONSE_CODE_COMPLETED;
    }
}

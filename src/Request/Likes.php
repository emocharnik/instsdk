<?php

namespace InstagramApp\Request;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\User\Like\UsersLikeCollection;
use InstagramApp\Request\Interfaces\LikesResource;

/**
 * Class Likes
 * @package InstagramApp\Request
 */
class Likes extends Media implements LikesResource
{
    private const ACTION_LIKES = 'likes';

    /**
     * Get a list of users who have liked this media
     *
     * @param string $id Instagram media ID
     *
     * @return UsersLikeCollection
     */
    public function getMediaLikes(string $id): UsersLikeCollection
    {
        $str      = $id . '/' . self::ACTION_LIKES;
        $response = $this->makeRequest($str);

        return new UsersLikeCollection($response);
    }

    /**
     * Set user like on a media
     *
     * @param string $id Instagram media ID
     *
     * @return bool
     */
    public function likeMedia(string $id): bool
    {
        $action   = $id . '/' . self::ACTION_LIKES;
        $response = $this->makeRequest($action, [], Requester::REQUEST_TYPE_POST);

        return $response['meta']['code'] == self::RESPONSE_CODE_COMPLETED;
    }

    /**
     * Remove user like on a media
     *
     * @param string $id Instagram media ID
     *
     * @return bool
     */
    public function deleteLikedMedia(string $id): bool
    {
        $action   = $id . '/' . self::ACTION_LIKES;
        $response = $this->makeRequest($action, [], Requester::REQUEST_TYPE_DELETE);

        return $response['meta']['code'] == self::RESPONSE_CODE_COMPLETED;
    }
}

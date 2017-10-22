<?php

namespace InstagramApp\Request\Interfaces;

use InstagramApp\Model\User\Like\UsersLikeCollection;

/**
 * Interface LikesResource
 * @package InstagramApp\Request\Interfaces
 */
interface LikesResource
{
    /**
     * Get a list of users who have liked this media
     *
     * @param int $id Instagram media ID
     *
     * @return UsersLikeCollection
     */
    public function getMediaLikes(int $id): UsersLikeCollection;

    /**
     * Set user like on a media
     *
     * @param int $id Instagram media ID
     *
     * @return bool
     */
    public function likeMedia(int $id): bool;

    /**
     * Remove user like on a media
     *
     * @param int $id Instagram media ID
     *
     * @return bool
     */
    public function deleteLikedMedia(int $id): bool;
}

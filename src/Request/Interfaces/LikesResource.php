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
     * @param string $id Instagram media ID
     *
     * @return UsersLikeCollection
     */
    public function getMediaLikes(string $id): UsersLikeCollection;

    /**
     * Set user like on a media
     *
     * @param string $id Instagram media ID
     *
     * @return bool
     */
    public function likeMedia(string $id): bool;

    /**
     * Remove user like on a media
     *
     * @param string $id Instagram media ID
     *
     * @return bool
     */
    public function deleteLikedMedia(string $id): bool;
}

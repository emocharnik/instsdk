<?php

namespace InstagramApp\Request\Interfaces;

use InstagramApp\Request\Auth;
use InstagramApp\Request\Likes;
use InstagramApp\Request\Media;
use InstagramApp\Request\User;

/**
 * Interface RequestsInterface
 * @package InstagramApp\Request\Interfaces
 */
interface RequestsInterface
{
    /**
     * @return Auth
     */
    public function getAuth(): Auth;

    /**
     * @return Likes
     */
    public function getLikes(): Likes;

    /**
     * @return Media
     */
    public function getMedia(): Media;

    /**
     * @return User
     */
    public function getUser(): User;
}

<?php

namespace InstagramApp\Request\Interfaces;

/**
 * Interface RequestsInterface
 * @package InstagramApp\Request\Interfaces
 */
interface RequestsInterface
{
    /**
     * @return LikesResource
     */
    public function getLikes(): LikesResource;

    /**
     * @return MediaResource
     */
    public function getMedia(): MediaResource;

    /**
     * @return UserResource
     */
    public function getUser(): UserResource;
}

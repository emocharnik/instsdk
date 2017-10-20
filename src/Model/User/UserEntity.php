<?php

namespace InstagramApp\Model\User;

use InstagramApp\Core\InstagramException;
use InstagramApp\Model\User\Marked\UserMarkedEntity;

/**
 * Class Current
 * @package InstagramApp\Model\User
 */
class UserEntity extends UserMarkedEntity
{
    /** @var string */
    protected $bio;

    /** @var string */
    protected $website;

    /** @var UserCommonStatEntity */
    protected $counts;

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * @param string $bio
     */
    public function setBio(string $bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * @return UserCommonStatEntity
     */
    public function getCounts(): UserCommonStatEntity
    {
        return $this->counts;
    }

    /**
     * @param UserCommonStatEntity | array $counts
     *
     * @throws InstagramException
     */
    public function setCounts($counts)
    {
        if (!$counts instanceof UserCommonStatEntity) {
            if (is_array($counts)) {
                $counts = new UserCommonStatEntity($counts);
            } else {
                throw new InstagramException('Unexpected variable type');
            }
        }

        $this->counts = $counts;
    }
}

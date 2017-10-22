<?php

namespace InstagramApp\Model\User\Caption;

use DateTime;
use InstagramApp\Model\AbstractModel;

/**
 * Class MediaCaptionEntity
 * @package InstagramApp\Model\User\Caption
 */
class MediaCaptionEntity extends AbstractModel
{
    /** @var string */
    protected $id;

    /** @var DateTime */
    protected $created_time;

    /** @var string */
    protected $text;

    /** @var UserFromEntity */
    protected $from;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedTime(): DateTime
    {
        return $this->created_time;
    }

    /**
     * @param DateTime | int $createdTime
     */
    public function setCreatedTime($createdTime)
    {
        if (is_int($createdTime)) {
            $createdTime = new DateTime(date(DateTime::ISO8601, $createdTime));
        }

        $this->created_time = $createdTime;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return UserFromEntity
     */
    public function getFrom(): UserFromEntity
    {
        return $this->from;
    }

    /**
     * @param UserFromEntity | array $from
     */
    public function setFrom($from)
    {
        if (!$from instanceof UserFromEntity) {
            $from = new UserFromEntity($from);
        }

        $this->from = $from;
    }
}

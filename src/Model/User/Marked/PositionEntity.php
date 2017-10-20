<?php

namespace InstagramApp\Model\User\Marked;

use InstagramApp\Model\AbstractModel;

/**
 * Class PositionEntity
 * @package InstagramApp\Model\User\Marked
 */
class PositionEntity extends AbstractModel
{
    /** @var float */
    protected $x;

    /** @var float */
    protected $y;

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @param float $x
     */
    public function setX(float $x)
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     */
    public function setY(float $y)
    {
        $this->y = $y;
    }
}

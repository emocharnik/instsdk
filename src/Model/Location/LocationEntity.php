<?php

namespace InstagramApp\Model\Location;

use InstagramApp\Model\AbstractModel;

/**
 * Class LocationEntity
 * @package InstagramApp\Model\Location
 */
class LocationEntity extends AbstractModel
{
    /** @var string */
    protected $id;

    /** @var float */
    protected $latitude;

    /** @var float */
    protected $longitude;

    /** @var string */
    protected $name;

    /** @var string */
    protected $street_address;

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
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getStreetAddress(): string
    {
        return $this->street_address;
    }

    /**
     * @param string $streetAddress
     */
    public function setStreetAddress(string $streetAddress)
    {
        $this->street_address = $streetAddress;
    }
}

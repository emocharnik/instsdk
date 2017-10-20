<?php

namespace InstagramApp\Model;

use InstagramApp\Core\Interfaces\ArraySerializableInterface;

/**
 * Class AbstractModel
 * @package InstagramApp\Model
 */
abstract class AbstractModel implements ArraySerializableInterface
{
    const PREFIX_GET = 'get';
    const PREFIX_SET = 'set';

    /**
     * AbstractModel constructor.
     *
     * @param mixed $data
     */
    public function __construct($data = [])
    {
        $this->exchangeArray($data);
    }

    /**
     * Exchange internal values from provided array
     *
     * @param  array $array
     *
     * @return void
     */
    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            $methodName = static::sanitizeKey($key);

            if (method_exists($this, $methodName)) {
                $this->{$methodName}($value);
            } else {
                $this->$key = $value;
            }
        }
    }

    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        // NOTE: DO nothing when property does not exists
    }

    /**
     * @param string $key
     * @param string $prefix
     *
     * @return string
     */
    protected function sanitizeKey($key, $prefix = self::PREFIX_SET)
    {
        return $prefix . str_replace('_', '', ucwords($key, '_'));
    }
}

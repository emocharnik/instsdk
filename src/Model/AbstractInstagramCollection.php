<?php

namespace InstagramApp\Model;

/**
 * Class AbstractInstagramCollection
 * @package InstagramApp\Model
 */
abstract class AbstractInstagramCollection extends AbstractModel
{
    /**
     * @param array $data
     */
    abstract public function append(array $data);

    /**
     * @param array $array
     */
    public function exchangeArray(array $array)
    {
        foreach ($array['data'] as $item) {
            $this->append($item);
        }
    }
}

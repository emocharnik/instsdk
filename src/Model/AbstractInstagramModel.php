<?php

namespace InstagramApp\Model;

/**
 * Class AbstractInstagramResponse
 * @package InstagramApp
 */
abstract class AbstractInstagramModel extends AbstractModel
{
    /**
     * @param array $array
     */
    public function exchangeArray(array $array)
    {
        if (isset($array['data']) && is_array($array['data'])) {
            $array = $array['data'];
        }

        parent::exchangeArray($array);
    }
}

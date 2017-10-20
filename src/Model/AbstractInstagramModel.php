<?php

namespace InstagramApp\Model\Response;

use InstagramApp\Model\AbstractModel;

/**
 * Class AbstractInstagramResponse
 * @package InstagramApp\Response
 */
abstract class AbstractInstagramModel extends AbstractModel
{
    /**
     * @param array $array
     */
    public function exchangeArray(array $array)
    {
        parent::exchangeArray($array['data']);
    }
}

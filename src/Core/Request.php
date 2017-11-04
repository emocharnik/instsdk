<?php

namespace InstagramApp\Core;

use InstagramApp\Core\Interfaces\Requester;

/**
 * Class Request
 * @package InstagramApp\Core
 */
abstract class Request
{
    const RESPONSE_CODE_COMPLETED = 200;

    private const ID_SELF = 'self';

    /** @var string */
    protected $controllerName;

    /** @var Requester */
    protected $requester;

    /**
     * Default constructor
     *
     * @param Requester $requester
     */
    public function __construct(Requester $requester)
    {
        $this->setRequester($requester);
    }

    /**
     * @param mixed  $action
     * @param array  $params
     * @param string $method
     *
     * @return array
     */
    public function makeRequest($action, array $params = [], string $method = Requester::REQUEST_TYPE_GET): array
    {
        $controllerAction = $this->getController() . '/' . $action;

        return $this->getRequester()->makeRequest($controllerAction, $method, $params);
    }

    /**
     * @return string
     * @throws InstagramException
     */
    public function getController(): string
    {
        if (!$this->controllerName) {
            throw new InstagramException('Controller should be defined');
        }

        return $this->controllerName;
    }

    /**
     * @return Requester
     * @throws InstagramException
     */
    protected function getRequester(): Requester
    {
        if (!$this->requester) {
            throw new InstagramException(Requester::class . ' should be injected');
        }

        return $this->requester;
    }

    /**
     * @param Requester $requester
     */
    public function setRequester(Requester $requester)
    {
        $this->requester = $requester;
    }

    /**
     * @param $id
     *
     * @return string
     */
    protected function resolveUserId($id): string
    {
        if ($id === 0) {
            $id = self::ID_SELF;
        }

        return $id;
    }
}

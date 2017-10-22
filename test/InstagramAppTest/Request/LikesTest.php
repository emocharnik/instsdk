<?php

namespace InstagramAppTest\Request;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\BaseConfig;
use InstagramApp\Model\User\Like\UserLikeEntity;
use InstagramApp\Model\User\Like\UsersLikeCollection;
use InstagramApp\Request\Likes;
use PHPUnit\Framework\TestCase;

/**
 * Class LikesTest
 * @package InstagramAppTest\Request
 */
class LikesTest extends TestCase
{
    public function testGetMediaLikes()
    {
        $id = 1;

        $user = [
            'id'         => $id,
            'username'   => 'username',
            'first_name' => 'First',
            'last_name'  => 'Last',
            'type'       => 'type',
        ];

        $users = ['data' => [$user]];

        $config    = $this->createMock(BaseConfig::class);
        $requester = $this->createMock(Requester::class);
        $action    = $id . '/likes';
        $auth      = true;
        $params    = [];

        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($action, 'GET', $auth, $params)
            ->willReturn($users);

        $resource = new Likes($config, $requester);
        $likes    = $resource->getMediaLikes($id);

        $this->assertInstanceOf(UsersLikeCollection::class, $likes);
        $this->assertCount(count($users['data']), $likes);

        foreach ($likes->getUsers() as $like) {
            $this->assertInstanceOf(UserLikeEntity::class, $like);
        }
    }

    public function testLikeMedia()
    {
        $id = 1;

        $response = ['meta' => ['code' => 200]];

        $config    = $this->createMock(BaseConfig::class);
        $requester = $this->createMock(Requester::class);
        $action    = $id . '/likes';
        $auth      = true;
        $params    = [];

        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($action, 'POST', $auth, $params)
            ->willReturn($response);

        $resource = new Likes($config, $requester);
        $likes    = $resource->likeMedia($id);

        $this->assertTrue($likes);
    }

    public function testDeleteLikeMedia()
    {
        $id = 1;

        $response = ['meta' => ['code' => 200]];

        $config    = $this->createMock(BaseConfig::class);
        $requester = $this->createMock(Requester::class);
        $action    = $id . '/likes';
        $auth      = true;
        $params    = [];

        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($action, 'DELETE', $auth, $params)
            ->willReturn($response);

        $resource = new Likes($config, $requester);
        $likes    = $resource->deleteLikedMedia($id);

        $this->assertTrue($likes);
    }
}

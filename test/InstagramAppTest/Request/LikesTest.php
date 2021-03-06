<?php

namespace InstagramAppTest\Request;

use InstagramApp\Core\Interfaces\Requester;
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
        $id     = 1;
        $action = 'media/' . $id . '/likes';
        $params = [];

        $user = [
            'id'         => $id,
            'username'   => 'username',
            'first_name' => 'First',
            'last_name'  => 'Last',
            'type'       => 'type',
        ];

        $users = ['data' => [$user]];

        /** @var Requester | \PHPUnit_Framework_MockObject_MockObject $requester */
        $requester = $this->createMock(Requester::class);
        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($action, 'GET', $params)
            ->willReturn($users);

        $resource = new Likes($requester);
        $likes    = $resource->getMediaLikes($id);

        $this->assertInstanceOf(UsersLikeCollection::class, $likes);
        $this->assertCount(count($users['data']), $likes);

        foreach ($likes->getUsers() as $like) {
            $this->assertInstanceOf(UserLikeEntity::class, $like);
        }
    }

    public function testLikeMedia()
    {
        $id     = 1;
        $action = 'media/' . $id . '/likes';
        $params = [];

        $response = ['meta' => ['code' => 200]];

        /** @var Requester | \PHPUnit_Framework_MockObject_MockObject $requester */
        $requester = $this->createMock(Requester::class);
        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($action, 'POST', $params)
            ->willReturn($response);

        $resource = new Likes($requester);
        $likes    = $resource->likeMedia($id);

        $this->assertTrue($likes);
    }

    public function testDeleteLikeMedia()
    {
        $id       = 1;
        $action   = 'media/' . $id . '/likes';
        $params   = [];
        $response = ['meta' => ['code' => 200]];

        /** @var Requester | \PHPUnit_Framework_MockObject_MockObject $requester */
        $requester = $this->createMock(Requester::class);
        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($action, 'DELETE', $params)
            ->willReturn($response);

        $resource = new Likes($requester);
        $likes    = $resource->deleteLikedMedia($id);

        $this->assertTrue($likes);
    }
}

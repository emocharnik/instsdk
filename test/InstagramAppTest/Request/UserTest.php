<?php

namespace InstagramAppTest\Request;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\User\UserExtendedEntity;
use InstagramApp\Request\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package InstagramAppTest\Request
 */
class UserTest extends TestCase
{
    public function testGetUser()
    {
        $id     = 1;
        $action = 'users/' . $id;

        $response = [
            'id'              => $id,
            'username'        => 'username',
            'profile_picture' => 'https://pic.org/link',
            'full_name'       => 'First Last',
            'bio'             => 'Bio',
            'counts'          => [
                'media'       => 1,
                'follows'     => 1,
                'followed_by' => 1,
            ],
        ];

        /** @var Requester | \PHPUnit_Framework_MockObject_MockObject $requester */
        $requester = $this->createMock(Requester::class);
        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($action, 'GET', [])
            ->willReturn(['data' => $response]);

        $resource = new User($requester);
        $user     = $resource->getUser($id);

        $this->assertInstanceOf(UserExtendedEntity::class, $user);
        $this->assertEquals($id, $user->getId());
    }

    public function testGetUserSelf()
    {
        $response = [
            'username'        => 'username',
            'profile_picture' => 'https://pic.org/link',
            'full_name'       => 'First Last',
            'bio'             => 'Bio',
            'counts'          => [
                'media'       => 1,
                'follows'     => 1,
                'followed_by' => 1,
            ],
        ];

        /** @var Requester | \PHPUnit_Framework_MockObject_MockObject $requester */
        $requester = $this->createMock(Requester::class);
        $requester->expects($this->once())
            ->method('makeRequest')
            ->with('users/self', 'GET', [])
            ->willReturn(['data' => $response]);

        $resource = new User($requester);

        $user = $resource->getUser();

        $this->assertInstanceOf(UserExtendedEntity::class, $user);
    }
}

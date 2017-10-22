<?php

namespace InstagramAppTest\Request;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\BaseConfig;
use InstagramApp\Model\Media\Collection\MediaCollection;
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
        $id = 1;

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

        $config = $this->createMock(BaseConfig::class);

        $requester = $this->createMock(Requester::class);
        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($id, 'GET', false, [])
            ->willReturn(['data' => $response]);

        $resource = new User($config, $requester);
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

        $token  = 'token';
        $config = $this->createMock(BaseConfig::class);

        $requester = $this->createMock(Requester::class);
        $requester->expects($this->once())
            ->method('makeRequest')
            ->with('self', 'GET', true, [])
            ->willReturn(['data' => $response]);

        $resource = new User($config, $requester);
        $resource->setAccessToken($token);

        $user = $resource->getUser();

        $this->assertInstanceOf(UserExtendedEntity::class, $user);
    }
}

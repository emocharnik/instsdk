<?php

namespace InstagramAppTest\Request;

use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\BaseConfig;
use InstagramApp\Model\User\Login\LoginDataEntity;
use InstagramApp\Request\Auth;

use PHPUnit\Framework\TestCase;

/**
 * Class AuthTest
 * @package InstagramAppTest\Request
 */
class AuthTest extends TestCase
{
    /**
     * @expectedException \InstagramApp\Core\InstagramException
     */
    public function testGetLoginLinkException()
    {
        /** @var Requester $requester */
        /** @var BaseConfig $config */

        $scope = ['undefined'];

        $requester = $this->createMock(Requester::class);
        $config    = $this->createMock(BaseConfig::class);

        $resource = new Auth($config, $requester);
        $resource->getLoginUrl($scope);
    }

    public function testGetLoginLink()
    {
        /** @var Requester $requester */
        /** @var BaseConfig | \PHPUnit_Framework_MockObject_MockObject $config */

        $apiKey      = 'API_KEY';
        $callbackUrl = 'CALLBACK_URL';
        $expectedUrl = 'https://api.instagram.com/oauth/authorize?client_id=API_KEY&redirect_uri=CALLBACK_URL' .
            '&scope=basic&response_type=code';

        $requester = $this->createMock(Requester::class);
        $config    = $this->createMock(BaseConfig::class);

        $config->expects($this->once())->method('getApiKey')->willReturn($apiKey);
        $config->expects($this->once())->method('getApiCallback')->willReturn($callbackUrl);

        $resource = new Auth($config, $requester);
        $url      = $resource->getLoginUrl();
        $this->assertEquals($expectedUrl, $url, 'Url does not match expected value');
    }

    public function testLogin()
    {
        /** @var Requester | \PHPUnit_Framework_MockObject_MockObject $requester */
        /** @var BaseConfig $config */

        $apiData = [];

        $token    = 'token';
        $userId   = 1;
        $loginUrl = 'https://api.instagram.com/oauth/access_token';

        $response = [
            'access_token' => $token,
            'user'         => [
                'id' => $userId,
            ],
        ];

        $config    = $this->createMock(BaseConfig::class);
        $requester = $this->createMock(Requester::class);
        $requester->expects($this->once())->method('login')->with($loginUrl, $apiData)->willReturn($response);

        $resource = new Auth($config, $requester);
        $userData = $resource->login($apiData);

        $this->assertInstanceOf(LoginDataEntity::class, $userData);
        $this->assertEquals($token, $userData->getAccessToken());
        $this->assertEquals($userId, $userData->getUser()->getId());
    }
}

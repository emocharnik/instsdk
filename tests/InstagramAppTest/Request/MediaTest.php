<?php

namespace InstagramAppTest\Request;

use DateTime;
use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\Media\UserMedia;
use InstagramApp\Request\Media;
use PHPUnit\Framework\TestCase;

/**
 * Class MediaTest
 * @package InstagramAppTest\Request
 */
class MediaTest extends TestCase
{
    public function testGetMedia()
    {
        $id     = '1';
        $action = 'media/' . $id;
        $link   = 'https://instagram.com/medialink';
        $date   = new DateTime();

        $userMedia = [
            'id'           => $id,
            'link'         => $link,
            'created_time' => $date,
        ];

        $response = ['data' => $userMedia];

        /** @var Requester | \PHPUnit_Framework_MockObject_MockObject $requester */
        $requester = $this->createMock(Requester::class);

        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($action, 'GET', [])
            ->willReturn($response);

        $resource = new Media($requester);
        $media    = $resource->getMedia($id);

        $this->assertInstanceOf(UserMedia::class, $media);
        $this->assertEquals($id, $media->getId());
    }
}

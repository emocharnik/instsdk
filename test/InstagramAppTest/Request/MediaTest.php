<?php

namespace InstagramAppTest\Request;

use DateTime;
use InstagramApp\Core\Interfaces\Requester;
use InstagramApp\Model\BaseConfig;
use InstagramApp\Model\Media\Collection\MediaCollection;
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
        $id   = 1;
        $link = 'https://instagram.com/medialink';
        $date = new DateTime();

        $userMedia = [
            'id'           => $id,
            'link'         => $link,
            'created_time' => $date,
        ];

        $response = ['data' => [$userMedia]];

        $config    = $this->createMock(BaseConfig::class);
        $requester = $this->createMock(Requester::class);

        $requester->expects($this->once())
            ->method('makeRequest')
            ->with($id, 'GET', true, [])
            ->willReturn($response);

        $resource = new Media($config, $requester);
        $media    = $resource->getMedia($id);

        $this->assertInstanceOf(MediaCollection::class, $media);
        $this->assertCount(count($response['data']), $media);

        foreach ($media as $mediaItem) {
            $this->assertInstanceOf(UserMedia::class, $mediaItem);
        }
    }
}

<?php
$config = [
    'apiKey'      => 'key',
    'apiSecret'   => 'secret',
    'apiCallback' => 'https://yourexample.com/callback',
];

//this token you received on creation step
$token = 'your_access_token';

$resources     = \InstagramApp\Factory\InstagramAppFactory::createResources($config, $token);
$mediaResource = $resources->getMedia();

$media        = $mediaResource->getMedia("1");
$popularMedia = $mediaResource->getPopularMedia('shortCode');
$searchMedia  = $mediaResource->searchMedia(1.2, 3.4);


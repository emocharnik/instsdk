<?php
$config = [
    'apiKey'      => 'key',
    'apiSecret'   => 'secret',
    'apiCallback' => 'https://yourexample.com/callback',
];

//this token you received on creation step
$token = 'your_access_token';

$resources    = \InstagramApp\Factory\InstagramAppFactory::createResources($config, $token);
$userResource = $resources->getUser();

$you       = $userResource->getUser();
$otherUser = $userResource->getUser(1);
$userMedia = $userResource->getUserRecentMedia(1, 5);
$users     = $userResource->searchUser('username', 10);

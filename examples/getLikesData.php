<?php
$config = [
    'apiKey'      => 'key',
    'apiSecret'   => 'secret',
    'apiCallback' => 'https://yourexample.com/callback',
];

//this token you received on creation step
$token = 'your_access_token';

$resources     = \InstagramApp\Factory\InstagramAppFactory::createResources($config, $token);
$likesResource = $resources->getLikes();

$liked   = $likesResource->likeMedia("1");
$unLiked = $likesResource->deleteLikedMedia("1");
$likes   = $likesResource->getMediaLikes("1");

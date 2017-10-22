<?php
$config = [
    'apiKey'      => 'key',
    'apiSecret'   => 'secret',
    'apiCallback' => 'https://yourexample.com/callback',
];

$authorization = \InstagramApp\Factory\InstagramAppFactory::getAuthResource($config);

//Your user has to click on this url.
// He will be redirected to Instagram authorization service which returns authorization code you need to send below.
$loginUrl = $authorization->getLoginUrl();

$code = 'receivedAuthorizationCodeFromInstagram';

$loginData = $authorization->login($code);

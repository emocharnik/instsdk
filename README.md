# Installation guide

## General info
This is SDK which can help you easely manipulate with Instagram API. 

There are implemented 4 sections to communicate with some endpoint of social network: Auth, Likes, Media and Users.

## Installation
This is only very begining of this package, so if you want to install it run 
* `composer require emocharnik/instsdk "dev-master"`

### Requirements
* PHP: >= 7.1
* ext-curl: "*",
* php-curl-class/php-curl-class: "^7.3"

## Basic Usage
1. First of all you have to create your API client here:
 * https://www.instagram.com/developer/
2. Then you have to create your own configrutation file. Library requires 3 basic fields:
* `apiKey`
* `apiSecret`
* `callbackUrl`
3. Then you need to create access token to communicate with Instagram API. To do it call `InstagramAppFactory::getAuthResource(array $config)`.
You will get authrization resource with to general methods: `getLoginUrl()` and `login()`. The last one will return data about the user and its access token. 
*[Example how to create access token](https://github.com/emocharnik/instsdk/blob/master/examples/createtoken.php)*

*Note: more info how it works you can get there: https://www.instagram.com/developer/authentication/*

4. Now received access token you can use in other resources. To get them call `InstagramAppFactory::createResources(array $config, $token)`.
5. You can easely extend library with your own resources. If want to do so extend a `InstagramApp` and `Request` classes. 
6. For more detailed information how to use library look for [examples](https://github.com/emocharnik/instsdk/tree/master/examples)

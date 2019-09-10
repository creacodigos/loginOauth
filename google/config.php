<?php
require_once '../config.php';
require_once 'google-api-php-client/vendor/autoload.php';

$client = new Google_Client();

$client->setApplicationName("Login with Google Account using PHP");

$client->setClientId(GO_APP_ID);
$client->setClientSecret(GO_APP_SECRET);
$client->setRedirectUri(GO_REDIRECT_URL);

$client->addScope([Google_Service_Oauth2::PLUS_LOGIN,Google_Service_Oauth2::USERINFO_EMAIL]);
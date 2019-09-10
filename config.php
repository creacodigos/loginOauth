<?php

// Facebook API configuration
define('FB_APP_ID', 'XXXXXXX');
define('FB_APP_SECRET', 'YYYYYYYYY');
define('FB_REDIRECT_URL', 'http://localhost:8888/loginOauth/facebook/');

// Google API configuration
define('GO_APP_ID', 'XXXXX-yyyy.apps.googleusercontent.com');
define('GO_APP_SECRET', 'SSD-ZZZZ');
define('GO_REDIRECT_URL', 'http://localhost:8888/loginOauth/google/');

// Start session
if(!session_id())
    session_start();


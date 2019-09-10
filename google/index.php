<?php

require_once 'config.php';

if(isset($_SESSION['accessToken']))
{
    $client->setAccessToken($_SESSION['accessToken']);
}
else if(isset($_GET['code']))
{
    $access_token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['accessToken'] = $access_token;
}
else{
    
    $authUrl = $client->createAuthUrl();
    header('location:'.$authUrl);
    exit;
}

    $oauth = new Google_Service_Oauth2($client);

    $user = $oauth->userinfo->get();

    // Getting user's profile data
    $userData               = array();
    $userData['red']        = 'google';
    $userData['id']         = $user['id'];
    $userData['first_name'] = $user['givenName'];
    $userData['last_name']  = $user['familyName'];
    $userData['name']       = $userData['first_name'].' '.$userData['last_name'];
    $userData['email']      = $user['email'];
    $userData['picture']    = $user['picture'];

    $_SESSION['userData']   = $userData;


// Compruebo que existe la sesión userData con email
if(!empty($_SESSION['userData']['email']))
    header("Location: ../");
    else
        {
            echo '<h1>Error inesperado</h1>';

            if(!empty($_SESSION['userData']))
            {            
                echo '<pre>$_SESSION[userData]: ';
                    print_r($_SESSION['userData']);
                echo '</pre>';
            }
        }
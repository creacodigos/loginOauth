<?php

require_once 'config.php';

if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Put short-lived access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
        // OAuth 2.0 client handler helps to manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Set default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    // Redirect the user back to the same page if url has "code" parameter in query string
    if(isset($_GET['code'])){
        header('Location: ./');
    }
    
    // Getting user's profile info from Facebook
    try {
        $graphResponse = $fb->get('/me?fields=name,first_name,last_name,email,picture');
        $fbUser = $graphResponse->getGraphUser();
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        exit;
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
        
    // Getting user's profile data
    $userData               = array();
    $userData['red']        = 'facebook';
    $userData['id']         = !empty($fbUser['id'])?$fbUser['id']: '';
    $userData['first_name'] = !empty($fbUser['first_name'])?$fbUser['first_name']: '';
    $userData['last_name']  = !empty($fbUser['last_name'])?$fbUser['last_name']: '';
    $userData['name']       = $userData['first_name'].' '.$userData['last_name'];
    $userData['email']      = !empty($fbUser['email'])?$fbUser['email']: '';
    $userData['picture']    = !empty($fbUser['picture']['url'])?$fbUser['picture']['url']: '';
    
    $_SESSION['userData']   = $userData;
    
    // Get logout url
    //$logoutURL = $helper->getLogoutUrl($accessToken, FB_REDIRECT_URL.'logout.php');
    $logoutURL = 'logout.php';
    
}else{
    // Get login url
    $permissions = ['email']; // Optional permissions
    $loginURL = $helper->getLoginUrl(FB_REDIRECT_URL, $permissions);
    
    // Render Facebook login button
    header('location:'.$loginURL);
}

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
            if(!empty($fbUser))
            {            
                echo '<pre>$fbUser: ';
                    print_r($fbUser);
                echo '</pre>';
            }
        }
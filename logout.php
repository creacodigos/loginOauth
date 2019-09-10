<?php

session_start();

// Facebook
unset($_SESSION['FBRLH_state']);
unset($_SESSION['facebook_access_token']);
unset($_SESSION['userDataFB']);

// Google
unset($_SESSION['accessToken']);
unset($_SESSION['userDataGO']);

// Remove user data from session
unset($_SESSION['userData']);

// Redirect to the homepage
header("Location:index.php");
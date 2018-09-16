<?php

  // Include Google API client library
  require_once 'google-api-php-client/src/Google_Client.php';
  require_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';

  //  Configuration and setup Google API
  $clientId = '529584455306-79vtn64kspen4tcbmt2e7e3gge5c5c4b.apps.googleusercontent.com'; 
  $clientSecret = '1ydzZ3tMmw9-hkxGv2j5T_Ja'; 
  $redirectURL = 'http://localhost/HeirloomNation/login.php'; //Callback URL

  // Call Google API
  $gClient = new Google_Client();
  $gClient->setApplicationName('Login to HeirloomNation');
  $gClient->setClientId($clientId);
  $gClient->setClientSecret($clientSecret);
  $gClient->setRedirectUri($redirectURL);
  $google_oauthV2 = new Google_Oauth2Service($gClient);
  $authUrl = $gClient->createAuthUrl();

  if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
  }

  if(isset($_SESSION['token'])){
    $gClient->setAccessToken($_SESSION['token']);
  }
?>
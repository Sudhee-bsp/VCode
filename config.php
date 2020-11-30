<?php

require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("317328162136-mqmv979b5g60ouodk48885mlkls1nmit.apps.googleusercontent.com");
$gClient->setClientSecret("zykxd8cSpdh5SRTedOF0xPk3");
$gClient->setApplicationName("VQuiz");
$gClient->setRedirectUri("http://localhost/Vquiz/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// login URL
$login_url = $gClient->createAuthUrl();

?>
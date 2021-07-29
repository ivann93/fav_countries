<?php 
// loading important files for application

// starting session
session_start();

// error disabling
error_reporting(E_ALL);

// including config variables and database classes
include('includes/config.php');
include('classes/DBClass.php');
include('classes/UserAuthClass.php');
include('classes/CountryClass.php');

// initialzing classes
$dbClass = new DbClass();
$userAuthClass = new UserAuthClass();
$countryClass = new CountryClass();


?>
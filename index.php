<?php
ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
//Base url of application
$ROOT['BASE_URL'] = '';

//Root of system file
include("System/FrameworkV.php");

//Initialize Framwork
new FrameworkV();


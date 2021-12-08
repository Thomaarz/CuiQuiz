<?php
@ini_set('display_errors', 'on');

// Start session
session_start();

// Init Connection
include "Connection.php";
Connection::initConnection();

// Modules
include "modules/Controller.php";

$controller = new Controller();
$controller->test();

?>
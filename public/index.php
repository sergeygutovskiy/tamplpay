<?php
require "app/db.php";


// print_r($_SERVER);

session_start();

DB::setup("localhost", "root", "root", "tamplpay2");

$route =  $_SERVER["REQUEST_URI"];

function isGet() { return $_SERVER["REQUEST_METHOD"] == "GET"; }
function isPost() { return $_SERVER["REQUEST_METHOD"] == "POST"; }

if ($route == "/register" && isGet())
{
	require_once "app/controllers/userController.php";
	register();
}

else if ($route == "/register" && isPost())
{
	require "app/controllers/userController.php";
	create();
}

?>
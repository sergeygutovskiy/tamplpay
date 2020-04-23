<?php
require_once "app/db.php";
require_once "app/auth.php";

require_once "vendor/autoload.php";


// print_r($_SERVER);

session_start();

// DB::setup("localhost", "root", "root", "tamplpay2");
DB::setup("eu-cdbr-west-03.cleardb.net", "bd387d086d00f2", "c5252877", "heroku_0ff4b9baa3b4647");


$route = explode("?", $_SERVER["REQUEST_URI"]);
if (count($route) > 1)
{
	$query = $route[1];
	$query = explode("&", $query);
	$_QUERY_VARS = [];
	foreach ($query as $q) $_QUERY_VARS[explode("=", $q)[0]] = explode("=", $q)[1];
}	

$route = $route[0];

function isGET() { return $_SERVER["REQUEST_METHOD"] == "GET"; }
function isPOST() { return $_SERVER["REQUEST_METHOD"] == "POST"; }

// $temp = explode("/", $route); 

// if ($temp[1] == "public") 
// {
// 	array_shift($temp);
// 	// array_shift($route);
// 	require implode("/", $temp);
// }

if ($route == "/" && isGET())
{
	Auth::loginBySession();

	require "public/views/index.php";
}

else if ($route == "/register" && isGET())
{
	require "app/controllers/userController.php";

	Auth::loginBySession();
	Auth::onlyQuest();

	register();
}

else if ($route == "/login" && isGET())
{
	require "app/controllers/userController.php";

	Auth::loginBySession();
	Auth::onlyQuest();

	login();
}

else if ($route == "/user" && isGET())
{
	require "app/controllers/userController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	index();
}

else if ($route == "/user/deals" && isGET())
{
	require "app/controllers/userController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	deals();
}

else if ($route == "/user/confirm" && isGET())
{
	require "app/controllers/userController.php";

	Auth::loginBySession();
	Auth::onlyQuest();

	confirm();
}

else if ($route == "/deal/create" && isGET())
{
	require "app/controllers/dealController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	create();
}

else if ($route == "/deal" && isGET() && isset($_QUERY_VARS["deal"]))
{
	require "app/controllers/dealController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	index($_QUERY_VARS["deal"]);
}

else if ($route == "/deal/chat" && isGET() && isset($_QUERY_VARS["deal"]))
{
	require "app/controllers/dealChatController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	index($_QUERY_VARS["deal"]);
}

else if ($route == "/register" && isPOST())
{
	require "app/controllers/userController.php";
	create();
}

else if ($route == "/login" && isPOST())
{
	require "app/controllers/userController.php";
	auth();
}

else if ($route == "/user/confirm" && isPOST())
{
	require "app/controllers/userController.php";
	confirmUserAccount();
}

else if ($route == "/deal/create" && isPOST())
{
	require "app/controllers/dealController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	store();
}

else if ($route == "/deal/accept" && isPOST())
{
	require "app/controllers/dealController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	accept();
}

else if ($route == "/deal/finish" && isPOST())
{
	require "app/controllers/dealController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	finish();
}

else if ($route == "/search/user" && isPOST())
{
	require "app/controllers/searchController.php";
	searchUserByKey();
}

else if ($route == "/deal/chat/message/add" && isPOST())
{
	require "app/controllers/dealChatController.php";

	Auth::loginBySession();
	Auth::onlyAuth();

	store();
}

else 
{
	require "public/views/404.php";
}
?>
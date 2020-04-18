<?php
require_once "app/db.php";


class Auth {
	private static $user = null;

	public static function user() {
		return self::$user;
	}

	public static function isAuth() { return !is_null(self::$user); }
	public static function isQuest() { return is_null(self::$user); }

	public static function login($key, $password) {
		DB::query("SELECT * FROM users WHERE unique_key = ?", [ $key ]);
		$results = DB::results();

		if (count($results) == 0) { return false; }
		else if ($results[0]["password"] != $password) { return false; }
		else 
		{
			self::$user = $results[0];
			return true;
		}
	}

	public static function loginBySession()
	{
		if (isset($_SESSION["key"]) && isset($_SESSION["password"]))
		{
			Auth::login($_SESSION["key"], $_SESSION["password"]);

			if (Auth::isQuest())
			{
				unset($_SESSION["key"]);
				unset($_SESSION["password"]);
			}
		}
	}

	public static function onlyAuth()
	{
		if (self::isQuest())
		{
			header("Location: /login");
		}		
	}

	public static function onlyQuest()
	{
		if (self::isAuth())
		{
			header("Location: /user");
		}		
	}

}

?>
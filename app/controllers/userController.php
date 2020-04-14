<?php


function register()
{
	require_once "public/views/user/register.php";
}

function create()
{
	$email = $_POST["email"];

	DB::query("SELECT * FROM users WHERE email = ?", [ $email ]);
	
	if (count(DB::results()) > 0)
	{
		echo json_encode(array("message" => "Такая почта уже зарегистрированна."));
	} 
	else 
	{
		$hash = md5(rand(0, 1000));
		$uniqueKey = substr((string)time(), 2);

		DB::query("INSERT INTO users (email, unique_key, hash) VALUES(?, ?, ?)", 
			[ $email, $uniqueKey, $hash ]
		);

		echo json_encode(array("message" => "Почта успешно зарегистрирована. На нее отправлено письмо для подтверждения акаунта."));
	}
}


?>
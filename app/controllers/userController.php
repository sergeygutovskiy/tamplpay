<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function register()
{
	require_once "public/views/user/register.php";
}

function login()
{
	require_once "public/views/user/login.php";
}

function create()
{
	$email = $_POST["email"];

	DB::query("SELECT * FROM users WHERE email = ?", [ $email ]);
	
	// print_r(DB::results());

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

		$mail = new PHPMailer(); 		// create a new object
		$mail->IsSMTP(); 				// enable SMTP
		$mail->SMTPDebug = 0; 			// debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; 		// authentication enabled
		$mail->SMTPSecure = 'tls'; 		// secure transfer enabled REQUIRED for Gmail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587; 				// or 587
		$mail->IsHTML(true);
		
		$mail->Username = "sergey.gutovsk@gmail.com";
		$mail->Password = "rbhjdf47rbhjdf47";
		
		$mail->SetFrom("sergey.gutovsk@gmail.com");
		$mail->Subject = "Confirm your account";
		$mail->Body = "Go this link: " . "http://localhost/user/confirm?hash=" . $hash 
			. "&key=" . $uniqueKey;

		// $mail->AddAddress($login);
		$mail->AddAddress("sergey.gutovsk@gmail.com");

		if ($mail->send()) {
			echo json_encode(array("message" => "Почта успешно зарегистрирована. На нее отправлено письмо для подтверждения акаунта."));
		} else {
			echo json_encode(array("message" => "Почта успешно зарегистрирована. Проблема с отправкой письма."));
		}

	}
}

function auth()
{
	$errors = [];

	$email = $_POST["email"];
	$password = $_POST["password"];

	if (strlen($email) == 0)
		$errors["email"] = "Email error";
	
	if (strlen($password) == 0)
		$errors["password"] = "Password error";

	if (count($errors) > 0)
	{
		echo json_encode(array("errors" => $errors));
	}
	else
	{
		$query = "SELECT * FROM users WHERE email = ?";
		DB::query($query, [ $email ]);

		$user = DB::results();
		if (count($user) == 0)
		{
			$errors["email"] = "No such user error";
			echo json_encode(array("errors" => $errors));
		}
		else 
		{
			$user = $user[0];
			
			if ($user["password"] != $password)
			{
				$errors["password"] = "Password is incorrect";
				echo json_encode(array("errors" => $errors));
			}	
			else
			{
				$_SESSION["key"] = $user["unique_key"];
				$_SESSION["password"] = $password;

				echo json_encode(array());
			}
		}
	}
}

function confirm() 
{
	$hash = $_GET["hash"];
	$key = $_GET["key"];

	DB::query("SELECT * FROM users WHERE unique_key = ? AND hash = ?", [ $key, $hash ]);
	$user = DB::results();

	if (count($user) == 0)
	{
		echo "Error";
	} 
	else 
	{
		$user = $user[0];

		require_once "public/views/user/confirm.php";
	}
}

function confirmUserAccount()
{
	$errors = [];

	$key = $_POST["key"];
	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$password = $_POST["password"];
	$passwordConfirm = $_POST["password-confirm"];

	if (strlen($name) == 0)
		$errors["name"] = "Name error";
	if (strlen($surname) == 0)
		$errors["surname"] = "Surname error";
	
	if (strlen($password) == 0)
		$errors["password"] = "Password error";
	else if ($password != $passwordConfirm)
		$errors["passwordConfirm"] = "Passwords not equals error";

	if (count($errors) > 0)
	{
		echo json_encode(array("errors" => $errors));
	}
	else 
	{
		$query = "UPDATE users SET name=?, surname=?, password=? WHERE unique_key=?";
		DB::query($query, [ $name, $surname, $password, $key ]);

		$_SESSION["key"] = $key;
		$_SESSION["password"] = $password;

		$message = 'Создание аккаунта успешео завершено. ';
		$message .= '<a href="/user"> Домой </a>';
		echo json_encode(array("message" => $message));
	}
}

function index()
{
	require_once "public/views/user/index.php";
}

function deals()
{
	$query = "SELECT * FROM deals WHERE seller_id = ? OR buyer_id = ?";
	DB::query($query, [ Auth::user()["id"], Auth::user()["id"] ]);

	$deals = DB::results();

	for ($i = 0; $i < count($deals); $i++)
	{
		if ($deals[$i]["seller_id"] == Auth::user()["id"])
		{
			$query =  "SELECT name, surname FROM users WHERE id = ?";
			DB::query($query, [ $deals[$i]["buyer_id"] ]);

			$deals[$i]["seller"] = Auth::user();
			$deals[$i]["buyer"]  = DB::results()[0];
		}
		else
		{
			$query =  "SELECT * FROM users WHERE id = ?";
			DB::query($query, [ $deals[$i]["seller_id"] ]);

			$deals[$i]["buyer"] = Auth::user();
			$deals[$i]["seller"]  = DB::results()[0];
		}
	}

	// var_dump($deals);

	require_once "public/views/user/deals.php";
}

?>
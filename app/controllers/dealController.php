<?php

function create() 
{
	require_once "public/views/deal/create.php";
}

function store()
{
	$title 		= $_POST["title"];
	$desc 		= $_POST["description"];
	$price 		= $_POST["price"];
	$partnerKey = $_POST["partner"];

	$errors = [];

	if (strlen($title) == 0)
		$errors["title"] = "Title error";
	if (strlen($desc) == 0)
		$errors["description"] = "Desc error";
	if (strlen($price) == 0)
		$errors["price"] = "Price error";

	if (count($errors) > 0)
	{
		echo json_encode(array("errors" => $errors));
	}
	else 
	{

		$query = "SELECT id FROM users WHERE unique_key = ?";
		DB::query($query, [ $partnerKey ]);
		$partnerId = DB::results();

		if (count($partnerId) == 0)
		{
			$errors["partner"] = "User not found";
			echo json_encode(array("errors" => $errors));
		}
		else 
		{
			$partnerId = $partnerId[0]["id"];
			$query  = "INSERT INTO deals (title, description, price, seller_id, buyer_id) ";
			$query .= "VALUES(?, ?, ?, ?, ?)"; 
			DB::query($query, [ $title, $desc, $price, Auth::user()["id"], $partnerId ]);

			echo json_encode(array("dealId" => DB::getLastInsertId()));
		}
	}
}

function index($dealId)
{
	$query =  "SELECT * FROM deals WHERE id = ?";
	DB::query($query, [ $dealId ]);
	$deal = DB::results();

	if (count($deal) == 0)
	{
		header("Location: /404");
	}
	else
	{
		$deal = $deal[0];

		if ($deal["seller_id"] == Auth::user()["id"])
		{
			$query =  "SELECT * FROM users WHERE id = ?";
			DB::query($query, [ $deal["buyer_id"] ]);

			$seller = Auth::user();
			$buyer  = DB::results()[0];
		}
		else
		{
			$query =  "SELECT * FROM users WHERE id = ?";
			DB::query($query, [ $deal["seller_id"] ]);

			$seller = DB::results()[0] ;
			$buyer  = Auth::user();
		}
	
		require_once "public/views/deal/index.php";
	}
}

function accept()
{
	$dealId = $_POST["dealId"];

	$query = "SELECT * FROM deals WHERE id = ?";
	DB::query($query, [ $dealId ]);
	$deal = DB::results();

	if (count($deal) == 0)
	{
		// error
	}
	else
	{
		$deal = $deal[0];

		if ($deal["status"] != 0)
		{
			// error
		}
		else
		{
			if ($deal["buyer_id"] != Auth::user()["id"])
			{
				// error
			}
			else
			{
				$query = "UPDATE deals SET status = 1 WHERE id = ?";
				DB::query($query, [ $dealId ]);
				
				echo json_encode(array("message" => "Yes"));
			}
		}
	} 
}

function finish()
{
	$dealId = $_POST["dealId"];

	$query = "SELECT * FROM deals WHERE id = ?";
	DB::query($query, [ $dealId ]);
	$deal = DB::results();

	if (count($deal) == 0)
	{
		// error
	}
	else
	{
		$deal = $deal[0];

		if ($deal["status"] != 1)
		{
			// error
		}
		else
		{
			if ($deal["buyer_id"] != Auth::user()["id"])
			{
				// error
			}
			else
			{
				$query = "UPDATE deals SET status = 2 WHERE id = ?";
				DB::query($query, [ $dealId ]);
				
				echo json_encode(array("message" => "Yes 2"));
			}
		}
	} 
}

?>
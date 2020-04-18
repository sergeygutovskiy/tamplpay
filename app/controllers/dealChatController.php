<?php

function index($dealId) {

	$userId = Auth::user()["id"];

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
		
		if (!(Auth::user()["id"] == $deal["seller_id"] || Auth::user()["id"] == $deal["buyer_id"]))
		{
			//error
		}
		else
		{
			$query =  "SELECT messages.id, messages.body, users.name as user_name, users.surname as user_surname";
			$query .= " FROM messages JOIN users ON users.id = messages.user_id";
			$query .= " WHERE deal_id = ? ORDER BY created_at ASC";
			
			DB::query($query, [ $dealId ]);
			$messages = DB::results();

			$query = "SELECT id, name, surname FROM users WHERE id = ?";
			if (Auth::user()["id"] == $deal["seller_id"])
				DB::query($query, [ $deal["buyer_id"] ]);
			else
				DB::query($query, [ $deal["seller_id"] ]);

			$partner = DB::results()[0];

			require_once "public/views/deal/chat/index.php";
		}
	}
}

function store() {

	$dealId = $_POST["dealId"];
	$body   = $_POST["body"];

	$query = "SELECT * FROM deals WHERE id = ? AND (seller_id = ? OR buyer_id = ?)";
	DB::query($query, [ $dealId, Auth::user()["id"], Auth::user()["id"] ]);
	$deal = DB::results();

	if (count($deal) == 0)
	{
		// error
	}
	else 
	{
		$query = "INSERT INTO messages (deal_id, user_id, body) VALUES (?, ?, ?)";
		DB::query($query, [ $dealId, Auth::user()["id"], $body ]);

		echo DB::getLastInsertId();
	}
}


?>
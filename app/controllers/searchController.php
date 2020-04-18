<?php

function searchUserBykey() 
{
	$key = $_POST["key"];

	$query = "SELECT name, surname FROM users WHERE unique_key = ?";
	DB::query($query, [ $key ]);
	echo json_encode(DB::results());
}
?>
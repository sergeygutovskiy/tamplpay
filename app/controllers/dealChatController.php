<?php

function index($deal) {

	$dealId = $deal;
	$userId = Auth::user()["id"];

	require_once "public/views/deal/chat/index.php";
}

?>
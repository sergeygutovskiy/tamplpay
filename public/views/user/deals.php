<!DOCTYPE html>
<html>
<head>
	<title>Deals</title>
</head>
<body>
	<?php require "public/layouts/_navigation.php"; ?>
	
	<h1>
		User deals
		<a href="/deal/create">Create</a>
	</h1>
	<?php foreach ($deals as $deal): ?>

	<p><?php echo '<a href="/deal?deal=' . $deal["id"] . '">' . $deal["title"]. '</a>'; ?></p>
	<p>Buyer: <?php echo $deal["buyer"]["name"] . " " . $deal["buyer"]["surname"]; ?></p>
	<p>Seller: <?php echo $deal["seller"]["name"] . " " . $deal["seller"]["surname"]; ?></p>
	<spap>Status: <?php echo $deal["status"]; ?></spap>
	<hr>

	<?php endforeach ?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Account</title>
</head>
<body>
	<?php require "public/layouts/_navigation.php"; ?>
	
	<h1>User account</h1>
	<p>
		<?php echo Auth::user()["name"] . " " . Auth::user()["surname"]; ?>
		<?php echo " #" . Auth::user()["unique_key"]; ?>
	</p>
	<p>
		Email: <?php echo Auth::user()["email"]; ?>
	</p>
</body>
</html>
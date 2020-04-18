<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="http://localhost:8080/socket.io/socket.io.js"></script>
	<script>
		var socket = io.connect('http://localhost:8080', {reconnect: true});
	</script>
</head>
<body>
	<h1>Chat</h1>
	<input type="hidden" id="deal-id" value="<?php echo $dealId; ?>">
	<input type="hidden" id="user-id" value="<?php echo $userId; ?>">
	
	<script>
	$(document).ready(() => {

		var dealId = $("#deal-id").val();
		var userId = $("#user-id").val();

		socket.emit("connect-to-room", { dealId, userId });

		socket.on("partner-connected", () => {
			console.log("Partner connected");
		});

	});
	</script>

</body>
</html>
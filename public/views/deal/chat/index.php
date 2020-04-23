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
	<?php require "public/layouts/_navigation.php"; ?>
	
	<h1>Chat</h1>
	<input type="hidden" id="deal-id" value="<?php echo $dealId; ?>">
		
	<input type="hidden" id="user-id" value="<?php echo $userId; ?>">
	<input type="hidden" id="user-name" value="<?php echo Auth::user()["name"]; ?>">
	<input type="hidden" id="user-surname" value="<?php echo Auth::user()["surname"]; ?>">

	<input type="hidden" id="partner-id" value="<?php echo $partner["id"]; ?>">
	<input type="hidden" id="partner-name" value="<?php echo $partner["name"]; ?>">
	<input type="hidden" id="partner-surname" value="<?php echo $partner["surname"]; ?>">

	<textarea id="message-input"></textarea>
	<button id="message-send-button">Send</button>

	<div id="messages">
		<?php foreach($messages as $msg): ?>
			<p>
				<?php echo $msg["user_name"] . " " . $msg["user_surname"] . ": "; ?>
				<span>
					<?php echo $msg["body"]; ?>
				</span>
			</p>
		<?php endforeach ?>
	</div>

	<script>
	$(document).ready(() => {

		var dealId = $("#deal-id").val();

		var userId = $("#user-id").val();
		var userName = $("#user-name").val();
		var userSurname = $("#user-surname").val();

		var partnerId = $("#partner-id").val();
		var partnerName = $("#partner-name").val();
		var partnerSurname = $("#partner-surname").val();

		socket.emit("connect-to-room", { dealId, userId });

		socket.on("partner-connected", () => {
			console.log("Partner connected");
		});

		socket.on("new-message-from-other-user", (message) => {
			showMessage(message);
		});

		$("#message-send-button").on("click", () => {
			var params = { 
				dealId: dealId,  
				body: $("#message-input").val() 
			};
			$.post("/deal/chat/message/add", params , (messageId) => {
				var message = {
					id: messageId,
					from: userId,
					room: dealId,
					body: $("#message-input").val() 
				};
				socket.emit("new-message", message);
				showMessage(message);
			});
		});

		function showMessage(message) {
			var newMessage = $("<p></p>");

			if (message.from == userId)
				newMessage.append(userName + " " + userSurname + ": ");
			else
				newMessage.append(partnerName + " " + partnerSurname + ": ");

			var newMessageBody = $("<span></span>");
			newMessageBody.append(message.body);
			newMessage.append(newMessageBody);

			$("#messages").append(newMessage);
		}

	});
	</script>

</body>
</html>
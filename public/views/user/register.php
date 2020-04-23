<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<?php require "public/layouts/_navigation.php"; ?>
	
	<h1> Register </h1>
	<form id="register-form" action="/register" method="POST">
		<input type="text" name="email" placeholder="email">
		<button type="submit">Send</button>
		<p id="message">
			
		</p>
	</form>

	<script>
	
	$(document).ready(() => {

		$('#register-form').submit(function(e) {
			//отмена действия по умолчанию для кнопки submit
			e.preventDefault(); 

			var $form = $(this);
			$.ajax({
				type: $form.attr('method'),
				url: $form.attr('action'),
				data: $form.serialize()
			}).done(function(res) {
				res = JSON.parse(res);
				$("#message").text(res.message);
			}).fail(function() {
				console.log('fail');
			});
		});
		
	});

// });

</script>

</body>
</html>
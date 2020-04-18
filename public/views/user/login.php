<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<h1> Login </h1>
	<form id="login-form" action="/login" method="POST">
		<input type="text" name="email" placeholder="email">
		<input type="password" name="password" placeholder="password">
		<button type="submit">Send</button>
		<p id="message">
			
		</p>
	</form>

	<script>
	
	$(document).ready(() => {

		$('#login-form').submit(function(e) {
			//отмена действия по умолчанию для кнопки submit
			e.preventDefault(); 

			var $form = $(this);
			$.ajax({
				type: $form.attr('method'),
				url: $form.attr('action'),
				data: $form.serialize()
			}).done(function(res) {
				res = JSON.parse(res);
				if (res.errors != undefined)
					console.log(res);
				else
					window.location.replace("http://localhost/user");
			}).fail(function() {
				console.log('fail');
			});
		});
		
	});

// });

</script>

</body>
</html>
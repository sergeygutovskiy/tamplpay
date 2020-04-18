<!DOCTYPE html>
<html>
<head>
	<title>Confirm</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<h1>Confirm account</h1>
	<form id="confirm-form" action="/user/confirm" method="POST">
		<input type="hidden" name="key" value="<?php echo $user['unique_key']; ?>"> <p></p>
		<input type="text" name="email" value="<?php echo $user['email']; ?>" disabled> <p></p>
		<input type="text" name="name" placeholder="name"> <p></p>
		<input type="text" name="surname" placeholder="surname"> <p></p>
		<input type="password" name="password" placeholder="password"> <p></p>
		<input type="password" name="password-confirm" placeholder="confirm password"> <p></p>
		<button type="submit">Confirm</button>

		<p id="message">
			
		</p>
	</form>

	<script>
	
	$(document).ready(() => {

		$('#confirm-form').submit(function(e) {
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
					console.log(res.errors);
				if (res.message != undefined)
					console.log(res.message);
					$("#message").append(res.message);
			}).fail(function() {
				console.log('fail');
			});
		});
		
	});

	</script>
</body>
</html>
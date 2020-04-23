<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<title>Вход</title>
</head>
<body>
	<main>
		<div class="main-enter-div">
			<div class="form-enter">
				<a href="/register">Зарегестрироваться</a>
				<br>
				<img src="img/logo.png">
				<h4>Войдите, чтобы продолжить</h4>
				<form id="login-form" action="/login" method="POST">
					<div class="message-div">
						<p class="message"></p>
					</div>
					<input type="text" name="email" placeholder="Почта">
					<br>
					<input type="password" name="password" placeholder="Пароль">

					<button type="submit">Войти</button>
					<a href="/register"><div class="reg-button">Регистрация</div></a>
				</form>
			</div>
		</div>
	</main>
	<script>

	var backgrounds = [
	  " url(/img/fon-1.jpg) top center ",
	  " url(/img/fon-2.jpg) top center ",
	  " url(/img/fon-3.jpg) top center ",
	  " url(/img/fon-4.jpg) top center ",
	  " url(/img/fon-5.jpg) top center ",
	  " url(/img/fon-6.jpg) top center ",
	  " url(/img/fon-7.jpg) top center ",
	  " url(/img/fon-8.jpg) top center ",
	  " url(/img/fon-9.jpg) top center ",
	  " url(/img/fon-10.jpg) top center "
	];

	document.body.style.background = backgrounds[Math.floor(Math.random() * (backgrounds.length))]  ;
	document.body.style.backgroundSize = "cover ";

	</script>

	<script>
		$(document).ready(() => {
			$('#login-form').submit(function(e) {
				e.preventDefault(); 

				var $form = $(this);
				$.ajax({
					type: $form.attr('method'),
					url: $form.attr('action'),
					data: $form.serialize()
				}).done(function(res) {
					res = JSON.parse(res);
					if (res.error != undefined)
						$(".message").text(res.error);
					else
						window.location.replace("http://localhost/user");
				}).fail(function() {
					console.log('fail');
				});
			});
		});
	</script>

</body>
</html>



<!-- <!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<?php require "public/layouts/_navigation.php"; ?>
	
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
</html> -->
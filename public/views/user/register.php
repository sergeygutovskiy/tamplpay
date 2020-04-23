<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/register.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<title>Регистрация</title>
</head>
<body>
	<main>
		<div class="enter-p-text">
			<p>
				Уже есть аккаунт TamplPay? 
				<a href="Enter.html">Войте</a>
			</p>
		</div>
		<div class="div-computer">
			<img src="/img/logo.png" class="div-computer-logo">
			<h2>Покупай безопастно через онлайн сервис</h2>
			<div class="pay-img-div-computer">
				<img src="/img/webmoney-img.png">
				<img src="/img/qiwi-img.png">
				<img src="/img/yandex-img.png">
			</div>
			<h3>
				TamplPay — это специальный сервис расчетов между покупателем и продавцом, который защищает их обоих. Покупайте товары или услуги в интернете и не переживайте за сохранность денег
			</h3>
		</div>
		<div class="main-form-on-registrtion">
			<img src="/img/logo.png" class="logo-mobile"><h3>Покупай безопастно</h3>
			<div class="form">
				<h2>Регистрация</h2>
				<form id="register-form" action="/register" method="POST">
					<input type="text" id="email" name="email" placeholder="Почта" >
					<div class="message-div">
						<p class="message"></p>
					</div>
					<button type="submit">Зарегестрироваться</button>
					<div class="enter-p-text-mobile">
						<p>
							Уже есть аккаунт TamplPay? 
							<a href="/login">Войти</a>
						</p>
					</div>
					<div class="main-infa">
						<p>Нажимая кнопку «Зарегистрироваться»:</p>
						<div class="polit-conf">
							<div class="checkbox-input">
								<input type="checkbox" checked="checked" name="polit-conf" >
							</div>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							Вы даете согласие на обработку персональных данных и соглашаетесь с 
							<a href="">Политикой конфиденциальности</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</main>
	<script>
		$(document).ready(() => {
			$('#register-form').submit(function(e) {
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
					console.log('ajax fail');
				});
			});
		});
	</script>
</body>
</html>

<!-- <!DOCTYPE html>
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
</html> -->
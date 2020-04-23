<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/register_confirm.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<title>Регистрация</title>
</head>
<body>
	<main>
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
			<img src="/img/logo.png" class="logo-mobile">
			<h3>Покупай безопастно</h3>
			<div class="form">
				<h2>Регистрация</h2>
				
				<form id="confirm-form" action="/user/confirm" method="POST">
					<p style="color: #2fa6ff"><?php echo $user['email']; ?></p>
					<input type="hidden" name="key" value="<?php echo $user['unique_key']; ?>">
					<input type="text" id="surname" name="surname" placeholder="Фамилия" >
					<input type="text" id="name" name="name" placeholder="Имя" >
					<input type="text" id="password" name="password" placeholder="Пароль" >
					<input type="text" id="password-confirm" 
					name="password-confirm" 
					placeholder="Пароль еще раз">
					<p class="message"></p>
					<button type="submit">Зарегестрироваться</button>
					<div class="main-infa">
						<p>Нажимая кнопку «Зарегистрироваться»:</p>
						<div class="polit-conf">
							<div class="checkbox-input">
								<input type="checkbox" checked="checked" name="polit-conf"></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								Вы даете согласие на обработку персональных данных и соглашаетесь с 
								<a href="">Политикой конфиденциальности</a>
							</div>
						</div>
					</div>
			</form>
		</div>
	</main>
	<script>
		$(document).ready(() => {
			$('#confirm-form').submit(function(e) {
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
</html> -->
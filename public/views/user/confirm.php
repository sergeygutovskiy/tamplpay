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
			<h3>TamplPay — это специальный сервис расчетов между покупателем и продавцом, который защищает их обоих. Покупайте товары или услуги в интернете и не переживайте за сохранность денег</h3>
		</div>

		<div class="main-form-on-registrtion">
	     <img src="/img/logo.png" class="logo-mobile"><h3>Покупай безопастно</h3>
			<div class="form">
				<h2>Регистрация</h2>
				<form id="confirm-form" action="/user/confirm" method="POST">
				
				
				<p style="color: #2fa6ff">
					<?php echo $user['email']; ?>
				</p>
				<input type="hidden" name="key" value="<?php echo $user['unique_key']; ?>">
				<input type="text" name="surname" placeholder="Фамилия" autocomplete="off">
				<input type="text" name="name" placeholder="Имя" autocomplete="off">
				<div class="password">
					<input type="password" id="password-input" placeholder="Введите пароль" name="password" autocomplete="off">
					<a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
				</div>
				<input type="text" name="password-confirm" placeholder="Пароль еще раз" autocomplete="off">
				<p class="message"></p>
				<button type="submit">Зарегестрироваться</button>
				
					<div class="main-infa">
						<p>Нажимая кнопку «Зарегистрироваться»:</p>
						<div class="polit-conf"><div class="checkbox-input">
							<input type="checkbox" checked="checked" name="polit-conf"></div>
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

	<script type="text/javascript">
		function show_hide_password(target) {
			var input = document.getElementById('password-input');
			if (input.getAttribute('type') == 'password') {
				target.classList.add('view');
				input.setAttribute('type', 'text');
			} else {
				target.classList.remove('view');
				input.setAttribute('type', 'password');
			}
			return false;
		}
	</script>

</body>
</html>
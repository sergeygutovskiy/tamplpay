


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<title>Вход</title>
</head>
<body>
	<div id="preloader"></div>

	<main>
		<div class="main-enter-div">
			<div class="form-enter">
				<a href="/register">Зарегестрироваться</a>
				<br>
				<img src="/img/logo.png">
				<h4>Войдите, чтобы продолжить</h4>
				<form id="login-form" action="/login" method="POST">
					<div class="message-div"><p class="message"></p></div>
					<label class="cool-input-label">Почта</label>
					<input type="text" name="email" id="email" autocomplete="off">
					<br>
					<div class="password">
						<label class="cool-input-label">Пароль</label>
						<input type="password" id="password-input" name="password" placeholder="" 
						name="password">
						<a href="#" class="password-control" 
						onclick="return show_hide_password(this);"></a>
					</div>

					<button type="submit">Войти</button>
					<a href="/register"><div class="reg-button">Регистрация</div></a>
				</form>
			</div>
		</div>
		<div class="div-link-left"><a href=""><p>Помощь</p></a></div>
		<div class="div-link"><p>© 2020, TamplPay</p></div>
	</main>

	<script>
		$(document).ready(() => {

			var email = $("#email");
			var password = $("#password-input");

			email.focus(() => { email.prev().addClass("cool-input-label-up"); });
			email.focusout(() => {
				if (email.val().length == 0)
					email.prev().removeClass("cool-input-label-up");
			});

			password.focus(() => { password.prev().addClass("cool-input-label-up"); });
			password.focusout(() => {
				if (password.val().length == 0)
					password.prev().removeClass("cool-input-label-up");
			});

		});
	</script>

	<script>
		$(document).ready(() => {

			var messageBox = $(".message-div");
			var message = $(".message");
			messageBox.hide();

			$('#login-form').submit(function(e) {
				e.preventDefault(); 

				var $form = $(this);
				$.ajax({
					type: $form.attr('method'),
					url: $form.attr('action'),
					data: $form.serialize()
				}).done(function(res) {
					res = JSON.parse(res);
					if (res.error != undefined) {
						messageBox.show();
						message.text(res.error);
					}
					else
						window.location.replace("http://localhost/user");
				}).fail(function() {
					console.log('fail');
				});
			});
		});
	</script>

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


	<script >
		jQuery(document).ready(function ($) {
		    $(window).load(function () {
		        setTimeout(function(){
		            $('#preloader').fadeOut('slow', function () {
		            });
		        },1000);

		    });  
		});
	</script>

	<script type="text/javascript">
		function show_hide_password(target){
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
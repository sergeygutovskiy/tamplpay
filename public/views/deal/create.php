<!DOCTYPE html>
<html>
<head>
	<title>Create Deal</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<?php require "public/layouts/_navigation.php"; ?>
	
	<h1> Create Deal </h1>
	<form id="deal-create-form" action="/deal/create" method="POST"> <p></p>
		<input type="text" name="title" placeholder="title"> <p></p>
		<input type="text" name="description" placeholder="description"> <p></p>
		<input type="number" name="price" placeholder="price" value="0" min="0"> <p></p>
		<input type="text" name="partner" placeholder="partner" id="search-input"> 
		<span id="search-message"></span>
		<p></p>
 

		<button type="submit">Create</button>
		<p id="message">
			
		</p>
	</form>

	<script>
	
	$(document).ready(() => {

		$("#search-input").on("input", () => {
			var val = $("#search-input").val();
			if (val.length == 8)
				sendUserSearchRequest(val);
		});

		$('#deal-create-form').submit(function(e) {
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
					window.location.replace("http://localhost/deal?deal=" + res.dealId);

			}).fail(function() {
				console.log('fail');
			});
		});
	});

	function sendUserSearchRequest(key) {
		$.post("/search/user", { key: key } , (user) => {
			if (user.length == 0)
				$("#search-message").text("User not found");
			else
				$("#search-message").text(user[0].name + " " + user[0].surname + " #" + key);
		}, 'json');
	} 

</script>

</body>
</html>
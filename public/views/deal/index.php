<!DOCTYPE html>
<html>
<head>
	<title>Deal</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<h1>Deal info</h1>
	<input type="hidden" id="deal-id" value="<?php echo $deal['id']; ?>">
	<h2><?php echo $deal["title"]; ?></h2>
	<p>
		<?php echo $deal["description"]; ?>
	</p>
	<p>
		Price: <?php echo $deal["price"]; ?>
	</p>
	<p>
		Seller: <?php echo $seller["name"] . " " . $seller["surname"]; ?>
	</p>
	<p>
		Buyer: <?php echo $buyer["name"] . " " . $buyer["surname"]; ?>
	</p>
	<p>
		Status: <?php echo $deal["status"]; ?>
	</p>
	<p>
		<?php if ($deal["status"] == 0 && $buyer["id"] == Auth::user()["id"]): ?>
			<button id="accept-deal-button">Accept</button>
		<?php endif ?>
		<?php if ($deal["status"] == 1 && $buyer["id"] == Auth::user()["id"]): ?>
			<button id="finish-deal-button">Finish</button>
		<?php endif ?>
	</p>



	<script>
	$(document).ready(() => {

		$("#accept-deal-button").on("click", () => {
			$.post("/deal/accept", { dealId: $("#deal-id").val() } , (res) => {
				console.log(res);
			}, 'json');			
		});

		$("#finish-deal-button").on("click", () => {
			$.post("/deal/finish", { dealId: $("#deal-id").val() } , (res) => {
				console.log(res);
			}, 'json');			
		});

	});
	</script>

</body>
</html>
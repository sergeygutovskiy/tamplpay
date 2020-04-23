<div style="display: flex">
	<?php if (Auth::isAuth()): ?>
		<a href="/user">Home</a>
		<a href="/user/deals">Deals</a>
	<?php else: ?>
		<a href="/register">Register</a>
		<a href="/login">Login</a>
	<?php endif ?>
</div>
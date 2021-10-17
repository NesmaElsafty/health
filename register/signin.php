<?php 
session_start();
$title = 'sign in';
	require_once '../config/header.php';
?>
<div id="main">
<form method="post" action="check.php">
	<div class="col-6 col-12-xsmall">
			<input type="email" name="email" id="demo-email" placeholder="Email" required />
		</div>
		<br>
		<div class="col-6 col-12-xsmall">
			<input type="password" name="password" id="demo-name" placeholder="Password" required />
		</div>
		<br>
		<div class="col-6 col-12-small">
		<ul class="actions stacked">
			<li><button name="signin" class="button primary">Sign up</button></li>
		</ul>
	</div>
</form>
</div>
<?php 
	
	require_once '../config/footer.php';
?>
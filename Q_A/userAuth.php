<?php 
// session_start();
require_once '../config/functions.php';

if(isset($_SESSION['auth'])){
	$authData = getData('users','email' ,$_SESSION['auth']);

	if (!empty($authData = getData('users','email' ,$_SESSION['auth']))) {
		$username = $authData['username'];
		$user_id = $authData['id'];
	}
}


?>

	<!-- fetch general time line with add post form -->
	<form method="post" action="actions.php">
		<div class="row gtr-uniform">
			<div class="col-12 col-12-xsmall">
				<input type="text" name="question" placeholder="Ask a your Doctor" />
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
				<input type="hidden" name="created" value="<?php echo date("Y-m-d h:i:sa"); ?>" />
			</div>
		</div>
		
			<button name="ask" type="submit">Ask</button>
	</form>
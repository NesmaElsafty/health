<?php 
session_start();
if (!empty($_SESSION['auth'])) {
	$title = 'update data'; 
}else{
	$title = 'sign up';
}
require_once '../config/header.php';

// echo $_SESSION['auth'];

// Retrieve session data
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get user data
$userData = array();
if(!empty($_GET['id'])){
    // Include and initialize DB class
    include '../config/db.php';
		    $db = new DB();
		    
		    // Fetch the user data
		    if (!empty($_SESSION['type']) && $_SESSION['type'] == 'user') {
		    	$conditions['where'] = array(
		        'email' => $_SESSION['auth'],
			    );
			    $conditions['return_type'] = 'single';
			    $userData = $db->getRows('users', $conditions);
		    }elseif (!empty($_SESSION['type']) && $_SESSION['type'] == 'doctor') {
		    	$conditions['where'] = array(
		        'dr_email' => $_SESSION['auth'],
			    );
			    $conditions['return_type'] = 'single';
			    $userData = $db->getRows('doctors', $conditions);
		    }
}
$userData = !empty($sessData['userData'])?$sessData['userData']:$userData;
unset($_SESSION['sessData']['userData']);

$actionLabel = !empty($_GET['id'])?'Edit':'sign up';

// Get status message from session
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}

?>
<div id="main">
<?php if(!empty($sessData['status']['msg'])){ ?>
  <div class="col-xs-12" style="color: red;">
      <?php 
      echo $sessData['status']['msg']; 
      unset($sessData['status']['msg']);
}
      ?>
	<?php  if(!empty($_SESSION['type']) && $_SESSION['type'] == 'doctor'){ ?>
			<form method="post" action="drAction.php">
				<input type="hidden" name="id" value="<?php echo !empty($userData['id'])?$userData['id']:''; ?>">
				<div class="row gtr-uniform">
					<div class="col-6 col-12-xsmall">
						<input type="text" name="dr_name" id="demo-name" value="<?php echo !empty($userData['dr_name'])?$userData['dr_name']:''; ?>" placeholder="username" required />
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="email" name="dr_email" id="demo-email" value="<?php echo !empty($userData['dr_email'])?$userData['dr_email']:''; ?>" placeholder="Email" required />
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="password" name="password" id="demo-name" placeholder="Password" required/>
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="text" name="dr_phone" id="demo-email" value="<?php echo !empty($userData['dr_phone'])?$userData['dr_phone']:''; ?>" placeholder="Phone number" required />
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="text" name="dr_address" id="demo-email" value="<?php echo !empty($userData['dr_address'])?$userData['dr_address']:''; ?>" placeholder="Location" required />
					</div>
				</div>
				<div class="col-6 col-12-small">
					<ul class="actions stacked">
						<br>
						<li><button name="dr_update" type="submit" class="button primary">Sign up</button></li>
					</ul>
				</div>
			</form>

<?php }else{ ?>

		<form method="post" action="userAction.php">
			<input type="hidden" name="id" value="<?php echo !empty($userData['id'])?$userData['id']:''; ?>">
			<div class="row gtr-uniform">
				<div class="col-6 col-12-xsmall">
					<input type="text" name="username" id="demo-name" value="<?php echo !empty($userData['username'])?$userData['username']:''; ?>" placeholder="username" required />
				</div>
				<div class="col-6 col-12-xsmall">
					<input type="email" name="email" id="demo-email" value="<?php echo !empty($userData['email'])?$userData['email']:''; ?>" placeholder="Email" required />
				</div>
				<div class="col-6 col-12-xsmall">
					<input type="password" name="password" id="demo-name" placeholder="Password" required/>
				</div>
				<div class="col-6 col-12-xsmall">
					<input type="text" name="phone" id="demo-email" value="<?php echo !empty($userData['phone'])?$userData['phone']:''; ?>" placeholder="Phone number" required />
				</div>
			</div>
			<div class="col-6 col-12-small">
				<ul class="actions stacked">
					<br>
					<li><button name="signup" type="submit" class="button primary">Sign up</button></li>
				</ul>
			</div>
		</form>
	<?php } ?>	
</div>
<?php 

require_once '../config/footer.php';
?>
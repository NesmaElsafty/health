
<?php 
session_start();
$title = 'Profile';
	require_once '../config/header.php';
		$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

		// Get user data
		$userData = array();
		if(!empty($_SESSION['auth'])){
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

		// Get status message from session
		if(!empty($sessData['status']['msg'])){
		    $statusMsg = $sessData['status']['msg'];
		    $statusMsgType = $sessData['status']['type'];
		    unset($_SESSION['sessData']['status']);
		}

?>
<footer id="footer">
	<?php if (!empty($_SESSION['type']) && $_SESSION['type'] == 'user') { ?>
					<section class="split contact">
							<section class="alt">
								<h3>Name</h3>
								<p><?php echo !empty($userData['username'])?$userData['username']:''; ?></p>
							</section>
							<section>
								<h3>Phone</h3>
								<p><?php echo !empty($userData['phone'])?$userData['phone']:''; ?></p>
							</section>
							<section>
								<h3>Email</h3>
								<p><?php echo $_SESSION['auth']; ?></p>
							</section>
							<section>
								<h3>Calculator Result</h3>
								<p><?php echo !empty($userData['cal_result'])?$userData['cal_result']:'use calculator'; ?></p>
							</section>
						</section>
						<ul class="actions stacked">
							<br>
							<li>
								<a href="signup.php?id=<?php echo $userData['id']; ?>">
									<button name="signup" class="button primary">Update Data</button>
								</a>
							</li>

						</ul>
					<?php  }elseif(!empty($_SESSION['type']) && $_SESSION['type'] == 'doctor'){ ?>
						<section class="split contact">
							<section class="alt">
								<h3>Name</h3>
								<p><?php echo !empty($userData['dr_name'])?$userData['dr_name']:''; ?></p>
							</section>
							<section>
								<h3>Phone</h3>
								<p><?php echo !empty($userData['dr_phone'])?$userData['dr_phone']:''; ?></p>
							</section>
							<section>
								<h3>Email</h3>
								<p><?php echo $_SESSION['auth']; ?></p>
							</section>
							<section>
								<h3>Location</h3>
								<p><?php echo !empty($userData['dr_address'])?$userData['dr_address']:''; ?></p>
							</section>
						</section>
						<ul class="actions stacked">
							<br>
							<li>
								<a href="signup.php?id=<?php echo $userData['id']; ?>">
									<button name="signup" class="button primary">Update Data</button>
								</a>
							</li>

						</ul>

					<?php } ?>
</footer>
<?php 
	
	require_once '../config/footer.php';
?>
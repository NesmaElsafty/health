<?php 

session_start();
if (isset($_SESSION['unID']) && $_SESSION['unID'] == 'admin') {

require_once '../config/connect.php';
require_once '../config/db.php';
require_once '../config/header.php';


$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get user data
$userData = array();
$db = new DB();
    
    // Fetch the user data
    // $conditions['where'] = array(
    //     'id' => $_GET['id'],
    // );
    $conditions['return_type'] = 'single';
    $userData = $db->getRows('ourdata', $conditions);

?>

<div class="animation-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="animation-single-int">
					<div class="animation-ctn-hd">
						<h2>Contact us info</h2>
						<strong>Email: </strong><p><?php echo $userData['email']; ?></p><br>
						<strong>phone: </strong><p><?php echo $userData['phone']; ?></p><br>
						<strong>facebook: </strong><p><?php echo $userData['facebook']; ?></p><br>
						<strong>instagram: </strong><p><?php echo $userData['insta']; ?></p><br>
						

					</div>
					
					<div class="animation-action">
						<div class="row">
							<div class="col-lg-6">
								<div class="animation-btn">
									<a href="addEdit.php?id=<?php echo $userData['id']; ?>">
										<button class="btn ant-nk-st bounce-ac">update</button>
									</a>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="animation-btn sm-res-mg-t-10 tb-res-mg-t-10 dk-res-mg-t-10">
									<a href="userAction.php?action_type=delete&id=<?php echo $userData['id']; ?>"onclick="return confirm('Are you sure to delete?');">
										<button class="btn ant-nk-st flash-ac">Delete</button>
									</a>
								</div>
							</div>
						</div>
						
				</div>
			</div>
		</div>
	</div>
</div>



<?php

require_once '../config/footer.php';

}else{
    echo 'no sessions yet';
    header('location:../login/index.php');
}


?>
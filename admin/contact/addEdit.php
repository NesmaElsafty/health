<?php 

session_start();
if (isset($_SESSION['unID']) && $_SESSION['unID'] == 'admin') {

require_once '../config/db.php';

require_once '../config/header.php';

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get user data
$userData = array();
if(!empty($_GET['id'])){
    // Include and initialize DB class
    $db = new DB();
    
    // Fetch the user data
    $conditions['where'] = array(
        'id' => $_GET['id'],
    );
    $conditions['return_type'] = 'single';
    $userData = $db->getRows('ourdata', $conditions);
}
$userData = !empty($sessData['userData'])?$sessData['userData']:$userData;
unset($_SESSION['sessData']['userData']);

$actionLabel = !empty($_GET['id'])?'Edit':'Add';

// Get status message from session
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<div class="form-element-area">
    <div class="container">
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        <div class="basic-tb-hd">
                            <h2><?php echo $actionLabel; ?> Contact Data</h2>
                            <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
                                <div class="col-xs-12">
                                    <div class="alert alert-success" role="alert"><?php echo $statusMsg; ?></div>
                                </div>
                            <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
                                <div class="col-xs-12">
                                    <div class="alert alert-danger alert-mg-b-0" role="alert"><?php echo $statusMsg; ?></div>
                                </div>
                            <?php } ?>
                        </div>
                        <form action="userAction.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" name="facebook" class="form-control" placeholder="facebook"value="<?php echo !empty($userData['facebook'])?$userData['facebook']:''; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-mail"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo !empty($userData['email'])?$userData['email']:''; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-phone"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="phone" placeholder="Contact Number" value="<?php echo !empty($userData['phone'])?$userData['phone']:''; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-map"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control" name="instagram" placeholder="instagram" value="<?php echo !empty($userData['insta'])?$userData['insta']:''; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <!-- <input type="hidden" name="image" value="text"> -->
                            <input type="hidden" name="id" value="<?php echo !empty($userData['id'])?$userData['id']:''; ?>">
  
                        </div>
                        <button class="btn btn-default btn-icon-notika waves-effect" type="submit" name="contactUS"><i class="notika-icon notika-checked"></i> Done</button>
                       </form>
                        
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
<?php 

session_start();
error_reporting(0);
 if (isset($_SESSION['unID']) && $_SESSION['unID'] == 'admin') {
// require_once '../config/connect.php';
require_once '../config/db.php';
require_once '../config/header.php';


$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Include and initialize DB class
$db = new DB();

// Fetch the users data
$users = $db->getRows('doctors');

// Get status message from session
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}

?>

<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Doctors</h2>
                                    <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
                                        <div class="col-xs-12">
                                            <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                                        </div>
                                    <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
                                        <div class="col-xs-12">
                                            <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="contact-area">
    <div class="container">

<?php if(!empty($users)){ $count = 0; foreach($users as $row){ $count++; ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="contact-list">
                    
                    <div class="contact-ctn">
                        <div class="contact-ad-hd" style="margin-top: 0px;">
                            <h2><?php echo $row['dr_name']; ?></h2> 
                            <p class="ctn-ads"><?php echo $row['dr_address']; ?></p> 
                        </div>
                        <p><?php echo $row['dr_email']; ?></p><br> 
                        <p><?php echo $row['dr_phone']; ?></p>
                    </div>
                    <div class="social-st-list">
                        <div class="social-sn">
                            <a href="addEdit.php?id=<?php echo $row['id']; ?>"><button class="btn btn-warning warning-icon-notika btn-reco-mg btn-button-mg waves-effect"> Update </button></a>
                        </div>
                        <div class="social-sn">
                            <a href="userAction.php?action_type=delete&id=<?php echo $row['id']; ?>"onclick="return confirm('Are you sure to delete?');">
                                <button class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg waves-effect"></i>Delete</button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } }else{ ?>
        <tr><td colspan="5">No user(s) found...</td></tr>
<?php } ?>

        
    </div>
</div>

<?php

require_once '../config/footer.php';

}else{
    echo 'no sessions yet';
    header('location:../login/index.php');
}
?>
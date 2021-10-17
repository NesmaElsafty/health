<?php 
// error_reporting(0);

session_start();
if (isset($_SESSION['unID']) && $_SESSION['unID'] == 'admin') {

require_once '../config/connect.php';
require_once '../config/db.php';
// Start session

// Retrieve session data
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get user data
$userData = array();
if(!empty($_GET['id'])){
    // Include and initialize DB class
    // include 'db.php';
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

require_once '../config/header.php';

?>

<div class="form-element-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="basic-tb-hd">
                        <h2><?php echo $actionLabel; ?> Our Data</h2>
                        <!-- <p>Text Inputs with different sizes by height(<code>.input-sm, .input-lg</code>) and column.</p> -->
                    </div>
                    <!-- Alerts -->
                    <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>

                        <div class="alert-list">
                            <div class="alert alert-success" role="alert"><?php echo $statusMsg; ?>
                        </div>
                    </div>

                    <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>

                        <div class="alert-list">
                            <div class="alert alert-danger alert-mg-b-0" role="alert"><?php echo $statusMsg; ?>
                            </div>
                        </div>
                    <?php } ?>
            <!-- End Alerts -->
            <form action="userAction.php" method="POST" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <div class="nk-int-st">
                                <input type="text" name="title" class="form-control" placeholder="Add Title" value="<?php echo !empty($userData['title'])?$userData['title']:''; ?>" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <?php if(isset($_GET['id'])){ ?>
                        <div class="custom-file mb-3">
                            <input type="file" name="image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                    <?php  }else{ ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <div class="nk-int-st">
                                    <input type="file" class="form-control" name="image" required>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>
    
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="basic-tb-hd">
                            <h2>Description</h2>

                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="nk-int-st">
                                        <textarea class="form-control" rows="5" name="description" required>
                                            <?php echo !empty($userData['description'])?$userData['description']:''; ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>

            
            <div class="buttons-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="btn-demo-notika mg-t-30">
                                <input type="hidden" name="id" value="<?php echo !empty($userData['id'])?$userData['id']:''; ?>">
                                <div class="material-design-btn">
                                    <button class="btn btn-warning notika-btn-warning waves-effect" type="submit" name="AboutUs" value="Submit">
                                        AboutUs
                                    </button>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>



<?php

require_once '../config/footer.php';

}else{
    echo 'no sessions yet';
    header('location:../login/index.php');
}

?>

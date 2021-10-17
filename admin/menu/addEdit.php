<?php 
error_reporting(0);

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
    include 'db.php';
    $db = new DB();
    
    // Fetch the user data
    $conditions['where'] = array(
        'id' => $_GET['id'],
    );
    $conditions['return_type'] = 'single';
    $userData = $db->getRows('menu', $conditions);
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
                        <h2><?php echo $actionLabel; ?> Meal</h2>
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
                                <input type="text" name="meal_name" class="form-control" placeholder="Meal Name" value="<?php echo !empty($userData['meal_name'])?$userData['meal_name']:''; ?>" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <?php if(isset($_GET['id'])){ ?>
                        <div class="custom-file mb-3">
                            <input type="file" name="image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">File Input</label>
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
                    <h2>Choose Category</h2>
                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="fm-checkbox">
                            <label><input type="radio" value="vigans" name="meal_cat" id="vigans"> <i></i> vigans</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="fm-checkbox">
                            <label><input type="radio" value="vegetrians"  name="meal_cat" id="vegetrians"> <i></i> vegetrians</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="fm-checkbox form-elet-mg">
                            <label><input type="radio" name="meal_cat" value="normal" id="normal"> <i></i>normal</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="basic-tb-hd">
                            <h2>ingredients</h2>

                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="nk-int-st">
                                        <textarea class="form-control" rows="5" placeholder="Type ingredients" name="ingredients" required>
                                            <?php echo !empty($userData['ingredients'])?$userData['ingredients']:''; ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list mg-t-30">
                        <div class="basic-tb-hd">
                            <h2>recipe</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="nk-int-st">
                                        <textarea class="form-control" rows="5" name="recipe" placeholder="Type recipes" required>
                                            <?php echo !empty($userData['recipe'])?$userData['recipe']:''; ?>
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
                                    <button class="btn btn-warning notika-btn-warning waves-effect" type="submit" name="AddMeal" value="Submit">
                                        Add Meal
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
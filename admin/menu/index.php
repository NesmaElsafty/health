<?php 

session_start();
if (isset($_SESSION['unID']) && $_SESSION['unID'] == 'admin') {
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Include and initialize DB class
require_once '../config/db.php';
$db = new DB();

// Fetch the users data
$users = $db->getRows('menu');

// Get status message from session
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
require_once '../config/header.php';

?>

<div class="normal-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="normal-table-list">
                    <div class="basic-tb-hd">

                        <h2>All Meals</h2>
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
                    <div class="bsc-tbl">
                        <table class="table table-sc-ex">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Meal Name</th>
                                    <th>Category Name</th>
                                    <th>Ingredient</th>
                                    <th>Recipe</th>
                                    <th>Image</th>
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($users)){ $count = 0; foreach($users as $row){ $count++; ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['meal_name']; ?></td>
                                    <td><?php echo $row['meal_cat']; ?></td>
                                    <td><?php echo $row['ingredients']; ?></td>
                                    <td><?php echo $row['recipe']; ?></td>
                                    <td>
                                        <img src="images/<?php echo $row['image']; ?>" class="img-fluid mr-3" alt="Responsive image">
                                    </td>
                                    <td><?php echo $row['created']; ?></td>
                                    <td><?php echo $row['modified']; ?></td>
                                    <td>
                                        <a href="addEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Update</a> || 
                                        <a href="userAction.php?action_type=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</a>
                                    </td>
                                </tr>
                                <?php } }else{ ?>
                                    <tr><td colspan="5">No user(s) found...</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
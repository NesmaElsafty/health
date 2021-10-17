<?php
// Start session
session_start();
// Include and initialize DB class

require_once '../config/db.php';
$db = new DB();

// Database table name
$tblName = 'ourdata';

// Set default redirect url
$redirectURL = 'index.php';


//functions
function uploadImage($fileName, $fileTmp){
    $target_dir = "images/";
    $target_file = $target_dir . basename($fileName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
             return 'failed to upload image';
    }else{
        move_uploaded_file($fileTmp, $target_file);
        return true;
    }
}


if(isset($_POST['AboutUs'])){
    // Get form fields value
    $title     = $_POST['title'];
    $description    = $_POST['description'];
    $image = $_FILES["image"]["name"];
    $tmp = $_FILES["image"]["tmp_name"];
    
    // Fields validation
    $errorMsg = '';

    
    // Submitted form data
    if (empty($image)) {
        $userData = array(
            'title' => $title,
            'description' => $description
        );
    }else{
        $upload = uploadImage($image, $tmp);
        $userData = array(
            'title' => $title,
            'description' => $description,
            'image' => $image
        );
    }    
    // Store the submitted field value in the session
    $sessData['userData'] = $userData;
    
    // Submit the form data
    if(empty($errorMsg)){
        if(!empty($_POST['id'])){
            // Update user data
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName, $userData, $condition);
            
            if($update){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'About Us Updated successfully';
                
                // Remote submitted fields value from session
                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'update failed, please try again.';
                
                // Set redirect url
                $redirectURL = 'addEdit.php';
            }
        }else{
            // Insert user data
            $insert = $db->insert($tblName, $userData);
            // die($insert);
            if($insert){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'About Us has been added successfully.';
                
                // Remote submitted fields value from session
                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'insert failed, please try again.';
                
                // Set redirect url
                $redirectURL = 'addEdit.php';
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg;
        
        // Set redirect url
        $redirectURL = 'addEdit.php';
    }
    
    // Store status into the session
    $_SESSION['sessData'] = $sessData;
}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
    // Delete data
    $condition = array('id' => $_GET['id']);
    $delete = $db->delete($tblName, $condition);
    
    if($delete){
        $sessData['status']['type'] = 'success';
        $sessData['status']['msg'] = 'About us data has been deleted successfully.';
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Delete failed, please try again.';
    }
    
    // Store status into the session
    $_SESSION['sessData'] = $sessData;
}

// Redirect to the respective page
header("Location:".$redirectURL);
exit();
?>

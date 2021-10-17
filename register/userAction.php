<?php
// Start session
session_start();

// Include and initialize DB class
require_once '../config/db.php';
require_once '../config/functions.php';
$db = new DB();

// Database table name
$tblName = 'users';

// Set default redirect url
$redirectURL = '../index.php';

if(isset($_POST['signup'])){
    // Get form fields value
    $username     = trim(strip_tags($_POST['username']));
    $password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
    $email    = trim(strip_tags($_POST['email']));
    $phone    = trim(strip_tags($_POST['phone']));
    
    // Fields validation
    $errorMsg = '';

    if(empty($phone) || !preg_match("/^[-+0-9]{6,20}$/", $phone)){
        $errorMsg .= '<p>Please enter a valid phone number.</p>';
    }
    
    // Submitted form data
    $userData = array(
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'phone' => $phone
    );
    
    // Store the submitted field value in the session
    $sessData['userData'] = $userData;
    
    // Submit the form data
    if(empty($errorMsg)){
        if(!empty($_POST['id'])){
            // Update user data
            if (CheckEmail('users','email',$email) <= 1 || CheckEmail('doctors','dr_email' , $email) <= 1) {


                $condition = array('id' => $_POST['id']);

                $update = $db->update($tblName, $userData, $condition);
                
            }else{
                $errorMsg .= '<p>This Email is used before, cannot update</p>';
            }
            if($update){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'your data has been updated successfully.';
                    // Remote submitted fields value from session
                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = $errorMsg;
                    // Set redirect url
                $redirectURL = 'signup.php';
            }
        }else{
            if(CheckEmail('users','email',$email) == 0 && CheckEmail('doctors','dr_email' , $email) == 0){

                // Insert user data
                $insert = $db->insert($tblName, $userData);
            }else{
                $errorMsg .= '<p>This Email is used before, cannot Signup</p>';
            }
            if($insert){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Welcome ' . $username;
                $_SESSION['auth'] = $email;
                $_SESSION['type'] = 'user';
                    // Remote submitted fields value from session
                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'failed to sign up, Some problem occurred, please try again.';

                    // Set redirect url
                $redirectURL = 'signup.php';
            }

        }
}else{
    $sessData['status']['type'] = 'error';
    $sessData['status']['msg'] = $errorMsg;

        // Set redirect url
    $redirectURL = 'signup.php';
}
$_SESSION['sessData'] = $sessData;

}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
    // Delete data
    $condition = array('id' => $_GET['id']);
    $delete = $db->delete($tblName, $condition);
    
    if($delete){
        $sessData['status']['type'] = 'success';
        $sessData['status']['msg'] = 'User data has been deleted successfully.';
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
    }
    
    // Store status into the session
    $_SESSION['sessData'] = $sessData;
}

// Redirect to the respective page
header("Location:".$redirectURL);
exit();
?>
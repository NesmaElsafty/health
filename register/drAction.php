<?php
// Start session
session_start();
// error_reporting(0);
// Include and initialize DB class

require_once '../config/db.php';
require_once '../config/functions.php';
$db = new DB();

// Database table name 
$tblName = 'doctors';

// Set default redirect url
$redirectURL = 'profile.php';


//functions

if(isset($_POST['dr_update'])){
    // Get form fields value
    $dr_name     = $_POST['dr_name'];
    $dr_address    = $_POST['dr_address'];
    $dr_email    = $_POST['dr_email'];
    $dr_phone    = $_POST['dr_phone'];
    $password    = password_hash($_POST['password'] , PASSWORD_DEFAULT);
    
    // Fields validation
    $errorMsg = '';


    // Submitted form data
   
        $userData = array(
            'dr_name' => $dr_name,
            'dr_address' => $dr_address,
            'dr_email' => $dr_email,
            'dr_phone' => $dr_phone,
            'password' => $password
        );
    
    // Store the submitted field value in the session
    $sessData['userData'] = $userData;
    
    // Submit the form data
    if(empty($errorMsg)){
        if(!empty($_POST['id'])){
            if (CheckEmail('doctors','dr_email' , $dr_email) <= 1) {


                $condition = array('id' => $_POST['id']);

                $update = $db->update($tblName, $userData, $condition);
                
            }else{
                $errorMsg .= '<p>This Email is used before, cannot update</p>';
            }
            
            if($update){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Doctor Data has been Updated successfully';
                $redirectURL = '../register/profile.php';
                // Remote submitted fields value from session
                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'update failed, please try again.';
                
                // Set redirect url
                $redirectURL = 'signup.php?id=' . $_POST['id'];
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
                $sessData['status']['msg'] = 'Doctor data has been added successfully.';
                
                // Remote submitted fields value from session
                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'insert failed, please try again.' ;
                
                // Set redirect url
                $redirectURL = 'signup.php';
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg;
        
        // Set redirect url
        $redirectURL = 'signup.php';
    }
    
    // Store status into the session
    $_SESSION['sessData'] = $sessData;
}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
    // Delete data
    $condition = array('id' => $_GET['id']);
    $delete = $db->delete($tblName, $condition);
    
    if($delete){
        $sessData['status']['type'] = 'success';
        $sessData['status']['msg'] = 'Doctor Data has been deleted successfully.';
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
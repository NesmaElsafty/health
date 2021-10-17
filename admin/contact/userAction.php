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



if(isset($_POST['contactUS'])){
    // Get form fields value
    $facebook     = $_POST['facebook'];
    $instagram    = $_POST['instagram'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    
    // Fields validation
    $errorMsg = '';
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errorMsg .= '<p>Please enter a valid email.</p>';
        //Other Condition
    }
    if(empty($phone) || !preg_match("/^[-+0-9]{6,20}$/", $phone)){
        $errorMsg .= '<p>Please enter a valid phone number.</p>';
    }

    $userData = array(
            'facebook' => $facebook,
            'insta' => $instagram,
            'email' => $email,
            'phone' => $phone
        );

    // Submitted form data

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
                $sessData['status']['msg'] = 'Contact Data has been Updated successfully';
                
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
                $sessData['status']['msg'] = 'Contact data has been added successfully.';
                
                // Remote submitted fields value from session
                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'insert failed, please try again.' ;
                
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
        $sessData['status']['msg'] = 'Contact Data has been deleted successfully.';
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
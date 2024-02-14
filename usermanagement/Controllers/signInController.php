<?php

require_once "../classes/Users.php";


$email = $_POST['email'];
$password = $_POST['password'];

function filterEmail($emailField){
    $emailField = filter_var(trim($emailField), 
    FILTER_SANITIZE_EMAIL);

    if(filter_var($emailField, FILTER_VALIDATE_EMAIL)){
        return $emailField;
    }else{
        return FALSE;
    }
}


$passwordErr =
$emailErr = "";

if(empty($email)){
    $emailErr = 'Please enter your email address';
}else{
    $email1 = filterEmail($email);
    if($email1 == FALSE){
        $emailErr = "Please enter a valid email address";
    }
}

if(empty($password)){
    $passwordErr = 'Please enter your password';
}

$userObj = new Users;

if(!empty($emailErr)){
    $res = array(
        "errorPwd"=>false,
        "errorEmail"=>true,
        "message"=>$emailErr
    );

    $jsonResponse = json_encode($res);

    header("Location:../Views/signin.php?data=".urlencode($jsonResponse));
    exit;
}
elseif(!empty($passwordErr)){
    $res = array(
        "errorPwd"=>true,
        "errorEmail"=>false,
        "message"=>$passwordErr
    );

    $jsonResponse = json_encode($res);

    header("Location:../Views/signin.php?data=".urlencode($jsonResponse));
    exit;
}else{

    $userObj->userPassword = $password;
    $userObj->userEmail = $email;

    $response = $userObj->signInUser();

if($response["status"]){
    
     header("Location:../Views/home.php");
     exit;
}else{
    require "../Views/signin.php";
}


}

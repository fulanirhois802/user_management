<?php

require_once "../classes/Users.php";

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$gender = $_POST['gender'];
$country = $_POST['country'];


function filterName($field){
    // Sanitize user name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    // Validate user name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, 
    array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    return $field; } else{
    return FALSE; }
    }

    function filterEmail($emailField){
        $emailField = filter_var(trim($emailField), 
        FILTER_SANITIZE_EMAIL);
    
        if(filter_var($emailField, FILTER_VALIDATE_EMAIL)){
            return $emailField;
        }else{
            return FALSE;
        }
    }

    function filterPhone($phoneNo){
            $phoneNo = filter_var(trim($phoneNo), 
            FILTER_SANITIZE_STRING);
        
            if(filter_var($phoneNo, FILTER_VALIDATE_REGEXP, 
            array("options"=>array("regexp"=>"/^[0-9]+$/")))){
                return $phoneNo;
            }else{
                return FALSE;
            }
        }
//Variable to assign th error message
$firstNameErr =
$lastNameErr =
$dobErr =
$genderErr =
$passwordErr =
$cpasswordErr =
$phoneErr =
$emailErr =
$countryErr = "";

if(empty($firstName)){
    $firstNameErr = "Please enter your first name";
}else{
    $firstName1 = filterName($firstName);
    if($firstName1 == FALSE){
        $firstNameErr = "Please enter a valid name";
    }
}

if(empty($lastName)){
    $lastNameErr = "Please enter your last name";
}else{
    $lastName1 = filterName($lastName);
    if($lastName1 == FALSE){
        $lastNameErr = "Please enter a valid name";
    }
}

if(empty($email)){
    $emailErr = 'Please enter your email address';
}else{
    $email1 = filterEmail($email);
    if($email1 == FALSE){
        $emailErr = "Please enter a valid email address";
    }
}

if(empty($phone)){
    $phoneErr = 'Please enter a phone number';
}else{
    $phone1 = filterPhone($phone);
    if($phone1 == FALSE){
        $phoneErr = 'Please enter a vaslid phone number';
    }
}

if(empty($password)){
    $passwordErr = 'Please enter your password';
}

if(empty($cpassword)){
    $cpasswordErr = 'Please confirm your password';
}

if($password != $cpassword){
     $cpasswordErr = 'Please your password does not match';
}



$userObj = new Users;

if(!empty($firstNameErr)){
    $res = array(
        "errorFn"=>true,
        "errorLn"=>false,
        "errorPwd"=>false,
        "errorCPwd"=>false,
        "errorPhone"=>false,
        "errorEmail"=>false,
        "message"=>$firstNameErr
    );

    $jsonResponse = json_encode($res);

    header("Location:../index.php?data=".urlencode($jsonResponse));
}elseif(!empty($lastNameErr)){
    $res = array(
        "errorFn"=>false,
        "errorLn"=>true,
        "errorPwd"=>false,
        "errorCPwd"=>false,
        "errorPhone"=>false,
        "errorEmail"=>false,
        "message"=>$lastNameErr
    );

    $jsonResponse = json_encode($res);

    header("Location:../index.php?data=".urlencode($jsonResponse));
}
elseif(!empty($emailErr)){
    $res = array(
        "errorFn"=>false,
        "errorLn"=>false,
        "errorPwd"=>false,
        "errorCPwd"=>false,
        "errorPhone"=>false,
        "errorEmail"=>true,
        "message"=>$emailErr
    );

    $jsonResponse = json_encode($res);

    header("Location:../index.php?data=".urlencode($jsonResponse));
}elseif(!empty($phoneErr)){
    $res = array(
        "errorFn"=>false,
        "errorLn"=>false,
        "errorPwd"=>false,
        "errorCPwd"=>false,
        "errorPhone"=>true,
        "errorEmail"=>false,
        "message"=>$phoneErr
    );

    $jsonResponse = json_encode($res);

    header("Location:../index.php?data=".urlencode($jsonResponse));
}elseif(!empty($passwordErr)){
    $res = array(
        "errorFn"=>false,
        "errorLn"=>false,
        "errorPwd"=>true,
        "errorCPwd"=>false,
        "errorPhone"=>false,
        "errorEmail"=>false,
        "message"=>$passwordErr
    );

    $jsonResponse = json_encode($res);

    header("Location:../index.php?data=".urlencode($jsonResponse));
}elseif(!empty($cpasswordErr)){
    $res = array(
        "errorFn"=>false,
        "errorLn"=>false,
        "errorPwd"=>false,
        "errorCPwd"=>true,
        "errorPhone"=>false,
        "errorEmail"=>false,
        "message"=>$cpasswordErr
    );

    $jsonResponse = json_encode($res);

    header("Location:../index.php?data=".urlencode($jsonResponse));
}else{
$userObj->userFirstName = $firstName;
$userObj->userLastName = $lastName;
$userObj->userAge = $dob;
$userObj->userGender = $gender;
$userObj->userPassword = $password;
$userObj->userPhone = $phone;
$userObj->userEmail = $email;
$userObj->userCountry = $country;


//$response = $userObj->getUserData();

$response = $userObj->saveUserData();

var_dump()

require "../Views/signinphp";

}
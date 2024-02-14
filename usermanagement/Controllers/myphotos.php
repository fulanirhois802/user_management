<?php


require_once("../classes/Users.php");

$obj = new Users;
$response = $obj->getUserPhoto();


if($response['status']===true){
	?>"<img src='../photos/'.<?php echo $response['photoName']   
}
?>
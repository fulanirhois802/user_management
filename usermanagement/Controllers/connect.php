<?php 

require_once "../classes/Databaseconnect.php";

$dbObj = new Databaseconnect;

$result = $dbObj->connectDb();

if($result === false){
    echo "Connection failed";
}else{
    echo "Connection Succesful";
}
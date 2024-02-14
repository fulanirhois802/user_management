<?php 

class Databaseconnect{
    public $hostname = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "users"; 


    public function connectDb(){
        $host = $this->hostname;
        $username = $this->username;
        $pass = $this->password;
        $db = $this->database;

        $mysqli = new mysqli($host, $username, $pass, $db);

        return $mysqli;
        // if($mysqli === false){
        //     die("Error: Could not connect.".$mysqli->connect_error);
        // }

        // echo "Connect Succesfully";
    }
}
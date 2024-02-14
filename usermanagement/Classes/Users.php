<?php
 require_once "../classes/Databaseconnect.php";

class Users{
    public $userId;
    public $userFirstName;
    public $userLastName;
    public $userAge;
    public $userGender;
    public $userEmail;
    public $userPhone;
    public $userPassword;
    public $userCountry;
    public $userPhoto;
    public $fileType;

    public function getUserData(){
        $userArray = array(
            "First Name"=>$this->userFirstName,
            "Last Name"=>$this->userLastName
        );
        return $userArray;
    }


    public function saveUserData(){
        $con = new Databaseconnect;
        $mysqlCon = $con->connectDb();

        $userid = str_shuffle(substr("1234567890abcdefghijklmnopqrstuvxyz",0,20));
        $hashedPassword = password_hash($this->userPassword,PASSWORD_DEFAULT);
        $regDate = date("Y-m-d H:i:s");
//Check if user have registered 
$querySQL = "SELECT user_email FROM user_personal_info WHERE user_email =?";


if($stmt = $mysqlCon->prepare($querySQL)){
    $stmt->bind_param("s", $this->userEmail);

    if($stmt->execute()){
        $stmt->store_result();
        
        if($stmt->num_rows >= 1){

            $response = array(
                'status'=>false,
                'message'=>'The user already registered'
            );
    
            return $response;
    
    
        }else{
    

        $sql = "INSERT INTO user_personal_info(user_uniqueid, user_firstname, user_lastname, user_dob
        ,user_phone, user_email, user_password, user_gender,
        user_nationality, user_reg_date)VALUES(?,?,?,?,?,?,?,?,?,?)";

        if($stmt = mysqli_prepare($mysqlCon, $sql)){
            mysqli_stmt_bind_param($stmt,'ssssssssss', $userid,  $this->userFirstName, $this->userLastName,
            $this->userAge, $this->userPhone, $this->userEmail,$hashedPassword,$this->userGender, $this->userCountry, $regDate);

            $stmt->execute();

           
            $response = array(
                'status'=>true,
                'message'=>'Successfully Registered'
            );
    
            return $response;
        }else{
            $response = array(
                'status'=>false,
                'message'=>"Error: .$sql.".$mysqlCon->error
            );
    
            return $response;
            
        }

        $stmt->close();

        $mysqlCon->close();


    }
}
    


}
}



public function signInUser(){
    $con = new Databaseconnect;
    $mysqlCon = $con->connectDb();

    $sql = "SELECT user_uniqueid, user_firstname, user_lastname, user_email, user_password FROM user_personal_info WHERE
    user_email=?";


    if($stmt = $mysqlCon->prepare($sql)){
        $stmt->bind_param("s", $this->userEmail);
        
        if($stmt->execute()){
            $stmt->store_result();
           
            if($stmt->num_rows >= 1){
               
                $stmt->bind_result($userId,$userFirstName, $userLastName,$userEmail,$userPass);
               
                    if($stmt->fetch()){
                        if(password_verify($this->userPassword, $userPass)){
                  
                        session_start();

                        $_SESSION["isLoggedIn"] = true;
                        $_SESSION["userId"] = $userId;
                        $_SESSION["userEmail"] = $userEmail;
                        $_SESSION["userFirstName"] = $userFirstName;
                        $_SESSION["userLastName"] = $userLastName;

                        $response = array(
                            "status"=>true,
                            
                        );
                        return $response;
                    }else{

                        $response = array(
                            "status"=>false,
                            "message"=>"Password is incorrect"
                        );
                        return $response;
                    }
                }
                
                
                
         
            }else{
                $response = array(
                    "status"=>false,
                    "message"=>"Error: Email address was not found"
                );
                return $response;
            }
        }
        $stmt->close();
    }
    $mysqlCon->close();
}










    


    public function savePhoto(){
        $date = date("Y:m:d H:i:s");

        $conn = new Databaseconnect;
        $mysqlCon=$conn->connectDb();
        $response;
        session_start();
        $uid = $_SESSION['userId'];


        $sql = "INSERT INTO photographs(photo_user, photo_file_name,photo_file_type,photo_date	)VALUES(?,?,?,?)";
        if($stmt = $mysqlCon->prepare($sql)){
            $stmt->bind_param("ssss",$uid,$this->userPhoto,$this->fileType, $date);
            $stmt->execute();

            $response = array(
                "status"=>true,
                "message"=>"Photo uploaded successfully"
            );
        }else{
            $response = array(
                "status"=>false,
                "message"=>"Error:could not prepare query: $sql.".$mysqlCon->error
            );
        }
$mysqlCon->close();

return $response;
    }

public function getUserPhoto (){
    $con = new Databaseconnect;
    $mysqlCon = $con->connectDb();
    session_start();
    $userid = $_SESSION[userId];

    $sql = "SELECT photo_user,	photo_file_name	,photo_file_type,photo_date FROM photographs WHERE photo_user=?";

    if($stmt = $mysqlCon->prepare($sql)){
        $stmt->bind_param("s", $userid);
        
        if($stmt->execute()){
            $stmt->store_result();
           
            if($stmt->num_rows >= 1){
               
                $stmt->bind_result($photo_user,$photo_file_name, $photo_date);
               
                    if($stmt->fetch()){
                       
                  
                  
                        $response = array(
                            "status"=>true,
                            "photoName"=>$photoName,
                            "photoDate"=>$photoDate
                            
                        );
                        return $response;
                 
                        
               
                }
                
                
                
         
        
            } 
        }
        $stmt->close();
    }
    $mysqlCon->close();

    // $sql "SELECT photo_file_name FROM photographs ";
  
}


}



?>
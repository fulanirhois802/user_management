<?php 
if(isset($_GET['data'])){
    $response = json_decode(urldecode($_GET['data']));

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management : Home</title>
    <link rel="stylesheet" href="style.css">
<style>
body,html{
    margin: 0;
    height: 100%;
}
.container{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
.form-container{
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    width: 50%;
    box-shadow: 1px 1px 2px 2px #ccc;
    border-radius: 15px;
    margin: 10px;
    padding-bottom: 20px;
    /* align-items: center;
    box-shadow: 1px 1px 2px 2px #ccc;
    width: 50%;
    border-radius: 15px;
    margin: 10px; */

}
.mb-3{
    margin-bottom: 10px;

}

.form-container input{
    width: 80%;
    height: 30px;
    border-radius: 10px;
    box-shadow: none;
    border: none;
    background: #ccc;
    padding: 5px;
    padding-left: 20px;
    
}
.form-container select{
    width: 80%;
    height: 30px;
    border-radius: 10px;
    box-shadow: none;
    border: none;
    background: #ccc;
    padding: 5px;
    padding-left: 20px;
}
.submit-btn{
    border: none;
    width: 80%;
    height: 30px;
    border-radius: 10px;
    background: #034bf4;
    color: #fff;

}
.form-container h3{
    line-height: 40px;
    letter-spacing: 2px;
}
/* .input-field{
    width: 80%;
} */
nav{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    background:  #034bf4;
}
.logo{
    margin-left: 50px;
    color: #fff;
    font-size: 30px;
    font-weight: bold;
}

.menu{
    margin-right: 100px;
}
.menu ul{
    display: flex;
    flex-direction: row;

}
.menu ul li{
    display: block;
    list-style: none;
    color: #fff;
    padding: 10px;
    margin: 2px;
    border-radius: 5px;
    transition: 0.5s ease;
}

.menu ul li:hover{
    background-color: #ccc;
}
.menu ul li a{
    text-decoration: none;
    letter-spacing: 1px;
    margin: 5px;
    color: #fff;

}

@media(max-width: 768px){
    .menu{
    display: flex;
    flex-direction: column;
}
.menu ul{
    display: flex;
    flex-direction: column;
    width: 100%;
}
nav{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
}
.logo{
    justify-content: flex-start;
    margin-left: 10px;
    color: #fff;
    font-size: 30px;
    font-weight: bold;
}
}

</style>

</head>
<body>
    <!-- <nav>

    </nav> -->
    <nav>
        <div class="logo">
            Logo
        </div>
        <div class="menu">
<ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About Us</a></li>
    <li><a href="#">Contact Us</a></li>
</ul>
        </div>
    </nav>
    <div class="container">
        <div class="form-container">
            <h3>Please all fields are required</h3>
            <?php if(isset($response)):?>
            <?php if($response['status']==false){?>
 <p><?php echo $response['message']?></p>
         <?php   }?>
           <?php endif;?>
            <form action="Controllers/signUpController.php" method="post">
                <div class="mb-3">
                    <input type="text" name="firstname" id="firstname" placeholder="Enter your first name here" class="input-field">
                <?php if(isset($_GET['data'])){
                   if($response->errorFn){
                    echo "<p style='color:red'>".$response->message."</p>";
                }
                }
                ?>
                
                </div>
                <div class="mb-3">
                    <input type="text" name="lastname" id="lastname" placeholder="Enter your last name here" class="input-field">
                    <?php if(isset($_GET['data'])){
                        if($response->errorLn){
                            echo "<p style='color:red'>".$response->message."</p>";
                        }
                   
                }
                ?>
                </div>
                <div class="mb-3">
                    <input type="text" name="email" id="email" placeholder="Enter your email here" class="input-field">
                    <?php if(isset($_GET['data'])){
                        if($response->errorEmail){
                            echo "<p style='color:red'>".$response->message."</p>";
                        }
                   
                }
                ?>
                </div>
                <div class="mb-3">
                    <input type="text" name="phone" id="phone" placeholder="Enter your phone number here" class="input-field">
                    <?php if(isset($_GET['data'])){
                        if($response->errorPhone){
                            echo "<p style='color:red'>".$response->message."</p>";
                        }
                   
                }
                ?>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" id="password" placeholder="Create your password here" class="input-field">
                    <?php if(isset($_GET['data'])){
                        if($response->errorPwd){
                            echo "<p style='color:red'>".$response->message."</p>";
                        }
                   
                }
                ?>
                
                </div>
                <div class="mb-3">
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password here" class="input-field">
                    <?php if(isset($_GET['data'])){
                        if($response->errorCPwd){
                            echo "<p style='color:red'>".$response->message."</p>";
                        }
                   
                }
                ?>
                </div>
                <div class="mb-3">
                    <select name="gender" id="gender" class="input-field">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="mb-3">
                <input type="date" name="dob" id="dob" placeholder="Enter your date of birth">
                </div>
                <div class="mb-3">
                <select name="country" id="country" class="input-field">
                        <option>Nigeria</option>
                        <option>Ghana</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button class="submit-btn">Submit</button>
                </div>

                <p>Already, have an account? <a href="Views/signin.php">Sign In</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User : Home</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
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
  <div class="section1">
    <div class="user-menu">
<ul>
    <li>
        <a href="../Views/home.php">Home</a>
    </li>
    <li>
        <a href="../Views/photos.php">Photos</a>
    </li>
    <li>
        <a href="#">My Contacts</a>
    </li>
</ul>
    </div>
    <div class="user-details">
   <div class="upload-card">
    <div class="card-header">
<h4>Upload new photo</h4>
    </div>
    <div class="card-body">
      <form action="" method="post" id="uploadform" enctype="multipart/form-data">
        <input type="file" name="photo" id="file">
        <button type="button" id="uploadBtn">Upload</button>
      </form>
    </div>
   </div>
    </div>
    <div class="photo-display">
<div class="display-card">
    <div class="card-header">
<h4>Upload new photo</h4>
    </div>
    <div class="card-body">
      
    </div>
   </div>
    </div>
</div>
  </div>


</div>


<script src="../res/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function(){
        $("#uploadBtn").click(function(){
            let filename = $("#file").val();
if(filename==" "){
    alert("No file selected");
}else{
    let uploadform = document.getElementById('uploadform');
    formData = new FormData(uploadform);

    $.ajax({
        type:'POST',
        url: '../Controllers/photoUpload.php',
        data:formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(e){
            alert(e);
            $('#uploadform')[0].reset();
        }
    })
}
            alert(filename);
        })
    })
</script>
</body>
</html>
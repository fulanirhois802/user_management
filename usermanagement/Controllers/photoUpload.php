<?php 


require_once("../classes/Users.php");




$objectUser = new Users;


if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
	$allowed = array("jpg"=>"image/jpg",
	"JPEG"=>"image/jpeg",
	"jpeg"=>"image/jpeg",
	"png"=>"image/png"

	
);
$filename = $_FILES["photo"]["name"];
$filetype = $_FILES["photo"]["type"];
$filesize = $_FILES["photo"]["size"];


//get the file type
$extension = pathinfo($filename, PATHINFO_EXTENSION);
if(!array_key_exists($extension, $allowed))
die("Error: please select a valid format");

$maxsize = 5 * 1024 * 1024;
if($filesize > $maxsize)
die("Error: file size is larger than the allowed limit.");


$filename = explode(".",$filename);
$prefix = str_shuffle(substr("1234567890abcdefghijklmnopqrstuvwxyz",0,6));
$newfileName = $prefix.$filename[0].".".$filename[1];

if(in_array($filetype, $allowed)){
	if(file_exists("../photos/".$newfileName)){
		echo $newfileName." already exists.";

	}else{
		move_uploaded_file($_FILES["photo"]["tmp_name"], "../photos/".$newfileName);


		$objectUser->userPhoto =$newfileName;
		$objectUser->fileType =$filetype;
		$response = $objectUser->savePhoto();
		if($response["status"] == true){
			echo $response["message"];
		}else{
			echo $response["message"];
		}
	}
}else{
	echo "Error: there is a problem uploading your files";
}

}else{
	echo "Error:no file selected";
}

?>
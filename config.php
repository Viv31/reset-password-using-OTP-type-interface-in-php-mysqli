<?php 
$host ="localhost";
$user = "root";
$db_password = "";
$db_name = "reset-password-using-OTP-type-interface";
$conn = mysqli_connect($host,$user,$db_password,$db_name);
if($conn){
	//echo "Connected";

}
else{
	echo "Connection Error";
}


?>
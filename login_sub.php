<?php 
require_once('config.php');
$username = $_POST['username'];
$password = md5($_POST['password']);

$login_query = "SELECT username,password FROM registration WHERE username = '".$username."' AND password='".$password."'";
$res = mysqli_query($conn,$login_query);
if(mysqli_num_rows($res)>0){
	echo "Login";

}
else{
	echo "Failed";
}
?>
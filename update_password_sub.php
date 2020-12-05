<?php
require_once('config.php');
$mobile_no = $_POST['mobile_no'];
$password = md5($_POST['password']); 
$conf_password = $_POST['conf_password'];

$update_password = "UPDATE registration set password='".$password."' WHERE mobile_no='".$mobile_no."'";
$res = mysqli_query($conn,$update_password);
if($res){
	echo "Update";

}
else{
	echo "Failed";
}
?>
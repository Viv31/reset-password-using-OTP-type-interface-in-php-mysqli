<?php
require_once('config.php');
$mobile_no = $_POST['mobile_no'];

$Get_New_OTP = "SELECT * FROM registration WHERE mobile_no='".$mobile_no."'";
$res = mysqli_query($conn,$Get_New_OTP);
if(mysqli_num_rows($res)>0){
	while ($rs = mysqli_fetch_assoc($res)) {
		echo "Your OTP is " .$rs['OTP'];

	}

}

?>
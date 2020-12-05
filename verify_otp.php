<?php 
require_once('config.php');
$otp = $_POST['OTP'];

$chkOTP = "SELECT OTP FROM registration WHERE OTP ='".$otp."' AND OTP_verify!=1";
$res = mysqli_query($conn,$chkOTP);
if(mysqli_num_rows($res)>0){

	$update_OTP ="UPDATE registration SET OTP_verify = 1 WHERE OTP = '".$otp."'";
	$result = mysqli_query($conn,$update_OTP);
	if($result!=true)
	{//echo "Failed";
}
else
{//echo "Update"; 
}

	echo "OTP Verify";
}
else{

	echo "OTP Not Verify";
}

?>
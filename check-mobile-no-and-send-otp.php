<?php 
require_once('config.php');
$user_inserted_mob = $_POST['mobile_no'];

$check_no = "SELECT mobile_no from registration WHERE mobile_no = '".$user_inserted_mob."' ";
$res = mysqli_query($conn,$check_no);
if(mysqli_num_rows($res)>0){
	//Generate random number of 4 digit and update on table
	$characters = '0123456789';
	$OTP_length = 4;
	 $generated_otp = '';
	  $max = strlen($characters) - 1;
  		for ($i = 0; $i < $OTP_length; $i++) {
       $generated_otp .= $characters[mt_rand(0, $max)];
		 }

		 //echo $generated_otp;
		 echo "Matched"; //exit();

	//Update OLD OTP 
	$update_old_otp = "UPDATE registration set `OTP` = '".$generated_otp."',`OTP_verify`= 0 WHERE mobile_no = '".$user_inserted_mob."' ";
	$result = mysqli_query($conn,$update_old_otp);
		if($result){
				echo "OTP SENT";
			}
		else{
			echo "OTP Failed";
		}


}
else{
	echo "Not Matched";
}


?>
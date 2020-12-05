<?php include_once('header.php'); ?>
<div id="login_div" style="left:0;height:100%;width:100%;position: absolute;top:0;background-color: rgba(0,0,0,0.7);z-index: 999;">
  <img src="loader.gif" height="50" width="50" style="margin-top:250px;margin-left: 50%;">
</div>
  <div class="row mt-5">
    <div class="col-md-4 mx-auto">
      <div class="form-group">
        <label>Mobile No:</label>
        <input type="text" name="mobile_no" id="mobile_no" placeholder="Enter Registred Mobile Number" class="form-control" maxlength="10" minlength="10" >
        <span id="mobile_chk"></span>
      </div>
      
      <button type="button" class="btn btn-dark" id="send_otp">Send OTP </button>
     
    </div>
  </div>
  <div class="row mt-5" id="otp_field_container">
    
    <div class="col-md-4 mx-auto">
      <div id="OTP_Container" class="bg-dark text-white h-5 p-5"></div>
      <div class="form-group">
        <label>Enter OTP:</label>
        <input type="number" name="OTP" id="OTP" placeholder="Enter OTP" class="form-control" onkeyup="return VerifyOTP(this.value);">
        <span id="OTP_error"></span>
      </div>
    </div>
  </div>
  <div class="row mt-5" id="reset_password_section">
    <div class="col-md-4 mx-auto">
      <h5 class="text-center">Rest Password</h5>
      <div class="form-group">
        <label>New Password:</label>
        <input type="Password" name="password" id="password" placeholder="Enter New Password" class="form-control">
      </div>
      <div class="form-group">
        <label>Confirm Password:</label>
        <input type="Password" name="conf_password" id="conf_password" placeholder="Re Enter New Password" class="form-control">
      </div>
      
      <button type="button" class="btn btn-primary" id="update_password">Update Password</button>
     
    </div>
  </div>
<?php include_once('footer.php'); ?>
<script type="text/javascript">
  
  //Initially hiding Password Updation form until mobile number is not verify or OTP not Verify
  $(document).ready(function(){
    $("#otp_field_container").hide();
    $("#reset_password_section").hide();

    //Checking 
    $("#send_otp").click(function(){
      var mobile_no = $("#mobile_no").val();
      //var mobile_length = mobile_no.length; //getting length of mobile no.
      var data = {
        "mobile_no":mobile_no
      }
      $.ajax({
        type:'POST',
        url:'check-mobile-no-and-send-otp.php',
        data:data,
        success:function(res){
          if(res == "Matched"){
            //alert("Matched");

          }
          else if(res == "Not Matched"){
            //alert("Enter registred number");
            $("#mobile_chk").text("Please Enter registred mobile number");
            $("#mobile_no").css("border-color",'red');



          }
         else if(res =="MatchedOTP SENT"){
            //alert("OTP SENT");
           $.ajax({
              type:'POST',
              url:'get_new_OTP.php',
              data:data,
              success:function(res1){
                //alert(res1);
                //Getting OTP value
                $("#OTP_Container").html(res1);

              },
            });
             $("#otp_field_container").show();
          }
          else{
            alert("OTP Failed");
          }

        },
      });
      
      /*$( document ).ajaxComplete(function() {
         
          
    });*/

    });


    //Updating New Password:
    

  });


   
    $("#login_div").hide();
    $("#update_password").click(function(){
      var mobile_no = $("#mobile_no").val();
      //alert(mobile_no);
      var password = $("#password").val();
      var conf_password = $("#conf_password").val();

      /*if(conf_password === password){
        alert("Both Passwords are not matching");
        return false;

      }*/

      var data = {
          "mobile_no":mobile_no,
          "password":password,
          "conf_password":conf_password
      }

      $.ajax({
        type:"POST",
        url:"update_password_sub.php",
        data:data,
        beforeSend:function(){
        $("#login_div").show();
      },
      success:function(res){
        if(res=="Update"){
           $("#login_div").hide();
          //alert("Login Success");
          window.location.href = "index.php";

        }
        if(res == "Failed"){
          $("#login_div").hide();
            $("#login_chk").text("please check login details");
        }

      }

      });


    });

 

//Cheking User inserted OTP value
function VerifyOTP($otp){
    //console.log($otp);
     var mobile_no = $("#mobile_no").val();
     var OTP = $otp;
     //alert(OTP);

     var data = {
      "mobile_no":mobile_no,
      "OTP":OTP

     }

     $.ajax({
      type:"POST",
      url:"verify_otp.php",
      data:data,
      beforeSend:function(){
        $("#OTP_error").text("Checking OTP ..............");
      },
      success:function(response){
        $("#OTP_error").text("");
        if(response == "OTP Verify"){
          //alert("Verified");
          $("#OTP").css("border-color",'green');

          $("#reset_password_section").show();

        }
        if(response == "OTP Not Verify"){
          //Checking  for OTP 
          $("#OTP").css("border-color",'red');
          $("#OTP_error").text("Please Enter Correct OTP");


        }

      }

     });
}

</script>

<?php include_once('header.php'); ?>
<div id="login_div" style="left:0;height:100%;width:100%;position: absolute;top:0;background-color: rgba(0,0,0,0.7);z-index: 999;">
  <img src="loader.gif" height="50" width="50" style="margin-top:250px;margin-left: 50%;">
</div>
  <div class="row mt-5">
    
    <div class="col-md-4 mx-auto">
      <div class="form-group">
        <input type="email" name="username" id="username" placeholder="Enter Username" class="form-control">
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
      </div>

      <button type="button" class="btn btn-dark" id="login">Login</button>
      <a href="foregt-password.php" class="btn btn-warning" target="_blank">Forget Password</a>
    </div>
  </div>
  <div class="col-md-4 mx-auto" id="login_chk"></div>
<?php include_once('footer.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#login_div").hide();
    $("#login").click(function(){
      var username = $("#username").val();
      var password = $("#password").val();

      var data = {
          "username":username,
          "password":password
      }

      $.ajax({
        type:"POST",
        url:"login_sub.php",
        data:data,
        beforeSend:function(){
        $("#login_div").show();
      },
      success:function(res){
        if(res=="Login"){
           $("#login_div").hide();
          //alert("Login Success");
          window.location.href = "dashboard.php";

        }
        if(res == "Failed"){
          $("#login_div").hide();
            $("#login_chk").text("please check login details");
        }

      }

      });


    });

  });
</script>
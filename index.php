
<?php

//$url = 'auth/php/db.php';
$url_enc ='module/enc_dec.php';
include('auth/php/db.php');
include('module/php/verify_token.php');


 //echo verify_token($url,$url_enc);
if(verify_token($db,$url_enc) == "true"){
echo "verified";
header('Location: pages/dashboard.php');
}else{
echo " invalid token";

}







  ?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!--  Alert Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!--  Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<body>

<nav class="navbar navbar-light bg-light" style="background-color: #0f0c29" style="height: 100px;" >
  <a class=" navbar-brand"  style="margin-right: 0: -300px;">Home</a>
  
  <div class="form-group">


  	 <div class="form-group btn btn-primary" data-toggle="modal" data-target="#signinModal">Sign In</div>
  	 <div class="form-group btn btn-secondary" data-toggle="modal" data-target="#signupModal">Sign Up</div>
  </div>
 
</nav>

	<h2 style="background-color: #0f0c29 " =></h2>
	<h1>WELCOME <a style="background-color: #0f0c29 " =></a></h1>
	<h6>Please Sign In...</h6><br><br><br><br>
	<p> Changelog ver1.00</p>


	
<!-- Modal Signin -->
<div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinModal" aria-hidden="true" style="  backdrop-filter: blur(10px);">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
			
				<div class="modal-title" id="signinModal">Sign In</div>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
	

			</div>
			<div class="modal-body">
					<div id="notif"   role="alert" style="display: none;">
						
					<h6 id="notif_text" ></h6>

					</div>
			
					<div class="form-group">
						<input id="user_login"  class="form-control" type="text" name="" placeholder="Enter Username">
						<input id="pass_login" type="password" class="form-control" name="" placeholder="Enter Password">


					</div>
			
				
			</div>
			<div class="modal-footer">

				<button id="signin" class="form-control btn btn-primary" onclick="login();">
					<span id="loading_login" class="" role="status" aria-hidden="true"></span>
						Sign In
				</button>

			</div>

		</div>
	</div>
</div>
<!-- Modal Signup  -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModal" aria-hidden="true" style="  backdrop-filter: blur(10px);">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title" id="signupModal">Sign Up</div>
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="modal-body">
				<div id="notif_2"   role="alert" style="display: none;">
						
					<h6 id="notif_text_2" ></h6>

					</div>
			
					<div class="form-group">
						<label for="r_username">*Enter Username</label>
						<input id="r_username" class="form-control" type="text" name="" placeholder="Enter Username">
						<label for="r_name">*<div></div> Enter Name and Lastname</label>
						<input id="r_name" class="form-control" type="text" name="" placeholder="Enter Firtsname">
						<input id="r_lastname" class="form-control" type="text" name="" placeholder="Enter Lastname">
						<label for="r_password">*Enter Password</label>
						<input id="r_password" type="password" class="form-control" name="" placeholder="Enter Password">
						<input id="r_cpassword" type="password" class="form-control" name="" placeholder="Confirm Password">
					</div>
			
				
			</div>
			<div class="modal-footer">
				<button id="signup" onclick="signup();" class="form-control btn btn-primary ">
				<span id="loading" class="" role="status" aria-hidden="true"></span>
				Sign Up</button>
			</div>

		</div>
	</div>
</div>

<div class="footer fixed-bottom ">
	
			<div class="row m-auto m-auto" style="max-width: 800px;height: 100%; position:sticky;">

				<div class="col-12">
					<center>
						<div class="card shadow bg-light" style="height: 60px;border-top-right-radius: 20px;border-top-left-radius: 20px;max-width: 800px;"> 

							<div class="row" style="margin-top: 10px;margin-right: 5px;margin-left: 5px;font-size: 12px;">
								<div class="col-4 btn btn-sm"   style="text-align: center;">Dashboard</div>
								<div class="col-4 4 btn btn-sm " style="border-radius: 0px; border-left: 1px;border-right: 1px;border-style: solid;border-top: 0px;border-bottom: 0px;" >Wallet</div>
								<div class="col-4 4 btn btn-sm" style="text-align: center;">Earn</div>
							</div>

						</div>
					</center>
				</div>
			</div>
	</div>



</body>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script type="text/javascript" src="auth/js/auth.js"></script>



 







</html>

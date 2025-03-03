<?php
 require('../auth/php/db.php');
 include('../module/php/verify_token.php');

//$url = '../auth/php/db.php';
$urlEnc = '../module/enc_dec.php';
//echo verify_token($url);



if(verify_token($db,$urlEnc) == "true"){
echo "verified";


}else{
echo " invalid token";
header('Location: ../index.php');
}

// Get user info
include('php/user_info.php');
$db_path = '../auth/php/db.php';
$row = getUserinfo($db);




$username = $_COOKIE['username'];
$username = enc_dec('dec',$username);


//print_r(getRecipient($db_path));
  ?>

<!DOCTYPE html>
<html>
<head>
<title>SEND</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="css/preloader.css">
       <!--  Alert Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<body>




		<!-- Preloader -->
		 <div class="preloader">
		    <div class="loader">
		        <div class="loader-outter"></div>
		        <div class="loader-inner"></div>

		        <div class="indicator"> 

		            <svg width="16px" height="12px">

		                <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
		                <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
		            </svg>
		        </div>
		    </div>
		</div> 

	<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
  
    Bootstrap
  </a>


  	  	<div class="dropdown" >
		  <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
		    <?=$username?>
		  </button>
		  <div class="dropdown-menu">
		    <a class="dropdown-item" onclick="logout();" href="#">Logout </a>
		  
		  </div>
	   </div>
</nav>

 <ol class="breadcrumb" style="height: 45px;">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="dashboard.php">Wallet</a></li>
    <li class="breadcrumb-item active" aria-current="page">Send</li>
  </ol>


	<div class="container-fluid " style="margin-bottom: 10px;">
		<div class="row m-auto" style="max-width: 800px;padding-bottom: 10px;">
			<div class="col-md-12 justify-content-center" style=" box-shadow: 100px; border-radius: 20px;height: 320;background-image: linear-gradient(to right bottom, #60e783, #71e770, #83e65b, #95e543, #a8e325);">
				<!-- <div class="row">
					<div class="col-12">
						<div class="text-white " style="font-size: 30px;"> </div>

					</div>


				
						
					
			
				</div> -->
				<div class="row" style="">
					<div class="col" style="width: 100%;margin-top: 25px;">
						<div class="form-group">
							<center><h3 class="text-white" style="margin-bottom: 20px;">₱ <?=number_format((float)$row['php'], 2, '.', ',');?></h3></center>
							<center><h3 class="text-white" style="margin-bottom: 20px;">Account Number</h3></center>
							<div class="row">
								<div class="col" style="margin-right: -20px;">
									<input  id="accountNumber" class="form-control" type="number" name="" style=" border-radius: 20px; height: 35px;text-align: center;">
								</div>
								<div class="col-2">
									
										

											<select onchange="changeAccNum()" id="selectRecipient" class="form-control form-control-sm "> 
												<option value="">Default</option>
												<?php 
											
													$stmt = getRecipient($db);
													if($stmt){

														while($row = $stmt->fetch()){
														
															//echo $row['user_accountNumber'];
															echo '<option value="'.$row['user_recipient'].'">'.$row['user_recipient'].' - '.$row['user_fullName'].'</option>';
														}

													}else{
														echo '<option value="">No saved recipient</option>';
													}
												
														

													?>
											
											</select>
													
								</div>
							</div>
							
					

							<center><h3 class="text-white" style="margin-bottom: 20px;">Amount</h3></center>
							<input  id="amount" class="form-control" type="number" name="" style="border-radius: 20px; height: 35px;text-align: center;">
						</div>
						<button id="btn_send" onclick="sendmoney();" class="t-money"  style="height: 35px;">
						<span id="loading_send" class="" role="status" aria-hidden="true"></span>
							Transfer Money</button>
						
					</div>
				</div>



				
			
			</div>
		</div>

		</div>



<!-- 				<div class="container-fluid " style="margin-bottom: 100px;">
					<div class="row m-auto" style="max-width: 800px;padding-bottom: 10px;">
						<div class="col-md-12 justify-content-center" style=" box-shadow: 100px; border-radius: 20px;height: 500px;background-image: linear-gradient(to right bottom, #60e783, #71e770, #83e65b, #95e543, #a8e325);">

								<div class="row" style="">
									<div class="col" style="width: 100%;margin-top: 25px;">
										<center><h4 class="text-white">Transaction History</h4></center>
										
									</div>
								</div>
							
						</div>
					</div>
				</div> -->
	
	</div>

<div class="footer fixed-bottom ">
	
			<div class="row m-auto m-auto" style="max-width: 800px;height: 100%; position:sticky;">

				<div class="col-12">
				<center>
					<div class="card shadow bg-light" style="height: 60px;border-top-right-radius: 20px;border-top-left-radius: 20px;max-width: 800px;"> 

						<div class="row" style="margin-top: 10px;margin-right: 5px;margin-left: 5px;font-size: 12px;">
							<div class="col-4 btn btn-sm"   style="text-align: center;">
								<a href="home.php">Home</a>
							</div>
							<div class="col-4 4 btn btn-sm " style="border-radius: 0px; border-left: 1px;border-right: 1px;border-style: solid;border-top: 0px;border-bottom: 0px;" >
								<a href="dashboard.php">Dashboard</a>
							</div>
							<div class="col-4 4 btn btn-sm" style="text-align: center;">Invite</div>
						</div>

					</div>
				</center>
				</div>
			</div>
	</div>
</body>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    	

    <script src="js/sendform.js"></script>
    <script src="../auth/js/auth.js"></script>
    <script src="js/main.js"></script>
	<script src="../auth/js/jquery-3.7.1.min.js"></script>


</html>
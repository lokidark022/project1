<?php
require('../auth/php/db.php');
include('../module/php/verify_token.php');
date_default_timezone_set('Asia/Manila');
//print(verify_token());

//$url = '../auth/php/db.php';
$urlEnc = '../module/enc_dec.php';
//echo verify_token($url);
if(verify_token($db,$urlEnc) == "true"){
	echo "verified";

}else{
	echo " invalid token";
	header('Location: ../index.php');
}

// $username = $_COOKIE['username'];
// $username = enc_dec('dec',$username);

// Get user info
include('php/user_info.php');
//$db_path = '../auth/php/db.php';
$row = getUserinfo($db);

//Get subscriptions
//$urlEnc = '../module/enc_dec.php';
include('php/subscriptions.php');
//$db_path = '../auth/php/db.php';
$row_userinfo = getSubscriptions($db,'');

//print_r($row_userinfo);



$php = $row['php'];
$username = $row['username'];
$account_number = $row['account_number'];
$tran_total = 0;


// Get user active subscriptions benifits
include('php/user_subscriptions_data.php');
$user_active_benifits = get_active_subs($db,$account_number);
$stats = $user_active_benifits->status;
$max_credits = $user_active_benifits->max_credits;
$daily_interest = $user_active_benifits->daily_interest;
$transfer_fee = $user_active_benifits->transfer_fee;

//print_r($stats);
//echo $transfer_fee;




?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="css/preloader.css">
	<!--  Alert Awesome -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	

	<!-- fafa fontawsome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



	<body >


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





		<nav class="navbar navbar-light bg-light" style="margin:0px;padding: 0px;">

			<a class="navbar-brand  "  href="#" >

				Bootstrap
			</a>

			<div class="dropdown " >
				<button class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
					<?=$username?>
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" onclick="logout();" href="#">Logout </a>

				</div>
			</div>
		</nav>


		<ol class="breadcrumb" style="height: 45px; ">
			<li class="breadcrumb-item active">Home</li>
			<!-- <li class="breadcrumb-item active">Wallet</li> -->
		</ol>

		<div class="container-fluid" style="margin-bottom: 25px; padding: 0px;margin: 0px;">





			<div class="row m-auto" style=" position:sticky;">


				<div class="col-12">

					
					<div class="row m-auto" style="max-width: 800px;height: 100%; position:sticky;">

						<div class="col-12 ml-auto mr-auto">
							<div class="row ">

								<div class="col-sm-12">
									<div class="card shadow text-white" style=" border-radius: 10px;">
										<div class="card-body">

											<div class="row bg-dark" style="margin-top: -15px;margin-bottom: 5px; border-radius: 5px;opacity: 0.7;">
												<div class="col-12"> <small style="font-size:12px;">Active Subscriptions</small> </div>

											</div>
											<div class="row bg-dark" style="border-radius: 5px;opacity: 0.7; height: 130px;">
												<div class="col" style="margin-left:2px;padding: 0px;">
													Benifits:
													<ul>
														<li style="font-size:12px;">Max Credits: <?=$max_credits?></li>
														<li style="font-size:12px;">Daily Interest: <?=$daily_interest?>%</li>
														<li style="font-size:12px;">Money Transfer Fee: <?=$transfer_fee?>% </li>

													</ul>
												</div>



											</div>
						<!-- 				<div class="row bg-dark" style="opacity:0.8;border-radius: 5px;height: auto;">
											<div class="col-5">	 
											
											</div>
											<div class="col">	
												<div class="text-white" style="font-size:14px;">
													<small></small>
												</div>
											</div>


										</div> -->

									</div>
								</div>
							</div>






							<?php
							$active = 'false';
							while($row = $row_userinfo->fetch()) {

								$bg_color1 = 'radial-gradient(circle, #e059e7, #c74ddb, #af42ce, #9737c2, #7e2cb5);';
								$bg_color2 = 'radial-gradient(circle, #8ff97d, #b5cc33, #cb9c00, #d26801, #c92728);';
								$bg_color3 = 'radial-gradient(circle, #00dacf, #00d3ae, #00cb86, #00c155, #3db506);';
								$pak = $row['pak'];
								$data = check_user_subscriptions($db,$account_number,$pak);
								$btn_text = '';
								if($data->status == 'active'){
									$active = 'true';
									$btn_text = 'Activated';
								}else{
									$active = 'false';
									$btn_text = 'Activate';
								}
							//$date_expired = $data->date_until;
							//print_r($data->date_until);

								?>


								<div class="col-sm-6">
									<div class="card shadow m-2 text-white" style="height: 205px;background-image: <?php if($row['pak'] == '1'){echo $bg_color1;}elseif($row['pak'] == '2'){echo $bg_color2;}else{echo $bg_color3;}?>border-radius: 10px;">
										<div class="card-body">

											<div class="row bg-dark" style="margin-top: -15px;margin-bottom: 5px; border-radius: 5px;opacity: 0.7;">
												<div class="col-8"><?=$row['days']?> Days</div>
												<div class="col" style=""><h6 style="text-align: right;">₱ <?=$row['price']?></h6></div>
											</div>
											<div class="row bg-dark" style="border-radius: 5px;opacity: 0.7; height: 105px;">
												<div class="col" style="margin-left:2px;padding: 0px;">
													Benifits:
													<ul>
														<li style="font-size:12px;">Max Credits: +<?=$row['max_credits']?></li>
														<li style="font-size:12px;">Daily Interest: +<?=$row['daily_interest']?>%</li>
														<li style="font-size:12px;">Money Transfer Fee: <?=$row['transfer_fee']?><?php if($row['transfer_fee'] != 'free'){echo '%';} $transfer_fee?></li>

													</ul>
												</div>
												<br>


											</div>
											<div class="row bg-dark mt-1" style="opacity:0.8;border-radius: 5px;height: 52px;">
												<div class="col-5">	 
													<button class="btn text-white  mt-1 border" <?php if($active == 'true'){echo 'disabled';} ?> onclick="subscribe(<?=$row['pak']?>);">
														<h6 ><?=$btn_text?></h6>
													</button>
												</div>
												<div class="col">	
													<div class="text-white" style="font-size:14px;">
														<small><?php if($active =='true'){echo 'Until:<br>'.$data->date_until;}else{} ?></small>
													</div>
												</div>


											</div>

										</div>
									</div>
								</div>


								<?php

							}




							?>





					<!-- 	<div class="col-sm-6">
							<div class="card shadow m-2 text-white" style="height: 195px;background-image: radial-gradient(circle, #8ff97d, #b5cc33, #cb9c00, #d26801, #c92728);border-radius: 10px;">
								<div class="card-body">

									<div class="row bg-dark" style="margin-top: -15px;margin-bottom: 5px; border-radius: 5px;opacity: 0.7;">
										<div class="col-8">10 Days</div>
										<div class="col" style=""><h6 style="text-align: right;">₱ 500</h6></div>
									</div>
									<div class="row bg-dark" style="border-radius: 5px;opacity: 0.7; height: 105px;">
										<div class="col" style="margin-left:2px;padding: 0px;">
											Benifits:
											<ul>
												<li style="font-size:12px;">Max Credits: +5</li>
												<li style="font-size:12px;">Daily Interest: +5%</li>
												<li style="font-size:12px;">Bunos: + ₱50</li>
												<li style="font-size:12px;"> Free Money Transfer: Unlimited</li>

											</ul>
										</div>
										<br>
										
										
									</div>
									<div class="row bg-dark mt-1" style="opacity:0.8;border-radius: 5px;">
										<div class="col">	
											<div class="btn text-white">
												<h6 >Activate</h6>
											</div>
										</div>
										
										
									</div>

								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card shadow m-2 text-white" style="height: 195px;background-image: radial-gradient(circle, #00dacf, #00d3ae, #00cb86, #00c155, #3db506);border-radius: 10px;">
								<div class="card-body">

									<div class="row bg-dark" style="margin-top: -15px;margin-bottom: 5px; border-radius: 5px;opacity: 0.7;">
										<div class="col-8">15 Days</div>
										<div class="col" style=""><h6 style="text-align: right;">₱ 1,000</h6></div>
									</div>
									<div class="row bg-dark" style="border-radius: 5px;opacity: 0.7; height: 105px;">
										<div class="col" style="margin-left:2px;padding: 0px;">
											Benifits:
											<ul>
												<li style="font-size:12px;">Max Credits: +8</li>
												<li style="font-size:12px;">Daily Interest: +8%</li>
												<li style="font-size:12px;">Bunos: + ₱110</li>
												<li style="font-size:12px;"> Free Money Transfer: Unlimited</li>

											</ul>
										</div>
										<br>
										
										
									</div>
									<div class="row bg-dark mt-1" style="opacity:0.8;border-radius: 5px;">
										<div class="col">	
											<div class="btn text-white">
												<h6 >Activate</h6>
											</div>
										</div>
										
										
									</div>

								</div>
							</div>
						</div> -->
						<div class="col-sm-6 btn" disabled style="opacity: 0.5;">
							<div class="card shadow m-2" style="height: 150px;">
								<div class="card-body">
									<h3 style="margin: 10%;">Not availabe</h3>
								</div>
							</div>
						</div>
						<div class="col-sm-6 btn" disabled style="opacity: 0.5;">
							<div class="card shadow m-2" style="height: 150px;">
								<div class="card-body">
									<h3 style="margin: 10%;">Not availabe</h3>
								</div>
							</div>
						</div>
						<div class="col-sm-6 btn" disabled style="opacity: 0.5;">
							<div class="card shadow m-2" style="height: 150px;">
								<div class="card-body">
									<h3 style="margin: 10%;">Not availabe</h3>
								</div>
							</div>
						</div>


					</div>

				</div>

			</div>

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

<script src="js/main.js"></script>
<script src="js/sendform.js"></script>
<script src="js/subscriptions.js"></script>

<script src="../auth/js/auth.js"></script>
<script src="../auth/js/jquery-3.7.1.min.js"></script>


</html>
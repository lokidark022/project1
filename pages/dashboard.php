<?php
require('../auth/php/db.php');
include('../module/php/verify_token.php');

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

//Get subscriptions
//$urlEnc = '../module/enc_dec.php';
include('php/subscriptions.php');
$db_path = '../auth/php/db.php';
$row_userinfo = getSubscriptions($db,'');

// Get user info
include('php/user_info.php');
$db_path = '../auth/php/db.php';
$row = getUserinfo($db);
$account_number = $row['account_number'];

// Get user active subscriptions benifits
include('php/user_subscriptions_data.php');
$user_active_benifits = get_active_subs($db,$account_number);
// $stats = $user_active_benifits->status;
// $max_credits = $user_active_benifits->max_credits;
$daily_interest = $user_active_benifits->daily_interest;
// $transfer_fee = $user_active_benifits->transfer_fee;
//echo $daily_interest;



$php = $row['php'];
$username = $row['username'];
$account_number = $row['account_number'];
$tran_total = 0;
?>

<!DOCTYPE html>
<html>
<head>
	<title>DASHBOARD</title>
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







	<nav class="navbar navbar-light bg-light" >

		<a class="navbar-brand  "  href="#" style="width:30%;">

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


	<ol class="breadcrumb" style="height: 45px;">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active">Wallet</li>
	</ol>


	<div class="container-fluid " style="margin-bottom: 5px;">

		
		<div class="row m-auto" style=" position:sticky;">
			

			<div class="col-12">
				

				<div class="row m-auto" style="max-width: 800px;padding-bottom: 10px;min-width: 300px;">
					<div class="col-12 justify-content-center" style="box-shadow: 100px; border-radius: 20px;height: 200px;background-image: linear-gradient(to right bottom, #60e783, #71e770, #83e65b, #95e543, #a8e325);">
						<div class="row">
							<div class="col-8">
								<div class="text-white " style="font-size: 25px;">₱ <?=number_format((float)$php, 2, '.', ',');?></div>

							</div>
							<div class="col-4">
								<div class="text-white " style="font-size: 14px;text-align: right;">Interest <?=$daily_interest?>%</div>
							</div>
							<div class="row ">
								<div class="col ml-3">
									<div class="text-white " style="font-size: 20px;">Account Number <br><?=$account_number?></div>
								</div>
							</div>
						</div>
						<div class="row" >
							<div class="col" style="width: 100%;">
								<button id="transferMoney" id="tmoney" onclick="tmoney()" href class="t-money">
									<span id="loading_transfer" class="" role="status" aria-hidden="true"></span>
									Transfer Money
								</button>

							</div>
						</div>
						<div class="row " >
							<div class="col-6">
								<button class="dep" onclick="show_toast(3,'disabled feature')">Top up</button>
							</div>
							<div class="col-6">
								<button class="wit" onclick="show_snack(3,'disabled feature')">Withdraw</button>

							</div>
						</div>


					</div>
				</div>


				<div class="row m-auto" style="max-width: 800px;padding-bottom: 10px;margin: 0px;min-width: 300px;">
					<div class="col-md-12 justify-content-center" style="">
						<center><h5>Recent Transaction</h5></center>


						<div class="row" >
							<div class="col" style="width: 100%;margin-top: 25px;">
								<div class="row" style="max-height: 400px;overflow-y: scroll;">
									<div class="col-12 " style="">


										<?php
														// $num1  = 2502054485;
														// $num2  = 2502111930;

													 // $sql = "INSERT INTO `user_recipients` (`user_accountNumber`, `user_recipient`)
														// 	 SELECT * FROM (SELECT :num1, :num2) AS `tmp`
														// 	 WHERE NOT EXISTS (
														// 	 SELECT `user_accountNumber`,`user_recipient` FROM `user_recipients` WHERE `user_accountNumber` = :num1 AND `user_recipient` = :num2) LIMIT 1";

														// 	 $stmt = $db->prepare($sql);
														// 	 $stmt->bindParam(':num1', $num1);
														// 	 $stmt->bindParam(':num2', $num2);
														// 	 $stmt->execute();


																	// $num1  = 2502054485;
																	// $num2  = 2502057141;
																	// $accountName = 'gegeg';

																	// $sql = "INSERT INTO `user_recipients` (`user_accountNumber`, `user_recipient`, `user_fullName`)
																	// SELECT * FROM (SELECT :num1, :num2, :num3) AS `tmp`
																	// WHERE NOT EXISTS (
																	// SELECT `user_accountNumber`,`user_recipient` FROM `user_recipients` WHERE `user_accountNumber` = :num1 AND `user_recipient` = :num2) LIMIT 1";

																	// $stmt = $db->prepare($sql);
																	// $stmt->bindParam(':num1', $num1);
																	// $stmt->bindParam(':num2', $num2);
																	// $stmt->bindParam(':num3', $accountName);
																	// $stmt->execute();




										try {
											$stmt = $db->prepare("SELECT * FROM `user_transaction`ORDER BY id DESC ");

											$stmt->execute();
														  //$stmt= $stmt->fetch();

											while($row = $stmt->fetch()) {
												$color = '';
												if($row['status'] == 'success'){
													$color = 'success';
												}elseif($row['status'] == 'pending'){
													$color = 'warning';
												}else{
													$color = 'danger';
												}

												$tid = $row['transaction_id'];
												$tid_subs = 'subs'.$tid;
												$tid_subs = enc_dec('enc',$tid_subs);
												$tid = enc_dec('enc',$tid);
												$tid_url = 'transaction_details.php?tid='.$tid;
												$tid_url_pending = 'confirmSend.php?tid='.$tid;
												$subscription_log = $tid_url.'&subs='.$tid_subs;

												if($row['to_accountNumber'] == $account_number && $row['status'] == 'success'){
													$tran_total += 1;
														  		// echo 'recieved';
														  		// echo $row['to_accountNumber'];

													?>

													<div class="card shadow" style="height: 130px;margin: 0px;border-radius: 10px;padding: 10px;">
														<div class="row">
															<div class="col" style="margin: 5px;"><label style="font-size: 10px;"><?=$row['date']?></label>	</div>
															<div class="col" style="margin: 5px;text-align: right;"><span class="badge badge-<?=$color?>"><?=$row['status']?></span> </div>
														</div>
														<div class="row">
															<div class="col" style="margin: 5px;"><?php if($row['transaction_type'] == 'transfer' && $row['transaction_type2'] == 'recieve'){echo 'Recieved Funds';}else{
																echo 'Interest Earned';

															} ?></div>
															<div class="col" style="margin: 5px;text-align: right;">Amount</div>
														</div>
														<div class="row">
															<div class="col" style="margin: 5px;"><a href="<?=$tid_url?>">View</a></div>
															<div class="col text-success" style="margin: 5px;text-align: right;">+ ₱ <?=number_format((float)$row['amount'], 2, '.', ',');?></div>
														</div>
													</div>
													<?php



												}elseif ($row['created_transaction_by'] == $account_number){
													$tran_total += 1;

													if($row['status'] == 'pending'){


														?>

														<div class="card shadow" style="height: 130px;margin: 0px;border-radius: 10px;padding: 10px;">
															<div class="row">
																<div class="col" style="margin: 5px;"><label style="font-size: 10px;"><?=$row['date']?></label></div>
																<div class="col" style="margin: 5px;text-align: right;"><span class="badge badge-<?=$color?>"><?=$row['status']?></span></div>
															</div>
															<div class="row">
																<div class="col" style="margin: 5px;"><?php if($row['transaction_type'] == 'transfer'){echo 'Transfer Funds';} ?></div>
																<div class="col" style="margin: 5px;text-align: right;">Amount</div>
															</div>
															<div class="row">
																<div class="col" style="margin: 5px;"><a href="<?=$tid_url_pending?>">View</a></div>
																<div class="col text-danger" style="margin: 5px;text-align: right;">- ₱ <?=number_format((float)$row['amount'], 2, '.', ',');?></div>
															</div>
														</div>

														<?php

													}elseif ($row['created_transaction_by'] == $account_number && $row['transaction_type'] == 'subscription'){


														?>

														<div class="card shadow" style="height: 130px;margin: 0px;border-radius: 10px;padding: 10px;">
															<div class="row">
																<div class="col" style="margin: 5px;"><label style="font-size: 10px;"><?=$row['date']?></label></div>
																<div class="col" style="margin: 5px;text-align: right;"><span class="badge badge-<?=$color?>"><?=$row['status']?></span></div>
															</div>
															<div class="row">
																<div class="col" style="margin: 5px;"><?php if($row['transaction_type'] == 'subscription'){echo 'Subscription';} ?></div>
																<div class="col" style="margin: 5px;text-align: right;">Amount</div>
															</div>
															<div class="row">
																<div class="col" style="margin: 5px;"><a href="<?=$subscription_log?>">View</a></div>
																<div class="col text-danger" style="margin: 5px;text-align: right;">- ₱ <?=number_format((float)$row['amount'], 2, '.', ',');?></div>
															</div>
														</div>

														<?php



													}


													else{


														?>

														<div class="card shadow" style="height: 130px;margin: 0px;border-radius: 10px;padding: 10px;">
															<div class="row">
																<div class="col" style="margin: 5px;"><label style="font-size: 10px;"><?=$row['date']?></label></div>
																<div class="col" style="margin: 5px;text-align: right;"><span class="badge badge-<?=$color?>"><?=$row['status']?></span></div>
															</div>
															<div class="row">
																<div class="col" style="margin: 5px;"><?php if($row['transaction_type'] == 'transfer'){echo 'Transfer Funds';} ?></div>
																<div class="col" style="margin: 5px;text-align: right;">Amount</div>
															</div>
															<div class="row">
																<div class="col" style="margin: 5px;"><a href="<?=$tid_url?>">View</a></div>
																<div class="col text-danger" style="margin: 5px;text-align: right;">- ₱ <?=number_format((float)$row['amount'], 2, '.', ',');?></div>
															</div>
														</div>

														<?php

													}

												}else{
													?>


													<?php 


												}
											}




											if($tran_total == 0){
												echo "<center>No Transaction</center>";
											}





										} catch (Exception $e) {

										}



										if($tran_total = 0){
											echo "No Transaction";
										}

										?>
									</div>
								</div>
								<center>

									<h5 style="">See more</h5>
								</center>


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


<script src="js/sendform.js"></script>
<script src="../auth/js/auth.js"></script>
<script src="js/main.js"></script>
<!-- <script src="../auth/js/jquery-3.7.1.min.js"></script> -->


</html>
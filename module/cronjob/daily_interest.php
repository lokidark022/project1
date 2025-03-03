<?php
$db_path = '../../auth/php/db.php';
include($db_path);



print_r(getUser_subscriptions($db));

function getAlluser_data($db){
	$stmt = $db->prepare("SELECT * FROM `auth`");
	$stmt->execute();
	//$row = $stmt->fetch();

	return $stmt;
}

function getUser_subscriptions ($db){

	date_default_timezone_set('Asia/Manila');
	$stats = '';
	$totalUser_interestDristibuted = 0;
	$users_data =  getAlluser_data($db);
	$daily_interest_earned = '';
	// Get user active subscriptions
		include('../../pages/php/user_subscriptions_data.php');
		include('../../pages/php/user_transaction.php');
	//include('../enc_dec.php');
	while ($row = $users_data->fetch()) {
		$totalUser_interestDristibuted +=1;
		$users_accountNumber = $row['account_number'];
		$users_php = $row['php'];
		
		$temp_balance = $users_php;

		$substart_date = new DateTime(date("Y/m/d H:i:s", time()));
		$substart_date=  $substart_date->format('Y-m-d H:i:s');

		$user_subs_data = get_active_subs($db,$users_accountNumber);
	//$max_credits = $user_subs_data->max_credits;
		$daily_interest = $user_subs_data->daily_interest;
	//$transfer_fee = $user_subs_data->transfer_fee;
		$daily_interest =$daily_interest * 0.01;
		$daily_interest_earned = $temp_balance * $daily_interest;
		//$daily_interest_earned = $daily_interest_earned + $row['account_number'];
		if($daily_interest_earned > 0){
			$stats = user_transaction_log($db,generateTransaction_id(),'',$users_accountNumber,'interest','system',$daily_interest_earned,'success',$substart_date);
		}

		
	}
	return $totalUser_interestDristibuted;
}

function generateTransaction_id(){
	$randnum = rand(1111111,9999999);
	$date = new DateTime();
	$input = 1;
	$output = date_format($date,"ymd").sprintf('%04u', $randnum);
	return $output;
}


?>
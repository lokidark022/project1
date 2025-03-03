<?php 

//$db_path = '../../auth/php/db.php';
// $temp_accountNumber = 2502194998;
// $status = '';

//print_r(get_active_subs($db_path,$temp_accountNumber));



function getTime_diff2($date1,$date2){
	// $date1 = "2007-03-24";
	// $date2 = "2009-06-26";

//$diff = abs(strtotime($date2) - strtotime($date1));
	$diff = strtotime($date2) - strtotime($date1);

// $years = floor($diff / (365*60*60*24));
// $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
// $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


	return $diff;
}

function get_subs_details($db,$pak){

	$stmt = $db->prepare("SELECT * FROM `subscriptions` WHERE `pak` = :pak  ORDER BY `transfer_fee` desc");
	$stmt->bindParam(':pak',$pak);
	$stmt->execute();
	//$stmt->fetch();
	//$stat = $stmt;
	return $stmt;
}

function get_active_subs($db,$account_number){
	date_default_timezone_set('Asia/Manila');
	$status = '';
	$max_credits = 0;
	$daily_interest = 0;
	$transfer_fee = '13';
	//include($db);
	$stmt = $db->prepare("SELECT * FROM `user_subscriptions` WHERE `account_number` = :account_number AND `status` = 'active' ORDER BY `pak` ASC ");
	$stmt->bindParam(':account_number', $account_number);
	$stmt->execute();
	while ($row = $stmt->fetch()) {
		// $substart_date =  new DateTime(date("Y/m/d H:i:s", time()));
		$substart_date=  $row['substart_date'];
		$subend_date = $row['subend_date'];
		$row_id = $row['id'];
		$interval = getTime_diff2($substart_date,$subend_date);

		if($interval > 0){

	        	//echo $row['pak'];
			$subs_details = get_subs_details($db,$row['pak']);
			while ($row = $subs_details->fetch()){
				$max_credits  = $max_credits + $row['max_credits'];
	        		//print_r($row);

				$daily_interest = $daily_interest + $row['daily_interest'];
				$transfer_fee =  $row['transfer_fee'];
			}

	        //	echo $max_credits;
	        	//print_r($subs_details);
	        	//print_r(get_subs_details($db,$row['pak']));
			validate_user_subs($db,$row_id,'active');
			$stat = 'active';
			

		}else{
			validate_user_subs($db,$row_id,'expired');

			$stat = 'expired';
		}
		$status = $stat ;

		//$status = $row;
	}

	// echo $max_credits. '  max_credits<br>';
	// echo $daily_interest. '  daily_interest<br>';
	// echo $transfer_fee. '  transfer_fee<br>';


$obj = new \stdClass();
$obj->status= $status;
$obj->max_credits= $max_credits;
$obj->daily_interest = $daily_interest;
$obj->transfer_fee = $transfer_fee;



	return $obj;
}

function validate_user_subs($db,$id,$stats){
	$status = '';
	$stmt = $db->prepare("UPDATE `user_subscriptions` SET `status` = :status WHERE `user_subscriptions`.`id` = :id;");
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':status', $stats);
	$stmt->execute();



	//return $status;
}






// $obj = new \stdClass();
// $obj->stat= $status;
// $obj->max_credits = $max_credits;
// $obj->daily_interest = $daily_interest;
// $obj->transfer_fee = $transfer_fee;
// $myObj = json_encode($obj);
// echo $myObj;
?>
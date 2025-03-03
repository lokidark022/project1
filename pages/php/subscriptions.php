<?php
date_default_timezone_set('Asia/Manila');

function getSubscriptions ($db,$pak){

		try {
			//include($url);
		$sql = '';

		if($pak != ''){
		  $stmt = $db->prepare("SELECT * FROM `subscriptions` WHERE `pak` = :pak");
		  $stmt->bindParam(':pak', $pak);
		}else {
		  $stmt = $db->prepare("SELECT * FROM `subscriptions`");
		 

		}
		//echo $username;
		
		  $stmt->execute();
		  // $stmt= $stmt->fetch();
	      // $row = $stmt;

	} catch (Exception $e) {
	  
	}
	return $stmt;
	}

function getTime_diff($date1,$date2){
	// $date1 = "2007-03-24";
	// $date2 = "2009-06-26";

//$diff = abs(strtotime($date2) - strtotime($date1));
$diff = strtotime($date2) - strtotime($date1);

// $years = floor($diff / (365*60*60*24));
// $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
// $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


 	return $diff;
}


function check_user_subscriptions($db,$account_number,$pak){
	// header('Content-type: application/json');
	$stat = 'test';

	try {

			//include($url);

		  $stmt = $db->prepare("SELECT * FROM `user_subscriptions` WHERE `account_number` = :account_number AND `pak` = :pak AND `status` != 'expired'  ");
		  $stmt->bindParam(':account_number', $account_number);
		  $stmt->bindParam(':pak', $pak);
		  $stmt->execute();
		  $stmt= $stmt->fetch();
	      $row = $stmt;

	      $substart_date =  new DateTime(date("Y/m/d H:i:s", time()));

	      $substart_date=  $substart_date->format('Y-m-d H:i:s');
	      $subend_date = $row['subend_date'];

	      $interval = getTime_diff($substart_date,$subend_date);
	      if($interval > 0){
	      	$stat = 'active';
	      }else{
	      	$stat = 'expired';

	      }



	      $stat = $stat;
	} catch (Exception $e) {
	  	$stat = $e;
	}

	$obj = new \stdClass();
	$obj->status = $stat;
	$obj->date_until= $subend_date;
	//$myObj = json_encode($obj);
	return $obj;
	}

 ?>
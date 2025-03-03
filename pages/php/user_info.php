<?php

function getUserinfo ($db){

	try {
		// include($url);
		
	$username = $_COOKIE['username'];
	$username = enc_dec('dec',$username);
	//echo $username;
	  $stmt = $db->prepare("SELECT * FROM `auth` WHERE `username` = :username");
	  $stmt->bindParam(':username', $username);
	  $stmt->execute();
	  $stmt= $stmt->fetch();


      $row = $stmt;
      // $account_number = $row['account_number'];
      // $php = $row['php'];





 //print_r($row['amount']);


} catch (Exception $e) {
  
}
return $row;
}

function getRecipient ($db){
	$get_accountNumber = getUserinfo($db);
	$get_accountNumber = $get_accountNumber['account_number'];

			try {
			//include($url);
			$username = $_COOKIE['username'];
			$username = enc_dec('dec',$username);
			//echo $username;
			  $stmt = $db->prepare("SELECT * FROM `user_recipients` WHERE `user_accountNumber` = :accountNumber;");
			  $stmt->bindParam(':accountNumber', $get_accountNumber);
			  $stmt->execute();
			  // $stmt= $stmt->fetch();


		   //    $row = $stmt;


	} catch (Exception $e) {
	  
	}
	return $stmt;
}

function getUserinfo_ ($db,$accountNumber){
	// $get_accountNumber = getUserinfo($url);
	// $get_accountNumber = $get_accountNumber['account_number'];

			try {
			//include($url);
			$username = $_COOKIE['username'];
			$username = enc_dec('dec',$username);
			//echo $username;
			  $stmt = $db->prepare("SELECT * FROM `auth` WHERE `account_number` = :accountNumber;");
			  $stmt->bindParam(':accountNumber', $accountNumber);
			  $stmt->execute();
			  $stmt= $stmt->fetch();


		      $row = $stmt;


	} catch (Exception $e) {
	  
	}
	return $stmt;
}


 ?>
<?php
date_default_timezone_set('Asia/Manila');
header('Content-type: application/json');
include("../../module/enc_dec.php");
include("../../auth/php/db.php");
$status = '';
$enc_tid = $_POST['enc_tid'];

//$username = $_COOKIE["username"];
$dec_tid  =enc_dec('dec', $enc_tid );
//$status = $dec_tid;
// function getFromDetails(){
// 			$status = 'test';
//$transaction_id = 	


// return $status;
// }

// public function check_balance($username){

// 	//$valid = 'false';
// 	  $mybal = 0;

// 	  $stmt5 = $db->prepare("SELECT php FROM `auth` WHERE `username` = :username");
// 	   $stmt5->bindParam(':username', $username);
// 	  $stmt5->execute();
// 	  $row= $stmt5->fetch();
// 	  $mybal = $row['php'];
// 	  if($mybal>=$temp_amount){
// 	  	$valid = 'true';
// 	  }else{
// 	  	$valid = 'false';
// 	  }

// return $valid;
// }

//echo check_balance('admin');




try {
	$stmt = $db->prepare("SELECT * FROM `user_transfer_transaction` WHERE `transaction_id` = :transaction_id");
	$stmt->bindParam(':transaction_id', $dec_tid);
	$stmt->execute();
	$stmt= $stmt->fetch();
	$row = $stmt;
	$stat = $row['status'];
	$amount = $row['amount'];
	$from_accountNumber = $row['from_user_accountNumber'];
	$to_accountNumber = $row['to_user_accountNumber'];
	$to_accountName = $row['to_accountName'];

	if($stat == 'pending'){

		$stmt = $db->prepare("UPDATE `user_transfer_transaction` SET `status` = 'success' WHERE `user_transfer_transaction`.`transaction_id` = :transaction_id;
			UPDATE `auth` SET `php` = `php` + :amount WHERE `auth`.`account_number` = :to_accountNumber;
			UPDATE `auth` SET `php` = `php` - :amount WHERE `auth`.`account_number` = :from_user_accountNumber;
			UPDATE `user_transaction` SET `status`='success' WHERE  `transaction_id` = :transaction_id;
			UPDATE `user_transaction` SET `status`='success' WHERE  `transaction_id` = :transaction_id; AND `transaction_type2` = 'recieved'");
		$stmt->bindParam(':transaction_id', $dec_tid);
		$stmt->bindParam(':to_accountNumber', $to_accountNumber);
		$stmt->bindParam(':from_user_accountNumber', $from_accountNumber);
		$stmt->bindParam(':amount', $amount);
		$stmt->execute();
		if($stmt){



			$num1  = $from_accountNumber;
			$num2  = $to_accountNumber;
			$accountName = $to_accountName;

			$sql = "INSERT INTO `user_recipients` (`user_accountNumber`, `user_recipient`, `user_fullName`)
			SELECT * FROM (SELECT :num1, :num2, :num3) AS `tmp`
			WHERE NOT EXISTS (
				SELECT `user_accountNumber`,`user_recipient` FROM `user_recipients` WHERE `user_accountNumber` = :num1 AND `user_recipient` = :num2) LIMIT 1";

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':num1', $num1);
			$stmt->bindParam(':num2', $num2);
			$stmt->bindParam(':num3', $accountName);
			$stmt->execute();




			$status = 'Transaction Success';
		}else{
			$status = 'Transaction failed';

		}

	}else{
		$status = 'transaction error';	  }
		
	  //$status = $stmt;



	} catch (Exception $e) {
		$status = 'error1';
	}





	$obj = new \stdClass();
	$obj->stat= $status;
	$obj->tid= $enc_tid;
	$myObj = json_encode($obj);
	echo $myObj;
?>
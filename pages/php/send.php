<?php
date_default_timezone_set('Asia/Manila');
header('Content-type: application/json');
include("../../module/enc_dec.php");
include("../../auth/php/db.php");
include("user_info.php");
$status = '';
$token = '';
$amount = $_POST['amount'];
$account_number = $_POST['accountNumber'];
$username = $_COOKIE["username"];
$username =enc_dec('dec', $username);
$stat = '';
$temp_amount = $amount;
$min_transfer = 10;
$mybal = 0;
$date_now = date("Y-m-d H:i");

$from_accountNumber = '';
$from_accountName = '';
$to_accountNumber = $account_number;
$to_accountName = '';
$tid = '';

function generateTransaction_id(){
	$randnum = rand(1111111,9999999);
	$date = new DateTime();
	$input = 1;
	$output = date_format($date,"ymd").sprintf('%04u', $randnum);
	return $output;
}

$url_ = '../../auth/php/db.php';


//print_r($data['account_name']);
// function getFromDetails(){
// 			$status = 'test';



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
	$stmt = $db->prepare("SELECT username FROM `auth` WHERE `account_number` = :accountNumber");
	$stmt->bindParam(':accountNumber', $account_number);
	$stmt->execute();
	$stmt= $stmt->fetch();
	$status = $stmt;
	
	if($stmt>0){


		$row = $stmt;
		    //$status = $row['username'];
		$to_accountName = $row['username'];
		$status = $stmt>0;

		$stmt2 = $db->prepare("SELECT username,account_number FROM `auth` WHERE `username` = :username AND `account_number` = :accountNumber");
		$stmt2->bindParam(':username', $username);
		$stmt2->bindParam(':accountNumber', $account_number);
		$stmt2->execute();
		$stmt2 = $stmt2->fetch();
			  //$status = $stmt2>0;
		if($stmt2>0){

			  	// $status = $stmt2>0;
			$status = 'you cant transfer funds to your own account';
		}else{
			  		//$status = check_balance($username);


			
			$stmt5 = $db->prepare("SELECT php FROM `auth` WHERE `username` = :username");
			$stmt5->bindParam(':username', $username);
			$stmt5->execute();
			$row= $stmt5->fetch();
			$mybal = $row['php'];
			if($mybal>=$temp_amount){
				if($temp_amount >= $min_transfer){
					$stmt3 = $db->prepare("SELECT username,account_number,account_name,account_lastName FROM `auth` WHERE `username` = :username");
					$stmt3->bindParam(':username', $username);
					$stmt3->execute();
					$row= $stmt3->fetch();
							//$status = $row;

					$data = getUserinfo_($db,$to_accountNumber);
					$account_name = $data['account_name'];
					$account_lastName = $data['account_lastName'];


					$from_accountNumber = $row['account_number'];
					$from_accountName = $row['username'];
							 // $account_name = $row['account_name'];
							 // $account_lastName = $row['account_lastName'];
					$to_accountName = $account_name.' '.$account_lastName;

					$created_transaction_by = $from_accountNumber;
							// $status = $row['account_number'];
					$transaction_type = 'transfer';
					$transaction_type2 = 'send';
					$transaction_status = 'pending';
					$transaction_id = generateTransaction_id();
					$status = $transaction_id;
					$stmt4 = $db->prepare("INSERT INTO `user_transfer_transaction` (`id`, `transaction_id`, `from_user_accountNumber`, `from_accountName`, `to_user_accountNumber`, `to_accountName`, `amount`, `status`, `date`) VALUES (NULL, :transaction_id, :from_accountNumber, :from_accountName, :to_accountNumber, :to_accountName, :amount, :status, :date);
						INSERT INTO `user_transaction` (`id`, `created_transaction_by`, `transaction_id`, `transaction_type`, `transaction_type2`, `amount`, `status`, `date`) VALUES (NULL, :created_transaction_by, :transaction_id, :transaction_type, :transaction_type2, :amount, :status, :date);
						INSERT INTO `user_transaction` (`id`,  `to_accountNumber`, `transaction_id`, `transaction_type`, `transaction_type2`, `amount`, `status`, `date`) VALUES (NULL, :to_accountNumber, :transaction_id, :transaction_type, 'recieve', :amount, :status, :date);");
					$stmt4->bindParam(':transaction_id', $transaction_id);
					$stmt4->bindParam(':created_transaction_by', $created_transaction_by);
					$stmt4->bindParam(':from_accountNumber', $from_accountNumber);
					$stmt4->bindParam(':from_accountName', $from_accountName);
					$stmt4->bindParam(':to_accountNumber', $to_accountNumber);
					$stmt4->bindParam(':to_accountName', $to_accountName);
					$stmt4->bindParam(':transaction_type', $transaction_type);
					$stmt4->bindParam(':transaction_type2', $transaction_type2);
					$stmt4->bindParam(':amount', $temp_amount);
					$stmt4->bindParam(':status', $transaction_status);
					$stmt4->bindParam(':date', $date_now);
					$stmt4->execute();
					if($stmt4){
						$status ='success_final';
						$tid = $transaction_id;
							  	//$status = check_balance($username);
					}else{
						$status = 'failed';
					}

				}else{
					$status = 'Minimum transfer atleast ₱10.00';


				}



				



				
			}else{
				$status = 'Not enought funds';
			}
			

			














			  	//$status = 'success22';
		}
	  	 //	$status = 'success1';
	}else{
	  		// $text = 'you cant transfer funds to your own account!!@#4123!';
	  		// echo enc_dec('enc', $text);
	  		// echo enc_dec('dec',enc_dec('enc', $text));
		
	  		//print(enc('text'));

	  		// print(dec(enc('text')));
		$status = 'Invalid Account Number!';
		
	}



} catch (Exception $e) {
	$status = 'error1';
}





$obj = new \stdClass();
$obj->stat= $status;
$obj->tid= enc_dec('enc',$tid);
$myObj = json_encode($obj);
echo $myObj;
?>
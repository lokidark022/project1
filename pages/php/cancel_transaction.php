<?php
date_default_timezone_set('Asia/Manila');
header('Content-type: application/json');
include("../../module/enc_dec.php");
include("../../auth/php/db.php");
$status = '';
$enc_tid = $_POST['enc_tid'];

//$username = $_COOKIE["username"];
$dec_tid  =enc_dec('dec', $enc_tid );



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

	  if($stat == 'pending'){

	  	  $stmt = $db->prepare("UPDATE `user_transfer_transaction` SET `status` = 'canceled' WHERE `user_transfer_transaction`.`transaction_id` = :transaction_id;
								UPDATE `user_transaction` SET `status`='canceled' WHERE  `transaction_id` = :transaction_id;
								UPDATE `user_transaction` SET `status`='canceled' WHERE  `transaction_id` = :transaction_id; AND `transaction_type2` = 'recieved'");
		  $stmt->bindParam(':transaction_id', $dec_tid);
		  $stmt->execute();
		  if($stmt){
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
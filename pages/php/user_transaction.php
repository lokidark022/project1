<?php 


 //print_r(user_transaction_log('../../auth/php/db.php','32144212','2502147324','','subscription',1,100,'success','date'));



function user_transaction_log($db,$transaction_id,$from_accountNumber,$to_accountNumber,$transaction_type,$transaction_type2,$amount,$status,$date){
	$stat = '';
	//include($url_path);

	$stmt = $db->prepare("INSERT INTO `user_transaction` (`id`,  `created_transaction_by`,  `to_accountNumber`, `transaction_id`, `transaction_type`, `transaction_type2`, `amount`, `status`, `date`) VALUES (NULL, :created_transaction_by, :to_accountNumber, :transaction_id, :transaction_type, :transaction_type2, :amount, :status, :date);");

	$stmt->bindParam(':created_transaction_by',$from_accountNumber);
	$stmt->bindParam(':to_accountNumber',$to_accountNumber);
	$stmt->bindParam(':transaction_id',$transaction_id);
	$stmt->bindParam(':transaction_type',$transaction_type);
	$stmt->bindParam(':transaction_type2',$transaction_type2);
	$stmt->bindParam(':amount',$amount);
	$stmt->bindParam(':status',$status);
	$stmt->bindParam(':date',$date);
	$stmt->execute();
	$stat = $stmt;
	return $stat;
}



?>
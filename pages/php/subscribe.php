<?php 
date_default_timezone_set('Asia/Manila');
include('user_info.php');
include('subscriptions.php');
include('user_transaction.php');
include('../../module/enc_dec.php');
include('../../auth/php/db.php');
$pak = $_POST['pak'];
$status = '';
//$db_path = '../../auth/php/db.php';
$user_info = getUserinfo($db);
$user_subscriptions = getSubscriptions($db,$pak);
$user_subscriptions = $user_subscriptions->fetch();

$pak_price = $user_subscriptions['price'];
$pak_days = $user_subscriptions['days'];

$row = $user_info;
$account_number = $row['account_number'];
$php = $row['php'];
//$days = $row['days'];

function generateTransaction_id(){
	$randnum = rand(1111111,9999999);
	$date = new DateTime();
	$input = 1;
	$output = date_format($date,"ymd").sprintf('%04u', $randnum);
	return $output;
}





function buy_subscriptions($db,$transaction_id,$account_number,$pak,$substart_date,$subend_date){
	//$stat = $db;
	try {
		//include($db);
		$stmt =  $db->prepare("INSERT INTO `user_subscriptions` (`id`, `account_number`, `pak`, `substart_date`, `subend_date`, `status`, `transaction_id`) 
		VALUES (NULL, :account_number, :pak, :substart_date, :subend_date, 'active', :transaction_id);");

		$stmt->bindParam(':account_number', $account_number);
		$stmt->bindParam(':pak', $pak);
		$stmt->bindParam(':substart_date', $substart_date);
		$stmt->bindParam(':subend_date', $subend_date);
		$stmt->bindParam(':transaction_id', $transaction_id);
		$stmt->execute();
		$stat = $stmt;
	} catch (Exception $e) {
		$stat = $e;
	}




	return $stat;
}

function update_userfunds($db,$account_number,$amount){
	$stat = '';
	//include($db);
	$stmt = $db->prepare("UPDATE `auth` SET `php` = `php` - :amount WHERE `account_number` = :account_number;");
	$stmt->bindParam(':amount',$amount);
	$stmt->bindParam(':account_number',$account_number);
	$stmt->execute();
	$stat = $stmt;

	return $stat;
}

if($user_subscriptions){
	//$status = 'true';




	$substart_date = new DateTime(date("Y/m/d H:i:s", time()));
	$subend_date = new DateTime(date("Y/m/d H:i:s", time() + 86400 * $pak_days));

	$interval = $substart_date->diff($subend_date);

	$substart_date=  $substart_date->format('Y-m-d H:i:s');
	$subend_date=  $subend_date->format('Y-m-d H:i:s');
	//$status = $interval->days;

	$user_subscriptions = check_user_subscriptions($db,$account_number,$pak);
	$data = $user_subscriptions->status;

	if($data == 'active'){
		$status = 'active';
	}else{

		if($php >= $pak_price){

			$status = 'valid';
			$status = update_userfunds($db,$account_number,$pak_price);

			if($status){
				$generatedTransaction_id = generateTransaction_id();
				$status = buy_subscriptions($db,$generatedTransaction_id,$account_number,$pak,$substart_date,$subend_date);
				$status = user_transaction_log($db,$generatedTransaction_id,$account_number,'','subscription',$pak,$pak_price,'success',$substart_date);
				$status = 'Transaction Completed';
			}else{
				$status = 'Something wrong';
			}





		}else{
			$status = 'Not enought funds';
		}
		//$status = 'expired';
	


	 }

 	//$status = buy_subscriptions($db,generateTransaction_id(),$account_number,$pak,$substart_date,$subend_date);
 	//$status = $db;
}else{
	$status = 'Something wrong!...';
}





$obj = new \stdClass();
$obj->stat= $status;
$myObj = json_encode($obj);
echo $myObj;

?>

<?php
header('Content-type: application/json');
require_once('db.php');
include("../../module/enc_dec.php");
$status = '';
$data = $_POST['myData'];
$decode_data = json_decode($data);
$username = $decode_data->username;
$password = $decode_data->password;
$password = enc_dec('enc', $password);

$name = $decode_data->name;
$lastname = $decode_data->lastname;


// echo 'gegeg';
// $name = 'test';
// $lastname = 'test2';
try {
		//check duplicate
		  $stmt = $db->prepare("SELECT username FROM auth WHERE username = :username");
		  $stmt->bindParam(':username', $username);
		  $stmt->execute();
		  $stmt= $stmt->fetch();
		  if($stmt>0){
		  	$status = 'duplicate';
		  }else{
		  	// $status = 'goods';
		  	 $accountNum = generateAccountNumber();
		  	 $stmt = $db->prepare("INSERT INTO `auth` (`id`, `username`, `password`, `account_number`, `account_name`, `account_lastName`) VALUES (NULL, :username, :password,:account_number,:name,:lastname)");
			  $stmt->bindParam(':username', $username);
			  $stmt->bindParam(':password', $password);
			  $stmt->bindParam(':account_number', $accountNum);
			  $stmt->bindParam(':name', $name);
			  $stmt->bindParam(':lastname', $lastname);
			  $stmt->execute();
			  if($stmt){
			  	$status ='success';
			  }else{
			  	$status = 'failed';
			 }
		 
		  }
	
	
} catch (Exception $e) {

	
}


function generateAccountNumber(){
	$randnum = rand(1111,9999);
	$date = new DateTime();
	$input = 1;
	$output = date_format($date,"ymd").sprintf('%04u', $randnum);
	return $output;
}




$obj = new \stdClass();
$obj->stat= $status;
$myObj = json_encode($obj);
echo $myObj;
 ?>
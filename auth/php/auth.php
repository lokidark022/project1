

<?php

header('Content-type: application/json');
include_once('db.php');
include('../../module/enc_dec.php');

$status = '';
$data = $_POST['myData'];
$decode_data = json_decode($data);
$username = $decode_data->username;
$password = $decode_data->password;
$password = enc_dec('enc',$password);

$token = '';
$stat_token = '';
$number_row = 0;
try {
  $stmt = $db->prepare("SELECT * FROM auth WHERE username = :username and password = :password");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->execute();
  $stmt= $stmt->fetch();
  $number_row = $stmt;
} catch (Exception $e) {
}
if($number_row){
	$token = bin2hex(random_bytes(16));
	  $stmt = $db->prepare("UPDATE `auth` SET `token` = :token WHERE `auth`.`username` = :username");
	  $stmt->bindParam(':username', $username);
	  $stmt->bindParam(':token', $token);
	  $stmt->execute();
	if( $stmt){
		$stat_token = 'token updated';
		//set token for 1 day
		setcookie('token', $token, time() + (60 * 30), "/"); // 86400 = 1 day
		setcookie('username',enc_dec('enc',$username), time() + (60 * 30), "/"); // 86400 = 1 day
	}else{
		$stat_token = 'failed';
	}
	$status = 'success';
}else{
	$status = 'failed';
}
$obj = new \stdClass();
$obj->pass = $password;
$obj->user = $username;
$obj->stat = $status;
$obj->token = $token;
$obj->stat_token = $stat_token;
$myObj = json_encode($obj);
echo $myObj;

 ?>
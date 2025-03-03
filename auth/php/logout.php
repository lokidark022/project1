<?php
header('Content-type: application/json');
require_once('db.php');
require_once('../../module/enc_dec.php');
$status = '';
$token = '';
$username = $_COOKIE["username"];
$username = enc_dec('dec',$username);
try {
	 $stmt = $db->prepare("UPDATE `auth` SET `token` = :token WHERE `auth`.`username` = :username;");
	  $stmt->bindParam(':username', $username);
	  $stmt->bindParam(':token', $token);
	  $stmt->execute();
	  if($stmt){
	  	$status ='success';
	  }else{
	  	$status = 'failed';
	  }
} catch (Exception $e) {
	
}
$obj = new \stdClass();
$obj->stat= $status;
$myObj = json_encode($obj);
echo $myObj;
 ?>
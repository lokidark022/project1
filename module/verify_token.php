<?php
 //	include('../auth/php/db.php');




  	
  	//header('Location: ../index.php');

	  //  $stmt = $db->prepare("SELECT token FROM auth WHERE token = :current_token AND username = :username");
	  // $stmt->bindParam(':current_token', $current_token);
	  // $stmt->bindParam(':username', $username);
	  // $stmt->execute();
	  // $stmt= $stmt->fetch();
	  // if($stmt>0){
	  // 	$verified = 'true';
	  // 	echo 'valid token';
	  // }else{
	  // 	$verified = 'false';
	  // }
echo verify_token('../auth/php/db.php');

function verify_token($url){

	include('enc_dec.php');
 // echo $_COOKIE['username'];
 // echo enc_dec('dec',$_COOKIE['username']);



		
			//include('enc_dec.php');
			include($url);
			$verified = 'false';
			$current_token = $_COOKIE['token'];
			$username = $_COOKIE['username'];
		    $username = enc_dec('dec',$username);
		    // $username =  (string) $username;
			//$username = 'admin';
	  $stmt = $db->prepare("SELECT token FROM auth WHERE token = :current_token AND username = :username");
	  $stmt->bindParam(':current_token', $current_token);
	  $stmt->bindParam(':username', $username);
	  $stmt->execute();
	  $stmt= $stmt->fetch();
	  if($stmt>0){
	  	$verified = 'true';
	  	//echo 'valid token';
	  }else{
	  	$verified = 'false';
	  }

	return $username;

	}

 ?>
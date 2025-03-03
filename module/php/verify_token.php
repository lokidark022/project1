<?php



// if(isset($_COOKIE['token']) && $_COOKIE['username']){
// 	echo 'gege';

// }else{
// 	echo 'null';
// }



function verify_token($db,$urlEnc){
 $verified = 'false';
	
 // echo $_COOKIE['username'];
 // echo enc_dec('dec',$_COOKIE['username']);

	if(isset($_COOKIE['token']) && $_COOKIE['username']){
					//include($url_enc);
			//include($url);
		include($urlEnc);
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

	}else{
		echo '';
	}





	return $verified;

}

?>
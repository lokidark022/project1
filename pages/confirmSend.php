<?php
 require('../auth/php/db.php');
 include('../module/php/verify_token.php');

//$url = '../auth/php/db.php';
$urlEnc = '../module/enc_dec.php';
//echo verify_token($url);
if(verify_token($db,$urlEnc) == "true"){
echo "verified";

}else{
echo " invalid token";
header('Location: ../index.php');
}



try {

 // include('../module/enc_dec.php');
  
  if(isset($_GET['tid'])){
    $url = $_GET['tid'];
    $enc_url = $url;
    $url = enc_dec('dec',$url);

  $stmt = $db->prepare("SELECT * FROM `user_transfer_transaction` WHERE `transaction_id` = :transaction_id AND status = 'pending'");
  $stmt->bindParam(':transaction_id', $url);
  $stmt->execute();
  $stmt= $stmt->fetch();


  if($stmt>0){
      $row = $stmt;
      $to_user_accountNumber = $row['to_user_accountNumber'];
      $to_accountName = $row['to_accountName'];
      $amount = $row['amount'];
      $status = $row['status'];
      $date = $row['date'];
      //$url = enc_dec('enc',$url);
  }else{
    header('Location: sendform.php');
  }
 //print_r($row['amount']);




  }else{
    header('Location: sendform.php');
    }

} catch (Exception $e) {
  
}

$username = $_COOKIE['username'];
$username = enc_dec('dec',$username);

  ?>

<!DOCTYPE html>
<html>
<head>
<title>Pending</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="css/preloader.css">
       <!--  Alert Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator"> 

                <svg width="16px" height="12px">

                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>


  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
    
      Bootstrap
    </a>


          <div class="dropdown" >
        <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
          <?=$username?>
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" onclick="logout();" href="#">Logout </a>
        
        </div>
       </div>
  </nav>


 <ol class="breadcrumb" style="height: 45px;">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item " aria-current="page"><a href="dashboard.php">Wallet</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pending</li>
</ol>



  <div class="container-fluid " style="margin-bottom: 100px;">
    <div class="row m-auto" style="max-width: 800px;padding-bottom: 10px;">
      <div class="col-md-12 justify-content-center" style="box-shadow: 100px; border-radius: 20px;height: 480px;background-image: linear-gradient(to right bottom, #60e783, #71e770, #83e65b, #95e543, #a8e325);">
        <div class="row">
          <div class="col-12">
           

          </div>


        
            
          
      
        </div>
        <div class="row" style="">
          <div class="col" style="width: 100%;margin-top: 20px;">
            <div class="form-group">
              <center>
                <h3 class="text-white">Confirm Transaction</h3>
                    <h5 class="text-white">Account Number</h5>
                      <h6 class="text-white"><?=$to_user_accountNumber?></h6>
                        <h5 class="text-white">Account Name</h5>
                      <h6 class="text-white"><?=$to_accountName?></h6>
                      <h5 class="text-white">Amount</h5>
                      <h4 class="text-white">₱<?=number_format((float)$amount, 2, '.', '');?></h4>
                       <h5 class="text-white">Status</h5>
                      <h6 class="text-white"><?=$status?></h6>
                    

                      <h8 class="text-white"><?=$date?></h8>
                      
              </center>
             

            </div>
            <button id="confirm_btn" onclick="confirmSend('<?=$enc_url?>');" class="t-money"  style="height: 50px;">
            <span id="loading_confirm" class="" role="status" aria-hidden="true"></span>
             Transfer Money
            </button>
            <button id="cancel_btn" onclick="cancelTransaction('<?=$enc_url?>');" class="t-money-c"  style="height: 50px;">
             <span id="loading_cancel" class="" role="status" aria-hidden="true"></span>
              Cancel Transaction</button>
            
          </div>
        </div>
      
      </div>
    </div>

    </div>
  
  </div>

<!-- <div class="footer fixed-bottom m-4" style="margin-top: 80vh;">
      <div class="row m-auto m-auto" style="max-width: 800px;height: 100%; position:sticky;">

        <div class="col-6 button btn-primary p-2 "style="border-radius: 20px;">
          <center>Dashboard</center>
        </div>
        <div class="col-6 button btn-primary p-2 "style="border-radius: 20px;">
          <center>Invest</center>
        </div>


      </div>
  </div>
</body> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
      

    <script src="js/sendform.js"></script>
    <script src="../auth/js/auth.js"></script>
    <script src="js/main.js"></script>
  <script src="../auth/js/jquery-3.7.1.min.js"></script>


</html>
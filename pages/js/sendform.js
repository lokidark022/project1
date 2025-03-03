function tmoney(){
  document.getElementById("transferMoney").setAttribute("disabled","");
  document.getElementById("loading_transfer").classList.add("spinner-border","spinner-border-sm");
	window.location.href = 'sendform.php';

}

function sendmoney(){
var accountNumber = document.getElementById('accountNumber').value;
var amount = document.getElementById('amount').value;
//console.log(accountNumber);

ajaxSend (accountNumber,amount);


// Swal.fire({
//   icon: "error",
//   title: "Oops...",
//   text: "Invalid Account Number!",

// });
}

function ajaxSend (accountNumber,amount){
   //var data = {username : username, password:password};
  //  var dataString = JSON.stringify(data);
           $.ajax({
                type: "POST",
                dataType: "json",
                url: './php/send.php',
                data: {accountNumber: accountNumber,amount:amount},

                beforeSend: function() {
               // console.log('test');
                  document.getElementById("loading_send").classList.add("spinner-border","spinner-border-sm");
                  //document.getElementById("loading").classList.remove("spinner-border","spinner-border-sm");
                  document.getElementById("btn_send").setAttribute("disabled","");
                 // document.getElementById("signup").removeAttribute("disabled","");
                },
                complete: function(){
                  document.getElementById("loading_send").classList.remove("spinner-border","spinner-border-sm");
                  document.getElementById("btn_send").removeAttribute("disabled","");                
                },
  
                
                success:function (data) {
	                	if(data.stat == 'success_final'){
	                	//	console.log();
	                		 window.location.href = 'confirmSend.php?tid=' + data.tid;
                  
	                	}else{
	                		Swal.fire({
							  icon: "error",
							  title: "Oops...",
							  text: data.stat,

							});

	                	}
                 console.log(data.stat);
                // window.location.href = 'index.php';
                },
                 error: function(e){
                    console.log(e.message);
                }
              });

}

function confirmSend(enc_tid){
	//console.log(enc_tid);



	     $.ajax({
                type: "POST",
                dataType: "json",
                url: './php/confirmSend.php',
                data: {enc_tid: enc_tid},

                beforeSend: function() {
                  //  console.log('test');
                    document.getElementById("loading_confirm").classList.add("spinner-border","spinner-border-sm");
                    //document.getElementById("loading").classList.remove("spinner-border","spinner-border-sm");
                    document.getElementById("confirm_btn").setAttribute("disabled","");
                   // document.getElementById("signup").removeAttribute("disabled","");
                  },
                  complete: function(){
                              //document.getElementById("loading").classList.add("spinner-border","spinner-border-sm");
                              document.getElementById("loading_confirm").classList.remove("spinner-border","spinner-border-sm");
                              // document.getElementById("signup").setAttribute("disabled","");
                               document.getElementById("confirm_btn").removeAttribute("disabled","");

                  },
   
                
                
                success:function (data) {
	                	if(data.stat == 'Transaction Success'){

            
                    
	                		console.log(data.stat);
	                		window.location.href = 'transaction_details.php?tid=' + data.tid;

                      
	                	}else{
	                		Swal.fire({
							  icon: "error",
							  title: "Oops...",
							  text: data.stat,

							});

	                	}
                 console.log(data.stat);
                // window.location.href = 'index.php';
                },
                 error: function(e){
                    console.log(e.message);
                }
              });
}

function cancelTransaction(enc_tid){
	console.log(enc_tid);


         $.ajax({
                type: "POST",
                dataType: "json",
                url: './php/cancel_transaction.php',
                data: {enc_tid: enc_tid},

                  beforeSend: function() {
                  //  console.log('test');
                    document.getElementById("loading_cancel").classList.add("spinner-border","spinner-border-sm");
                    //document.getElementById("loading").classList.remove("spinner-border","spinner-border-sm");
                    document.getElementById("cancel_btn").setAttribute("disabled","");
                   // document.getElementById("signup").removeAttribute("disabled","");
                  },
                  complete: function(){

                                             //document.getElementById("loading").classList.add("spinner-border","spinner-border-sm");
                                             document.getElementById("loading_cancel").classList.remove("spinner-border","spinner-border-sm");
                                             // document.getElementById("signup").setAttribute("disabled","");
                                              document.getElementById("cancel_btn").removeAttribute("disabled","");

                  },

                
                success:function (data) {
                        if(data.stat == 'Transaction Success'){
             
                            console.log(data.stat);
                            window.location.href = 'transaction_details.php?tid=' + data.tid;
                        }else{
                            Swal.fire({
                              icon: "error",
                              title: "Oops...",
                              text: data.stat,

                            });

                        }
                 console.log(data.stat);
                // window.location.href = 'index.php';
                },
                 error: function(e){
                    console.log(e.message);
                }
              });
}


function changeAccNum(){
    var acctNum = document.getElementById("selectRecipient").value;
    document.getElementById('accountNumber').value = acctNum;
 // console.log(acctNum);
}
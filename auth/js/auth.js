 


    function login (){
      let notif = document.getElementById('notif');
      let notif_text = document.getElementById('notif_text');
                        var password = document.getElementById('pass_login').value;
                        var username = document.getElementById('user_login').value;
                       //console.log(password);    
                       // window.location.href = 'dashboard.php';
                        // notif.className = 'alert alert-success';
                        // notif.style.display = 'block';
                        // notif_text.innerHTML  = 'Access Granted..';

                           ajaxAuth(username,password);


            }


            function ajaxAuth(username,password){
              var data = {username : username, password:password};
              var dataString = JSON.stringify(data);
             // console.log(dataString);
              // window.location.href = './auth/php/auth.php';
              $.ajax({
                type: "POST",
                dataType: "json",
                url: './auth/php/auth.php',
                data: {myData: dataString},


                beforeSend: function() {
                  console.log('test');
                  document.getElementById("loading_login").classList.add("spinner-border","spinner-border-sm");
                  //document.getElementById("loading").classList.remove("spinner-border","spinner-border-sm");
                  document.getElementById("signin").setAttribute("disabled","");
                 // document.getElementById("signup").removeAttribute("disabled","");
                },
                complete: function(){
                                          //document.getElementById("loading").classList.add("spinner-border","spinner-border-sm");
                                          document.getElementById("loading_login").classList.remove("spinner-border","spinner-border-sm");
                                          // document.getElementById("signup").setAttribute("disabled","");
                                           document.getElementById("signin").removeAttribute("disabled","");

                },

          
                
                success:function (data) {
                  if(data.stat == 'success'){
              
                  
                        notif.className = 'alert alert-success';
                        notif.style.display = 'block';
                        notif_text.innerHTML  = 'Access Granted..';
                        console.log(data.stat_token);
                        window.location.href = 'pages/home.php';
                    console.log('success');
                  }else{
                   // console.log(data.stat_token);
                     notif.className = 'alert alert-danger';
                        notif.style.display = 'block';
                        notif_text.innerHTML  = 'Access Denied.';
                     console.log('failed');

                  }
                 // console.log(data.stat);
                },
                 error: function(e){
                    console.log(e.message);
                }
              });

            }


function logout(){


  Swal.fire({
  title: "Do you want to Logout?",
  showCancelButton: true,
  confirmButtonText: "Logout"
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire("Logged out!", "", "success");

            var data = 'logout';
             $.ajax({
                type: "POST",
                dataType: "json",
                url: '../auth/php/logout.php',
                data: {Data: data},


          
                
                success:function (data) {
                 console.log(data.stat);
                 window.location.href = '../index.php';
                },
                 error: function(e){
                    console.log(e.message);
                }
              });
    } else if (result.isDenied) {
      
    }
  });



}
function signup(){
  //console.log('signup');

  let notif = document.getElementById('notif_2');
  let notif_text = document.getElementById('notif_text_2');

  var name = document.getElementById('r_name').value;
  var lastname = document.getElementById('r_lastname').value;
  var username = document.getElementById('r_username').value;
  var password = document.getElementById('r_password').value;
  var c_password = document.getElementById('r_cpassword').value;
  if(password == '' || username == '' || c_password =='' || name =='' || lastname ==''){
    notif.className = 'alert alert-danger';
    notif.style.display = 'block';
    notif_text.innerHTML  = "Empty input's";

      // document.getElementById("loading").classList.add("spinner-border","spinner-border-sm");
      // document.getElementById("loading").classList.remove("spinner-border","spinner-border-sm");
      // document.getElementById("signup").setAttribute("disabled","");
      // document.getElementById("signup").removeAttribute("disabled","");
      
 
   // console.log("empty input's");
  }else{
    if(password == c_password){
      if(password.length >= 8){
        //console.log('success');
        ajaxSignup(username,password,name,lastname);

      } else{
        notif.className = 'alert alert-danger';
        notif.style.display = 'block';
        notif_text.innerHTML  = "Passowrd 8 length required.";

      }
     
    }else{
      notif.className = 'alert alert-danger';
      notif.style.display = 'block';
      notif_text.innerHTML  = 'Password didnt match';
      console.log('Password didnt match');
    }

  }
}

function ajaxSignup (username,password,name,lastname){
  let notif = document.getElementById('notif_2');
  let notif_text = document.getElementById('notif_text_2');
  var data = {username : username, password:password, name:name, lastname:lastname};
   var dataString = JSON.stringify(data);
           $.ajax({
                type: "POST",
                dataType: "json",
                url: 'auth/php/signup.php',
                data: {myData: dataString},

                beforeSend: function() {
                  document.getElementById("loading").classList.add("spinner-border","spinner-border-sm");
                  //document.getElementById("loading").classList.remove("spinner-border","spinner-border-sm");
                  document.getElementById("signup").setAttribute("disabled","");
                 // document.getElementById("signup").removeAttribute("disabled","");
                },
                complete: function(){
                              //document.getElementById("loading").classList.add("spinner-border","spinner-border-sm");
                              document.getElementById("loading").classList.remove("spinner-border","spinner-border-sm");
                              // document.getElementById("signup").setAttribute("disabled","");
                               document.getElementById("signup").removeAttribute("disabled","");
                              
                },
                
                success:function (data) {
                 console.log(data.stat);
                 if(data.stat == 'duplicate'){
                  console.log('username already registered');
                   notif.className = 'alert alert-danger';
                    notif.style.display = 'block';
                    notif_text.innerHTML  = 'Username already registered';

                 }else{

                               
                                    
                    console.log(data.stat);

                    notif.className = 'alert alert-success';
                    notif.style.display = 'block';
                    notif_text.innerHTML  = 'Username Succsefully Registered Please sign In';

                 }
                // window.location.href = 'index.php';
                },
                 error: function(e){
                    console.log(e.message);
                }
              });

}


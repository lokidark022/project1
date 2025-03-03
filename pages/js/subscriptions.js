function subscribe(pak){





	Swal.fire({
		title: "Are you sure to you want activate this subsciptions?",

		showCancelButton: true,
		confirmButtonText: "Activate"
	
	}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
				$.ajax({
				type: "POST",
				dataType: "json",
				url: './php/subscribe.php',
				data: {pak: pak},

				beforeSend: function() {
					
				},
				complete: function(){
			
				
				},


				success:function (data) {
					if(data.stat == 'Transaction Completed'){
						 Swal.fire({
									  title: data.stat,
									  icon: "success"
									});

						 setTimeout(function(){ 
					      	 window.location.href = 'home.php';
					    }, 3000);

						 
					}else{
					    	Swal.fire(data.stat, "", "info");
					}

				
					console.log(data.stat);
				},
				error: function(e){
					console.log(e.message);
				}
			});

			
			//Swal.fire("Saved!", "", "success");
		} else if (result.isDenied) {
			// Swal.fire("Changes are not saved", "", "info");
		}
	});




}
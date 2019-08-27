$('.login-input').on('focus', function() { 
  $('.login').addClass('focused');
});

$('.login').on('submit', function(e) {
        e.preventDefault();
   
        var userName = $("#userName").val();
        var password = $("#password").val(); 
        
       $.ajax({
		type: "POST",
		url: "index.php/main/login_proc", 
		data: {
                userName: userName, password: password, 
			},
		beforeSend: function() {			
  			$('.login').removeClass('focused').addClass('loading');
         },
		success: function(res) { 
            window.location.replace("index.php/main/home");
            
		},
		error: function(e){	
			$('.login').removeClass('loading').addClass('focused');  					
            alert('Invalid login credentials!');  
			  
		}
	});
  
});
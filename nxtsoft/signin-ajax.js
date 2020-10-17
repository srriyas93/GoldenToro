function signin(event){

	event.preventDefault();
    var username=document.getElementById('username').value;
    var password=document.getElementById('password').value;
  if(username==''||password==''){
	msg = "Enter the Username and Password!";
	$("#loginmessage").html(msg);
  }else{
	msg = "";
	$("#loginmessage").html(msg);
	var url = "signin-ajax.php?mode=Login&username="+username+"&password="+password; // the script where you handle the form input.
	

	$.ajax({
		type: "POST",
        url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: true,
		success: function(responseText)
		{
			//alert(responseText);
			if(responseText == "1")
			{
        	setTimeout(function()
			{
           	window.location.href = 'dashboard.php';
        	},1500);	
			}
			if(responseText == "2"){
				document.getElementById("loginfm").reset();
				msg = "You are not an Active Admin!";
			}
			if(responseText == "0")
			{
				document.getElementById("loginfm").reset();
				msg = "Invalid username or password!";
				
            }
		$("#message").html(msg);
		}
	});
  }  
}

function resetPasswordPop(){
	$('#ResetPasswordPop').modal('show');
}

function CheckContact(reset_pass_mobile){
	
	var reset_pass_mobile=document.getElementById('reset_pass_mobile').value;
	//alert(reset_pass_email);
	if(reset_pass_mobile==''){
		msg = "Please Enter Mobile Number!";
		$("#mobilemessage").html(msg);
	}else{
	var url = "signin-ajax.php?mode=resetPasswordContactCheck&reset_pass_mobile="+reset_pass_mobile; // the script where you handle the form input.

	$.ajax({
		type: "POST",
		url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: true,
		success: function(responseText)
		{
			//alert(responseText);
			if(responseText == "1")
			{	
				document.getElementById("reset_pass_mobile").style.borderColor="";
				msg = "";
			}else{
				
				msg = "Mobile Number Seems to be Invalid.Please Check and try again...";
				document.getElementById("reset_pass_mobile").style.borderColor="red";
				document.getElementById("reset_pass_mobile").value=null;	
				}
			$("#mobilemessage").html(msg);
		}
	});
} 
}

function CheckEmail(reset_pass_email){
	
	var reset_pass_email=document.getElementById('reset_pass_email').value;
	//alert(reset_pass_email);
	if(reset_pass_email==''){
		msg = "Please Enter Email Address!";
		$("#emailmessage").html(msg);
	}else{
	var url = "signin-ajax.php?mode=resetPasswordEmailCheck&reset_pass_email="+reset_pass_email; // the script where you handle the form input.

	$.ajax({
		type: "POST",
		url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: true,
		success: function(responseText)
		{
			//alert(responseText);
			if(responseText == "1")
			{	
				document.getElementById("reset_pass_email").style.borderColor="";
				msg = "";
			}else{
				
				msg = "Email Seems to be Invalid.Please Check and try again...";
				document.getElementById("reset_pass_email").style.borderColor="red";
				document.getElementById("reset_pass_email").value=null;	
			}
		$("#emailmessage").html(msg);
		}
	});
} 
}

function resetPassword(event){

	var reset_pass_mobile=document.getElementById('reset_pass_mobile').value;
	var reset_pass_email=document.getElementById('reset_pass_email').value;
	//alert(reset_pass_email);
	if(reset_pass_email==''|| reset_pass_mobile==''){
		msg1 = "Please Enter Email Address!";
		msg2 = "Please Enter Mobile Number!";
		$("#emailmessage").html(msg1);
		$("#mobilemessage").html(msg2);	
	}else{
	var url = "signin-ajax.php?mode=resetPassword&reset_pass_mobile="+reset_pass_mobile+"&reset_pass_email="+reset_pass_email; // the script where you handle the form input.

	$.ajax({
		type: "POST",
        url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: true,
		success: function(responseText)
		{
			alert(responseText);
			if(responseText == "1")
			{
				msg = "Reset Password has been sent to your email successfully...!!!";
				$("#resetpassconfirmmessage").html(msg); 
				document.getElementById("FrmResetPasswordPop").reset();	
            	
			}
		}
	}); 
} 
}
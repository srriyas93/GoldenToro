function CheckPassword(cust_change_pass_old,username){
	
	var username=document.getElementById('username').value;
	var cust_change_pass_old=document.getElementById('cust_change_pass_old').value;

	var url = "changePassword-ajax.php?mode=OldPasswordCheck&username="+username+"&cust_change_pass_old="+cust_change_pass_old; // the script where you handle the form input.

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
			if(responseText == "success")
			{	
				document.getElementById("cust_change_pass_old").style.borderColor="";
				msg = "";
			}else{
				
				msg = "Password Seems to be Invalid!";
				document.getElementById("cust_change_pass_old").style.borderColor="red";
				document.getElementById("cust_change_pass_old").value=null;	
			}
		$("#oldpassword1").html(msg);
		}
	}); 
}

function changePassword(event){

	event.preventDefault();
	var username=document.getElementById('username').value;
	var cust_pass_old=document.getElementById('cust_change_pass_old').value;
	var cust_pass_new=document.getElementById('cust_change_pass_new').value;
	var cust_pass_new_confirm=document.getElementById('cust_change_pass_new_confirm').value;
	if(cust_pass_old==''){
		msg = "Old Password not Entered!";
		if(cust_pass_new!=cust_pass_new_confirm){
			document.getElementById("cust_pass_new_confirm").style.borderColor="red";	
			msg = "Password not matching!";
			$("#passwordmessage1").html(msg);
			}
		$("#oldpassword1").html(msg);
		}
		else{	
		var url = "changePassword-ajax.php?mode=CustChangePassword&username="+username+"&cust_pass_new="+cust_pass_new; // the script where you handle the form input.
	
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
				if(responseText == "success")
				{	
					document.getElementById("DisplayProfileForm").reset();
					swal("Password has been changed Successfully!!!",
				{
					  icon: "success",
				}); 
					setTimeout(function()
					{
					window.location.href = 'changePassword.php';
					 }, 3000);	
				}
			}
		}); 
	}
}
function openAdminEditpop(admin_id,admin_type,admin_name,admin_email,admin_mobile){
	
    document.getElementById('admin_edit_id').value=admin_id;
	document.getElementById('admin_edit_type').value=admin_type;
	document.getElementById('admin_edit_name').value=admin_name;
	document.getElementById('admin_edit_email').value=admin_email;
    document.getElementById('admin_edit_mobile').value=admin_mobile;
	$('#editAdminPop').modal('show');
}

function openAdminViewpop(admin_type,admin_name,admin_email,admin_mobile,admin_create_date,status){
//alert(admin_type);	
	document.getElementById('admin_view_type').value=admin_type;
	document.getElementById('admin_view_name').value=admin_name;
	document.getElementById('admin_view_email').value=admin_email;
	document.getElementById('admin_view_mobile').value=admin_mobile;
	document.getElementById('admin_view_create_date').value=admin_create_date;
	document.getElementById('admin_view_status').value=status;
	$('#ViewAdminPop').modal('show');
}


function insertAdmin(event){

	event.preventDefault();
	
	var admin_name=document.getElementById('admin_name').value;
	var admin_type=document.getElementById('admin_type').value;
	var admin_email=document.getElementById('admin_email').value;
    var admin_password=document.getElementById('admin_password').value;
	var admin_mobile=document.getElementById('admin_mobile').value;
	if(admin_name==''||admin_type==-1||admin_email==''||admin_password==''||admin_mobile==''){
	msg="Input Fields Cannot be null";
	$("#adminregmessage").html(msg);
}else{

	var url = "admin-ajax.php?mode=addAdmin&admin_name="+admin_name+"&admin_type="+admin_type+"&admin_email="+admin_email+"&admin_password="+admin_password+"&admin_mobile="+admin_mobile; // the script where you handle the form input.
	

	$.ajax({
		type: "POST",
		url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: true,
		success: function(responseText)
		{
			
			if(responseText == "success")
			{
				
				document.getElementById("FrmeaddAdminPop").reset();
				
				showNotification("Record submitted succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'admin.php';$('#popaddnewadmin').modal('hide');
         		}, 3000);	
			}
		}
	});
}
}

function CheckContact(admin_mobile){
	
	var admin_mobile=document.getElementById('admin_mobile').value;
	alert(admin_mobile);
	if(admin_mobile==''){
		msg = "Please Enter Mobile Number!";
		$("#mobilemessageadmin").html(msg);
	}else{
	var url = "admin-ajax.php?mode=ContactCheck&admin_mobile="+admin_mobile; // the script where you handle the form input.

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
				msg = "Mobile Number Already Exist...!!!";
				document.getElementById("admin_mobile").style.borderColor="red";
				document.getElementById("admin_mobile").value=null;
				
			}else{
				document.getElementById("admin_mobile").style.borderColor="";
				msg = "";
				
				}
			$("#mobilemessageadmin").html(msg);
		}
	});
} 
}

function CheckEmail(admin_email){
	alert(admin_email);
	var admin_email=document.getElementById('admin_email').value;
	
	if(admin_email==''){
		msg = "Please Enter Email Address!";
		$("#emailmessageadmin").html(msg);
	}else{
	var url = "admin-ajax.php?mode=EmailCheck&admin_email="+admin_email; // the script where you handle the form input.

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
				document.getElementById("admin_email").style.borderColor="red";
				document.getElementById("admin_email").value=null;
				msg = "Email Already Exist...!!!";
				
			}else{
				document.getElementById("admin_email").style.borderColor="";
				msg = "";
					
			}
		$("#emailmessageadmin").html(msg);
		}
	});
} 
}
function EditAdmin(event)
{

    event.preventDefault();
	var admin_id = $('#admin_edit_id').val();
	var admin_name = $('#admin_edit_name').val();
	var admin_type = $('#admin_edit_type').val();
	if(admin_type=="Admin")
        {
        admin_type=1;
        }
    else
        {
        admin_type=2;
		} 	
	var admin_email = $('#admin_edit_email').val();
	var admin_mobile = $('#admin_edit_mobile').val();

	var url = "admin-ajax.php?mode=editUpdate&admin_id="+admin_id+"&admin_name="+admin_name+"&admin_type="+admin_type+"&admin_email="+admin_email+"&admin_mobile="+admin_mobile;
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(responseText)
			{
		
			if(responseText == "success")
			{
			document.getElementById("FrmeEditAdminPop").reset();
				
				showNotification("Record updated succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'admin.php';$('#editAdminPop').modal('hide');
         		}, 3000);	
			}
		}	
	}); 
}

function openAdminChangePasswordpop(admin_id,admin_name){
	
    document.getElementById('admin_pass_id').value=admin_id;
	document.getElementById('admin_pass_name').value=admin_name;
	
	$('#AdminChangePasswordPop').modal('show');
}

function ChangePasswordAdmin(event){

	event.preventDefault();
	var admin_id=document.getElementById('admin_pass_id').value;
	var admin_pass_new=document.getElementById('admin_pass_new').value;
	var admin_pass_new_confirm=document.getElementById('admin_pass_new_confirm').value;
	if(admin_pass_new!=admin_pass_new_confirm){
		document.getElementById("admin_pass_new_confirm").style.borderColor="red";	
		msg = "Password not matching!";
		$("#passwordmessageadmin").html(msg);
	}
	else{	
		var url = "admin-ajax.php?mode=AdminChangePassword&admin_id="+admin_id+"&admin_pass_new="+admin_pass_new; // the script where you handle the form input.
	
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
					document.getElementById("AdminChangePassword").reset();
					swal("Password has been changed Successfully!!!",
				{
					  icon: "success",
				}); 
					setTimeout(function()
					{
					window.location.href ='admin.php';$('#AdminChangePasswordPop').modal('hide');
					 }, 3000);	
				}
			}
		}); 
	}
}


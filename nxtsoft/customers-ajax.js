function openCustomerEditpop(cust_sno,cust_id,cust_name,cust_address,cust_email,cust_mobile,cust_aadhar_no,cust_bank_acc_no,cust_bank_name,cust_bank_ifsc_code){
	//alert(cust_sno);
	document.getElementById('cust_edit_sno').value=cust_sno;
    document.getElementById('cust_edit_id').value=cust_id;
	document.getElementById('cust_edit_name').value=cust_name;
	document.getElementById('cust_edit_address').value=cust_address;
	document.getElementById('cust_edit_email').value=cust_email;
	document.getElementById('cust_edit_mobile').value=cust_mobile;
	document.getElementById('cust_edit_aadhar_no').value=cust_aadhar_no;
	document.getElementById('cust_bank_edit_acc_no').value=cust_bank_acc_no;
	document.getElementById('cust_bank_edit_name').value=cust_bank_name;
	document.getElementById('cust_bank_edit_ifsc_code').value=cust_bank_ifsc_code;
	$('#editCustomersPop').modal('show');
}

function openCustomerViewpop(cust_sno,cust_id,cust_name,cust_address,cust_email,cust_mobile,cust_aadhar_no,cust_bank_acc_no,cust_bank_name,cust_bank_ifsc_code,status,cust_bank_referrer_id,cust_created_date,cust_updated_date){
	//alert(cust_sno);
	document.getElementById('cust_view_sno').value=cust_sno;
 	document.getElementById('cust_view_id').value=cust_id;
	document.getElementById('cust_view_name').value=cust_name;
	document.getElementById('cust_view_address').value=cust_address;
	document.getElementById('cust_view_email').value=cust_email;
	document.getElementById('cust_view_mobile').value=cust_mobile;
	document.getElementById('cust_view_aadhar_no').value=cust_aadhar_no;
	document.getElementById('cust_bank_view_acc_no').value=cust_bank_acc_no;
	document.getElementById('cust_bank_view_name').value=cust_bank_name;
	document.getElementById('cust_bank_view_ifsc_code').value=cust_bank_ifsc_code;
	document.getElementById('cust_view_status').value=status;
	document.getElementById('cust_bank_view_referrer_id').value=cust_bank_referrer_id;
	document.getElementById('cust_view_created_date').value=cust_created_date;
	document.getElementById('cust_view_updated_date').value=cust_updated_date;
	$('#ViewCustomersPop').modal('show');
}
function insertCustomers(event){
	
	event.preventDefault();
	var cust_id=document.getElementById('cust_id').value;
	//alert(cust_id);
	var cust_type=1;
	var admin_approval=1;
	var cust_name=document.getElementById('cust_name').value;
	var cust_address=document.getElementById('cust_address').value;
	var cust_email=document.getElementById('cust_email').value;
	var cust_password=document.getElementById('cust_password').value;
	var cust_mobile=document.getElementById('cust_mobile').value;
    var cust_aadhaar_no=document.getElementById('cust_aadhaar_no').value;
    var cust_bank_acc_no=document.getElementById('cust_bank_acc_no').value;
    var cust_bank_name=document.getElementById('cust_bank_name').value;
    var cust_bank_ifs_code=document.getElementById('cust_bank_ifs_code').value;
    var cust_referrer_id=document.getElementById('cust_referrer_id').value;
	var cust_referrer_type=document.getElementById('cust_referrer_type').value;
	if(cust_id==''||cust_name==''||cust_address==''||cust_email==''||cust_password==''||cust_mobile==''||cust_aadhaar_no==''||cust_bank_acc_no==''||cust_bank_name==''||cust_bank_ifs_code==''){
		msg="Input Fields Cannot be null"
		$("#custregmessage").html(msg);
	}else{

	var url = "customers-ajax.php?mode=addCustomers&cust_id="+cust_id+"&cust_type="+cust_type+"&cust_name="+cust_name+"&cust_address="+cust_address+"&cust_email="+cust_email+"&cust_password="+cust_password+"&cust_mobile="+cust_mobile+"&cust_aadhaar_no="+cust_aadhaar_no+"&cust_bank_acc_no="+cust_bank_acc_no+"&cust_bank_name="+cust_bank_name+"&cust_bank_ifs_code="+cust_bank_ifs_code+"&cust_referrer_id="+cust_referrer_id+"&cust_referrer_type="+cust_referrer_type+"&admin_approval="+admin_approval; // the script where you handle the form input.
	

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
				
			document.getElementById("FrmeaddCustomersPop").reset();
				showNotification("Record submitted succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'customers.php';$('#popAddNewCustomers').modal('hide');
         		}, 3000);	
			}
		}
	}); 
	}
}
function GetCustomerId(){
	

	var url = "customers-ajax.php?mode=GetCustomerId";
	
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		data: FormData,
		success: function(data)
			{
			//alert(data);
			document.getElementById("cust_id").value = data;
	
		//	$('#popAddNewCustomers.cust_id').modal();
			
		}	
	}); 
}

function CheckContact(cust_mobile){
	
	var cust_mobile=document.getElementById('cust_mobile').value;
	//alert(cust_mobile);
	if(cust_mobile==''){
		msg = "Please Enter Mobile Number!";
		$("#mobilemessagecust").html(msg);
	}else{
	var url = "customers-ajax.php?mode=ContactCheck&cust_mobile="+cust_mobile; // the script where you handle the form input.

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
				msg = "Mobile Number Already Exist...!!!";
				document.getElementById("cust_mobile").style.borderColor="red";
				document.getElementById("cust_mobile").value=null;
				
			}else{
				document.getElementById("cust_mobile").style.borderColor="";
				msg = "";
				
				}
			$("#mobilemessagecust").html(msg);
		}
	});
} 
}

function CheckEmail(cust_email){
	
	var cust_email=document.getElementById('cust_email').value;
	//alert(cust_email);
	if(cust_email==''){
		msg = "Please Enter Email Address!";
		$("#emailmessagecust").html(msg);
	}else{
	var url = "customers-ajax.php?mode=EmailCheck&cust_email="+cust_email; // the script where you handle the form input.

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
				document.getElementById("cust_email").style.borderColor="red";
				document.getElementById("cust_email").value=null;
				msg = "Email Already Exist...!!!";
				
			}else{
				document.getElementById("cust_email").style.borderColor="";
				msg = "";
					
			}
		$("#emailmessagecust").html(msg);
		}
	});
} 
}


function EditCustomers(event)
{

	event.preventDefault();
	var cust_sno=document.getElementById('cust_edit_sno').value;
	var cust_id=document.getElementById('cust_edit_id').value;
	var cust_name=document.getElementById('cust_edit_name').value;
	var cust_address=document.getElementById('cust_edit_address').value;
	var cust_email=document.getElementById('cust_edit_email').value;
	var cust_mobile=document.getElementById('cust_edit_mobile').value;
    var cust_aadhar_no=document.getElementById('cust_edit_aadhar_no').value;
    var cust_bank_acc_no=document.getElementById('cust_bank_edit_acc_no').value;
    var cust_bank_name=document.getElementById('cust_bank_edit_name').value;
	var cust_bank_ifs_code=document.getElementById('cust_bank_edit_ifsc_code').value;
	

	var url = "customers-ajax.php?mode=editCustomers&cust_sno="+cust_sno+"&cust_id="+cust_id+"&cust_name="+cust_name+"&cust_address="+cust_address+"&cust_email="+cust_email+"&cust_mobile="+cust_mobile+"&cust_aadhar_no="+cust_aadhar_no+"&cust_bank_acc_no="+cust_bank_acc_no+"&cust_bank_name="+cust_bank_name+"&cust_bank_ifs_code="+cust_bank_ifs_code;
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(responseText)
			{
		   //alert(responseText);
			if(responseText == "success")
			{
			document.getElementById("FrmeEditCustomersPop").reset();
				
				showNotification("Record updated succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'customers.php';$('#editCustomersPop').modal('hide');
         		}, 3000);	
			}
		}	
	}); 
}

function ReferrerCheck(event) {
	var cust_referrer_id=document.getElementById('cust_referrer_id').value;
	//alert(cust_referrer_id);
	var url = "customers-ajax.php?mode=CheckReferrerID&cust_referrer_id=" +cust_referrer_id;

	$.ajax({
		type: "POST",
		url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function (responseText) {
			//alert(responseText);
			if (responseText == "0") {
				msg = "Given ID doesnot exist!";
				document.getElementById("cust_referrer_id").style.borderColor="red";
				document.getElementById("cust_referrer_id").value=null;
				
			}else{
				msg = "";
				document.getElementById("cust_referrer_id").style.borderColor="green";
			}
		$("#custid").html(msg);
		}
	});
}

function openAssignPlanPop(cust_id)
{
	
	document.getElementById('cust_plan_id').value=cust_id;
	$('#popAssignPlan').modal('show');
}

function CustAssignPlan(event){
	
	
	event.preventDefault();
	var cust_id=document.getElementById('cust_plan_id').value;
	var cust_plans=document.getElementById('cust_plans').value;
	var cust_no_plans=document.getElementById('cust_no_plans').value;
	var cust_joining=document.getElementById('cust_joining').value;
	var note =document.getElementById('plan_assign_note').value;

	var url = "customers-ajax.php?mode=CustomerAssignPlan&cust_id="+cust_id+"&cust_plans="+cust_plans+"&cust_no_plans="+cust_no_plans+"&cust_joining="+cust_joining+"&note="+note; // the script where you handle the form input.
	

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
				
				document.getElementById("FrmAssignPlanPop").reset();
				//showNotification("Assigning plan succesfully completed !!!","bg-green");
				swal("Plan has been Successfully Registered!!!",
				{
					  icon: "success",
				}); 

				setTimeout(function()
				{
            	window.location.href = 'customers.php';$('#popAssignPlan').modal('hide');
         		}, 3000);	
			}
		}
	}); 
}

function openPlansPop(cust_id,cust_name)
{
	
	$('#ViewCustomerPlans').modal('show');

	$.ajax({
		url: "customers-ajax.php?mode=ViewCustomerPlan&cust_id="+cust_id+"&cust_name="+cust_name,
		dataType : 'html',
		context: document.body,
		success: function(responseText)
		{
			//alert(responseText);
			$('#displayCustomerPlan').html(responseText);
			$(function()
			{
				console.log( "ready!" );
			});
			
		}
	});	
}

function openCustomerChangePasswordpop(cust_id,cust_name){
	//alert(cust_id);
	document.getElementById('cust_pass_id').value=cust_id;
	document.getElementById('cust_pass_name').value=cust_name;
   
	$('#CustomerChangePasswordPop').modal('show');
}

function ChangePasswordCustomer(event){

	event.preventDefault();
	var cust_id=document.getElementById('cust_pass_id').value;
	var cust_pass_new=document.getElementById('cust_pass_new').value;
	var cust_pass_new_confirm=document.getElementById('cust_pass_new_confirm').value;
	if(cust_pass_new!=cust_pass_new_confirm){
		document.getElementById("cust_pass_new_confirm").style.borderColor="red";	
		msg = "Password not matching!";
		$("#passwordmessage").html(msg);
	}
	else{	
		var url = "customers-ajax.php?mode=CustChangePassword&cust_id="+cust_id+"&cust_pass_new="+cust_pass_new; // the script where you handle the form input.
	
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
					document.getElementById("CustomerChangePassword").reset();
					swal("Password has been changed Successfully!!!",
				{
					  icon: "success",
				}); 
					setTimeout(function()
					{
					window.location.href = 'customers.php';$('#CustomerChangePasswordPop').modal('hide');
					 }, 3000);	
				}
			}
		}); 
	}
}





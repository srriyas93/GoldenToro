function insertOpenCustomers(event){
		
	event.preventDefault();
	var cust_id=document.getElementById('reg_cust_id').value;
	//alert(cust_id);
	var cust_type=1;
	var cust_name=document.getElementById('reg_name').value;
	var cust_address=document.getElementById('reg_address').value;
	var cust_email=document.getElementById('reg_email').value;
	var cust_mobile=document.getElementById('reg_phone').value;
	var cust_password=document.getElementById('reg_password').value;
    var cust_aadhaar_no=document.getElementById('reg_aadhar').value;
    var cust_bank_acc_no=document.getElementById('reg_acc_no').value;
    var cust_bank_name=document.getElementById('reg_bank_name').value;
    var cust_bank_ifs_code=document.getElementById('reg_ifsc').value;
    var cust_referrer_id=document.getElementById('reg_referrer').value;
	var cust_referrer_type=document.getElementById('reg_referrer_type').value;
	
	if(cust_id==''||cust_name==''||cust_address==''||cust_email==''||cust_password==''||cust_mobile==''||cust_aadhaar_no==''||cust_bank_acc_no==''||cust_bank_name==''||cust_bank_ifs_code==''){
		msg="Input Fields Cannot be null"
		$("#custregmessage").html(msg);
	}else{

	var url = "customers-ajax.php?mode=addOpenCustomers&cust_id="+cust_id+"&cust_type="+cust_type+"&cust_name="+cust_name+"&cust_address="+cust_address+"&cust_email="+cust_email+"&cust_password="+cust_password+"&cust_mobile="+cust_mobile+"&cust_aadhaar_no="+cust_aadhaar_no+"&cust_bank_acc_no="+cust_bank_acc_no+"&cust_bank_name="+cust_bank_name+"&cust_bank_ifs_code="+cust_bank_ifs_code+"&cust_referrer_id="+cust_referrer_id+"&cust_referrer_type="+cust_referrer_type; // the script where you handle the form input.
	

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
				
				document.getElementById("modal-switch-label").value=null;
				swal("Customer Registration Successfull!",
                                    {
                                    icon: "success",
                                    }); 

				setTimeout(function()
				{
            	window.location.href = 'index.php';$('#modal-switch').modal('hide');
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
			document.getElementById("reg_cust_id").value = data;
	
		//	$('#popAddNewCustomers.cust_id').modal();
			
		}	
	}); 
}

function CheckContact(reg_phone){
	
	var cust_mobile=document.getElementById('reg_phone').value;
	//alert(cust_mobile);
	if(cust_mobile==''){
		msg = "Please Enter Mobile Number!";
		$("#mobilemessagehome").html(msg);
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
				document.getElementById("reg_phone").style.borderColor="red";
				document.getElementById("reg_phone").value=null;
				
			}else{
				document.getElementById("reg_phone").style.borderColor="";
				msg = "";
				
				}
			$("#mobilemessagehome").html(msg);
		}
	});
} 
}

function CheckEmail(reg_email){
	
	var cust_email=document.getElementById('reg_email').value;
	//alert(cust_email);
	if(cust_email==''){
		msg = "Please Enter Email Address!";
		$("#emailmessagehome").html(msg);
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
				document.getElementById("reg_email").style.borderColor="red";
				document.getElementById("reg_email").value=null;
				msg = "Email Already Exist...!!!";
				
			}else{
				document.getElementById("reg_email").style.borderColor="";
				msg = "";
					
			}
		$("#emailmessagehome").html(msg);
		}
	});
} 
}


function ReferrerCheck(event) {
	var cust_referrer_id=document.getElementById('reg_referrer').value;
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
				document.getElementById("reg_referrer").style.borderColor="red";
				document.getElementById("reg_referrer").value=null;
				
			}else{
				msg = "";
				document.getElementById("reg_referrer").style.borderColor="green";
			}
		$("#custid").html(msg);
		}
	});
}




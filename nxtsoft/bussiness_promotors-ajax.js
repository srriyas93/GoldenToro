function openBussinessPromotorsEditpop(bp_sno,bp_id,bp_name,bp_address,bp_email,bp_mobile,bp_aadhar_no,bp_bank_acc_no,bp_bank_name,bp_bank_ifsc_code){

	document.getElementById('bp_edit_sno').value=bp_sno;
    document.getElementById('bp_edit_id').value=bp_id;
	document.getElementById('bp_edit_name').value=bp_name;
	document.getElementById('bp_edit_address').value=bp_address;
	document.getElementById('bp_edit_email').value=bp_email;
	document.getElementById('bp_edit_mobile').value=bp_mobile;
	document.getElementById('bp_edit_aadhar_no').value=bp_aadhar_no;
	document.getElementById('bp_bank_edit_acc_no').value=bp_bank_acc_no;
	document.getElementById('bp_bank_edit_name').value=bp_bank_name;
	document.getElementById('bp_bank_edit_ifsc_code').value=bp_bank_ifsc_code;
	$('#editBussinessPromotorsPop').modal('show');
}

function openBpViewpop(bp_id,bp_name,bp_address,bp_email,bp_mobile,bp_aadhar_no,bp_bank_acc_no,bp_bank_name,bp_bank_ifsc_code,bp_bank_referrer_id,bp_created_date,status,bp_updated_date){
	//alert(bp_id);
    document.getElementById('bp_view_id').value=bp_id;
	document.getElementById('bp_view_name').value=bp_name;
	document.getElementById('bp_view_address').value=bp_address;
	document.getElementById('bp_view_email').value=bp_email;
	document.getElementById('bp_view_mobile').value=bp_mobile;
	document.getElementById('bp_view_aadhar_no').value=bp_aadhar_no;
	document.getElementById('bp_bank_view_acc_no').value=bp_bank_acc_no;
	document.getElementById('bp_bank_view_name').value=bp_bank_name;
	document.getElementById('bp_bank_view_ifsc_code').value=bp_bank_ifsc_code;
	document.getElementById('bp_bank_view_referrer_id').value=bp_bank_referrer_id;
	document.getElementById('bp_view_created_date').value=bp_created_date;
	document.getElementById('bp_view_updated_date').value=bp_updated_date;
	document.getElementById('bp_view_status').value=status;
	$('#ViewBussinessPromotorsPop').modal('show');
}
	
function insertBp(event){
    
	event.preventDefault();
	var bp_id=document.getElementById('bp_id').value;
	//alert(bp_id);
	var bp_type=2;
	var bp_name=document.getElementById('bp_name').value;
	var bp_address=document.getElementById('bp_address').value;
	var bp_email=document.getElementById('bp_email').value;
	var bp_password=document.getElementById('bp_password').value;
	var bp_mobile=document.getElementById('bp_mobile').value;
    var bp_aadhaar_no=document.getElementById('bp_aadhaar_no').value;
    var bp_bank_acc_no=document.getElementById('bp_bank_acc_no').value;
    var bp_bank_name=document.getElementById('bp_bank_name').value;
    var bp_bank_ifs_code=document.getElementById('bp_bank_ifs_code').value;
    var bp_referrer_id=document.getElementById('bp_referrer_id').value;
	var bp_referrer_type=document.getElementById('bp_referrer_type').value;
	if(bp_id==''||bp_name==''||bp_address==''||bp_email==''||bp_password==''||bp_mobile==''||bp_aadhaar_no==''||bp_bank_acc_no==''||bp_bank_name==''||bp_bank_ifs_code==''){
		msg="Input Fields Cannot be null"
		$("#bpregmessage").html(msg);
	}else{

	var url = "bussiness_promotors-ajax.php?mode=addBp&bp_id="+bp_id+"&bp_type="+bp_type+"&bp_name="+bp_name+"&bp_address="+bp_address+"&bp_email="+bp_email+"&bp_password="+bp_password+"&bp_mobile="+bp_mobile+"&bp_aadhaar_no="+bp_aadhaar_no+"&bp_bank_acc_no="+bp_bank_acc_no+"&bp_bank_name="+bp_bank_name+"&bp_bank_ifs_code="+bp_bank_ifs_code+"&bp_referrer_id="+bp_referrer_id+"&bp_referrer_type="+bp_referrer_type; // the script where you handle the form input.
	

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
				
			document.getElementById("FrmeaddBussinessPromotersPop").reset();
				showNotification("Record submitted succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'bussiness_promotors.php';$('#popAddNewBussinessPromoters').modal('hide');
         		}, 3000);	
			}
		}
	});
}
}

function GetBpId(){
	

	var url = "bussiness_promotors-ajax.php?mode=GetBpId";
	
	
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
			document.getElementById("bp_id").value = data;
	
		//	$('#popAddNewCustomers.cust_id').modal();
			
		}	
	}); 
}

function EditBp(event)
{

	event.preventDefault();
	var bp_sno=document.getElementById('bp_edit_sno').value;
	var bp_id=document.getElementById('bp_edit_id').value;
	var bp_name=document.getElementById('bp_edit_name').value;
	var bp_address=document.getElementById('bp_edit_address').value;
	var bp_email=document.getElementById('bp_edit_email').value;
	var bp_mobile=document.getElementById('bp_edit_mobile').value;
    var bp_aadhar_no=document.getElementById('bp_edit_aadhar_no').value;
    var bp_bank_acc_no=document.getElementById('bp_bank_edit_acc_no').value;
    var bp_bank_name=document.getElementById('bp_bank_edit_name').value;
	var bp_bank_ifsc_code=document.getElementById('bp_bank_edit_ifsc_code').value;
	
	var url = "bussiness_promotors-ajax.php?mode=EditBp&bp_sno="+bp_sno+"&bp_id="+bp_id+"&bp_name="+bp_name+"&bp_address="+bp_address+"&bp_email="+bp_email+"&bp_mobile="+bp_mobile+"&bp_aadhar_no="+bp_aadhar_no+"&bp_bank_acc_no="+bp_bank_acc_no+"&bp_bank_name="+bp_bank_name+"&bp_bank_ifsc_code="+bp_bank_ifsc_code;
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(responseText)
			{
		    // alert(responseText);
			if(responseText =="success")
			{
				document.getElementById("FrmeEditBussinessPromotorsPop").reset();
				
				showNotification("Record updated succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'bussiness_promotors.php';$('#editBussinessPromotorsPop').modal('hide');
         		}, 3000);	
			}
		}	
	}); 
}

function ReferrerCheck1(event) {
	var bp_referrer_id=document.getElementById('bp_referrer_id').value;
//	alert(cust_referrer_id);
	var url = "bussiness_promotors-ajax.php?mode=CheckReferrerID&bp_referrer_id=" + bp_referrer_id;

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
				document.getElementById("bp_referrer_id").style.borderColor="red";
				document.getElementById("bp_referrer_id").value=null;
				
			}else{
				msg="";
				document.getElementById("bp_referrer_id").style.borderColor="green";
			}
		$("#bpid").html(msg);
		}
	});
}

function openBpChangePasswordpop(bp_id,bp_name){

    document.getElementById('bp_pass_id').value=bp_id;
	document.getElementById('bp_pass_name').value=bp_name;
	
	$('#BpChangePasswordPop').modal('show');
}

function ChangePasswordBp(event){

	event.preventDefault();
	var bp_id=document.getElementById('bp_pass_id').value;
	var bp_pass_new=document.getElementById('bp_pass_new').value;
	var bp_pass_new_confirm=document.getElementById('bp_pass_new_confirm').value;
	if(bp_pass_new!=bp_pass_new_confirm){
		document.getElementById("bp_pass_new_confirm").style.borderColor="red";	
		msg = "Password not matching!";
		$("#passwordmessagebp").html(msg);
	}
	else{	
		var url = "bussiness_promotors-ajax.php?mode=BpChangePassword&bp_id="+bp_id+"&bp_pass_new="+bp_pass_new; // the script where you handle the form input.
	
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
					document.getElementById("BpChangePassword").reset();
					swal("Password has been changed Successfully!!!",
				{
					  icon: "success",
				}); 
					setTimeout(function()
					{
					window.location.href = 'bussiness_promotors.php';$('#BpChangePasswordPop').modal('hide');
					 }, 3000);	
				}
			}
		}); 
	}
}


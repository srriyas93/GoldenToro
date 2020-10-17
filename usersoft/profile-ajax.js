
function editProfile(event){
    event.preventDefault();
	var cust_name=document.getElementById('cust_profile_name').value;
	var cust_username=document.getElementById('cust_profile_username').value;
  	var cust_mobile=document.getElementById('cust_profile_mobile').value;
    var cust_address=document.getElementById('cust_profile_address').value;
    var cust_aadhar=document.getElementById('cust_profile_aadhar').value;
    var cust_bank_acc_num=document.getElementById('cust_profile_bank_acc_num').value; 
    var cust_bank_name=document.getElementById('cust_profile_bank_name').value;  
	var cust_bank_ifsc_code=document.getElementById('cust_profile_bank_ifsc_code').value;
	var cust_referrer_id=document.getElementById('cust_profile_referrer_id').value;
	var cust_bank_created_date=document.getElementById('cust_profile_created_date').value;
	var cust_bank_updated_date=document.getElementById('cust_profile_updated_date').value;
  
  //alert(cust_username);
    var url = "profile-ajax.php?mode=editProfile&cust_name="+cust_name+"&cust_username="+cust_username+"&cust_mobile="+cust_mobile+"&cust_address="+cust_address+"&cust_aadhar="+cust_aadhar+"&cust_bank_acc_num="+cust_bank_acc_num+"&cust_bank_name="+cust_bank_name+"&cust_bank_ifsc_code="+cust_bank_ifsc_code+"&cust_referrer_id="+cust_referrer_id+"&cust_bank_created_date="+cust_bank_created_date+"&cust_bank_updated_date="+cust_bank_updated_date;

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
	
				showNotification("Profile Updated succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'profile.php';
         	}, 3000);	
			} 	
		}
	});
}

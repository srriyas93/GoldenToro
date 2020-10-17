function showConfirmMessage1(module,name,id,status)
{
  //alert(name);
     swal({
          title: "Warning",
          text: "Do you want to change "+name+" status?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                  switch (module)
                  {
                        case "plans":
                                    disablePlanStatus(id,status);
                                    swal(name+" status has been changed Successfully!",
                                    {
                                          icon: "success",
                                    }); 
                        break;
                        case "customers":
                                    disableCustomerStatus(id,status);
                                    swal(name+" status has been changed Successfully!",
                                    {
                                    icon: "success",
                                    }); 
                        break;
                        case "bussiness_promotors": 
                                    disableBpStatus(id,status);
                                    swal(name+" status has been changed Successfully!",
                                    {
                                    icon: "success",
                                    }); 
                        break;
                        case "admin":
                                    disableAdminStatus(id,status);
                                    swal(name+" status has been changed Successfully!",
                                    {
                                    icon: "success",
                                    }); 
                        break;
                       
                  }
            }
            else
            {
                  swal(name+" status change request cancelled!");
            }
      });
}

function disablePlanStatus(plan_id,status){
      //alert(plan_id);
     var url = "custom-ajax.php?mode=disablePlan&plan_id="+plan_id+"&status="+status;

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
            setTimeout(function()
                  {
            window.location.href = 'plans.php';
         }, 1500);	        
         	
            }	
         }
      }); 
}


function disableCustomerStatus(cust_sno,status){
   
      var url = "custom-ajax.php?mode=disableCustomer&cust_sno="+cust_sno+"&status="+status;
 
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
            setTimeout(function()
            {
             window.location.href = 'customers.php';
          }, 1500);	        
                
            }	
      }
  });
} 

function disableBpStatus(bp_sno,status){
    
      var url = "custom-ajax.php?mode=disableBp&bp_sno="+bp_sno+"&status="+status;
 
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
            setTimeout(function()
            {
             window.location.href = 'bussiness_promotors.php';
          }, 1500);	        
                
            }	
      }
  });
} 

function disableAdminStatus(user_id,status){
   
      var url = "custom-ajax.php?mode=disableAdmin&user_id="+user_id+"&status="+status;

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
            setTimeout(function()
            {
             window.location.href = 'admin.php';
          }, 1500);	        
                
            }	
      }
  });
}

function showConfirmMessage2(module,name,email,admin_approval)
{

     swal({
          title: "Confirm",
          text: "Do you want to Approve "+name+"?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                  switch (module)
                  {
                        case "dashboardadminapproval":
                                    enableAdminApproval(email,admin_approval);
                                    swal(name+" has been successfully Approved!",
                                    {
                                    icon: "success",
                                    }); 
                        break;
                        case "customeradminapproval":
                              
                                    enableAdminApprovalCust(email,admin_approval);
                                    swal(name+" has been successfully Approved!",
                                    {
                                    icon: "success",
                                    }); 
                        break;
                        
                       
                  }
            }
            else
            {
                  swal(name+" approval request cancelled!");
            }
      });
}

function enableAdminApproval(email,admin_approval)
{

	var url = "custom-ajax.php?mode=enableAdminApproval&email="+email+"&admin_approval="+admin_approval;
	
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
				setTimeout(function()
				{
            	window.location.href = 'dashboard.php';
         		}, 3000);	
			}
		}	
	}); 
}

function enableAdminApprovalCust(email,admin_approval)
{
      
	var url = "custom-ajax.php?mode=enableAdminApproval&email="+email+"&admin_approval="+admin_approval;
	
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
				setTimeout(function()
				{
            	window.location.href = 'customers.php';
         		}, 3000);	
			}
		}	
	}); 
}
  
function formIsValid(moduleName,frmId,event)
{
      var form = document.getElementById(frmId);
      var isValidForm = form.checkValidity();

      if (isValidForm)
      {
            switch (moduleName)
            {
                  case "WeeklySettlement":
                        WeeklySettlement(event);
                        break;
                  case "admin":
                        insertAdmin(event);
                        break;
                  case "admin_edit":
                        EditAdmin(event);
                        break;
                  case "admin_chgpass":
                        ChangePasswordAdmin(event);
                        break;
                  case "customers":                      
                        GetCustomerId();
                        insertCustomers(event);
                        break;
                  case "customers_edit":                      
                        EditCustomers(event);
                        break;
                  case "customers_assign_plan":                      
                        CustAssignPlan(event);
                        break;
                  case "customers_chg_pass":                      
                        ChangePasswordCustomer(event);
                        break;
                  case "bp":                      
                        insertBp(event);
                        break;
                  case "bp_edit":                      
                        EditBp(event);
                        break;
                  case "bp_chg_pass":                      
                        ChangePasswordBp(event);
                        break;
                  case "plans":                      
                        insertPlans(event);
                        break;
                  case "plans_edit":                      
                        editPlan(event);
                        break;
                  default:
                        alert("Something Went Wrong! Please Try Later");
            }
      }
      else
      {
            return false;
      }
}

// Function for managing Menu Active
activemenu();
function activemenu()
{
      var urlpath = window.location.pathname;
      url_Index = urlpath.lastIndexOf("/") + 1;
      fileName = urlpath.substr(url_Index);

      var activeMenu = fileName.split('.');
      activeItem = "menu-" + activeMenu[0];
      document.getElementById(activeItem).classList.add("active");

      switch (activeMenu[0])
      {
            case "customers":
            case "bussiness_promotors":
            case "admin":
                  document.getElementById('menu-user').classList.add("active");
                  break;
            
            case "reports_customers":
            case "reports_plans":
            case "reports_transaction":
            case "reports_settlement":
                  document.getElementById('menu-reports').classList.add("active");
                  break;
            
            case "settings_trade_calendar":
                  document.getElementById('menu-settings').classList.add("active");
                  break;
      }
}
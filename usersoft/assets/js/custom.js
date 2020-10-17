function showConfirmMessage1(module,id,status)
{
  //alert(status);
     swal({
          title: "Warning",
          text: "Do you want to change the status?",
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
                                    swal("Confirmed! Plan status has been changed!",
                                    {
                                          icon: "success",
                                    }); 
                        break;
                        case "customers":
                                    disableCustomerStatus(id,status);
                                    swal("Confirmed! Customer status has been changed!",
                                    {
                                    icon: "success",
                                    }); 
                        break;
                        case "bussiness_promotors": 
                                    disableBpStatus(id,status);
                                    swal("Confirmed! Bussiness Promotor status has been changed!",
                                    {
                                    icon: "success",
                                    }); 
                        break;
                        case "admin":
                                    disableAdminStatus(id,status);
                                    swal("Confirmed! Admin status has been changed!",
                                    {
                                    icon: "success",
                                    }); 
                        break;
                  }
            }
            else
            {
                  swal("Status changed request cancelled!");
            }
      });
}

function disablePlanStatus(plan_id,status){
      
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
            case "profile":
            case "changePassword":
                  document.getElementById('menu-user').classList.add("active");
                  break;

            case "reports_transaction":
                  document.getElementById('menu-reports').classList.add("active");
                  break;
      }
}

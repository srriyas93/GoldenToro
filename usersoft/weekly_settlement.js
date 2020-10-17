function WeeklySettlement(event)
{
	
	event.preventDefault();
	var username=document.getElementById('username').value;
	var planid=document.getElementById('cust_report_planid').value;
	var dt=document.getElementById('cust_report_start_date').value;
	var pl =document.getElementById('cust_report_planid');
	var pl_name = pl.options[pl.selectedIndex].text;
	if(planid == -1)
	{
		pl_name = 'All Plan';
	}
		
	var url = "weekly_settlement-ajax.php?mode=DisplayCustAmt&username="+username+"&planid="+planid+"&dt="+dt; // the script where you handle the form input.

	$.ajax({
		url: url,
		dataType : 'html',
		context: document.body,
		success: function(responseText)
		{
			//alert(responseText);
			$('#displayCustomerSettlement').html(responseText);

			/* ----- Setting up data for Export Report start ---*/
			document.getElementById('td_acc_fromDate').innerHTML = dt;
			document.getElementById('td_acc_plan').innerHTML =pl_name;
				/* ----- Setting up data for Export Report ends ---*/
			$(function()
			{
				console.log( "ready!" );
			});
			
			
		}
	});	
}

function weeklypaysettlement(sno,amt,dt,status)
{
	swal({
          title: "Warning",
          text: "Do you want to settle the payment?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
				var url = "weekly_settlement-ajax.php?mode=SettleAmt&cu_pl_id="+sno+"&amt="+amt+"&dt="+dt+"&status="+status; // the script where you handle the form input.
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
							swal("Confirmed! Settlement has successfully completed!",
							{
								icon: "success",
							});
							WeeklySettlement(event);

						}
						else
						{
							swal("Error in Settlement !");

						}
					}
				});
            }
            else
            {
                  swal("Settlement request has been cancelled!");
            }
      });
}

function PlansReport(event){
	event.preventDefault();
	var plan_planid=document.getElementById('plan_report_planid').value;
    var plan_custid=document.getElementById('plan_report_custid').value;
   // alert(plan_custid);
   // alert(plan_planid);
	var plan_start_date=document.getElementById('plan_report_start_date').value;
	var plan_end_date=document.getElementById('plan_report_end_date').value;

	
	if(plan_custid == -1)
	{
		var cust_name = "NA"	;
	}
	else
	{
		var cust = document.getElementById('plan_report_custid');
		var cust_name = cust.options[cust.selectedIndex].text;
	}

	if(plan_planid == -1)
	{
		var pl_name = "NA"	;
	}
	else
	{
		var pl =document.getElementById('plan_report_planid');
		var pl_name = pl.options[pl.selectedIndex].text;
	}

	var url = "reports_plans-ajax.php?mode=PlansReport&plan_custid="+plan_custid+"&plan_planid="+plan_planid+"&plan_start_date="+plan_start_date+"&plan_end_date="+plan_end_date; // the script where you handle the form input.

	$.ajax({
		url: url,
		dataType : 'html',
		context: document.body,
		success: function(responseText)
		{
			//alert(responseText);
			$('#displayPlansReport').html(responseText);

			/* ----- Setting up data for Export Report start ---*/
			document.getElementById('td_cu_type').innerHTML = cust_name;
			document.getElementById('td_cu_plan').innerHTML =pl_name;
			document.getElementById('td_cu_stdate').innerHTML =plan_start_date;
			document.getElementById('td_cu_enddate').innerHTML = plan_end_date;
			/* ----- Setting up data for Export Report ends ---*/
			$(function()
			{
				console.log( "ready!" );
			});
			document.getElementById("CustomerSearch").reset();
			
		}
	});	
}
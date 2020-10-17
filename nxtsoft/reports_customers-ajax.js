function CustomersReport(event){
	event.preventDefault();
	var cust_snoname=document.getElementById('cust_report_snoname').value;
	//alert(cust_snoname);
	var cust_planid=document.getElementById('cust_report_planid').value;
	var cust_status=document.getElementById('cust_report_status').value;
	var cust_start_date=document.getElementById('cust_report_start_date').value;
	var cust_end_date=document.getElementById('cust_report_end_date').value;

	if(cust_snoname == -1)
	{
		var cust_name = "NA"	;
	}
	else
	{
		var cust = document.getElementById('cust_report_snoname');
		var cust_name = cust.options[cust.selectedIndex].text;
	}

	if(cust_planid == -1)
	{
		var pl_name = "NA"	;
	}
	else
	{
		var pl =document.getElementById('cust_report_planid');
		var pl_name = pl.options[pl.selectedIndex].text;
	}

	if(cust_status == -1)
	{
		var status = "NA"	;
	}
	else
	{
		var stat =document.getElementById('cust_report_status');
		var status = stat.options[stat.selectedIndex].text;
	}


	var url = "reports_customers-ajax.php?mode=CustomersReport&cust_snoname="+cust_snoname+"&cust_planid="+cust_planid+"&cust_status="+cust_status+"&cust_start_date="+cust_start_date+"&cust_end_date="+cust_end_date; // the script where you handle the form input.

	$.ajax({
		url: url,
		dataType : 'html',
		context: document.body,
		success: function(responseText)
		{
			//alert(responseText);
			$('#displayCustomerReport').html(responseText);

			/* ----- Setting up data for Export Report start ---*/
			document.getElementById('td_cu_type').innerHTML = cust_name;
			document.getElementById('td_cu_plan').innerHTML =pl_name;
			document.getElementById('td_cu_status').innerHTML = status;
			document.getElementById('td_cu_stdate').innerHTML =cust_start_date;
			document.getElementById('td_cu_enddate').innerHTML = cust_end_date;
			/* ----- Setting up data for Export Report ends ---*/
			$(function()
			{
				console.log( "ready!" );
			});
			document.getElementById("CustomerSearch").reset();
			
		}
	});	
}
function TransactionReport(event){
	event.preventDefault();
	var cust_snoname=document.getElementById('cust_report_snoname').value;
	//alert(cust_snoname);
	var cust_planid=document.getElementById('cust_report_planid').value;
	var cust_start_date=document.getElementById('cust_report_start_date').value;
	var cust_end_date=document.getElementById('cust_report_end_date').value;

	
	if(cust_snoname == -1)
	{
		var cust_name = "NA"	;
	}
	else
	{
		var cust = document.getElementById('cust_report_snoname');
		var cust_name = cust.options[cust.selectedIndex].text;
	}

	if(cust_planid == -1)
	{
		var pl_name = "NA"	;
	}
	else
	{
		var pl =document.getElementById('cust_report_planid');
		var pl_name = pl.options[pl.selectedIndex].text;
	}

	var url = "reports_customers-ajax.php?mode=TransactionReport&cust_snoname="+cust_snoname+"&cust_planid="+cust_planid+"&cust_start_date="+cust_start_date+"&cust_end_date="+cust_end_date; // the script where you handle the form input.

	$.ajax({
		url: url,
		dataType : 'html',
		context: document.body,
		success: function(responseText)
		{
			//alert(responseText);
			$('#displayCustomerReport').html(responseText);

			/* ----- Setting up data for Export Report start ---*/
			document.getElementById('td_cu_type').innerHTML = cust_name;
			document.getElementById('td_cu_plan').innerHTML =pl_name;
			document.getElementById('td_cu_stdate').innerHTML =cust_start_date;
			document.getElementById('td_cu_enddate').innerHTML = cust_end_date;
			/* ----- Setting up data for Export Report ends ---*/
			$(function()
			{
				console.log( "ready!" );
			});
			document.getElementById("CustomerSearch").reset();
			
		}
	});	
}
function SettlementReport(event){
	event.preventDefault();
	var cust_snoname=document.getElementById('cust_report_snoname').value;
	//alert(cust_snoname);
	var cust_planid=document.getElementById('cust_report_planid').value;
	var cust_start_date=document.getElementById('cust_report_start_date').value;
	var cust_end_date=document.getElementById('cust_report_end_date').value;

	
	if(cust_snoname == -1)
	{
		var cust_name = "NA"	;
	}
	else
	{
		var cust = document.getElementById('cust_report_snoname');
		var cust_name = cust.options[cust.selectedIndex].text;
	}

	if(cust_planid == -1)
	{
		var pl_name = "NA"	;
	}
	else
	{
		var pl =document.getElementById('cust_report_planid');
		var pl_name = pl.options[pl.selectedIndex].text;
	}

	var url = "reports_customers-ajax.php?mode=SettlementReport&cust_snoname="+cust_snoname+"&cust_planid="+cust_planid+"&cust_start_date="+cust_start_date+"&cust_end_date="+cust_end_date; // the script where you handle the form input.

	$.ajax({
		url: url,
		dataType : 'html',
		context: document.body,
		success: function(responseText)
		{
			//alert(responseText);
			$('#displayCustomerReport').html(responseText);

			/* ----- Setting up data for Export Report start ---*/
			document.getElementById('td_cu_type').innerHTML = cust_name;
			document.getElementById('td_cu_plan').innerHTML =pl_name;
			document.getElementById('td_cu_stdate').innerHTML =cust_start_date;
			document.getElementById('td_cu_enddate').innerHTML = cust_end_date;
			/* ----- Setting up data for Export Report ends ---*/
			$(function()
			{
				console.log( "ready!" );
			});
			document.getElementById("CustomerSearch").reset();
			
		}
	});	
}
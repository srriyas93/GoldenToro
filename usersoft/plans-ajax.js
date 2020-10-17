
function openPlanViewpop(plan_title,plan_amount,plan_daily_roi,plan_life,cust_join_date,cust_plan_expiry,cust_plan_status1)
{
	document.getElementById('plan_view_title').value=plan_title;
	document.getElementById('plan_view_amount').value=plan_amount;
	document.getElementById('plan_view_daily_roi').value=plan_daily_roi;
	document.getElementById('plan_view_life').value=plan_life;
	document.getElementById('cust_view_join_date').value=cust_join_date;
	document.getElementById('cust_plan_view_expiry').value=cust_plan_expiry;
	document.getElementById('cust_plan_view_status').value=cust_plan_status1;
	$('#ViewPlanPop').modal('show');
}

function insertPlans(event)
{
	event.preventDefault();
	var plan_title=document.getElementById('plan_title').value;
	var plan_amount=document.getElementById('plan_amount').value;
	var plan_daily_roi=document.getElementById('plan_daily_roi').value;
	var plan_life=document.getElementById('plan_life').value;

	var url = "plans-ajax.php?mode=addPlans&plan_title="+plan_title+"&plan_amount="+plan_amount+"&plan_daily_roi="+plan_daily_roi+"&plan_life="+plan_life;
	
	if (plan_title == '' || plan_amount == '' || plan_daily_roi == '' || plan_life == '') {
		document.getElementById("plan_title").style.borderColor="red";
		document.getElementById("plan_amount").style.borderColor="red";
		document.getElementById("plan_daily_roi").style.borderColor="red";
		document.getElementById("plan_life").style.borderColor="red";
	} else{
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
				
				document.getElementById("FrmeAddPlanPop").reset();
	
				showNotification("Plan submitted succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'plans.php';$('#popaddnewplan').modal('hide');
         	}, 3000);	
			}	
		}
	}); 
}
}

function editPlan(event)
{
	event.preventDefault();
	var plan_id = $('#plan_edit_id').val();
	var plan_title = $('#plan_edit_title').val();
	var plan_amount = $('#plan_edit_amount').val();	
	var plan_daily_roi = $('#plan_edit_daily_roi').val();
	var plan_life = $('#plan_edit_life').val();

	var url = "plans-ajax.php?mode=planUpdate&plan_id="+plan_id+"&plan_title="+plan_title+"&plan_amount="+plan_amount+"&plan_daily_roi="+plan_daily_roi+"&plan_life="+plan_life;
	
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
				document.getElementById("FrmeditPlanPop").reset();
				
				showNotification("Plan updated succesfully !!!","bg-green");

				setTimeout(function()
				{
            	window.location.href = 'plans.php';$('#editPlanPop').modal('hide');
         	}, 3000);
		   }
		}	
	}); 
}



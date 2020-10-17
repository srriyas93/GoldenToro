<?php
include('dbconfig.php');
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');


if (isset($_GET['mode'])) 
{
    if ($_REQUEST['mode'] == "addPlans") 
    {
        
        $plan_title = $_GET['plan_title'];
        $plan_amount = $_GET['plan_amount'];
        $plan_daily_roi = $_GET['plan_daily_roi'];
        $plan_life = $_GET['plan_life'];

        $q = "INSERT INTO plans(title,amount,daily_roi,plan_life) VALUES ('$plan_title',$plan_amount,$plan_daily_roi,$plan_life)";

        if (!mysqli_query($con, $q)) 
        {
            echo("Error description: " . mysqli_error($con));
        } 
        else 
        {
            echo "success";
		}
	} 
	elseif ($_REQUEST['mode'] == "planUpdate") 
    {
        $plan_id=$_GET['plan_id'];
        $plan_title = $_GET['plan_title'];
        $plan_amount = $_GET['plan_amount'];
        $plan_daily_roi = $_GET['plan_daily_roi'];
        $plan_life = $_GET['plan_life'];
        
        $Q3 = " UPDATE `plans` SET `title` = '$plan_title', amount = $plan_amount, daily_roi = $plan_daily_roi, plan_life = $plan_life, updated_date = CURRENT_TIMESTAMP() WHERE id= $plan_id";
        
        $r3 = mysqli_query($con, $Q3);

        if ($r3) 
        {
            echo "success";
        } 
        else 
        {
            echo("Error in Updation");
        }
    }
}
 
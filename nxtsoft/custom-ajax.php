<?php
include('dbconfig.php');
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if (isset($_GET['mode'])) {
    if ($_REQUEST['mode'] == "disablePlan") {

        $plan_id = $_GET['plan_id'];
        $status = $_GET['status'];
        if($status==1){
            $plan_status=0;
        }else{
            $plan_status=1;
        }
 
        $Q3 = "UPDATE plans SET status=$plan_status, updated_date = CURRENT_TIMESTAMP() WHERE id= $plan_id";

        $r3 = mysqli_query($con, $Q3);

        if (!mysqli_query($con, $Q3)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }

elseif ($_REQUEST['mode'] == "disableCustomer") {

        $cust_sno = $_GET['cust_sno'];
        $status = $_GET['status'];
        if($status==1){
            $cust_status=0;
        }else{
            $cust_status=1;
        }
 
        $Q3 = "UPDATE users_customers SET status=$cust_status, updated_date = CURRENT_TIMESTAMP() WHERE sno= $cust_sno";

        $r3 = mysqli_query($con, $Q3);

        if (!mysqli_query($con, $Q3)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }

elseif ($_REQUEST['mode'] == "disableBp") {

        $bp_sno = $_GET['bp_sno'];
        $status = $_GET['status'];
        if($status==1){
            $bp_status=0;
        }else{
            $bp_status=1;
        }
 
        $Q3 = "UPDATE users_customers SET status=$bp_status, updated_date = CURRENT_TIMESTAMP() WHERE sno= $bp_sno";

        $r3 = mysqli_query($con, $Q3);

        if (!mysqli_query($con, $Q3)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }

elseif ($_REQUEST['mode'] == "disableAdmin") {

        $user_id = $_GET['user_id'];
        $status = $_GET['status'];
        if($status==1){
            $admin_status=0;
        }else{
            $admin_status=1;
        }
       
        $Q3 = "UPDATE users_admin SET status=$admin_status, updated_date = CURRENT_TIMESTAMP() WHERE user_id= $user_id";
        $r3 = mysqli_query($con, $Q3);

        if (!mysqli_query($con, $Q3)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }

    elseif ($_REQUEST['mode'] == "enableAdminApproval") {

        $email = $_GET['email'];
        $admin_approval = $_GET['admin_approval'];
        if($admin_approval==0){
            $admin_approval=1;
        }else{
            $admin_approval=0;
        }
       
        $Q3 = "UPDATE users_customers SET admin_approval=$admin_approval,status=1, updated_date = CURRENT_TIMESTAMP() WHERE email='$email'";
        $r3 = mysqli_query($con, $Q3);

        if (!mysqli_query($con, $Q3)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }
}
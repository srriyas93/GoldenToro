<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');


if (isset($_GET['mode'])){
    if ($_REQUEST['mode'] == "editProfile"){
        
        
        $cust_name=$_GET['cust_name'];
        $cust_username=$_GET['cust_username'];
        $cust_mobile=$_GET['cust_mobile'];  
        $cust_address=$_GET['cust_address']; 
        $cust_aadhar=$_GET['cust_aadhar'];
        $cust_bank_acc_num=$_GET['cust_bank_acc_num'];  
        $cust_bank_name=$_GET['cust_bank_name']; 
        $cust_bank_ifsc_code=$_GET['cust_bank_ifsc_code'];
        $cust_referrer_id=$_GET['cust_referrer_id'];
        $cust_bank_created_date=$_GET['cust_bank_created_date'];
        $cust_bank_updated_date=$_GET['cust_bank_updated_date'];
        
        $Q3 = "UPDATE `users_customers` SET `name`='$cust_name',`address`='$cust_address', mobile='$cust_mobile',aadhaar_no='$cust_aadhar',bank_acc_no='$cust_bank_acc_num',bank_name ='$cust_bank_name',ifs_code='$cust_bank_ifsc_code', updated_date=CURRENT_TIMESTAMP() WHERE cust_type=1 AND email='$cust_username'";
        $r3 = mysqli_query($con, $Q3);

        if ($r3) {
            echo "success";
        } else {
            echo("Error description: " . mysqli_error($con));
		}
    }
}
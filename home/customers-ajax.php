<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if (isset($_GET['mode'])) {
    if ($_REQUEST['mode'] == "addOpenCustomers") {
        $cust_id= $_GET['cust_id'];
        $cust_type= $_GET['cust_type'];
        $cust_name= $_GET['cust_name'];
        $cust_address = $_GET['cust_address'];
        $cust_email = $_GET['cust_email'];
        $cust_password = $_GET['cust_password'];
         /* md5 Conversion */ 
         $md5_password=md5($cust_password);

        $cust_mobile = $_GET['cust_mobile'];
        $cust_aadhaar_no = $_GET['cust_aadhaar_no'];
        $cust_bank_acc_no = $_GET['cust_bank_acc_no'];
        $cust_bank_name = $_GET['cust_bank_name'];
        $cust_bank_ifs_code = $_GET['cust_bank_ifs_code'];
        $cust_referrer_id = $_GET['cust_referrer_id'];
        $cust_referrer_type = $_GET['cust_referrer_type'];
       

        $q = "INSERT INTO users_customers(cust_id,cust_type,name,address,email,password,mobile,aadhaar_no,bank_acc_no,bank_name,ifs_code,referrer_id,referrer_type) VALUES ('$cust_id',$cust_type,'$cust_name','$cust_address','$cust_email','$md5_password','$cust_mobile','$cust_aadhaar_no','$cust_bank_acc_no','$cust_bank_name','$cust_bank_ifs_code','$cust_referrer_id',$cust_referrer_type)";
      

        if (!mysqli_query($con, $q)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }
    elseif($_REQUEST['mode'] =="GetCustomerId" ){

        $query="SELECT cust_id FROM users_customers WHERE sno=(SELECT max(sno) FROM users_customers WHERE cust_type=1);";
        $r = mysqli_query($con, $query);
        $c = mysqli_num_rows($r);
        if (!mysqli_num_rows($r) > 0) {
            $id="CUST-1000";
             
        } else {
            while ($row = mysqli_fetch_array($r)) {
                $id = $row['cust_id'];   
            }
        }
                $i=explode("-",$id);
                $num=(int)$i[1];
                $num++;
                $cust_id=$i[0]."-".$num."";
                echo $cust_id;
    }

    elseif ($_REQUEST['mode'] == "CheckReferrerID") {
        
        $cust_referrer_id = $_GET['cust_referrer_id'];

        $q = "SELECT count(*) as cntcustid FROM users_customers WHERE cust_id='$cust_referrer_id'";
        $result = mysqli_query($con, $q);
        if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_array($result);  //Fetching the result

            $count = $row['cntcustid'];
            if ($count > 0) {
                echo "1";
            }else {
                echo "0";
            }
        }
    }

    elseif ($_REQUEST['mode'] == "ContactCheck") {

        
        $cust_mobile=$_GET['cust_mobile'];
        
        $Q3 = "SELECT count(*) AS countMobile FROM users_customers WHERE mobile='$cust_mobile'";
        $r3 = mysqli_query($con, $Q3);
        
            $row = mysqli_fetch_array($r3);

            $count = $row['countMobile'];
            if ($count > 0) {
                echo "1";
            } else {
                echo "0";
            }
        
    }

    elseif ($_REQUEST['mode'] == "EmailCheck") {

        
        $cust_email=$_GET['cust_email'];
        
        $Q3 = "SELECT count(*) AS countEmail FROM users_customers WHERE email='$cust_email'";
        $r3 = mysqli_query($con, $Q3);
        
            $row = mysqli_fetch_array($r3);

            $count = $row['countEmail'];
            if ($count > 0) {
                echo "1";
            } else {
                echo "0";
            }
        
    }
}
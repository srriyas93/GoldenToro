<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if (isset($_GET['mode'])) {
    if ($_REQUEST['mode'] == "addBp") {
        $bp_id= $_GET['bp_id'];
        $bp_type= $_GET['bp_type'];
        $bp_name= $_GET['bp_name'];
        $bp_address = $_GET['bp_address'];
        $bp_email = $_GET['bp_email'];
        $bp_password = $_GET['bp_password'];
        /* md5 Conversion */ 
        $md5_password=md5($bp_password);

        $bp_mobile = $_GET['bp_mobile'];
        $bp_aadhaar_no = $_GET['bp_aadhaar_no'];
        $bp_bank_acc_no = $_GET['bp_bank_acc_no'];
        $bp_bank_name = $_GET['bp_bank_name'];
        $bp_bank_ifs_code = $_GET['bp_bank_ifs_code'];
        $bp_referrer_id = $_GET['bp_referrer_id'];
        $bp_referrer_type = $_GET['bp_referrer_type'];

        $q = "INSERT INTO users_customers(cust_id,cust_type,name,address,email,password,mobile,aadhaar_no,bank_acc_no,bank_name,ifs_code,referrer_id,referrer_type) VALUES ('$bp_id',$bp_type,'$bp_name','$bp_address','$bp_email','$md5_password','$bp_mobile','$bp_aadhaar_no','$bp_bank_acc_no','$bp_bank_name','$bp_bank_ifs_code','$bp_referrer_id',$bp_referrer_type)";
      

        if (!mysqli_query($con, $q)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }

    elseif($_REQUEST['mode'] =="GetBpId" ){
        $query="SELECT cust_id FROM users_customers WHERE sno=(SELECT max(sno) FROM users_customers WHERE cust_type=2);";
        $r = mysqli_query($con, $query);
        $c = mysqli_num_rows($r);
        if (!mysqli_num_rows($r) > 0) {
            $bp_id="BP-1000";
             
        } else {
            while ($row = mysqli_fetch_array($r)) {
                $id = $row['cust_id'];   
            }
        }
                $i=explode("-",$id);
                $num=(int)$i[1];
                $num++;
               // $var="BP-";
                $bp_id=$i[0]."-".$num."";
                echo $bp_id;
    }

    elseif ($_REQUEST['mode'] == "EditBp") {
        $bp_sno=$_GET['bp_sno'];
        $bp_id = $_GET['bp_id'];
        $bp_name = $_GET['bp_name'];
        $bp_address = $_GET['bp_address'];
        $bp_email = $_GET['bp_email'];
        $bp_mobile = $_GET['bp_mobile'];
        $bp_aadhar_no = $_GET['bp_aadhar_no'];
        $bp_bank_acc_no = $_GET['bp_bank_acc_no'];
        $bp_bank_name = $_GET['bp_bank_name'];
        $bp_bank_ifsc_code = $_GET['bp_bank_ifsc_code'];

        $Q3 = "UPDATE `users_customers` SET sno = $bp_sno,cust_id = '$bp_id',`name` = '$bp_name',`address` = '$bp_address', email = '$bp_email', mobile='$bp_mobile',aadhaar_no = '$bp_aadhar_no',bank_acc_no = '$bp_bank_acc_no',bank_name = '$bp_bank_name',ifs_code = '$bp_bank_ifsc_code', updated_date = CURRENT_TIMESTAMP() WHERE sno= $bp_sno";
        
        
        $r3 = mysqli_query($con, $Q3);

        if (!mysqli_query($con, $Q3)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }

    elseif ($_REQUEST['mode'] == "CheckReferrerID") {
        
        $bp_referrer_id = $_GET['bp_referrer_id'];

        $q = "SELECT count(*) as cntcustid FROM users_customers WHERE cust_id='$bp_referrer_id'";
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

    elseif ($_REQUEST['mode'] == "BpChangePassword") {

        $bp_id = $_GET['bp_id'];
        $bp_pass_new=$_GET['bp_pass_new'];
         /* md5 Conversion */ 
        $md5_password=md5($bp_pass_new);

        $Q3 = "UPDATE `users_customers` SET password = '$md5_password', updated_date = CURRENT_TIMESTAMP() WHERE cust_id= '$bp_id'";
        
        $r3 = mysqli_query($con, $Q3);

        if ($r3) {
            echo "success";
        } else {
            echo("Error description: " . mysqli_error($con));
        }
    }

    elseif ($_REQUEST['mode'] == "CheckPassBp") {
    
        $bp_pass = $_GET['bp_pass'];
         /* md5 Conversion */ 
        $md5_password=md5($bp_pass);

        $q = "SELECT count(*) as cntbppass FROM users_customers WHERE password ='$md5_password'";
        $result = mysqli_query($con, $q);
        if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_array($result);  //Fetching the result

            $count = $row['cntbppass'];
            if ($count > 0) {
                echo "1";
            }else {
                echo "0";
            }
        }
    }
}

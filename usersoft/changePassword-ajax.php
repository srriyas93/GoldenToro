<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');


if (isset($_GET['mode'])) {
    if ($_REQUEST['mode'] == "CustChangePassword") {
        
        $username=$_GET['username'];
        $cust_pass_new=$_GET['cust_pass_new'];
        /* md5 Conversion */
        $md5_password=md5($cust_pass_new);

        $Q3 = "UPDATE `users_customers` SET password = '$md5_password', updated_date = CURRENT_TIMESTAMP() WHERE email= '$username'";

        $r3 = mysqli_query($con, $Q3);

        if ($r3) {
            echo "success";
        } else {
            echo("Error description: " . mysqli_error($con));
        }
    }

    elseif ($_REQUEST['mode'] == "OldPasswordCheck") {

        $username=$_GET['username'];
        $cust_change_pass_old=$_GET['cust_change_pass_old'];
        /* md5 Conversion */
        $cust_md5_password_old=md5($cust_change_pass_old);

        $Q3 = "SELECT password FROM users_customers WHERE cust_type=1 AND email='$username'";
        $r3 = mysqli_query($con, $Q3);
        while($row = mysqli_fetch_array($r3))
            {
                $password = $row['password'];

            if ($password == $cust_md5_password_old) {
                echo "success";
            } else {
                echo "Failure";
            }
        }
    }
}
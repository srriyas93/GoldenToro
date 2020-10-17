<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if (isset($_GET['mode'])) {
    if ($_REQUEST['mode'] == "Login") {
        $username = $_GET['username'];
        $password= $_GET['password'];

        $md5_password=md5($password);
          
        $q = "SELECT count(*) as cntUser,status FROM `users_admin` WHERE `email` = '$username' AND password='$md5_password'";
        $result = mysqli_query($con, $q);
       
        if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_array($result);  //Fetching the result

            $count = $row['cntUser'];
            $status = $row['status'];

            if ($count > 0) {
                if($status==1){
                session_start();
                $_SESSION['email'] = $username;
                $_SESSION['last_login_timestamp']=time();
                echo "1";
                }else{
                    echo "2";
                }
            } else {
                echo "0";
            }
        }
    }
    
    elseif ($_REQUEST['mode'] == "resetPasswordContactCheck") {

        
        $reset_pass_mobile=$_GET['reset_pass_mobile'];
        
        $Q3 = "SELECT count(mobile) AS countMobile FROM users_admin WHERE user_type=1 OR user_type=2 AND mobile='$reset_pass_mobile'";
        $r3 = mysqli_query($con, $Q3);
        if (mysqli_num_rows($r3)>0) {
            $row = mysqli_fetch_array($r3);

            $count = $row['countMobile'];
            if ($count > 0) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    elseif ($_REQUEST['mode'] == "resetPasswordEmailCheck") {

        
        $reset_pass_email=$_GET['reset_pass_email'];
        
        $Q3 = "SELECT count(email) AS countEmail FROM users_admin WHERE user_type=1 OR user_type=2 AND email='$reset_pass_email'";
        $r3 = mysqli_query($con, $Q3);
        if (mysqli_num_rows($r3)>0) {
            $row = mysqli_fetch_array($r3);

            $count = $row['countEmail'];
            if ($count > 0) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    elseif ($_REQUEST['mode'] == "resetPassword") {

        $reset_pass_mobile=$_GET['reset_pass_mobile'];
        $reset_pass_email=$_GET['reset_pass_email'];
        
        $Q3 = "SELECT count(email) AS countEmail,count(mobile) AS countMobile FROM users_admin WHERE user_type=1 OR user_type=2 AND mobile='$reset_pass_mobile' AND email='$reset_pass_email'";
        $r3 = mysqli_query($con, $Q3);
        if (mysqli_num_rows($r3)>0) {
            $row = mysqli_fetch_array($r3);

            $countemail = $row['countEmail'];
            $countMobile = $row['countMobile'];
            if ($countemail > 0 && $countMobile > 0) {
                    $n=10; 
                    function getPassword($n) { 
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                        $randomString = ''; 
  
                        for ($i = 0; $i < $n; $i++) { 
                            $index = rand(0, strlen($characters) - 1); 
                            $randomString .= $characters[$index]; 
                        } 
                        return $randomString; 
                    } 
                    $password=getPassword($n); 
                    //echo $password;
                    /* Senting Reset Password Email to the Customer */

                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $from = "test@hostinger-tutorials.com";
                    $to = "'$reset_pass_email'";
                    $subject = "Reset Password From ELTORO";
                    $message = "Your Reset Password is: '$password'";
                    $headers = "From:" . $from;
                    mail($to,$subject,$message, $headers);
                    echo $password;

                    
                    if (mail($to, $subject, $body, $headers)) {
                        /* Updating Database Password */
                        $md5_password=md5($password);

                        $Q3 = "UPDATE `users_admin` SET password = '$md5_password', updated_date = CURRENT_TIMESTAMP() WHERE user_type=1 OR user_type=2 AND mobile='$reset_pass_mobile' AND email='$reset_pass_email'";

                        $r3 = mysqli_query($con, $Q3);

                        if ($r3) {
                            echo "success";
                        } else {
                            echo("Error description: " . mysqli_error($con));
                       }
                    }
            } else {
                echo "0";
            }
        }
    }
}

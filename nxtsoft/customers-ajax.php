<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if (isset($_GET['mode'])) {
    if ($_REQUEST['mode'] == "addCustomers") {
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
        $admin_approval = $_GET['admin_approval'];

        $q = "INSERT INTO users_customers(cust_id,cust_type,name,address,email,password,mobile,aadhaar_no,bank_acc_no,bank_name,ifs_code,admin_approval,referrer_id,referrer_type) VALUES ('$cust_id',$cust_type,'$cust_name','$cust_address','$cust_email','$md5_password','$cust_mobile','$cust_aadhaar_no','$cust_bank_acc_no','$cust_bank_name','$cust_bank_ifs_code',$admin_approval,'$cust_referrer_id',$cust_referrer_type)";
      

        if (!mysqli_query($con, $q)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        }
    }
    elseif ($_REQUEST['mode'] == "editCustomers") {
        $cust_sno=$_GET['cust_sno'];
        $cust_id = $_GET['cust_id'];
        $cust_name = $_GET['cust_name'];
        $cust_address = $_GET['cust_address'];
        $cust_email = $_GET['cust_email'];
        $cust_mobile = $_GET['cust_mobile'];
        $cust_aadhar_no = $_GET['cust_aadhar_no'];
        $cust_bank_acc_no = $_GET['cust_bank_acc_no'];
        $cust_bank_name = $_GET['cust_bank_name'];
        $cust_bank_ifs_code = $_GET['cust_bank_ifs_code'];

        $Q3 = "UPDATE `users_customers` SET sno = $cust_sno,cust_id = '$cust_id',`name` = '$cust_name',`address` = '$cust_address', email = '$cust_email', mobile='$cust_mobile',aadhaar_no = '$cust_aadhar_no',bank_acc_no = '$cust_bank_acc_no',bank_name = '$cust_bank_name',ifs_code = '$cust_bank_ifs_code', updated_date = CURRENT_TIMESTAMP() WHERE sno= $cust_sno";
        
        
        $r3 = mysqli_query($con, $Q3);

        if ($r3) {
            echo "success";
        } else {
            echo("Error description: " . mysqli_error($con));
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


    elseif ($_REQUEST['mode'] == "CustomerAssignPlan") {

        $cust_id= $_GET['cust_id'];
        $cust_plans= $_GET['cust_plans'];
        $cust_no_plans= $_GET['cust_no_plans'];
        $cust_joining = $_GET['cust_joining'];
        $note = $_GET['note'];
        
        $cust_date= date("Y-m-d", strtotime($cust_joining)); 

        $i=0;
        while($i<$cust_no_plans) {
             $q = "INSERT INTO customer_plans(cust_id,plan_id,started_date,trans_note) VALUES ('$cust_id',$cust_plans,'$cust_date','$note')";
             $r=mysqli_query($con, $q);
            $i++;
         }
    
        if (!$r) {
            echo("Error description: " . mysqli_error($con));
        } else {
            echo "success";
        } 
    }
    
    elseif ($_REQUEST['mode'] == "ViewCustomerPlan") {

        $cust_id= $_GET['cust_id'];
        $cust_name= $_GET['cust_name'];

        $u="SELECT title,customer_plans.started_date AS join_date,plans.status AS status FROM customer_plans,plans WHERE cust_id='$cust_id' AND customer_plans.plan_id=plans.id ORDER BY status DESC";
        
        $v = mysqli_query($con, $u);
        
            if (mysqli_num_rows($v) > 0) {
                    echo'
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <strong>Customer Name</strong>
                                <div class="form-group">
                                    <input id="cp_view_name" name="cp_view_name" type="text" class="form-control" value='.$cust_id.' disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong>Customer ID</strong>
                                <div class="form-group">
                                    <input id="cp_view_id" name="cp_view_id" type="text" class="form-control" value='.$cust_name.' disabled>
                                </div>
                            </div>';
                    
                                       
                    echo'   <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="project_list">
                                        <div class="table-responsive">
                  
                                            <table class="table table-hover c_table theme-color">

                                                <thead>
                                                    <tr style="text-align:center;">
                                                        <th>S.no</th>
                                                        <th>Plan Name</th>
                                                        <th>Entry Date</th>
                                                        <th>Plan Status</th>
                                                    </tr>
                                                </thead>';
                                                $i=1;
                                                while($i<=mysqli_num_rows($v)){
                                                    while ($row = mysqli_fetch_array($v)) {
                                                        $title=$row['title'];
                                                        $join_date=$row['join_date'];
                                                        $cp_status=$row['status'];
                                                        if ($cp_status==1) {
                                                            $status = 'Active';
                                                        } else {
                                                            $status = 'Inactive';
                                                        }
                               
                                                        $cp_join_date = strtotime($row['join_date']);
                                                        $cp_join_date = date("d-m-Y", $cp_join_date);
                                                       
                    echo'                       <tbody>
                                                    <tr style="text-align:center;">
                                                        <th>'.$i.'</th>
                                                        <th>'.$title.'</th>
                                                        <th>'. $cp_join_date.'</th>
                                                        <th>'. $status.'</th>
                                                    </tr>
                                                </tbody>';$i++;
                                                    }
                                                    }  
                    echo'                   </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        echo'   
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>';  
                    }else{
                    echo'   <div class="row clearfix">
                                <div class="col-sm-6">
                                    <strong>Customer Name</strong>
                                    <div class="form-group">
                                        <input id="cp_view_name" name="cp_view_name" type="text" class="form-control" value='.$cust_id.' disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <strong>Customer ID</strong>
                                    <div class="form-group">
                                        <input id="cp_view_id" name="cp_view_id" type="text" class="form-control" value='.$cust_name.' disabled>
                                    </div>
                                </div>
                                <div class="container center">
                                    <td><strong>Dont have Active Plans</strong></td>
                                </div>
                            </div>';
                   
                    echo'   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>';  
    
                } 
        }
    elseif ($_REQUEST['mode'] == "CustChangePassword") {

            $cust_id = $_GET['cust_id'];
            $cust_pass_new=$_GET['cust_pass_new'];
             /* md5 Conversion */ 
            $md5_password=md5($cust_pass_new);
    
            $Q3 = "UPDATE `users_customers` SET password = '$md5_password', updated_date = CURRENT_TIMESTAMP() WHERE cust_id= '$cust_id'";
            
            $r3 = mysqli_query($con, $Q3);
    
            if ($r3) {
                echo "success";
            } else {
                echo("Error description: " . mysqli_error($con));
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
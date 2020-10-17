<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- Include Other Files -->
<?php 
    include('profile-ajax.php');
?>
<!-- Include Left Side Bar --> 
<?php
    include('page_left-sidebar.php');
?>
<!-- Include Right Side Bar --> 
<?php
    include('page_right-sidebar.php');
?>

<!-- Main Content -->
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2><?php echo $_SESSION['name']?> Profile</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item active"> Profile</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
               <!--         <button class="btn btn-success btn-icon float-right" type="button" data-toggle="modal" data-target="#popaddnewplan"><i class="zmdi zmdi-plus"></i></button>-->
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <form name="DisplayProfileForm" id="DisplayProfileForm" method="POST">
                        <div id="DisplayProfile" class="modal-body">
                        <?php
                        $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                        
                        /* Taking Session ID */
                        $username = $_SESSION['email'];
                        $q = "SELECT cust_id,name,email,mobile,address,aadhaar_no,bank_acc_no,ifs_code,bank_name,status,referrer_id,created_date,updated_date FROM users_customers WHERE cust_type=1 AND email='$username'";
                        $r3 = mysqli_query($con, $q);
                        $num1=mysqli_num_rows($r3);
                        
                        if (mysqli_num_rows($r3) > 0){
                            while ($row = mysqli_fetch_array($r3)) 
                            {
                                $cust_id=$row['cust_id'];
                                $cust_name=$row['name'];
                                $cust_email=$row['email'];
                                $cust_mobile=$row['mobile'];
                                $cust_address=$row['address'];
                                $cust_aadhar=$row['aadhaar_no'];
                                $cust_bank_acc_no=$row['bank_acc_no'];
                                $cust_bank_name=$row['bank_name'];
                                $cust_bank_ifsc_code=$row['ifs_code'];
                                $cust_status=$row['status'];
                                $cust_referrer_id=$row['referrer_id'];
                                
                                $cust_created_date = strtotime($row['created_date']);
                                $cust_created_date = date("d-m-Y", $cust_created_date);

                                $cust_updated_date = strtotime($row['updated_date']);
                                $cust_updated_date = date("d-m-Y", $cust_updated_date);
                                
                                if($cust_status==1){
                                    $status='Active';
                                }else{
                                    $status='Inactive';
                                }
                                  
            echo'       <div class="row clearfix">
                            <div class="col-sm-12">
                                <strong>Customer ID</strong>
                                <div class="form-group">
                                    <input id="cust_profile_id" name="cust_profile_id" type="text" value='.$cust_id.' class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Customer Name </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_name" name="cust_profile_name" type="text" value='.$cust_name.' class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Email </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_username" name="cust_profile_username" type="text" value='.$username.' class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Mobile </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_mobile" name="cust_profile_mobile" type="text" value='.$cust_mobile.' class="form-control" >
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Address </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_address" name="cust_profile_address" type="text" value='.$cust_address.' class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Aadhar Number </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_aadhar" name="cust_profile_aadhar" type="text"  value='.$cust_aadhar.' class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Bank Account Number </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_bank_acc_num" name="cust_profile_bank_acc_num" type="text" value='.$cust_bank_acc_no.' class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Bank Name </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_bank_name" name="cust_profile_bank_name" type="text" value='.$cust_bank_name.' class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Bank IFSC </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_bank_ifsc_code" name="cust_profile_bank_ifsc_code" type="text" value='.$cust_bank_ifsc_code.' class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Current Status </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_status" name="cust_profile_status" type="text" value='.$status.' class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Reffered By </strong> 
                                <div class="form-group">
                                    <input id="cust_profile_referrer_id" name="cust_profile_referrer_id" type="text"  class="form-control"value='.$cust_referrer_id.'  disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Joining Date</strong> 
                                <div class="form-group">
                                    <input id="cust_profile_created_date" name="cust_profile_created_date" type="text" value='.$cust_created_date.' class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Last Updated On</strong> 
                                <div class="form-group">
                                    <input id="cust_profile_updated_date" name="cust_profile_updated_date" type="text" value='.$cust_updated_date.' class="form-control" disabled>
                                </div>
                            </div>
                        </div>';
                    }
                } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger waves-effect" onClick="editProfile(event);">UPDATE CHANGES</button>
                            <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                    </div>
                </div>
           </div>
        </div>
    </section>';

<!-- Include Footer --> 
<?php
    include('page_footer.php');
?>
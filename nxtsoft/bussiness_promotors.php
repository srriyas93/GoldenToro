<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- Include Other Files -->
<?php 
    include('bussiness_promotors-ajax.php');
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
                        <h2>Bussiness Promotors</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Bussiness Promotors</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                        <button class="btn btn-success btn-icon float-right" type="button" data-toggle="modal" data-target="#popAddNewBussinessPromoters"><i class="zmdi zmdi-plus"></i></button>
                    </div>
                </div>
            </div>
            <div id="DisplayPlan" class="container-fluid">
                <div class="row clearfix">
                    <div id="DisplayPlan" class="col-md-12 col-sm-12 col-xs-12">
               
                        <!-- Displaying the  contents -->
                        <?php
                            $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                            $q = "SELECT * FROM users_customers WHERE cust_type=2 GROUP BY created_date DESC";

                            $r = mysqli_query($con, $q);

                            $num = mysqli_num_rows($r);
                            if(!mysqli_num_rows($r) > 0)
                            { ?>
                            
                                <div class="container center">
                                <h5 class="card conta">No Target File added </h5>
                                </div>
                            <?php }
                            
                            else
                            {
			                 echo'
                                <div class="card project_list">
                                    <div class="table-responsive">
                                    <h6><strong><i class="zmdi zmdi-chart"></i> Total Record(s):</strong> '.$num.'</h6>
                                        <table class="table table-hover c_table theme-color">
                                            <thead>
                                                <tr>
                                                    <th>BP ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Referrred By</th>
                                                    <th>Joining Date</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>';
                                    while($row = mysqli_fetch_array($r))
                                    {
                                        $bp_sno=$row['sno'];
                                        $bp_id=$row['cust_id'];
                                        $bp_type=$row['cust_type'];
                                        $bp_name=$row['name'];
                                        $bp_address=$row['address'];
                                        $bp_email=$row['email'];
                                        $bp_mobile=$row['mobile'];
                                        $bp_aadhar_no=$row['aadhaar_no'];
                                        $bp_bank_acc_no=$row['bank_acc_no'];
                                        $bp_bank_name=$row['bank_name'];
                                        $bp_bank_ifsc_code=$row['ifs_code'];
                                        $bp_bank_referrer_id=$row['referrer_id'];
                                        
                                        $bp_created_date = strtotime($row['created_date']);
                                        $bp_created_date = date("d-m-Y", $bp_created_date);

                                        $bp_updated_date = strtotime($row['updated_date']);
                                        $bp_updated_date = date("d-m-Y", $bp_updated_date);
                                        
                                        $bp_status=$row['status'];

                                        $bpname=explode(" ",$bp_name);

                                        if($bp_status == 1)
                                        {
                                            $status = 'Active';
                                        }
                                        else
                                        {
                                            $status = 'Inactive';
                                        }

                                        echo' <tbody>
                                            <tr>
                                                <td><strong>'.$bp_id.'</strong></td>
                                                <td><strong>'.$bp_name.'</strong></td>
                                                <td><strong>'.$bp_email.'</strong></td>
                                                <td><strong>'.$bp_mobile.'</strong></td>
                                                <td><strong>'.$bp_bank_referrer_id.'</strong></td>
                                                <td><strong>'.$bp_created_date.'</strong></td>
                                                <td><strong>'.$status.'</strong></td>';
                                      
                                        echo' <td class="aligncenter">
                                                <div class="btn-group dropleft">
                                                    <a id="btndropdown'.$bp_sno.'" class="mousehand" data-toggle="dropdown" href="javascript:void()" data-activates="dropdown'.$bp_sno.'" aria-expanded="false"><i class="zmdi zmdi-hc-fw"></i></a>
                                                    <div id="dropdown'.$bp_sno.'"class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openBpViewpop('."'". $bp_id."'".','."'". $bp_name."'".','."'". $bp_address."'".','."'". $bp_email."'".','."'". $bp_mobile."'".','."'". $bp_aadhar_no."'".','."'". $bp_bank_acc_no."'".','."'". $bp_bank_name."'".','."'". $bp_bank_ifsc_code."'".','."'". $bp_bank_referrer_id."'".','."'". $bp_created_date."'".','."'". $status."'".','."'". $bp_updated_date."'".');" title="View">
                                                            <i class="zmdi zmdi-hc-fw margin-right10"></i>View
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openBussinessPromotorsEditpop('.$bp_sno.','."'".$bp_id."'".','."'".$bp_name."'".','."'".$bp_address."'".','."'".$bp_email."'".','."'".$bp_mobile."'".','."'".$bp_aadhar_no."'".','."'".$bp_bank_acc_no."'".','."'".$bp_bank_name."'".','."'".$bp_bank_ifsc_code."'".');" title="Edit">
                                                            <i class="zmdi zmdi-hc-fw margin-right10"></i>Edit
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openBpChangePasswordpop('."'".$bp_id."'".','."'".$bp_name."'".');" title="Change Password">
                                                            <i class="zmdi zmdi-hc-fw margin-right10"></i>Change Password
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick=javascript:showConfirmMessage1("bussiness_promotors",'."'".$bpnam."'".','.$bp_sno.','.$bp_status.'); >
                                                            <i class="zmdi zmdi-hc-fw margin-right10"></i>Status
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>';
                                       echo' </tr>
                                    </tbody>';
                                    }
                               echo' </table>
                            </div>
                        </div>';
                    }
                ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
<!-- Add New Popup -->
    <div id="popAddNewBussinessPromoters"  class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="addPlanPopTitle">Add New Bussiness Promotor</h4>
                </div>
                <form name="FrmeaddBussinessPromotersPop" id="FrmeaddBussinessPromotersPop" method="POST">
                <div class="modal-body"> 
                    <div class="row clearfix">
                            <div class="form-group">
                                <input id="bp_id" name="bp_id" type="hidden" class="form-control">
                            </div>
                        <div class="col-sm-12">
                        <strong>Full Name*</strong>(Capital)
                            <div class="form-group">
                                <input id="bp_name" name="bp_name" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Address*</strong> 
                            <div class="form-group">
                            <textarea  id="bp_address" name ="bp_address" type="text" class="form-control" required></textarea>
                              <!--  <input id="plan_amount" name="plan_amount" type="text" class="form-control" required/>-->
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Email*</strong> 
                            <div class="form-group">
                                <input id="bp_email" name="bp_email" type="email" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Password*</strong> 
                            <div class="form-group">
                                <input id="bp_password" name="bp_password" type="password" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Contact Number*</strong> 
                            <div class="form-group">
                                <input id="bp_mobile" name="bp_mobile" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Aadhar Number*</strong> 
                            <div class="form-group">
                                <input id="bp_aadhaar_no" name="bp_aadhaar_no" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Bank Account Number*</strong> 
                            <div class="form-group">
                                <input id="bp_bank_acc_no" name="bp_bank_acc_no" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Bank Name*</strong> 
                            <div class="form-group">
                                <input id="bp_bank_name" name="bp_bank_name" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Bank IFSC*</strong> 
                            <div class="form-group">
                                <input id="bp_bank_ifs_code" name="bp_bank_ifs_code" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Referrer ID </strong> 
                            <div class="form-group">
                                <input id="bp_referrer_id" name="bp_referrer_id" type="text" class="form-control" onBlur="ReferrerCheck1(event)"required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div id="bpid">
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Referrer Type </strong> 
                            <div class="form-group">
                            <select id="bp_referrer_type" name="bp_referrer_type" class="form-control" required>
					            <option value="-1" selected>--- SELECT USER TYPE ---</option>
					            <option value="1">Customer</option>
                                <option value="2">Bussiness Promoter</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                        <div style='font-size: 15px;font-weight: bold;color:red' id="bpregmessage"></div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect" onClick="javascript:formIsValid('bp','FrmeaddBussinessPromotersPop',event);">SAVE CHANGES</button>
                    <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
            </div>
        </div>
    </div>
 
<!-- Edit Popup -->
    <div id="editBussinessPromotorsPop" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="addPlanPopTitle">Edit Bussiness Promoter</h4>
                </div>
                <form name="FrmeEditBussinessPromotorsPop" id="FrmeEditBussinessPromotorsPop" method="POST">
                <div class="modal-body"> 
                    <div class="row clearfix">
                            <div class="form-group">
                                <input id="bp_edit_sno" name="bp_edit_sno" type="hidden" class="form-control">
                            </div>
                            <div class="form-group">
                                <input id="bp_edit_id" name="bp_edit_id" type="hidden" class="form-control">
                            </div>
                        <div class="col-sm-12">
                        <strong>Full Name*</strong>(Capital)
                            <div class="form-group">
                                <input id="bp_edit_name" name="bp_edit_name" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Address*</strong> 
                            <div class="form-group">
                            <textarea  id="bp_edit_address" name ="bp_edit_address" type="text" class="form-control"></textarea>
                              <!--  <input id="plan_amount" name="plan_amount" type="text" class="form-control" required/>-->
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Email*</strong> 
                            <div class="form-group">
                                <input id="bp_edit_email" name="bp_edit_email" type="email" class="form-control" disabled>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                        <strong>Contact Number*</strong> 
                            <div class="form-group">
                                <input id="bp_edit_mobile" name="bp_edit_mobile" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Aadhar Number*</strong> 
                            <div class="form-group">
                                <input id="bp_edit_aadhar_no" name="bp_edit_aadhar_no" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Account Number*</strong> 
                            <div class="form-group">
                                <input id="bp_bank_edit_acc_no" name="bp_bank_edit_acc_no" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Bank Name*</strong> 
                            <div class="form-group">
                                <input id="bp_bank_edit_name" name="bp_bank_edit_name" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>IFSC Code*</strong> 
                            <div class="form-group">
                                <input id="bp_bank_edit_ifsc_code" name="bp_bank_edit_ifsc_code" type="text" class="form-control" required/>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect" onClick="javascript:formIsValid('bp_edit','FrmeEditBussinessPromotorsPop',event);">UPDATE CHANGES</button>
                    <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
            </div>
        </div>
    </div>

<!-- View Popup -->
    <div id="ViewBussinessPromotorsPop" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="addPlanPopTitle">Bussiness Promoter Details</h4>
                </div>
                <form name="FrmeEditBussinessPromotorsPop" id="FrmeEditCustomersPop" method="POST">
                <div class="modal-body"> 
                    <div class="row clearfix">
                    <div class="col-sm-12">
                        <strong>Bussiness Promotor ID</strong>
                        <div class="form-group">
                            <input id="bp_view_id" name="bp_view_id" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <strong>Bussiness Promotor Name*</strong>
                        <div class="form-group">
                            <input id="bp_view_name" name="bp_view_name" type="text" class="form-control" disabled>
                        </div>
                    </div>
                        <div class="col-sm-12">
                        <strong>Address </strong> 
                            <div class="form-group">
                            <input id="bp_view_address" name="bp_view_address" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Email </strong> 
                            <div class="form-group">
                                <input id="bp_view_email" name="bp_view_email" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                        <strong>Contact Number </strong> 
                            <div class="form-group">
                                <input id="bp_view_mobile" name="bp_view_mobile" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Aadhar Number </strong> 
                            <div class="form-group">
                                <input id="bp_view_aadhar_no" name="bp_view_aadhar_no" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Account Number </strong> 
                            <div class="form-group">
                                <input id="bp_bank_view_acc_no" name="bp_bank_view_acc_no" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Bank Name </strong> 
                            <div class="form-group">
                                <input id="bp_bank_view_name" name="bp_bank_view_name" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>IFSC Code </strong> 
                            <div class="form-group">
                                <input id="bp_bank_view_ifsc_code" name="bp_bank_view_ifsc_code" type="text" class="form-control" disabled>
                            </div>
                        </div> 
                        <div class="col-sm-12">
                        <strong>Referred By </strong> 
                            <div class="form-group">
                                <input id="bp_bank_view_referrer_id" name="bp_bank_view_referrer_id" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Current Status </strong> 
                            <div class="form-group">
                                <input id="bp_view_status" name="bp_view_status" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Joining Date </strong> 
                            <div class="form-group">
                                <input id="bp_view_created_date" name="bp_view_created_date" type="text" class="form-control" disabled>
                            </div>
                        </div>  
                        <div class="col-sm-12">
                        <strong>Last Updated</strong> 
                            <div class="form-group">
                                <input id="bp_view_updated_date" name="bp_view_updated_date" type="text" class="form-control" disabled>
                            </div>
                        </div>  
                    </div>
                </div>

               <div class="modal-footer">
            <!--    <button type="submit" class="btn btn-danger waves-effect" onClick="this.disabled=true; this.value='Processing…'; EditBp(event);">UPDATE CHANGES</button>-->
                    <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
            </div>
        </div>
    </div>

<!-- Change Password Popup -->
    <div id="BpChangePasswordPop" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="addPlanPopTitle">Change Password</h4>
                </div>
                <form name="BpChangePassword" id="BpChangePassword" method="POST">
                <div id="displayCustomerPlan" class="modal-body"> 
                   
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <strong>BP Name</strong>
                            <div class="form-group">
                                <input id="bp_pass_name" name="bp_pass_name" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong>BP ID</strong>
                            <div class="form-group">
                                <input id="bp_pass_id" name="bp_pass_id" type="text" class="form-control" disabled>
                            </div>
                        </div> 
                        <div class="col-sm-12">
                            <div id="oldpasswordbp">
                            </div>
                        </div>  
                        <div class="col-sm-12">
                        <strong>New Password*</strong> 
                            <div class="form-group">
                                <input id="bp_pass_new" name="bp_pass_new" type="password" class="form-control">
                            </div>
                        </div>      
                        <div class="col-sm-12">
                        <strong>Confirm Password*</strong> 
                            <div class="form-group">
                                <input id="bp_pass_new_confirm" name="bp_pass_new_confirm" type="password" class="form-control">
                            </div>
                        </div> 
                        <div class="col-sm-12">
                            <div id="passwordmessagebp">
                            </div>
                        </div>
                    </div>      
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect" onClick="javascript:formIsValid('bp_chg_pass','CustomerChangePassword',event);">PROCEED</button>
                    <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>


<!-- Include Footer --> 
<?php
    include('page_footer.php');
?>
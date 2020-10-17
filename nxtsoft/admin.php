<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- Include Other Files --> 
<?php 
    include_once('admin-ajax.php');
?>
<!-- Include Left Side Bar -->
<?php
    include('page_left-sidebar.php');
?>
<!-- Include Right Side Bar --> 
<?php
    include('page_right-sidebar.php');
?>

   
<!--Main Content -->
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Admins</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Admin</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                        <button class="btn btn-success btn-icon float-right" type="button" data-toggle="modal" data-target="#popaddnewadmin"><i class="zmdi zmdi-plus"></i></button>
                    </div>
                </div>
            </div>
            <div id="DisplayPlan" class="container-fluid">
                <div class="row clearfix">
                    <div id="DisplayPlan" class="col-md-12 col-sm-12 col-xs-12">
                        
                        <!--Displaying the  contents-->
                        <?php
		                $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
		                $q = "SELECT * FROM users_admin WHERE user_type=1 OR user_type=2";
      
                        $r = mysqli_query($con, $q);
        
                        $num = mysqli_num_rows($r);
		                if(!mysqli_num_rows($r) > 0)
		                    {
                        ?>
			            <div class="container center">
			                <h5 class="card conta">No Target File added </h5>
			            </div>
		                <?php
		                    }
                        else{
			            echo'
                            <div class="card project_list">
                                <div class="table-responsive">
                                <h6><strong><i class="zmdi zmdi-chart"></i> Total Record(s):</strong> '.$num.'</h6>
                                    <table class="table table-hover c_table theme-color">
                                    <thead>
                                        <tr>
                                            
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>';
                                while($row = mysqli_fetch_array($r))
                                    {
                                    $admin_id=$row['user_id'];
                                    $admin_user_type = $row['user_type'];
                                    if( $admin_user_type==1)
                                        {
                                        $admin_type='Admin';
                                        }
                                    elseif($admin_user_type==2)
                                        {
                                        $admin_type='Manager';
                                        }
                                    else
                                        {
                                        $admin_type= 'SuperAdmin';
                                        }
                                    $admin_name = $row['name'];
                                    $admin_email = $row['email'];
                                    $admin_mobile = $row['mobile'];
                                   
                                    $admin_created_date = strtotime($row['created_date']);
                                    $admin_created_date = date("d-m-Y", $admin_created_date);
                                    $admin_status= $row['status'];

                                    $adminname=explode(" ",$admin_name);

                                    if($admin_status == 1){
                                        $status= 'Active';
                                        }
                                    else
                                        {
                                        $status= 'Inactive';
                                        }

                        echo' 
                                    <tbody>
                                    <tr>
                                        <td><strong>'.$admin_type.'</strong></td>
                                        <td><strong>'.$admin_name.'</strong></td>
                                        <td><strong>'.$admin_email.'</strong></td>
                                        <td><strong>'.$admin_mobile.'</strong></td>
                                        <td><strong>'.$admin_created_date.'</strong></td>
                                        <td><strong>'.$status.'</strong></td>';
                                      
                        echo' 
                                        <td class="aligncenter">
                                            <div class="btn-group dropleft">
                                                <a id="btndropdown'.$admin_id.'" class="mousehand" data-toggle="dropdown" href="javascript:void()" data-activates="dropdown'.$admin_id.'" aria-expanded="false"><i class="zmdi zmdi-hc-fw"></i></a>
                                                <div id="dropdown'.$admin_id.'"class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openAdminViewpop('."'".$admin_type."'".','."'".$admin_name."'".','."'".$admin_email."'".','."'".$admin_mobile."'".','."'".$admin_created_date."'".','."'".$status."'".');" title="View">
                                                            <i class="zmdi zmdi-hc-fw margin-right10"></i>View
                                                        </a>
                                                <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openAdminEditpop('.$admin_id.','."'".$admin_type."'".','."'".$admin_name."'".','."'".$admin_email."'".','."'".$admin_mobile."'".' );" title="Edit">
                                                    <i class="zmdi zmdi-hc-fw margin-right10"></i>Edit
                                                    </a>
                                                <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openAdminChangePasswordpop('.$admin_id.','."'".$admin_name."'".');" title="Change Password">
                                                    <i class="zmdi zmdi-hc-fw margin-right10"></i>Change Password
                                                    </a>';
                                            if($admin_user_type==2) {   
                                        echo'   <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href=javascript:void(0);" onClick=javascript:showConfirmMessage1("admin",'."'".$adminname[0]."'".','.$admin_id.','.$admin_status.'); title="Status">
                                                    <i class="zmdi zmdi-hc-fw margin-right10"></i>Status
                                                    </a>
                                                </div>';
                                              } 
                                    echo'   </div>
                                        </td>';
                        echo' 
                                        </tr>
                                    </tbody>';
                                    }
                        echo'            
                                    </table>
                                </div>
                            </div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Add New Admin/Manager -->
    <div class="modal fade" id="popaddnewadmin" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="addAdminPopTitle">Add New Admin/Manager</h4>
                </div>
                <form id="FrmeaddAdminPop"name="FrmeaddAdminPop" action="admin.php" method="POST">
                <div class="modal-body"> 
                    <div class="row clearfix">
                        <div class="col-sm-12">
                        <strong>Name*</strong>
                            <div class="form-group">
                            <input id="admin_name" name="admin_name" type="text" class="form-control" required/>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                        <strong>User Type*</strong>
                            <div class="form-group">
                            <select id="admin_type" name="admin_type" class="form-control" required>
					            <option value="-1" selected>--- SELECT USER TYPE ---</option>
					            <option value="1"> Admin</option>
                                <option value="2">Manager</option>
                               <!-- <option value="3">SuperAdmin</option>-->
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Email* </strong> 
                            <div class="form-group">
                                <input id="admin_email" name="admin_email" type="email" class="form-control" onblur="CheckEmail(admin_email)" required/>
                            </div>                           
                        </div>
                        <div class="col-sm-12">
                            <div style='font-size: 15px;font-weight: bold;color:red' id="emailmessageadmin"></div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Password* </strong> 
                            <div class="form-group">
                                <input id="admin_password" name="admin_password" type="password" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Mobile* </strong> 
                            <div class="form-group">
                                <input id="admin_mobile" name="admin_mobile" type="text" class="form-control"  onblur="CheckContact(admin_mobile)" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div style='font-size: 15px;font-weight: bold;color:red' id="mobilemessageadmin"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                        <div style='font-size: 15px;font-weight: bold;color:red' id="adminregmessage"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger waves-effect" onClick="javascript:formIsValid('admin','FrmeaddAdminPop',event);">SAVE CHANGES</button>
                        <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Edit Popup -->
    <div class="modal fade" id="editAdminPop" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Edit Admin/Manager</h4>
                </div>
                <form name="FrmeEditAdminPop" id="FrmeEditAdminPop" method="POST">
                <div id="addAdmin" class="modal-body"> 
                    <div class="row clearfix">                     
                        <div class="form-group">
                            <input id="admin_edit_id" name="admin_edit_id" type="hidden" class="form-control" required/>
                        </div>
                        <div class="col-sm-12">
                        <strong>Name</strong>
                            <div class="form-group">
                                <input id="admin_edit_name" name="admin_edit_name" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <strong>User Type</strong>
                            <div class="form-group">
                            <div class="form-group">
                                <input id="admin_edit_type" name="admin_edit_type" type="text" class="form-control" disabled>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Email</strong> 
                            <div class="form-group">
                                <input id="admin_edit_email" name="admin_edit_email" type="email" class="form-control" disabled>
                            </div>
                        </div>
                         <!--   <div class="col-sm-12">
                                <strong>Password* </strong> (INR)
                                <div class="form-group">
                                    <input id="admin_edit_password" name="admin_password" type="text" class="form-control" required/>
                                </div>
                            </div>-->
                        <div class="col-sm-12">
                        <strong>Mobile</strong> 
                            <div class="form-group">
                                <input id="admin_edit_mobile" name="admin_edit_mobile" type="text" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect" onClick="javascript:formIsValid('admin_edit','FrmeEditAdminPop',event);">UPDATE CHANGES</button>
                    <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- View Popup -->
    <div class="modal fade" id="ViewAdminPop" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Admin/Manager Details</h4>
                </div>
                <form name="FrmeEditAdminPop" id="FrmeEditAdminPop" method="POST">
                <div id="addAdmin" class="modal-body"> 
                    <div class="row clearfix">                     
                        <div class="col-sm-12">
                        <strong>Admin Type</strong>
                            <div class="form-group">
                                <input id="admin_view_type" name="admin_view_type" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <strong>Admin Name</strong>
                            <div class="form-group">
                                <input id="admin_view_name" name="admin_view_name" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Email </strong>
                            <div class="form-group">
                                <input id="admin_view_email" name="admin_view_email" type="email" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Contact Number </strong>
                            <div class="form-group">
                                <input id="admin_view_mobile" name="admin_view_mobile" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Joining Date </strong>
                            <div class="form-group">
                                <input id="admin_view_create_date" name="admin_view_create_date" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Current Status </strong>
                            <div class="form-group">
                                <input id="admin_view_status" name="admin_view_status" type="text" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
              <!--      <button type="submit" class="btn btn-danger waves-effect" onClick="this.disabled=true; this.value='Processing…'; EditAdmin(event);">UPDATE CHANGES</button>-->
                    <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- Change Password Popup -->
    <div id="AdminChangePasswordPop" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="addPlanPopTitle">Change Password</h4>
                </div>
                <form name="AdminChangePassword" id="AdminChangePassword" method="POST">
                <div id="displayCustomerPlan" class="modal-body"> 
                   
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <strong>Name</strong>
                            <div class="form-group">
                                <input id="admin_pass_name" name="admin_pass_name" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong>ID</strong>
                            <div class="form-group">
                                <input id="admin_pass_id" name="admin_pass_id" type="text" class="form-control" disabled>
                            </div>
                        </div> 
                        <div class="col-sm-12">
                            <div id="oldpasswordadmin">
                            </div>
                        </div>  
                        <div class="col-sm-12">
                        <strong>New Password </strong> 
                            <div class="form-group">
                                <input id="admin_pass_new" name="admin_pass_new" type="password" class="form-control" required/>
                            </div>
                        </div>      
                        <div class="col-sm-12">
                        <strong>Confirm Password </strong> 
                            <div class="form-group">
                                <input id="admin_pass_new_confirm" name="admin_pass_new_confirm" type="password" class="form-control" required/>
                            </div>
                        </div> 
                        <div class="col-sm-12">
                            <div id="passwordmessageadmin">
                            </div>
                        </div>
                    </div>      
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect" onClick="javascript:formIsValid('admin_chgpass','AdminChangePassword',event);">PROCEED</button>
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
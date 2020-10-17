<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- Include Other Files -->
<?php 
    include('plans-ajax.php');
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
                        <h2>Plans</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Plans</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                <!--        <button class="btn btn-success btn-icon float-right" type="button" data-toggle="modal" data-target="#popaddnewplan"><i class="zmdi zmdi-plus"></i></button>-->
                    </div>
                </div>
            </div>
            <div id="DisplayPlan" class="container-fluid">
                <div class="row clearfix">
                    <div id="DisplayPlan" class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Displaying the  contents -->
                        <?php
                            $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

                            /* Taking Session ID */
                            $username = $_SESSION['email'];
                            
                            $q = "SELECT p.id AS plan_id, p.title AS plan_title,cp.started_date AS entry_date,cp.plan_exp_dt AS cust_plan_expiry,cp.status AS cust_plan_status,p.amount AS plan_amount,p.daily_roi AS plan_daily_roi,p.plan_life AS plan_life,p.created_date AS plan_created_date FROM plans p,customer_plans cp,users_customers u WHERE p.id=cp.plan_id AND u.cust_id=cp.cust_id AND u.email='$username'";

                            $r = mysqli_query($con, $q);

                            $c = mysqli_num_rows($r);
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
                                        <table class="table table-hover c_table theme-color">
                                            <thead>
                                                <tr>
                                                    <th>Plan Title</th>
                                                    <th>Amount (INR)</th>
                                                    <th>Daily ROI (INR)</th>
                                                    <th>Plan Life (Days)</th>
                                                    <th>Entry Date</th>
                                                    <th>Expiry Date</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>';
                                    while($row = mysqli_fetch_array($r))
                                    {
                                        $plan_id = $row['plan_id'];
                                        $plan_title = $row['plan_title'];
                                        $plan_amount = $row['plan_amount'];
                                        $plan_daily_roi = $row['plan_daily_roi'];
                                        $plan_life =  $row['plan_life'];
                                        
                                        $plan_created_date = strtotime($row['plan_created_date']);
                                        $plan_created_date = date("d-m-Y", $plan_created_date);

                                        $cust_entry_date = strtotime($row['entry_date']);
                                        $cust_entry_date = date("d-m-Y", $cust_entry_date);

                                        $cust_plan_expiry = strtotime($row['cust_plan_expiry']);
                                        $cust_plan_expiry = date("d-m-Y", $cust_plan_expiry);

                                        $cust_plan_status= $row['cust_plan_status'];

                                        if($cust_plan_status == 1)
                                        {
                                            $cust_plan_status1 = 'Active';
                                        }
                                        elseif($cust_plan_status == 2)
                                        {
                                            $cust_plan_status1 = 'Expired,have settlement amount';
                                        }else{
                                            $cust_plan_status1 = 'Expired';
                                        }

                                        echo' <tbody>
                                            <tr>
                                                <td><strong>'.$plan_title.'</strong></td>
                                                <td><strong>'.$plan_amount.'</strong></td>
                                                <td><strong>'.$plan_daily_roi.'</strong></td>
                                                <td><strong>'.$plan_life.'</strong></td>
                                                <td><strong>'.$cust_entry_date.'</strong></td>
                                                <td><strong>'.$cust_plan_expiry.'</strong></td>
                                                <td><strong>'.$cust_plan_status1.'</strong></td>';
                                      
                                        echo' <td class="aligncenter">
                                                <div class="btn-group dropleft">
                                                    <a id="btndropdown'.$plan_id.'" class="mousehand" data-toggle="dropdown" href="javascript:void()" data-activates="dropdown'.$plan_id.'" aria-expanded="false"><i class="zmdi zmdi-hc-fw"></i></a>
                                                    <div id="dropdown'.$plan_id.'"class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openPlanViewpop('."'". $plan_title."'".','."'". $plan_amount."'".','."'". $plan_daily_roi."'".','."'". $plan_life."'".','."'". $cust_entry_date."'".','."'". $cust_plan_expiry."'".','."'". $cust_plan_status1."'".');" title="View">
                                                            <i class="zmdi zmdi-hc-fw margin-right10"></i>View
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

<!-- View Popup -->
<div id="ViewPlanPop" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="editPlanPopTitle">Plan Details</h4>
                </div>
                <form name="FrmeditPlanPop" id="FrmeditPlanPop" method="POST">
                    <div  class="modal-body"> 
                        <div class="row clearfix">
                                <div class="col-sm-12">
                                <strong>Plan Title</strong>
                                <div class="form-group">
                                    <input id="plan_view_title" name="plan_view_title" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Plan Amount </strong> (INR)
                                <div class="form-group">
                                    <input id="plan_view_amount" name="plan_view_amount" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Daily ROI </strong> (INR)
                                <div class="form-group">
                                    <input id="plan_view_daily_roi" name="plan_view_daily_roi" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Plan Life </strong> (Days)
                                <div class="form-group">
                                    <input id="plan_view_life" name="plan_view_life" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Entry Date </strong> 
                                <div class="form-group">
                                    <input id="cust_view_join_date" name="cust_view_join_date" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Expiry Date </strong> 
                                <div class="form-group">
                                    <input id="cust_plan_view_expiry" name="cust_plan_view_expiry" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Current Status</strong> 
                                <div class="form-group">
                                    <input id="cust_plan_view_status" name="cust_plan_view_status" type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                  <!--      <button type="submit" class="btn btn-danger waves-effect" onClick="this.disabled=true; this.value='Processing…';editPlan(event);">UPDATE CHANGES</button>-->
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
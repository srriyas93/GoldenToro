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
                        <button class="btn btn-success btn-icon float-right" type="button" data-toggle="modal" data-target="#popaddnewplan"><i class="zmdi zmdi-plus"></i></button>
                    </div>
                </div>
            </div>
            <div id="DisplayPlan" class="container-fluid">
                <div class="row clearfix">
                    <div id="DisplayPlan" class="col-md-12 col-sm-12 col-xs-12">
                        <!-- Displaying the  contents -->
                        <?php
                            $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                            $q = "SELECT id as plan_id, title as plan_title, amount as plan_amount, daily_roi as plan_daily_roi, plan_life,created_date as plan_created_date,status as plan_status FROM plans GROUP BY created_date DESC";

                            $r = mysqli_query($con, $q);

                            $num = mysqli_num_rows($r);
                            if(!mysqli_num_rows($r) > 0)
                            { ?>
                            
                            <div class="card">
                                <div class="body">
                                    <br>
                                    <p>No Plan(s) Found</p>
                                    <br>
                                </div>
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
                                                    <th>Plan Title</th>
                                                    <th>Amount (INR)</th>
                                                    <th>Daily ROI (INR)</th>
                                                    <th>Plan Life (Days)</th>
                                                    <th>Created Date</th>
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
                                        $plan_status= $row['plan_status'];

                                        $i=explode(" ",$plan_title);
                                        $pname=$i[0]."-".$i[1];

                                        if($plan_status == 1)
                                        {
                                            $status = 'Active';
                                        }
                                        else
                                        {
                                            $status = 'Inactive';
                                        }

                                        echo' <tbody>
                                            <tr>
                                                <td><strong>'.$plan_title.'</strong></td>
                                                <td><strong>'.$plan_amount.'</strong></td>
                                                <td><strong>'.$plan_daily_roi.'</strong></td>
                                                <td><strong>'.$plan_life.'</strong></td>
                                                <td><strong>'.$plan_created_date.'</strong></td>
                                                <td><strong>'.$status.'</strong></td>';
                                      
                                        echo' <td class="aligncenter">
                                                <div class="btn-group dropleft">
                                                    <a id="btndropdown'.$plan_id.'" class="mousehand" data-toggle="dropdown" href="javascript:void()" data-activates="dropdown'.$plan_id.'" aria-expanded="false"><i class="zmdi zmdi-hc-fw"></i></a>
                                                    <div id="dropdown'.$plan_id.'"class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openPlanViewpop('."'". $plan_title."'".','."'". $plan_amount."'".','."'". $plan_daily_roi."'".','."'". $plan_life."'".','."'". $plan_created_date."'".','."'". $status."'".');" title="View">
                                                            <i class="zmdi zmdi-hc-fw margin-right10"></i>View
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick="javascript:openPlanEditpop('.$plan_id.','."'".$plan_title."'".','.$plan_amount.','.$plan_daily_roi.','.$plan_life.' );" title="Edit">
                                                            <i class="zmdi zmdi-hc-fw margin-right10"></i>Edit
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0);" onClick=javascript:showConfirmMessage1("plans",'."'".$pname."'".','.$plan_id.','.$plan_status.');>
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
    <div id="popaddnewplan"  class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="addPlanPopTitle">Add New Plan</h4>
                </div>
                <form name="FrmeAddPlanPop" id="FrmeAddPlanPop" method="POST">
                <div class="modal-body"> 
                    <div class="row clearfix">
                        <div class="col-sm-12">
                        <strong>Plan Title*</strong>
                            <div class="form-group">
                                <input id="plan_title" name="plan_title" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Plan Amount* </strong> (INR)
                            <div class="form-group">
                                <input id="plan_amount" name="plan_amount" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Daily ROI* </strong> (INR)
                            <div class="form-group">
                                <input id="plan_daily_roi" name="plan_daily_roi" type="text" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <strong>Plan Life* </strong> (Days)
                            <div class="form-group">
                                <input id="plan_life" name="plan_life" type="text" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                        <div style='font-size: 15px;font-weight: bold;color:red' id="planregmessage"></div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect" onClick="javascript:formIsValid('plans','FrmeAddPlanPop',event);">SAVE CHANGES</button>
                    <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
            </div>
        </div>
    </div>
 
<!-- Edit Popup -->
    <div id="editPlanPop" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="editPlanPopTitle">Edit Plan</h4>
                </div>
                <form name="FrmeditPlanPop" id="FrmeditPlanPop" method="POST">
                    <div  class="modal-body"> 
                        <div class="row clearfix">
                            <div class="col-sm-12">
                            <div class="form-group">
                                    <input id="plan_edit_id" name="plan_edit_id" type="hidden" class="form-control" required/>
                                </div>
                            </div>
                                <div class="col-sm-12">
                                <strong>Plan Title*</strong>
                                <div class="form-group">
                                    <input id="plan_edit_title" name="plan_edit_title" type="text" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Plan Amount* </strong> (INR)
                                <div class="form-group">
                                    <input id="plan_edit_amount" name="plan_edit_amount" type="text" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Daily ROI* </strong> (INR)
                                <div class="form-group">
                                    <input id="plan_edit_daily_roi" name="plan_edit_daily_roi" type="text" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Plan Life* </strong> (Days)
                                <div class="form-group">
                                    <input id="plan_edit_life" name="plan_edit_life" type="text" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger waves-effect" onClick="javascript:formIsValid('plans_edit','FrmeditPlanPop',event);">UPDATE CHANGES</button>
                        <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                                <strong>Started Date </strong> 
                                <div class="form-group">
                                    <input id="plan_view_created_date" name="plan_view_created_date" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Current Status </strong> (Days)
                                <div class="form-group">
                                    <input id="plan_view_status" name="plan_view_status" type="text" class="form-control" disabled>
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
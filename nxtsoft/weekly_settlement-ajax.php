<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if (isset($_GET['mode'])) {
    if ($_REQUEST['mode'] == "DisplayCustAmt") {

    	 $planid = $_GET['planid'];
    	 $dt = $_GET['dt'];


    	/* Date Conversion into Ymd Format */ 
        $enddt1 = date("d-m-Y", strtotime($dt));
        $enddt2 = date("Y-m-d", strtotime($dt));
        $settle_dt = $enddt2;

        //display all plan
        if( $planid == -1)
        {
             $q = "select 
                        cp.`sno`,
                        cp.`cust_id`, 
                        cp.`plan_id`, 
                        cp.`started_date`, 
                        cp.`status`, 
                        cp. `plan_exp_dt`, 
                        cu.`name`, 
                        `plans`.`title` 
                    from `customer_plans` cp,`users_customers` cu,`plans` 
                    where  (cp.`status` =1 OR cp.`status` =2) 
                    AND cu.`cust_id` = cp.`cust_id` 
                    AND cp.`started_date` <= '$enddt2'
                    AND `plans`.`id` = cp.`plan_id`  
                    order by cp.cust_id";
        }
        else
        {

        $q = "select 
                    cp.`sno`, 
                    cp.`cust_id`, 
                    cp.`plan_id`, 
                    cp.`started_date`, 
                    cp.`status`, 
                    cp. `plan_exp_dt`,
                    cu.`name`,
                    `plans`.`title` 
                from `customer_plans` cp,`users_customers` cu,`plans` 
                where cp.`plan_id` =$planid 
                AND (cp.`status` =1 OR cp.`status` =2) 
                AND cu.`cust_id` = cp.`cust_id`
                AND cp.`started_date` <= '$enddt2' 
                AND `plans`.`id` =cp.`plan_id`  
                order by cp.cust_id";
        }
        
        $r3 = mysqli_query($con, $q);
        $num=mysqli_num_rows($r3);

        if (mysqli_num_rows($r3) > 0)
        {
            //************************* REPORT MENU
              //************************* &#39; ESCAPE CODE FOR SINGLE QUOTE

                //************************* REPORT MENU Ends---
                echo'
                <table class="tblexport" style="display:none;" data-tableexport-display="always">
                    <tr>
                        <td></td>
                        <td colspan="2" style="font-family: arial; font-size: 15px; font-weight: bold">Weekly Settlement </td>
                    </tr>
                    <tr>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">To Date</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Plan</th>
                    </tr>
                    <tr>
                        <td id="td_acc_fromDate"></td>
                        <td id="td_acc_plan"></td>
                    </tr>
                 </table>';

    		echo' <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="card project_list">
                                <div class="table-responsive">
                                <div class="header">
                                    <h2><strong><i class="zmdi zmdi-chart"></i> Total Record(s):</strong> '.$num.'</h2>
                                    <ul class="header-dropdown">
                                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-right slideUp" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(33px, 34px, 0px);width:180px;">
                                                <li><a href="javascript:void(0);" onclick="doExportPDF()" style="line-height: 20px;"><i class="zmdi zmdi-hc-fw"></i> Export to PDF</a></li>
                                                <li><a href="javascript:void(0);" onclick="doExportExcel()" style="line-height: 20px;"><i class="zmdi zmdi-hc-fw"></i> Export to Excel</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <table class="table table-hover c_table theme-color tblexport">
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Name</th>   
                                        <th>Plans</th>                                            
                                        <th>Entry Date</th>
                                        <th>Amount</th>
                                        <th>Transaction Note</th>
                                        <th data-tableexport-display="none">Action</th>
                                        
                                    </tr>
                                </thead>';    
                                while ($row = mysqli_fetch_array($r3))
                                 {
                                    $sno = $row['sno'];
                                    $custid=$row['cust_id'];
                                    $planid = $row['plan_id'];
                                    $custname=$row['name'];
                                    $custstatus=$row['title'];
                                    $status = $row['status'];
                                   
                                    
                                    $custjoindate=strtotime($row['started_date']); 
                                    $custjoindate1 = date("d-m-Y", $custjoindate);
                                    $custjoindate2 = date("Y-m-d", $custjoindate);

                                    $plan_exp_dt = strtotime($row['plan_exp_dt']); 
                                    $plan_exp_dt1 = date("d-m-Y", $plan_exp_dt);
                                    $plan_exp_dt2 = date("Y-m-d", $plan_exp_dt);


                                    
                                    if($status == 2){
                                        $date1 = strtotime($plan_exp_dt1);
                                        $enddt2 = $plan_exp_dt2;
                                    }
                                    else
                                        $date1 = strtotime($enddt1);


									$date2 = strtotime($custjoindate1); 

									$diff = $date2 - $date1;
                                    $days = abs(round($diff/86400));

									//calculating no of holidays bw join date and enddt
									$h_q = "select count(sno) AS holidays from settings_holidays where date >='$custjoindate2' and date <= '$enddt2'";
									 $h_res = mysqli_query($con, $h_q);
        							while ($h_row = mysqli_fetch_array($h_res))
                                 	{
                                 		$holdays =$h_row['holidays'];
                                 	}

                                 	
                                     $work_days = $days - $holdays;
                                     $work_days = $work_days + 1;
                                    
                                    // calculating daily roi
                                 	$d_q = "select daily_roi from plans where id = $planid";
                                 	$d_res = mysqli_query($con, $d_q);
                                 	while ($d_row = mysqli_fetch_array($d_res))
                                 	{
                                 		$dailyRoi =$d_row['daily_roi'];
                                 	}

                                 	$amt = $work_days * $dailyRoi;

                                 	//subtract settlement amt
                                    $settle_q = "select SUM(amount) AS amt from settlement where cust_plan_id = $sno";
                                    $settle_res = mysqli_query($con, $settle_q);
                                    while ($s_row = mysqli_fetch_array($settle_res))
                                    {
                                        $settledAmt =$s_row['amt'];
                                    }

                                    $finalAmt = $amt - $settledAmt;

                                    if( $finalAmt != 0)
                                    {

               					 	echo'   <tbody>
                      				<tr>
                           		 	<td><strong>'.$custid.'</strong></td>
                           			<td><strong>'.$custname.'</strong></td>
                           			<td><strong>'.$custstatus.'</strong></td>
                            		<td><strong>'.$custjoindate1.'</strong></td>
                           			<td><strong>'.$finalAmt.'</strong></td>
                                    <td><input type="text" name="'.$sno.'settle_assign_note" id="'.$sno.'settle_assign_note" class="form-control"></td>

                           			<td data-tableexport-display="none"><strong class="primary"><a href="javascript:void(0);" onclick="weeklypaysettlement('.$sno.','.$finalAmt.','."'".$settle_dt."'".','.$status.');">Settle Now</a></strong></td>
                           			</tr>                                               
                   				    </tbody>';
                                    }     
            					  }
                    echo'   </table>
                        </div>
                    </div>
                </div>
            </div>';
        }
        else{
                echo'
                <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card project_list">
                        <div class="table-responsive">
                        <table class="table table-hover c_table theme-color">
                        <td><strong>No information found!</strong></td>
                       </table>
                        </div>
                    </div>
                </div>
            </div>';
            }

    }
    elseif ($_REQUEST['mode'] == "SettleAmt")
    {
         $cu_pl_id = $_GET['cu_pl_id'];
         $amt = $_GET['amt'];
         $dt = $_GET['dt'];
         $status = $_GET['status'];
         $note = $_GET['note'];

          $q = "INSERT INTO `settlement` (`cust_plan_id`,`amount`,`settled_date`,`trans_note`)VALUES ($cu_pl_id,$amt,'$dt','$note')";
           if (!mysqli_query($con, $q)) {
            echo("Error description: " . mysqli_error($con));
        } else {
            if($status == 2) //change the status to 3
            {
                $update_q = "UPDATE `customer_plans` SET `status` = 3 where sno=$cu_pl_id";
                $r3 = mysqli_query($con, $update_q);
                
            }
            echo "success";
        }

    }
}
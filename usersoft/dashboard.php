<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- Include Database Configuration --> 
<?php
    include('dbconfig.php');
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
                    <h2>Dashboard</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid product-report">
            <!-- Plans Overview -->

            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12">
                <?php
                                    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

                                    /* Taking Session ID */
                                    $username = $_SESSION['email'];
                            
                                    $q = "SELECT plans.title AS plan_name,plans.amount AS plan_amount,plans.daily_roi AS plans_daily_roi,plans.plan_life AS plans_life,cp.started_date AS entry_date,IFNULL(SUM(s.amount),0) AS amt 
                                            FROM settlement s, customer_plans cp, users_customers cu, plans 
                                            WHERE cp.sno = s.cust_plan_id 
                                            AND cu.cust_id = cp.cust_id 
                                            AND plans.id = cp.plan_id 
                                            AND cu.email='$username'
                                            GROUP BY plans.title,cp.sno";
                                
                                    $r = mysqli_query($con, $q);

                                    $c = mysqli_num_rows($r);
                                    
                                    if(!mysqli_num_rows($r) > 0)
                                    {
                                    $q="SELECT plans.title AS plan_name,plans.amount AS plan_amount,plans.daily_roi AS plans_daily_roi,plans.plan_life AS plans_life,cp.started_date AS entry_date  
                                        FROM customer_plans cp, users_customers cu, plans 
                                        WHERE cu.cust_id = cp.cust_id 
                                        AND plans.id = cp.plan_id 
                                        AND cu.email='$username'
                                        GROUP BY plans.title,cp.sno";

                                        $s = mysqli_query($con, $q);

                                        $c = mysqli_num_rows($s);

    echo'           <div class="card">
                        <div class="header">
                            <h2><strong>Plans</strong> Overview</h2>
                        </div>
                        <div class="row clearfix">';
                                        while ($row = mysqli_fetch_array($s)) {
                                            $plan_name = $row['plan_name'];
                                            $plan_amount = $row['plan_amount'];
                                            $plans_daily_roi = $row['plans_daily_roi'];
                                            $plans_life = $row['plans_life'];
                                            $total_roi=round($plans_daily_roi* $plans_life);

                                            $plan_entry_date = strtotime($row['entry_date']);
                                            $plan_entry_date = date("d-m-Y", $plan_entry_date);


    echo'                   <div class="col-lg-4 col-md-6 col-sm-6 col-6 text-center"> 
                                <div class="card">
                                    <div class="body">
                                        <div class="table-responsive">                                                                            
                                            <table class="table m-b-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" colspan="2">'.$plan_name.' (INR)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Plan Amount</td>
                                                        <td>'.$plan_amount.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total ROI</td>
                                                        <td>'.$total_roi.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Daily ROI</td>
                                                        <td>'.$plans_daily_roi.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Plan Life</td>
                                                        <td>'.$plans_life.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Entry Date</td>
                                                        <td>'.$plan_entry_date.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pay-Off Days</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Pay-Off</td>
                                                        <td>0</td>
                                                    </tr>
                                                </tbody>
                                            </table>                                        
                                        </div>                                       
                                    </div>
                                </div>
                            </div>';
                                        }                                                                                  
    echo'               </div>                                   
                    </div>';
                        }else{
                        
    echo'           <div class="card">
                        <div class="header">
                            <h2><strong>Plans</strong> Overview</h2>
                        </div>
                        <div class="row clearfix">';
                                        while ($row = mysqli_fetch_array($r)) {
                                            $plan_name = $row['plan_name'];
                                            $plan_amount = $row['plan_amount'];
                                            $plans_daily_roi = $row['plans_daily_roi'];
                                            $plans_life = $row['plans_life'];

                                            $plan_entry_date = strtotime($row['entry_date']);
                                            $plan_entry_date = date("d-m-Y", $plan_entry_date);

                                            $amt =  $row['amt'];
                                            /* Pay Off Days Calculation*/
                                            $pay_off_days = round($amt/$plans_daily_roi);
                                            /* Total ROI Calculation */
                                            $total_roi=round($plans_daily_roi* $plans_life);

    echo'                   <div class="col-lg-4 col-md-6 col-sm-6 col-6 text-center"> 
                                <div class="card">
                                    <div class="body">
                                        <div class="table-responsive">                                                                            
                                            <table class="table m-b-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" colspan="2">'.$plan_name.' (INR)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Plan Amount</td>
                                                        <td>'.$plan_amount.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total ROI</td>
                                                        <td>'.$total_roi.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Daily ROI</td>
                                                        <td>'.$plans_daily_roi.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Plan Life</td>
                                                        <td>'.$plans_life.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Entry Date</td>
                                                        <td>'.$plan_entry_date.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pay-Off Days</td>
                                                        <td>'.$pay_off_days.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Pay-Off</td>
                                                        <td>'.$amt.'</td>
                                                    </tr>
                                                </tbody>
                                            </table>                                        
                                        </div>                                       
                                    </div>
                                </div>
                            </div>';
                                        }                                                                                  
    echo'               </div>                                   
                    </div>';}?>
                </div>
            </div>
            <!-- Monthly Overview -->                                    
            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12">
                <?php
                                    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

                                    /* Taking Session ID */
                                    $username = $_SESSION['email'];
                            
                                    $q = "select 
                                    cp.`sno`,
                                    cp.`cust_id`, 
                                    cp.`plan_id`, 
                                    cp.`started_date`, 
                                    cp.`status`, 
                                    cp. `plan_exp_dt`, 
                                    CURRENT_DATE() AS today,
                                    cu.`name`, 
                                    `plans`.`title` 
                                from `customer_plans` cp,`users_customers` cu,`plans` 
                                where  (cp.`status` =1 OR cp.`status` =2) 
                                AND cu.`cust_id` = cp.`cust_id` 
                                AND `plans`.`id` = cp.`plan_id` 
                                AND cu.email='$username' 
                                order by cp.cust_id ";

                                    $r = mysqli_query($con, $q);

                                    $c = mysqli_num_rows($r);
                                    if(mysqli_num_rows($r) > 0)
                                    {     
    echo'           <div class="card">
                        <div class="header">
                            <h2><strong>Plans</strong> Monthly Overview</h2>
                        </div>
                        <div class="row clearfix">'; 
                        while ($row = mysqli_fetch_array($r))
                                 {
                                    $sno = $row['sno'];
                                    $custid=$row['cust_id'];
                                    $planid = $row['plan_id'];
                                    $custname=$row['name'];
                                    $custplan=$row['title'];
                                    $status = $row['status'];
                                   
                                    
                                    $custjoindate=strtotime($row['started_date']); 
                                    $custjoindate1 = date("d-m-Y", $custjoindate);
                                    $custjoindate2 = date("Y-m-d", $custjoindate);

                                    $today = strtotime($row['today']); 
                                    $today1 = date("d-m-Y", $today);
                                    $today2 = date("Y-m-d", $today);

                                    $todaymonth = date("F", $today);
                                    $todayyear = date("Y", $today);

									$diff = $custjoindate - $today;
                                    $days = abs(round($diff/86400));

                                    //calculating no of holidays bw join date and enddt
									$h_q = "select count(sno) AS holidays from settings_holidays where date >='$custjoindate2' and date <= CURRENT_DATE()";
                                    $h_res = mysqli_query($con, $h_q);
                                   while ($h_row = mysqli_fetch_array($h_res))
                                    {
                                        $holdays =$h_row['holidays'];
                                    }

                                    
                                    $work_days = $days - $holdays;
                                    $work_days1 = $work_days + 1;
                                    
                                    // calculating daily roi
                                 	$d_q = "select daily_roi from plans where id = $planid";
                                 	$d_res = mysqli_query($con, $d_q);
                                 	while ($d_row = mysqli_fetch_array($d_res))
                                 	{
                                 		$dailyRoi =$d_row['daily_roi'];
                                 	}

                                 	$amt = $work_days1 * $dailyRoi;

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
    echo'                   <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-center">
                                <div class="card">
                                    <div class="body">
                                        <h5>'.$custplan.'</h5>
                                        <h4>Wallet - Rs '.$finalAmt.'</h4>
                                        <div class="d-flex bd-highlight text-center mt-4">
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Year</small>
                                                <h6 class="mb-0">'. $todayyear.'</h6>
                                            </div>
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Month</small>
                                                <h6 class="mb-0">'.$todaymonth.'</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                                   }   }                     
    echo'               </div>
                    </div>';}?>
                </div>
            </div>
            <!-- Recent Transactions && Holidays -->
            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-6">
                <?php
                            $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                            $username = $_SESSION['email'];
                            $q = "SELECT cu.name AS cname,s.amount AS amt, s.settled_date AS tr_date from settlement s, customer_plans cp, users_customers cu, plans 
                                    WHERE cp.sno = s.cust_plan_id 
                                    AND cu.cust_id = cp.cust_id 
                                    AND plans.id = cp.plan_id
                                    AND cu.email='$username' 
                                    ORDER BY s.settled_date DESC LIMIT 10";

                            $r = mysqli_query($con, $q);

                            $c = mysqli_num_rows($r);
                            if (!mysqli_num_rows($r) > 0) {
        echo'              <div class="card">
                                <div class="col-sm-12 col-md-12 col-lg-12 row">
                                    <div class="col-md-9 col-lg-9 header">
                                        <h2><strong>Recent</strong> Transactions</h2>
                                    </div>
                                    <div class="col-md-3 col-lg-3 viewall">
                                        <div class=""><a href="reports_transaction.php">View All</a></div>
                                    </div>
                                </div>
                                <div class="body">
                                    <thead>
                                    <tr>
                                        <th>No Transactions</th>
                                    </tr>
                                </div>
                            </div>';
                            }else{
    echo'
                    <div class="card">
                        <div class="col-sm-12 col-md-12 col-lg-12 row">
                            <div class="col-md-9 col-lg-9 header">
                                <h2><strong>Recent</strong> Transactions</h2>
                            </div>
                            <div class="col-md-3 col-lg-3 viewall">
                                <div class=""><a href="reports_transaction.php">View All</a></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Amount (INR)</th>
                                    </tr>
                                </thead>';
                                while ($row = mysqli_fetch_array($r)) {
                                    $cname=$row['cname'];
                                    $amt=$row['amt'];

                                    $tr_date=strtotime($row['tr_date']);
                                    $tr_date = date("d-m-Y", $tr_date);
    echo'
                               <tbody>
                                    <tr>
                                        <td>'.$cname.'</td>
                                        <td>'.$tr_date.'</td>
                                        <td class="padd13px">'.$amt.'</td>
                                    </tr>
                                </tbody>';
                                }
    echo'                   </table>
                        </div>
                    </div>';
                                }?>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                        <?php
                            $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                            $q = "SELECT `sno`,`date`,
                            CASE `title`
                                WHEN 1 THEN 'Saturday'
                                WHEN 2 THEN 'Sunday' 
                                WHEN 3 THEN 'Public Holiday'
                            END AS `title`
                            FROM settings_holidays 
                            WHERE date>=CURRENT_DATE() 
                             /*AND MONTH(date) = MONTH(CURRENT_DATE()) 
                             AND YEAR(date) = YEAR(CURRENT_DATE())*/ 
                            ORDER BY sno ASC LIMIT 5";

                            $r = mysqli_query($con, $q);

                            $c = mysqli_num_rows($r);
                            if (mysqli_num_rows($r) > 0) {
            echo'   <div class="card">        
                        <div class="col-sm-12 col-md-12 col-lg-12 row">
                            <div class="col-md-12 col-lg-12 header">
                                <h2><strong>Upcoming</strong> Holidays</h2>
                            </div>
                        </div>                        
                        <div class="table-responsive">                         
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Holiday</th>
                                    </tr>
                                </thead>';
                                
                                while ($row = mysqli_fetch_array($r)) {
                                    $upcoming_holidays_date=strtotime($row['date']);
                                    $upcoming_holidays_date = date("d-m-Y", $upcoming_holidays_date);

                                    $holiday_day=$row['title'];
                                    echo'
                                <tbody>
                                    <tr>
                                        <td>'.$upcoming_holidays_date.'</td>
                                        <td>'.$holiday_day.'</td>
                                    </tr>
                                </tbody>';
                                }
            echo'           </table>
                        </div>
                    </div>';
                            }?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Footer --> 
<?php
    include('page_footer.php');
?>
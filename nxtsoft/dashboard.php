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
                    <h2>Admin Dashboard</h2>
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
            <!-- Monthly Overview -->
            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Monthly</strong> Overview</h2>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-center">
                                <?php
                                $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                                $q = "SELECT SUM(p.amount) AS Income,MONTH(CURRENT_DATE()) AS month,YEAR(CURRENT_DATE()) AS year FROM plans p,customer_plans cp,users_customers u 
                                        WHERE u.cust_id=cp.cust_id 
                                        AND p.id=cp.plan_id 
                                        AND MONTH(cp.started_date)=MONTH(CURRENT_DATE()) 
                                        AND YEAR(cp.started_date)=YEAR(CURRENT_DATE());";
    
                                $r = mysqli_query($con, $q);
    
                                $c = mysqli_num_rows($r);
                                if (mysqli_num_rows($r) > 0) {
                                    
    echo'                       <div class="card">';
                                    while ($row = mysqli_fetch_array($r)) {
                                        $Income=$row['Income'];
                                        $month=date($row['month']);

                                        $dateObj = DateTime::createFromFormat('!m', $month); 
  
                                        // Store the month name to variable 
                                        $monthName = $dateObj->format('F'); 
                                        $year=$row['year'];
    echo'                           <div class="body">
                                        <h5>Income</h5>
                                        <h4>'.$Income.' INR</h4>
                                        <div class="d-flex bd-highlight text-center mt-4">
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Year</small>
                                                <h6 class="mb-0">'.$year.'</h6>
                                            </div>
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Month</small>
                                                <h6 class="mb-0">'.$monthName.'</h6>
                                            </div>
                                        </div>
                                    </div>';
                                    }
    echo'                       </div>';
                                }?>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-center">
                                <?php
                                    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                                    $q = "SELECT MONTH(CURRENT_DATE()) AS month,YEAR(CURRENT_DATE()) AS year,SUM(s.amount) AS settlements 
                                            FROM settlement s, customer_plans cp, users_customers cu, plans 
                                            WHERE cp.sno = s.cust_plan_id 
                                            AND cu.cust_id = cp.cust_id 
                                            AND plans.id = cp.plan_id 
                                            AND MONTH(s.settled_date)=MONTH(CURRENT_DATE()) 
                                            AND YEAR(s.settled_date)= YEAR(CURRENT_DATE()) ";
    
                                        $r = mysqli_query($con, $q);
    
                                        $c = mysqli_num_rows($r);
                                        if (mysqli_num_rows($r) > 0) {
    echo'                       <div class="card">';
                                            while ($row = mysqli_fetch_array($r)) {
                                                $settlements=$row['settlements'];
                                                $month=date($row['month']);

                                                $dateObj = DateTime::createFromFormat('!m', $month);
                                                // Store the month name to variable
                                                $monthName = $dateObj->format('F');
                                                $year=$row['year'];
    echo'                           <div class="body">                            
                                        <h5>Settlement</h5>
                                        <h4>'.$settlements.' INR</h4>
                                        <div class="d-flex bd-highlight text-center mt-4">
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Year</small>
                                                <h6 class="mb-0">'.$year.'</h6>
                                            </div>
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Month</small>
                                                <h6 class="mb-0">'.$monthName.'</h6>
                                            </div>
                                        </div>
                                    </div>';
                                    }
    echo'                       </div>';
                                }?>
                            </div>
                            
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-center">
                                <?php
                                    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                                    $q = "SELECT CASE `cust_type`
                                    WHEN 1 THEN 'Customers'
                                    WHEN 2 THEN 'Bussiness Promoters' 
                                    END AS `cust_type`,MONTH(CURRENT_DATE()) AS month,YEAR(CURRENT_DATE()) AS year,count(cust_id) AS countcustid FROM users_customers 
                                    WHERE cust_type=1 
                                    AND MONTH(created_date)=MONTH(CURRENT_DATE()) 
                                    AND YEAR(created_date)=YEAR(CURRENT_DATE())";
    
                                        $r = mysqli_query($con, $q);
    
                                        $c = mysqli_num_rows($r);
                                        if (mysqli_num_rows($r) > 0) {
    echo'                       <div class="card">';
                                    while ($row = mysqli_fetch_array($r)) {
                                        $countcustid=$row['countcustid'];
                                        $month=date($row['month']);

                                        $dateObj = DateTime::createFromFormat('!m', $month);
                                        // Store the month name to variable
                                        $monthName = $dateObj->format('F');
                                        $year=$row['year'];     
    echo'                           <div class="body">                            
                                        <h5>Customers</h5>
                                        <h4>'.$countcustid.'</h4>
                                        <div class="d-flex bd-highlight text-center mt-4">
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Year</small>
                                                <h6 class="mb-0">'.$year.'</h6>
                                            </div>
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Month</small>
                                                <h6 class="mb-0">'.$monthName.'</h6>
                                            </div>
                                        </div>
                                    </div>';
                                }
    echo'                       </div>';
                                }?>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-center">
                                <?php
                                    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                                    $q = "SELECT CASE `cust_type`
                                    WHEN 1 THEN 'Customers'
                                    WHEN 2 THEN 'Bussiness Promoters' 
                                    END AS `cust_type`,MONTH(CURRENT_DATE()) AS month,YEAR(CURRENT_DATE()) AS year,count(cust_id) AS countcustid FROM users_customers 
                                    WHERE cust_type=2 
                                    AND MONTH(created_date)=MONTH(CURRENT_DATE()) 
                                    AND YEAR(created_date)=YEAR(CURRENT_DATE())";
    
                                        $r = mysqli_query($con, $q);
    
                                        $c = mysqli_num_rows($r);
                                        if (mysqli_num_rows($r) > 0) {
    echo'                       <div class="card">
                                    <div class="body">'; 
                                    while ($row = mysqli_fetch_array($r)) {
                                        $countcustid=$row['countcustid'];
                                        $month=date($row['month']);

                                        $dateObj = DateTime::createFromFormat('!m', $month);
                                        // Store the month name to variable
                                        $monthName = $dateObj->format('F');
                                        $year=$row['year'];
    echo'                               <h5>Promoters</h5>
                                        <h4>'.$countcustid.'</h4>
                                        <div class="d-flex bd-highlight text-center mt-4">
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Year</small>
                                                <h6 class="mb-0">'.$year.'</h6>
                                            </div>
                                            <div class="flex-fill bd-highlight">
                                                <small class="text-muted">Month</small>
                                                <h6 class="mb-0">'.$monthName.'</h6>
                                            </div>
                                        </div>
                                    </div>';
                                    }
    echo'                       </div>';
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Waiting Admin Approval && Recent Transactions -->
            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-6">
                <?php
                            $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                            $q = "SELECT name,mobile,email,admin_approval FROM users_customers WHERE cust_type=1 AND admin_approval=0 ORDER BY created_date ASC LIMIT 5";

                            $r = mysqli_query($con, $q);

                            $c = mysqli_num_rows($r);
                            if (!mysqli_num_rows($r) > 0) {
                                ?>
                            
                            <div class="card">
                                <div class="col-sm-12 col-md-12 col-lg-12 row">
                                    <div class="col-md-9 col-lg-9 header">
                                    <h2><strong>Pending</strong> Admin Approval</h2>
                                </div>
                                <div class="col-md-3 col-lg-3 viewall">
                                    <div class=""><a href="customers.php">View All</a></div>
                                </div>
                            </div>
                                <div class="body">
                                    <thead>
                                    <tr>
                                        <th>No More Admin Approvals</th>
                                    </tr>
                                </div>
                            </div>
                            <?php }else{
    echo'           <div class="card">
                        <div class="col-sm-12 col-md-12 col-lg-12 row">
                            <div class="col-md-9 col-lg-9 header">
                                <h2><strong>Pending</strong> Admin Approval</h2>
                            </div>
                            <div class="col-md-3 col-lg-3 viewall">
                                <div class=""><a href="customers.php">View All</a></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>';
                                    while ($row = mysqli_fetch_array($r)) {
                                        $name=$row['name'];
                                        $mobile=$row['mobile'];
                                        $email=$row['email'];
                                        $admin_approval=$row['admin_approval'];

                                        $i=explode(" ",$name);
    echo'                       <tbody>
                                    <tr>
                                        <td>'.$name.'</td>
                                        <td>'.$mobile.'</td>
                                        <td><a href="javascript:void(0);" onClick=javascript:showConfirmMessage2("dashboardadminapproval",'."'".$i[0]."'".','."'".$email."'".','.$admin_approval.');><span class="badge badge-warning">APPROVE</span></td>
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
                            $q = "SELECT cu.name AS cname,s.amount AS amt, s.settled_date AS tr_date from settlement s, customer_plans cp, users_customers cu, plans 
                                    WHERE cp.sno = s.cust_plan_id AND cu.cust_id = cp.cust_id AND plans.id = cp.plan_id ORDER BY s.settled_date DESC LIMIT 5";

                            $r = mysqli_query($con, $q);

                            $c = mysqli_num_rows($r);
                            if (!mysqli_num_rows($r) > 0) {
                                ?>
                            
                            <div class="card">
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
                                        <th>No Recent Transactions</th>
                                    </tr>
                                </div>
                            </div>
                            <?php }else{
    echo'           <div class="card">
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
    echo'                       <tbody>
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
            </div>
            <!--  Recent Customers && Holidays -->
            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-6">
                        <?php
                            $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
                            $q = "SELECT name,mobile,created_date FROM users_customers WHERE cust_type=1 ORDER BY created_date DESC LIMIT 5";

                            $r = mysqli_query($con, $q);

                            $c = mysqli_num_rows($r);
                            if (mysqli_num_rows($r) > 0) {
    echo'           <div class="card">
                        <div class="col-sm-12 col-md-12 col-lg-12 row">
                            <div class="col-md-9 col-lg-9 header">
                                <h2><strong>Recent</strong> Customers</h2>
                            </div>
                            <div class="col-md-3 col-lg-3 viewall">
                                <div class=""><a href="customers.php">View All</a></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Date of Join</th>
                                    </tr>
                                </thead>';
                                while ($row = mysqli_fetch_array($r)) {
                                    $name=$row['name'];
                                    $mobile=$row['mobile'];

                                    $created_date=strtotime($row['created_date']);
                                    $created_date = date("d-m-Y", $created_date);
    echo'                       <tbody>
                                    <tr>
                                        <td>'.$name.'</td>
                                        <td>'.$mobile.'</td>
                                        <td>'.$created_date.'</td>
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
        
    echo'           <div class="card">        
                        <div class="col-sm-12 col-md-12 col-lg-12 row">
                            <div class="col-md-9 col-lg-9 header">
                                <h2><strong>Upcoming</strong> Holidays</h2>
                            </div>
                            <div class="col-md-3 col-lg-3 viewall">
                                <div class=""><a href="settings_trade_calendar.php">View All</a></div>
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
    echo'                       <tbody>
                                    <tr>
                                        <td>'.$upcoming_holidays_date.'</td>
                                        <td>'.$holiday_day.'</td>
                                    </tr>
                                </tbody>';
                            }
    echo'                   </table>
                        </div>
                    </div>';
                    } ?> 
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- Include Footer --> 
<?php
    include('page_footer.php');
?>
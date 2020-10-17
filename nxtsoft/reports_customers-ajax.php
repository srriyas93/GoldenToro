<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if (isset($_GET['mode']))
{
    if ($_REQUEST['mode'] == "CustomersReport")
    {
          
      $cust_snoname = $_GET['cust_snoname'];
      $cust_planid = $_GET['cust_planid'];
      $cust_status = $_GET['cust_status'];
      $cust_start_date = $_GET['cust_start_date'];
      $cust_end_date = $_GET['cust_end_date'];

      /* Date Conversion into Ymd Format */ 
      $cust_date_start= date("Y-m-d 00:00:00", strtotime($cust_start_date));
      $cust_date_end= date("Y-m-d 23:59:59", strtotime($cust_end_date));
     
     
        $q = "SELECT u.cust_id AS custid, u.name AS custname,u.mobile AS mob, u.status AS custstatus, cp.started_date AS planjoindate, plans.title AS p_name FROM customer_plans cp,users_customers u, plans WHERE cp.cust_id = u.cust_id AND plans.id = cp.plan_id AND cust_type=1";
              
        if($cust_snoname != -1)
        {
            $q = $q." AND u.sno = $cust_snoname";
        }
         if($cust_planid !=-1){
                    $q = $q." AND cp.plan_id=$cust_planid ";
        }
        if($cust_status != -1){
                    $q = $q." AND u.status = $cust_status";
        }
        if($cust_start_date != ""){
                    $q = $q." AND u.created_date >= '$cust_date_start'";
        }   
        if($cust_end_date != ""){
                    $q = $q." AND u.created_date <= '$cust_date_end'";
        }
         
        $r3 = mysqli_query($con, $q);
        $num=mysqli_num_rows($r3);
        if (mysqli_num_rows($r3) > 0) 
        { 
                //************************* REPORT MENU
                echo'
                <table class="tblexport" style="display:none;" data-tableexport-display="always">
                    <tr>
                        <td></td>
                        <td colspan="2" style="font-family: arial; font-size: 15px; font-weight: bold">Customer Report</td>
                    </tr>
                    <tr>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Customer</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Plans</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Status</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Start Date</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">End Date</th>
                    </tr>
                    <tr>
                        <td id="td_cu_type"></td>
                        <td id="td_cu_plan"></td>
                        <td id="td_cu_status"></td>
                        <td id="td_cu_stdate"></td>
                        <td id="td_cu_enddate"></td>
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
                                             <th>Contact No</th> 
                                            <th>Plan</th> 
                                            <th>Entry Date</th>
                                            <th>Status</th>
                                         </tr>
                                    </thead>
                                    <tbody>';                                          
                                            while($row = mysqli_fetch_array($r3)) 
                                            {
                                                $custid=$row['custid'];
                                                $custname=$row['custname'];
                                                $mob = $row['mob'];
                                                $custstatus=$row['custstatus'];
                                                $p_name=$row['p_name'];
                                                $custjoindate=strtotime($row['planjoindate']);
                                                $custjoindate = date("d-m-Y", $custjoindate);

                                                if($custstatus == 1) {
                                                    $custstatus = 'Active';
                                                } else {
                                                    $custstatus = 'Inactive';
                                                }
                                                                                                 
                                                echo'<tr>
                                                    <td><strong>'.$custid.'</strong></td>
                                                    <td><strong>'.$custname.'</strong></td>  
                                                    <td><strong>'.$mob.'</strong></td>                        
                                                    <td><strong>'.$p_name.'</strong></td>
                                                    <td><strong>'.$custjoindate.'</strong></td>
                                                    <td><strong>'.$custstatus.'</strong></td>';'
                                                </tr>';
                                            } 
                                               
                                    echo' </tbody>                                     
                                </table>
                           </div>
                        </div>
                    </div>
                </div>';                
        }else
        {
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
    else  if ($_REQUEST['mode'] == "TransactionReport")
    {
          
      $cust_id = $_GET['cust_snoname'];
      $cust_planid = $_GET['cust_planid'];
      $cust_start_date = $_GET['cust_start_date'];
      $cust_end_date = $_GET['cust_end_date'];

      /* Date Conversion into Ymd Format */ 
      $cust_date_start= date("Y-m-d 00:00:00", strtotime($cust_start_date));
      $cust_date_end= date("Y-m-d 23:59:59", strtotime($cust_end_date));
     
     
        $q = "SELECT cp.cust_id AS cid, cu.name AS cname, plans.title AS plname,cp.started_date AS entry,s.amount AS amt, s.settled_date AS tr_date from settlement s, customer_plans cp, users_customers cu, plans where cp.sno = s.cust_plan_id AND cu.cust_id = cp.cust_id AND plans.id = cp.plan_id";
              
       if($cust_id != -1)
        {
            $q = $q." AND cp.cust_id = '$cust_id'";
        } 
        if($cust_planid !=-1){
                    $q = $q." AND cp.plan_id=$cust_planid ";
        } 
        if($cust_start_date != ""){
                    $q = $q." AND s.settled_date >= '$cust_date_start'";
        }   
        if($cust_end_date != ""){
                    $q = $q." AND s.settled_date <= '$cust_date_end'";
        } 
        // echo $q;
        $r3 = mysqli_query($con, $q);
        $num=mysqli_num_rows($r3);
        if (mysqli_num_rows($r3) > 0) 
        { 
            //************************* REPORT MENU
                echo'
                <table class="tblexport" style="display:none;" data-tableexport-display="always">
                    <tr>
                        <td></td>
                        <td colspan="2" style="font-family: arial; font-size: 15px; font-weight: bold">Transaction Report</td>
                    </tr>
                    <tr>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Customer</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Plans</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Start Date</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">End Date</th>
                    </tr>
                    <tr>
                        <td id="td_cu_type"></td>
                        <td id="td_cu_plan"></td>
                        <td id="td_cu_stdate"></td>
                        <td id="td_cu_enddate"></td>
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
                                            <th>Plan</th> 
                                            <th>Entry Date</th>
                                            <th>Amount</th> 
                                            <th>Settled Date</th>
                                            
                                         </tr>
                                    </thead>
                                    <tbody>';                                          
                                            while($row = mysqli_fetch_array($r3)) 
                                            {
                                                $cid=$row['cid'];
                                                $cname=$row['cname'];
                                                $plname = $row['plname'];
                                                $entry = $row['entry'];
                                                $amt=$row['amt'];
                                                $tr_date=$row['tr_date'];
                                        $tr_date = date("d-m-Y", strtotime($tr_date));
                                            $entry = date("d-m-Y", strtotime($entry));
                                           
                                                                                                 
                                                echo'<tr>
                                                    <td><strong>'.$cid.'</strong></td>
                                                    <td><strong>'.$cname.'</strong></td>  
                                                <td><strong>'.$plname.'</strong></td> 
                                                <td><strong>'.$entry.'</strong></td>                         
                                                    <td><strong>'.$amt.'</strong></td>
                                                    <td><strong>'.$tr_date.'</strong></td>
                                                   </tr>';
                                            } 
                                               
                                    echo' </tbody>                                     
                                </table>
                           </div>
                        </div>
                    </div>
                </div>';                
        }else
        {
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
    else  if ($_REQUEST['mode'] == "SettlementReport")
    {
          
      $cust_id = $_GET['cust_snoname'];
      $cust_planid = $_GET['cust_planid'];
      $cust_start_date = $_GET['cust_start_date'];
      $cust_end_date = $_GET['cust_end_date'];

      /* Date Conversion into Ymd Format */ 
      $cust_date_start= date("Y-m-d 00:00:00", strtotime($cust_start_date));
      $cust_date_end= date("Y-m-d 23:59:59", strtotime($cust_end_date));
     
     
        $q = "SELECT cp.cust_id AS cid, cu.name AS cname, plans.title AS plname,SUM(s.amount) AS amt from settlement s, customer_plans cp, users_customers cu, plans where cp.sno = s.cust_plan_id AND cu.cust_id = cp.cust_id AND plans.id = cp.plan_id ";
              
       if($cust_id != -1)
        {
            $q = $q." AND cp.cust_id = '$cust_id'";
        } 
        if($cust_planid !=-1){
                    $q = $q." AND cp.plan_id=$cust_planid ";
        } 
        if($cust_start_date != ""){
                    $q = $q." AND s.settled_date >= '$cust_date_start'";
        }   
        if($cust_end_date != ""){
                    $q = $q." AND s.settled_date <= '$cust_date_end'";
        }

        $q = $q." group by cp.plan_id, cp.cust_id";
         //echo $q;
        $r3 = mysqli_query($con, $q);
        $num=mysqli_num_rows($r3);
        if (mysqli_num_rows($r3) > 0) 
        { 
            //************************* REPORT MENU
                echo'
                <table class="tblexport" style="display:none;" data-tableexport-display="always">
                    <tr>
                        <td></td>
                        <td colspan="2" style="font-family: arial; font-size: 15px; font-weight: bold">Settlement Report</td>
                    </tr>
                    <tr>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Customer</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Plans</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">Start Date</th>
                        <th style="font-family: arial; font-size: 12px; font-weight: bold">End Date</th>
                    </tr>
                    <tr>
                        <td id="td_cu_type"></td>
                        <td id="td_cu_plan"></td>
                        <td id="td_cu_stdate"></td>
                        <td id="td_cu_enddate"></td>
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
                                            <th>Plan</th> 
                                            <th>Amount</th> 
                                         </tr>
                                    </thead>
                                    <tbody>';                                          
                                            while($row = mysqli_fetch_array($r3)) 
                                            {
                                                $cid=$row['cid'];
                                                $cname=$row['cname'];
                                                $plname = $row['plname'];
                                                $amt=$row['amt'];
                                               
                                                echo'<tr>
                                                    <td><strong>'.$cid.'</strong></td>
                                                    <td><strong>'.$cname.'</strong></td>  
                                                <td><strong>'.$plname.'</strong></td> 
                                                    <td><strong>'.$amt.'</strong></td>
                                                   </tr>';
                                            } 
                                               
                                    echo' </tbody>                                     
                                </table>
                           </div>
                        </div>
                    </div>
                </div>';                
        }else
        {
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
}
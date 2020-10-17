<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');

if (isset($_GET['mode'])) {
    if ($_REQUEST['mode'] == "PlansReport") {

        $plan_custid = $_GET['plan_custid'];
        $plan_planid = $_GET['plan_planid'];
        $plan_start_date = $_GET['plan_start_date'];
        $plan_end_date = $_GET['plan_end_date'];

      /* Date Conversion into Ymd Format */ 
      $plan_date_start= date("Y-m-d 00:00:00", strtotime($plan_start_date));
      $plan_date_end= date("Y-m-d 23:59:59", strtotime($plan_end_date));
     
     
        $q = "SELECT p.title AS plan_name,p.amount AS plan_amount,p.daily_roi AS plan_daily_roi,cp.cust_id AS custid,u.name AS cust_name,CASE cp.status
        WHEN 1 THEN 'Active'
        WHEN 2 THEN 'Plan Expired But have settlement amount' 
        WHEN 3 THEN 'Expired'
    END AS status,cp.started_date AS entry_date 
                FROM plans p,customer_plans cp,users_customers u 
                WHERE cp.cust_id=u.cust_id 
                AND p.id=cp.plan_id";
            
        $q1="SELECT sum(p.amount) AS amount FROM plans p,users_customers u,customer_plans cp WHERE cp.cust_id=u.cust_id AND p.id=cp.plan_id";

    if($plan_custid != -1)
    {
        $q = $q." AND u.cust_id = '$plan_custid'";
        $q1=$q1." AND u.cust_id = '$plan_custid'";
    }
    if($plan_planid !=-1){
        $q = $q." AND cp.plan_id=$plan_planid ";
        $q1=$q1." AND cp.plan_id=$plan_planid";
    }
    if($plan_start_date != ""){
        $q = $q." AND cp.started_date >= '$plan_date_start'";
        $q1=$q1." AND cp.started_date >= '$plan_date_start'";
    }   
    if($plan_end_date != ""){
        $q = $q." AND cp.started_date <= '$plan_date_end'";
        $q1=$q1." AND cp.started_date <= '$plan_date_end'";
    }
 
    //echo $q;
    //echo $q1;
        $r3 = mysqli_query($con, $q);
        $num=mysqli_num_rows($r3);
       
        $r4= mysqli_query($con, $q1);
        if (mysqli_num_rows($r3) > 0) 
        { 
            //************************* REPORT MENU
            echo'
            <table class="tblexport" style="display:none;" data-tableexport-display="always">
                <tr>
                    <td></td>
                    <td colspan="2" style="font-family: arial; font-size: 15px; font-weight: bold">Plans Report</td>
                </tr>
                <tr>
                    <th style="font-family: arial; font-size: 12px; font-weight: bold">Plans</th>
                    <th style="font-family: arial; font-size: 12px; font-weight: bold">Customer</th>
                    <th style="font-family: arial; font-size: 12px; font-weight: bold">Start Date</th>
                    <th style="font-family: arial; font-size: 12px; font-weight: bold">End Date</th>
                </tr>
                <tr>
                    <td id="td_cu_plan"></td>
                    <td id="td_cu_type"></td>
                    <td id="td_cu_stdate"></td>
                    <td id="td_cu_enddate"></td>
                </tr>
             </table>';

        echo'   <div class="row clearfix">
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
                                        <th>Plan Name</th>
                                        <th>Plan Amount</th> 
                                         <th>Daily ROI</th> 
                                        <th>Customer Name</th> 
                                        <th>Status</th>
                                        <th>Entry Date</th>
                                     </tr>
                                </thead>
                                <tbody>';                                          
                                        while($row = mysqli_fetch_array($r3)) 
                                        {
                                            $plan_name=$row['plan_name'];
                                            $plan_amount=$row['plan_amount'];
                                            $plan_daily_roi=$row['plan_daily_roi'];
                                            $custid=$row['custid'];
                                            $cust_name=$row['cust_name'];
                                            $status=$row['status'];
                                            
                        
                                            $entry_date = strtotime($row['entry_date']);
                                            $entry_date = date("d-m-Y", $entry_date);

                                            
                                                                                             
        echo'                               <tr>
                                                <td><strong>'.$plan_name.'</strong></td>
                                                <td><strong>'.$plan_amount.'</strong></td>  
                                                <td><strong>'.$plan_daily_roi.'</strong></td>                        
                                                <td><strong>'.$cust_name.'</strong></td>
                                                <td><strong>'.$status.'</strong></td>
                                                <td><strong>'.$entry_date.'</strong></td>
                                            </tr>';
                                        } 
                                        while ($row = mysqli_fetch_array($r4)) {
                                            $amount=$row['amount'];
                                            
    echo'                               <tr>
                                                <td><strong>Total</strong></td>
                                                <td><strong>'.$amount.'</strong></td>
                                        </tr>';
                                        }
        echo'                       </tbody>                                                          
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
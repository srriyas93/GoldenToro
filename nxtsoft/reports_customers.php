<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- DB Configuration --> 
<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
?>
<!-- Include Other Files -->
<?php 
    include('reports_customers-ajax.php');
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
                    <h2>Reports</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
<!-- Advanced Search Fields -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="CustomerSearch" class="report_card">
                    <div class="header">
                        <h2><strong>Customer</strong> Report</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4">
                                <strong>Customers </strong> 
                                <div class="form-group">
                                    <select id="cust_report_snoname" name="cust_report_snoname" class="form-control" required>
                                        <option value="-1" selected>--- SELECT CUSTOMER ---</option>
                                        <?php
                                        $select="customers";
                                        if(isset($select)&&$select!=""){
                                            $select=$_POST['customers']; 
                                            }
                                       
                                        $q = "SELECT sno, name FROM users_customers WHERE cust_type=1";

                                        $r = mysqli_query($con, $q);
                                        while($row_list=mysqli_fetch_assoc($r)){
                                        ?>
                                        <option value="<?php echo $row_list['sno']; ?>"><?php if($row_list['sno']==$select){ echo "selected"; } ?><?php echo $row_list['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <strong>Plans </strong> 
                                <div class="form-group">
                                    <select id="cust_report_planid" name="cust_report_planid" class="form-control" required>
                                        <option value="-1" selected>--- SELECT PLAN ---</option>
                                        <?php
                                        $select="plan";
                                        if(isset($select)&&$select!=""){
                                            $select=$_POST['customers']; 
                                            }
                                        $q = "SELECT id,title FROM plans";

                                        $r = mysqli_query($con, $q);
                                        while($row_list=mysqli_fetch_assoc($r)){
                                        ?>
                                        <option value="<?php echo $row_list['id']; ?>"><?php if($row_list['id']==$select){ echo "selected"; } ?><?php echo $row_list['title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <strong>Status </strong> 
                                <div class="form-group">
                                    <select id="cust_report_status" name="cust_report_status" class="form-control" required>
                                        <option value="-1" selected>--- SELECT STATUS ---</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <strong>Start Date </strong> 
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                    </div>
                                    <input type="text" name="cust_report_start_date" id="cust_report_start_date" class="form-control datepicker" placeholder="Please choose date ...">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <strong>End Date </strong> 
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                    </div>
                                    <input type="text" name="cust_report_end_date" id="cust_report_end_date" class="form-control datepicker" placeholder="Please choose date ...">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4" style="margin-top:20px;">
                            <button class="btn btn-primary btn-round"  onClick="CustomersReport(event);"> Generate Report </button>
                            </div>
                        </div>
                        <div class="row clearfix m-t-30"></div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Search Results -->
        <div class="container-fluid">
            <div id="displayCustomerReport"></div>
       
        </div>
    </div>
</section>
 
<!-- Include Footer --> 
<?php
    include('page_footer.php');
?>
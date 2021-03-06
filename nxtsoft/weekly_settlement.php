<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- DB Configuration --> 
<?php
require_once 'dbconfig.php';
$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
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
                    <h2>Weekly Settlement</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Weekly Settlement</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <!-- Search Fields -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="CustomerSearch" class="report_card">
                    <div class="body">
                        <form id="frmWeeklySettle" name="frmWeeklySettle" action="#">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4">
                                    <strong>Select Date </strong> 
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                        </div>
                                        <input type="text" name="cust_report_start_date" id="cust_report_start_date" class="form-control datepicker" placeholder="Please choose date ..." required >
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <strong>Plans </strong> 
                                    <div class="form-group">
                                        <select id="cust_report_planid" name="cust_report_planid" class="form-control" required>
                                            <option value="-1" selected>--- SELECT PLAN ---</option>
                                            <?php
                                                $q = "SELECT id,title FROM plans";
                                                $r = mysqli_query($con, $q);
                                                while($row_list=mysqli_fetch_assoc($r))
                                                {
                                            ?>
                                                <option value="<?php echo $row_list['id']; ?>"><?php echo $row_list['title']; ?></option>
                                            <?php 
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4" style="margin-top:20px;">
                                    <button class="btn btn-primary btn-round"  onClick="javascript:formIsValid('WeeklySettlement','frmWeeklySettle',event);"> Generate Settlement </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row clearfix m-t-30"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Results -->
    <div class="container-fluid">
        <div id="displayCustomerSettlement"></div>
    </div>
    </div>
</section>

<!-- Include Footer --> 
<?php
    include('page_footer.php');
?>
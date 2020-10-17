<!-- Include Header --> 
<?php
    include('page_header.php');
?>
<!-- Include Other Files -->
<?php 
    include('changePassword-ajax.php');
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
                        <h2>Change Password</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
               <!--         <button class="btn btn-success btn-icon float-right" type="button" data-toggle="modal" data-target="#popaddnewplan"><i class="zmdi zmdi-plus"></i></button>-->
                    </div>
                </div>
            </div>
        
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form name="DisplayProfileForm" id="DisplayProfileForm" method="POST">
                        <div id="DisplayProfile" class="modal-body">
                            <div class="row clearfix">
                            <?php
                                $username = $_SESSION['email'];
                echo'               <div class="form-group">
                                        <input id="username" name="username" value='.$username.' type="hidden" class="form-control">
                                    </div>';?>
                                <div class="col-sm-12">
                                    <strong>Old Password</strong>
                                    <div class="form-group">
                                        <input id="cust_change_pass_old" name="cust_change_pass_old" type="password" onblur="CheckPassword(cust_change_pass_old,username)" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12" style='font-size: 13px;font-weight: bold;color:red'>
                                    <div id="oldpassword1">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                <strong>New Password</strong> 
                                    <div class="form-group">
                                        <input id="cust_change_pass_new" name="cust_change_pass_new" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                <strong>Confirm Password </strong> 
                                    <div class="form-group">
                                        <input id="cust_change_pass_new_confirm" name="cust_change_pass_new_confirm" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12" style='font-size: 13px;font-weight: bold;color:red'>
                                    <div id="passwordmessage1">
                                    </div>
                                </div>
                                </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger waves-effect" onClick="changePassword(event);">CHANGE PASSWORD</button>
                            <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                            </div>
                        </div>
                    </form>
                </div>
           </div>
        </div>
    </section>';

<!-- Include Footer --> 
<?php
    include('page_footer.php');
?>
<!-- Include Other Files --> 
<?php 
    include_once('signin-ajax.php');
?>

<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="">
    <title>:: USERSOFT :: Sign In</title>
    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="72x72" href="favicon.png">
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush">
    <div id="login" class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form method="post" class="card auth_form" id="loginfm">
                    <div class="header">
                        <img class="logo" src="assets/images/logo.png" alt="">
                        <h5>Log in</h5>
                    </div>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>
                        </div>
                        <div style='font-size: 15px;font-weight: bold;color:red' id="loginmessage"></div>
                        <div class="checkbox">
                            <input id="remember_me" type="checkbox">
                            <label for="remember_me">Remember Me</label>
                        </div>
                        <input type="submit" onClick=";signin(event);" class="btn btn-primary btn-block waves-effect waves-light" name="login" value = "SIGN IN">
                        <div style='font-size: 15px;font-weight: bold;color:red' id="message"></div>
                        <div class="signin_with mt-3" style="display: none;">
                            <p class="mb-0">or Sign Up using</p>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round facebook"><i class="zmdi zmdi-facebook"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round twitter"><i class="zmdi zmdi-twitter"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round google"><i class="zmdi zmdi-google-plus"></i></button>
                        </div>
                        <div class="checkbox">
                           <a href="javascript:void(0);" onclick="resetPasswordPop()">Forgot Password!</a>
                        </div>
                    </div>
                    </form>
                    <div class="copyright text-center">
                        <span>Copyright © </a></span>
                        <script>
                        document.write(new Date().getFullYear())
                        </script>
                        <span> by EL Toro</a></span>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="assets/images/signin.svg" alt="Sign In" />
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Reset Password-->
    <div id="ResetPasswordPop" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="editPlanPopTitle">Reset Password!</h4>
                </div>
                <form name="FrmResetPasswordPop" id="FrmResetPasswordPop" method="POST">
                    <div  class="modal-body"> 
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <strong>Please Enter Your Registered Mobile Number*</strong>(Without Country Code)
                                <div class="form-group">
                                    <input id="reset_pass_mobile" name="reset_pass_mobile" type="text" onblur="CheckContact(reset_pass_mobile)" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div style='font-size: 15px;font-weight: bold;color:red' id="mobilemessage"></div>
                            </div>
                            <div class="col-sm-12">
                                <strong>Please Enter Your Registered Email Address*</strong>
                                <div class="form-group">
                                    <input id="reset_pass_email" name="reset_pass_email" type="text" onblur="CheckEmail(reset_pass_email)" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div style='font-size: 15px;font-weight: bold;color:red' id="emailmessage"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger waves-effect" onClick="resetPassword(event)">RESET PASSWORD</button>
                        <button type="button" class="btn btn-danger bg-grey waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                    <div class="col-sm-12">
                        <div style='font-size: 13px;font-weight: bold;color:green' id="resetpassconfirmmessage"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

    <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
    <script src="assets/js/custom.js"></script> <!-- Custom Js -->
    
    <script type="text/javascript" src="signin-ajax.js"></script>
</body>
</html>
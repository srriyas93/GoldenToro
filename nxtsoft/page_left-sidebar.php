<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="profile.html"><img src="assets/images/profile_av.jpg" alt="User"></a>
                    <div class="detail">
                        <h4>ELTORO</h4>
                        <small><?php echo $_SESSION['email']?></small>
                    </div>
                </div>
            </li>
            <li id="menu-dashboard"><a href="dashboard.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li id="menu-weekly_settlement"><a href="weekly_settlement.php"><i class="zmdi zmdi-assignment"></i><span>Weekly Settlement</span></a></li>
            <li id="menu-plans"><a href="plans.php"><i class="zmdi zmdi-assignment"></i><span>Plans</span></a></li>
            <li id="menu-user"> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account"></i><span>Users</span></a>
                <ul class="ml-menu">
                    <li id="menu-customers"><a href="customers.php">Customers</a></li>
                    <li id="menu-bussiness_promotors"><a href="bussiness_promotors.php">Business Promotors</a></li>
                    <li id="menu-admin"><a href="admin.php">Admin</a></li>
                </ul>
            </li>
            <li id="menu-reports"> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Reports</span></a>
                <ul class="ml-menu">
                    <li id="menu-reports_customers"><a href="reports_customers.php">Customers</a></li>
                    <li id="menu-reports_plans"><a href="reports_plans.php">Plans</a></li>
                    <li id="menu-reports_transaction"><a href="reports_transaction.php">Transaction</a></li>
                    <li id="menu-reports_settlement"><a href="reports_settlement.php">Settlement</a></li>
                </ul>
            </li>
            <li id="menu-settings"> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
                <ul class="ml-menu">
                    <li id="menu-settings_trade_calendar"><a href="settings_trade_calendar.php">Trading Calendar</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
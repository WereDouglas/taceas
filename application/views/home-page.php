<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TACEAS</title>
        <!-- Core CSS - Include with every page -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/main-style.css" rel="stylesheet" />
        <!-- Page-Level CSS -->
        <link href="<?php echo base_url(); ?>assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    </head>
    <body>
        <!--  wrapper -->
        <div id="wrapper">
            <!-- navbar top -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
                <!-- navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <div class="user-text-online">
                            TACEAS
                        </div>
                        <img src="<?php echo base_url(); ?>images/barcode.png" alt="" />
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- navbar-top-links -->
                <ul class="nav navbar-top-links navbar-right">
                    <!-- main dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="top-label label label-danger">3</span><i class="fa fa-envelope fa-2x"></i>
                        </a>
                        <!-- dropdown-messages -->
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="#">
                                    <div>
                                        <strong><span class=" label label-danger">Tom Matovu</span></strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong><span class=" label label-info">Jonney Depp</span></strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong><span class=" label label-success">Jonney Depp</span></strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- end dropdown-messages -->
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="top-label label label-success">4</span>  <i class="fa fa-tasks fa-2x"></i>
                        </a>
                        <!-- dropdown tasks -->
                        <ul class="dropdown-menu dropdown-tasks">
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 1</strong>
                                            <span class="pull-right text-muted">40% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 2</strong>
                                            <span class="pull-right text-muted">20% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 3</strong>
                                            <span class="pull-right text-muted">60% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 4</strong>
                                            <span class="pull-right text-muted">80% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Tasks</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- end dropdown-tasks -->
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="top-label label label-warning">5</span>  <i class="fa fa-bell fa-2x"></i>
                        </a>
                        <!-- dropdown alerts-->
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i>New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i>3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i>Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i>New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i>Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- end dropdown-alerts -->
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-2x"></i>
                        </a>
                        <!-- dropdown user-->
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i>Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a  href="<?php echo base_url() . "index.php/welcome/logout"; ?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                            </li>
                        </ul>
                        <!-- end dropdown-user -->
                    </li>
                    <!-- end main dropdown -->
                </ul>
                <!-- end navbar-top-links -->

            </nav>
            <!-- end navbar top -->

            <!-- navbar side -->
            <nav class="navbar-default navbar-static-side" role="navigation">
                <!-- sidebar-collapse -->
                <div class="sidebar-collapse">
                    <!-- side-menu -->
                    <ul class="nav" id="side-menu">
                        <li>
                            <!-- user image section-->
                            <div class="user-section">
                                <div class="user-section-inner">
                                    <img src="<?php echo base_url(); ?>images/temp.png" alt="">
                                </div>
                                <div class="user-info">
                                    <div><strong>Tom Matovu</strong></div>
                                    <div class="user-text-online">
                                        <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                    </div>
                                </div>
                            </div>
                            <!--end user image section-->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bookmark fa-fw"></i> Payments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li >
                                    <a target="frame" href="<?php echo base_url() . "index.php/payment/pay"; ?>">Pay</a>
                                </li>
                                <li >
                                    <a target="frame" href="<?php echo base_url() . "index.php/payment/add"; ?>"></i>New</a>
                                </li>
                                
                            </ul>
                            <!-- second-level-items -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tablet fa-fw"></i>Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/account/"; ?>">Accounts</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/payment/"; ?>">Transactions</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/discount/"; ?>">Discounts</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/interest/"; ?>">Interest Rates</a>
                                </li>
                            </ul>
                            <!-- second-level-items -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building-o fa-fw"></i>Inventory<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/product/"; ?>">Products</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/package/"; ?>">Package</a>
                                </li>

                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/store/"; ?>">Stores</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/inventory/"; ?>">Stock</a>
                                </li>
                            </ul>
                            <!-- second-level-items -->
                        </li>
                        <li>
                            <a target="frame" href="<?php echo base_url() . "index.php/agent/"; ?>"><i class="fa fa-user-md fa-fw"></i>Agents</a>
                        </li>
                        <li>
                            <a target="frame" href="<?php echo base_url() . "index.php/customer/"; ?>"><i class="fa fa-user fa-fw"></i>Customers</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-building-o fa-fw"></i>Structure<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/region/"; ?>"><i class="fa fa-upload fa-fw"></i>Region</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/district/"; ?>"><i class="fa fa-globe fa-fw"></i>District</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/county/"; ?>"><i class="fa fa-crosshairs fa-fw"></i>County</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/subcounty/"; ?>"><i class="fa fa-crosshairs fa-fw"></i>Sub-County</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/parish/"; ?>"><i class="fa fa-bell fa-fw"></i>Parish</a>
                                </li>
                                <li>
                                    <a target="frame" href="<?php echo base_url() . "index.php/village/"; ?>"><i class="fa fa-globe fa-fw"></i>Villages</a>
                                </li>   

                            </ul>
                            <!-- second-level-items -->
                        </li>
                        <li>
                            <a target="frame" href="<?php echo base_url() . "index.php/user/"; ?>"><i class="fa fa-user fa-fw"></i>User</a>
                        </li>
                        <li>
                            <a target="frame" href="<?php echo base_url() . "index.php/role/"; ?>"><i class="fa fa-user fa-fw"></i>Role</a>
                        </li>



                    </ul>
                    <!-- end side-menu -->
                </div>
                <!-- end sidebar-collapse -->
            </nav>
            <!-- end navbar side -->
            <!--  page-wrapper -->



            <iframe id="frame" name="frame" frameborder="no" border="0" onload="resizeIframe(this)" scrolling="no"  style="padding: 10px; min-height:1400px;" width="100%" class="span12" src="<?php echo base_url() . "index.php/home/start"; ?>"> </iframe>   




            <!-- end page-wrapper -->

        </div>
        <!-- end wrapper -->

        <!-- Core Scripts - Include with every page -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-1.10.2.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/pace/pace.js"></script>
        <script src="<?php echo base_url(); ?>assets/scripts/siminta.js"></script>
        <!-- Page-Level Plugin Scripts-->
        <script src="<?php echo base_url(); ?>assets/plugins/morris/raphael-2.1.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/morris/morris.js"></script>
        <script src="<?php echo base_url(); ?>assets/scripts/dashboard-demo.js"></script>

    </body>

</html>

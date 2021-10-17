<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Health Essential Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.css">
    <link rel="stylesheet" href="../assets/css/owl.transitions.css">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jvectormap CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/notika-custom-icon.css">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/wave/waves.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area" style="text-align: right; color: white;">
                        <h3>Health Assential Admin Panel</h3>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            
                        
                            <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-menus"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Settings</h2>
                                    </div>
                                    
                                    <div class="hd-message-info">
                                        
                                        <a href="#">
                                            <div class="hd-message-sn">
                                                <!-- <li>Icon</li> -->
                                                <div class="hd-mg-ctn">
                                                    <h3>Change Password</h3>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="../login/logout.php">
                                            <div class="hd-message-sn">
                                                
                                                <div class="hd-mg-ctn">
                                                    <h3>Logout</h3>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                   
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">Home</a>
                                    <ul class="collapse dropdown-header-top">
                                        <li><a href="../menu/index.php">Show Meals</a></li>
                                        <li><a href="../menu/addEdit.php">add Meal</a></li>
                                        
                                    </ul>
                                </li>
                                
                                <li><a data-toggle="collapse" data-target="#democrou" href="#">Doctors</a>
                                    <ul id="democrou" class="collapse dropdown-header-top">
                                        <li><a href="../doctors/index.php">All Doctors</a></li>
                                        <li><a href="../doctors/addEdit.php">Add Doctor</a></li>
                                        
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demolibra" href="#">Clients</a>
                                    <ul id="demolibra" class="collapse dropdown-header-top">
                                        <li><a href="../users/index.php">Show All</a></li>
                                    </ul>
                                </li>        
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li><a data-toggle="tab" href="#Home"><i class="notika-icon notika-menus"></i> Menu</a>
                        </li>
                        <li><a data-toggle="tab" href="#mailbox"><i class="notika-icon notika-house"></i> Doctors </a>
                        </li>
                        <li><a data-toggle="tab" href="#Interface"><i class="notika-icon notika-star"></i> Clients</a>
                        </li>
                        <li><a data-toggle="tab" href="#Charts"><i class="notika-icon notika-refresh"></i> About us</a>
                        </li>
                        <li><a data-toggle="tab" href="#Tables"><i class="notika-icon notika-phone"></i> Contact us</a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Home" class="tab-paneS notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="../menu/addEdit.php">Add Meal</a>
                                </li>
                                <li><a href="../menu/index.php">Show Meals</a>
                                </li>
                            </ul>
                        </div>
                        <div id="mailbox" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="../doctors/addEdit.php">Add Doctor </a>
                                </li>
                                <li><a href="../doctors/index.php">Show Doctors</a>
                                </li>
                            </ul>
                        </div>
                        <div id="Interface" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="../users/index.php">Show All</a>
                                </li>
                                
                            </ul>
                        </div>
                        <div id="Charts" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="../about_us/index.php">Show OurData</a></li>
                                <li><a href="../about_us/addEdit.php">Add or Edit</a></li>
                                
                            </ul>
                        </div>
                        <div id="Tables" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="../contact/index.php">Contact Data</a></li>
                                <li><a href="../contact/addEdit.php">Add or Edit</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
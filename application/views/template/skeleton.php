<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Title -->
        <title>CleanApp</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="CleanApp" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="<?php echo PLUGINS . "materialize/css/materialize.css"; ?>"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="<?php echo PLUGINS . "metrojs/MetroJs.min.css"; ?>" rel="stylesheet">
        <link href="<?php echo PLUGINS . "weather-icons-master/css/weather-icons.min.css"; ?>" rel="stylesheet">


        <!-- Theme Styles -->
        <link href="<?php echo CSS . "alpha.css"; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo CSS . "custom.css"; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo PLUGINS . "clean_app/styles/clean_app.css"; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo PLUGINS . "data-table/datatables.min.css"; ?>" rel="stylesheet" type="text/css"/>
         <link href="<?php echo PLUGINS . "daterangepicker/daterangepicker.min.css"; ?>" rel="stylesheet" type="text/css"/>
       
        
        
        
        <link href="<?php echo PLUGINS . "clean_app/styles/" . $style . ".css"; ?>" rel="stylesheet" type="text/css"/>



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-teal lighten-1">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content fixed-sidebar">
            <header class="mn-header navbar-fixed">
                <nav class="cyan darken-1">
                    <div class="nav-wrapper row">
                        <section class="material-design-hamburger navigation-toggle">
                            <a href="javascript:void(0)" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                                <span class="material-design-hamburger__layer"></span>
                            </a>
                        </section>
                        <div class="header-title col s3 m3">      
                            <span class="chapter-title">Clean App</span>
                        </div>

                    </div>
                </nav>
            </header>


            <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                       
                        <div class="sidebar-profile-info">
                            <a href="javascript:void(0);" class="account-settings-link">
                                <p><?php echo $this->session->userdata('name'); ?></p>
                                <span><?php echo $this->session->userdata('email'); ?>
                                  <!--  <i class="material-icons right">arrow_drop_down</i></span>-->
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-account-settings">
                        <ul>

                            <li class="no-padding">
                                <a class="waves-effect waves-grey"><i class="material-icons">star_border</i>Profile</a>
                            </li>

                            <li class="divider"></li>
                            <li class="no-padding">
                                <a class="waves-effect waves-grey"><i class="material-icons">exit_to_app</i>Sign Out</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion" style="padding-top:0px!important;">
                        <li class="no-padding item--slide-menu ism-0 "><a class="waves-effect waves-grey   subitem--slide-menu ssm-0 " href="<?php echo PROYECT_ROOT . "dashboard" ?>"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>
                        <li class="no-padding  item--slide-menu ism-1 "><a class="waves-effect waves-grey   subitem--slide-menu ssm-1 " href="<?php echo PROYECT_ROOT . "admins" ?>"><i class="material-icons">settings_input_svideo</i>Admin users</a></li>
                        <li class="no-padding  item--slide-menu ism-2 "><a class="waves-effect waves-grey   subitem--slide-menu ssm-2 " href="<?php echo PROYECT_ROOT . "cleaning_users" ?>"><i class="material-icons">settings_input_svideo</i>Cleaning employees</a></li>
                        <li class="no-padding  item--slide-menu ism-3 "><a class="waves-effect waves-grey   subitem--slide-menu ssm-3 " href="<?php echo PROYECT_ROOT . "plans" ?>"><i class="material-icons">settings_input_svideo</i>Plans</a></li>
                        <li class="no-padding  item--slide-menu ism-4 "><a class="waves-effect waves-grey   subitem--slide-menu ssm-4 " href="<?php echo PROYECT_ROOT . "registered_services" ?>"><i class="material-icons">settings_input_svideo</i>Registered Services</a></li>
                        <li class="no-padding  item--slide-menu ism-5 "><a class="waves-effect waves-grey   subitem--slide-menu ssm-5 " href="<?php echo PROYECT_ROOT . "promotions" ?>"><i class="material-icons">settings_input_svideo</i>Promotions</a></li>

                    </ul>

                </div>
            </aside>
            <main class="mn-inner inner-active-sidebar">

                <?php echo $body; ?>
            </main>
            <div class="page-footer">
                <div class="footer-grid container">
                    <div class="footer-l white">&nbsp;</div>
                    <div class="footer-grid-l white">
                    </div>
                    <div class="footer-r white">&nbsp;</div>

                </div>
            </div>
        </div>
        <div class="left-sidebar-hover"></div>


        <!-- Javascripts -->
        <script src="<?php echo PLUGINS . "jquery/jquery-2.2.0.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "materialize/js/materialize.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "material-preloader/js/materialPreloader.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "jquery-blockui/jquery.blockui.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "jquery-inputmask/jquery.inputmask.bundle.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "waypoints/jquery.waypoints.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "counter-up-master/jquery.counterup.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "jquery-sparkline/jquery.sparkline.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "chart.js/chart.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "d3/d3.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "nvd3/nv.d3.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.time.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.symbol.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.resize.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.tooltip.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.pie.min.js"; ?>"></script>
 
        <script src="<?php echo PLUGINS . "jquery-sparkline/jquery.sparkline.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "curvedlines/curvedLines.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "peity/jquery.peity.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "google-code-prettify/prettify.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "data-table/datatables.min.js"; ?>"></script> 
            <script src="<?php echo PLUGINS . "daterangepicker/moment.js"; ?>"></script> 

            <script src="<?php echo PLUGINS . "daterangepicker/jquery.daterangepicker.js"; ?>"></script> 

        <script src="<?php echo JS . "pages/ui-modals.js"; ?>"></script> 
        <script src="<?php echo JS . "alpha.min.js"; ?>"></script> 
        <script src="<?php echo JS . "pages/dashboard.js"; ?>"></script> 
        <?php
        if ($script != null) {
            echo "<script src='" . PLUGINS . "clean_app/scripts/clean_app.js'></script>";
            echo "<script src='" . PLUGINS . "clean_app/scripts/" . $script . ".js'></script>";
        }
        ?>
    </body>
</html>
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
        <link type="text/css" rel="stylesheet" href="<?php echo PLUGINS . "material-preloader/css/materialPreloader.min.css"; ?>"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="<?php echo PLUGINS . "metrojs/MetroJs.min.css"; ?>" rel="stylesheet">
        <link href="<?php echo PLUGINS . "weather-icons-master/css/weather-icons.min.css"; ?>" rel="stylesheet">


        <!-- Theme Styles -->
        <link href="<?php echo CSS . "alpha.css"; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo CSS . "custom.css"; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo PLUGINS . "clean_app/styles/clean_app.css"; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo PLUGINS . "clean_app/styles/" . $style . ".css"; ?>" rel="stylesheet" type="text/css"/>



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="signin-page">

        <?php echo $body; ?>

        <!-- Javascripts -->
        <script src="<?php echo PLUGINS . "jquery/jquery-2.2.0.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "materialize/js/materialize.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "material-preloader/js/materialPreloader.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "jquery-blockui/jquery.blockui.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "waypoints/jquery.waypoints.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "counter-up-master/jquery.counterup.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "jquery-sparkline/jquery.sparkline.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "chart.js/chart.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.time.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.symbol.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.resize.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "flot/jquery.flot.tooltip.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "curvedlines/curvedLines.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "peity/jquery.peity.min.js"; ?>"></script>
        <script src="<?php echo PLUGINS . "google-code-prettify/prettify.js"; ?>"></script>
       
        <script src="<?php echo JS . "pages/ui-modals.js"; ?>"></script> 
         <script src="<?php echo JS . "alpha.min.js"; ?>"></script> 
        <?php
        if ($script != null) {
            echo "<script src='" . PLUGINS . "clean_app/scripts/clean_app.js'></script>";
            echo "<script src='" . PLUGINS . "clean_app/scripts/" . $script . ".js'></script>";
        }
        ?>
    </body>
</html>
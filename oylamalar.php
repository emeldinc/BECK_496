<?php
    if(session_id() == '')
        session_start();
    include('dbconnection.php');
?>

<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Oylamalar</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-fixed page-sidebar-closed-hide-logo">
         <?php include('header.php'); ?>
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="index.php">Anasayfa</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Oylamalar</a>
                </li>
            </ul>
            <div class="page-actions">
            <div class="btn-group">
                <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span class="hidden-sm hidden-xs">Seçenekler&nbsp;</span><i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="yeni_oylama.php">
                            <i class="icon-docs"></i> Oylama Oluştur </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-tag"></i> Önceki Oylamalar </a>
                    </li>


                </ul>
            </div>
            </div>
            <br />
            <!-- END PAGE BREADCRUMB -->
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROGRESS BARS PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>Devam Eden Oylamalar
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config">
                                </a>
                                <a href="javascript:;" class="reload">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php
                                $sql_oylama = "SELECT * FROM `oylama`";
                                $res = mysqli_query($db,$sql_oylama);

                                while($row = mysqli_fetch_assoc($res))
                                {
                                    echo "<h3>";
                                        echo $row['title'];
                                    echo "</h3>";
                                    echo "<p>";
                                        echo $row['description'];
                                    echo "</p>";

                                    $sql_oysayisi = "SELECT * FROM `oy` WHERE ref_oylama_id = ".$row['id'];
                                    mysqli_query($db,$sql_oysayisi);
                                    $toplamoy = mysqli_affected_rows($db);

                                    //echo "<script> alert($toplamoy) </script>";


                                    $sql_oytipi = "SELECT * FROM `oy_tipi` WHERE `ref_oylama_id` = ".$row['id'];
                                    $innerres = mysqli_query($db,$sql_oytipi);
                                    while($innerrow = mysqli_fetch_assoc($innerres))
                                    {
                                        $sql_oy = "SELECT * FROM `oy` WHERE ref_oy_tipi = ".$row['id'];
                                        mysqli_query($db,$sql_oy);
                                        $sayi = mysqli_affected_rows($db);
                                        if($toplamoy == 0)
                                            $yuzde = 0;
                                        else
                                            $yuzde = (($sayi/$toplamoy)*100);
                                        echo "<p>";
                                            echo $innerrow['description'];
                                        echo "</p>";
                                        echo "<div class=\"progress\">";
                                           echo "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ". $yuzde ."%\">";
                                           echo "</div>";
                                        echo "</div>";
                                    }
                                }
                            ?>



                            <h3>Stacked</h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" style="width: 35%">
									<span class="sr-only">
									35% Complete (success) </span>
                                </div>
                                <div class="progress-bar progress-bar-warning" style="width: 20%">
									<span class="sr-only">
									20% Complete (warning) </span>
                                </div>
                                <div class="progress-bar progress-bar-danger" style="width: 10%">
									<span class="sr-only">
									10% Complete (danger) </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGINATION PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2014 &copy; Metronic by keenthemes.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-bootpag/jquery.bootpag.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/holder.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/ui-general.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        UIGeneral.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

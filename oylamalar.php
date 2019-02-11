<?php
    if(session_id() == '')
        session_start();
    include('dbconnection.php');

    if(isset($_POST['oylamasil']))
    {
        $user = $_SESSION['user_id'];
        $oylama_id = $_POST['oylamasil'];
        $sql_oylamasil = "SELECT * FROM `oylama` WHERE ref_user_id = $user AND id = ".$oylama_id;
        $res = mysqli_query($db,$sql_oylamasil);
        $row = mysqli_fetch_assoc($res);
        if($row['ref_user_id'] == $user)
        {
            $sql_oylamasil = "DELETE FROM `oylama` WHERE id = ".$_POST['oylamasil'];
            mysqli_query($db,$sql_oylamasil);
        }
        else
        {
            echo "<script> alert('Bu oylamayı silemezsiniz...') </script>";
        }
    }

    if(isset($_POST['oylamayap']))
    {
        $user = $_SESSION['user_id'];
        $oylama_id = $_POST['oylamayap'];
        $oy = $_POST['oy'];
        $sql_onceki_oylama = "SELECT * FROM `oy` WHERE ref_user_id = $user AND ref_oylama_id = $oylama_id";
        mysqli_query($db,$sql_onceki_oylama);
        if(mysqli_affected_rows($db) < 1)
        {
            $sql_oylamayap = "INSERT INTO `oy`(`ref_user_id`, `ref_oylama_id`, `ref_oy_tipi_id`) VALUES ($user,$oylama_id,$oy)";
            mysqli_query($db,$sql_oylamayap);

        }
        else
        {
            echo "<script> alert('Daha önceden oylama yaptığınız için tekrar kullanamazsınız...') </script>";
        }
    }
?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<html lang="en">

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

    <script>
        function oylama_sil(id)
        {
            var approval = confirm('Bu oylamayı silmek istediğinize emin misiniz ?');
            if(approval) {
                $.ajax({
                    type: "POST",
                    data: {oylamasil: id},
                    success: function (data) {
                        location.reload();
                    }
                })
            }
        }

        function oylama_yap(oylama,oy)
        {
            var approval = confirm('Emin misiniz ?');
            if(approval) {
                $.ajax({
                    type: "POST",
                    data: {oylamayap: oylama, oy: oy},
                    success: function (response) {
                        location.reload();
                    }
                })
            }
        }

    </script>
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
         <?php $page='oylamalar';include('header.php'); ?>
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

                                if(mysqli_affected_rows($db) == 0)
                                    echo "<h3> Henüz Aktif Oylama Bulunmamaktadır...</h3>";
                                else
                                {
                                    $count = 0;
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $counter = 0;
                                        if($count != 0)
                                            echo "<hr>";
                                        echo "<div class=\"btn-group\" style=\"float: right\">
														<button type=\"button\" class=\"btn btn-success\">Seçenekler</button>
														<button type=\"button\" class=\"btn btn-success dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-angle-down\"></i></button>
														<ul class=\"dropdown-menu\" role=\"menu\">
															<li>
																<a id=\"oylama_yap\" data-toggle=\"modal\" href=\"#oylama_".$row['id']."\"> 
																<i class=\"icon-note\"></i>
																&nbsp;Oyla </a>
															</li>
															<li>
																<a id=\"oylama_sil\" href=\"javascript:;\" onclick=\"oylama_sil(".$row['id'].")\">
																<i class=\"icon-trash\"></i>
																&nbsp;Sil </a>
															</li>
														</ul>
													</div>";
                                        $sql_oysayisi = "SELECT * FROM `oy` WHERE ref_oylama_id = ".$row['id'];
                                        mysqli_query($db,$sql_oysayisi);
                                        $toplamoy = mysqli_affected_rows($db);

                                        echo "<h1>";
                                            echo $row['title'];
                                        echo "</h1>";
                                        echo "<h3>";
                                            echo $row['description'];
                                        echo "</h3>";
                                        echo  "<h5><cite>Toplam Kullanılan Oy:</cite> $toplamoy</h5>";



                                        //echo "<script> alert($toplamoy) </script>";

                                        $sql_oytipi = "SELECT * FROM `oy_tipi` WHERE `ref_oylama_id` = ".$row['id'];
                                        $innerres = mysqli_query($db,$sql_oytipi);
                                        while($innerrow = mysqli_fetch_assoc($innerres))
                                        {

                                            if($counter%4 == 0)
                                                $renk = "success";
                                            else if($counter%4 == 1)
                                                $renk = "warning";
                                            else if($counter%4 == 2)
                                                $renk = "danger";
                                            else
                                                $renk = "primary";
                                            $sql_oy = "SELECT * FROM `oy` WHERE ref_oy_tipi_id = ". $innerrow['id'] . " AND ref_oylama_id = ".$row['id'];
                                            mysqli_query($db,$sql_oy);
                                            $sayi = mysqli_affected_rows($db);
                                            if($toplamoy == 0)
                                                $yuzde = 0;
                                            else
                                                $yuzde = (($sayi / $toplamoy)*100);
                                            //echo "<script> alert($sql_oy) </script>";
                                            echo "<p>";
                                                echo $innerrow['description'];
                                            echo "</p>";
                                            echo "<div class=\"progress\">";
                                               echo "<div class=\"progress-bar progress-bar-$renk\" role=\"progressbar\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ". $yuzde ."%;\">";
                                            echo "</div>";
                                            echo "</div>";
                                            $counter++;


                                        }
                                        echo "<div class=\"modal fade bs-modal-lg\" id=\"oylama_".$row['id']."\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\" style=\"display: none;\">
                                                    <div class=\"modal-dialog modal-lg\">
                                                        <div class=\"modal-content\">
                                                            <div class=\"modal-header\">
                                                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"></button>
                                                                <h1 class=\"modal-title\"> ".$row['title']." </h1>
                                                                <h3> ".$row['description']." </h3>
                                                                <p>Lütfen birini seçiniz...</p>
                                                            </div>
                                                            <div class=\"modal-body\">";
                                                                $innerres = mysqli_query($db,$sql_oytipi);
                                                                $counter = 0;
                                                                while($innerrow = mysqli_fetch_assoc($innerres))
                                                                {
                                                                    if($counter%4 == 0)
                                                                        $renk = "success";
                                                                    else if($counter%4 == 1)
                                                                        $renk = "warning";
                                                                    else if($counter%4 == 2)
                                                                        $renk = "danger";
                                                                    else
                                                                        $renk = "primary";
                                                                    $sql_oy = "SELECT * FROM `oy` WHERE ref_oy_tipi_id = ". $innerrow['id'] . " AND ref_oylama_id = ".$row['id'];
                                                                    mysqli_query($db,$sql_oy);
                                                                    $sayi = mysqli_affected_rows($db);



                                                                    if($toplamoy == 0)
                                                                    {
                                                                        $yuzde = 20;
                                                                        $gercek_yuzde = 0;
                                                                    }
                                                                    else
                                                                    {
                                                                        $yuzde = (int)(($sayi/$toplamoy)*100);
                                                                        $gercek_yuzde = $yuzde;
                                                                    }
                                                                    echo "<button type=\"button\" style=\"width: ".(20+(($yuzde)*0.8))."%;\" class=\"btn btn-".$renk."\" title=\"#1oy1oydur\" onclick=\"oylama_yap(".$row['id'].",".$innerrow['id'].");\"' > ".$innerrow['description']." ".$gercek_yuzde."% </button>";
                                                                    echo "<br><br>";
                                                                    $counter++;

                                                                }
                                        echo                "</div>
                                                            <div class=\"modal-footer\">
                                                                <button type=\"button\" class=\"btn default\" data-dismiss=\"modal\">Vazgeç</button>
                                                                <button type=\"button\" class=\"btn blue\">Oyla</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>";
                                        $count++;
                                    }
                                }
                            ?>
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

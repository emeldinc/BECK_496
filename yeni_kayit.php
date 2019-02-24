<?php
    include ('dbconnection.php');

    if(session_id() == '')
        session_start();

?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title> Kullanıcı Kaydı </title>
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
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>

    <script>

        function siteMi() {
            var x = $("#site_list").children("option:selected").val();
            if (x == -1) {
                var name_div = "<div id=\"site_name_div\" class=\"form-group has-error\">\n" +
                    "<label class=\"control-label col-md-3\">Sitenin İsmi <span class=\"required\" aria-required=\"true\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t* </span>\n" +
                    "</label>\n" +
                    "<div class=\"col-md-4\">\n" +
                    "<input id=\"site_name\" type=\"text\" class=\"form-control\" name=\"fullname\" aria-required=\"true\" aria-invalid=\"false\" aria-describedby=\"fullname-error\"><span id=\"fullname-error\" class=\"help-block help-block-error valid\"></span>\n" +
                    "</div>\n" +
                    "</div>";

                var city_div = "<div id=\"site_city_div\" class=\"form-group has-error\">\n" +
                    "<label class=\"control-label col-md-3\">Şehir <span class=\"required\" aria-required=\"true\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t* </span>\n" +
                    "</label>\n" +
                    "<div class=\"col-md-4\">\n" +
                    "<input id=\"site_city\" type=\"text\" class=\"form-control\" name=\"city\" aria-required=\"true\" aria-invalid=\"false\" aria-describedby=\"city-error\"><span id=\"fullname-error\" class=\"help-block help-block-error valid\"></span>\n" +
                    "</div>\n" +
                    "</div>";

                var state_div = "<div id=\"site_state_div\" class=\"form-group has-error\">\n" +
                    "<label class=\"control-label col-md-3\">İlçe <span class=\"required\" aria-required=\"true\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t* </span>\n" +
                    "</label>\n" +
                    "<div class=\"col-md-4\">\n" +
                    "<input id=\"site_state\" type=\"text\" class=\"form-control\" name=\"address\" aria-required=\"true\" aria-invalid=\"false\" aria-describedby=\"address-error\"><span id=\"fullname-error\" class=\"help-block help-block-error valid\"></span>\n" +
                    "</div>\n" +
                    "</div>";

                var postal_div = "<div id=\"site_postal_div\" class=\"form-group has-error\">\n" +
                    "<label class=\"control-label col-md-3\">Posta Kodu <span class=\"required\" aria-required=\"true\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t* </span>\n" +
                    "</label>\n" +
                    "<div class=\"col-md-4\">\n" +
                    "<input id=\"site_postal\" type=\"number\" class=\"form-control\" name=\"postal\" aria-required=\"true\" aria-invalid=\"false\" aria-describedby=\"postal-error\"><span id=\"fullname-error\" class=\"help-block help-block-error valid\"></span>\n" +
                    "</div>\n" +
                    "</div>";
                $("#tab2").append(name_div);
                $("#tab2").append(city_div);
                $("#tab2").append(state_div);
                $("#tab2").append(postal_div);
            }
            else
            {
                $("#site_name_div").remove();
                $("#site_city_div").remove();
                $("#site_state_div").remove();
                $("#site_postal_div").remove();
            }
        }

        function apartman() {
            var x = $("#apartman_list").children("option:selected").val();
            if (x == -1) {
                var name_div = "<div id=\"apartman_name_div\" class=\"form-group has-success\">\n" +
                    "<label class=\"control-label col-md-3\">Apt İsmi <span class=\"required\" aria-required=\"true\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t* </span>\n" +
                    "</label>\n" +
                    "<div class=\"col-md-4\">\n" +
                    "<input id=\"apartman_name\" type=\"text\" class=\"form-control\" name=\"fullname\" aria-required=\"true\" aria-invalid=\"false\" aria-describedby=\"fullname-error\"><span id=\"fullname-error\" class=\"help-block help-block-error valid\"></span>\n" +
                    "</div>\n" +
                    "</div>";

                var number_div = "<div id=\"apartman_number_div\" class=\"form-group has-success\">\n" +
                    "<label class=\"control-label col-md-3\">Apt. No <span class=\"required\" aria-required=\"true\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t\t* </span>\n" +
                    "</label>\n" +
                    "<div class=\"col-md-4\">\n" +
                    "<input id=\"apartman_number\" type=\"text\" class=\"form-control\" name=\"phone\" aria-required=\"true\" aria-invalid=\"false\" aria-describedby=\"phone-error\"><span id=\"phone-error\" class=\"help-block help-block-error valid\"></span>\n" +
                    "</div>\n" +
                    "</div>";
                $("#tab3").append(name_div);
                $("#tab3").append(number_div);
            }
            else
            {
                $("#apartman_name_div").remove();
                $("#apartman_number_div").remove();
            }
        }

        function kaydet() {
            var username = $("#username").val();
            var password = $("#submit_form_password").val();
            var fullname = $("#fullname").val().split(" ");

            var site_isim = "";
            var site_sehir = "";
            var site_ilce = "";
            var site_posta_kodu = "";

            var apartman_ismi = "";
            var apartman_no = "";

            $.ajax({ /* User Kayit */
                type: "POST",
                url: 'genel_kayit.php',
                data: {username: username, password: password,firstname: fullname[0],lastname: fullname[1],role: "yasayan"},
            });

            var site_secenek = $("#site_list").val();
            if(site_secenek == "-1")
            {
                var site_isim = $("#site_name").val();
                var site_sehir = $("#site_city").val();
                var site_ilce = $("#site_state").val();
                var site_posta_kodu = $("#site_postal").val();
            }
            var apartman_secenek = $("#apartman_list").val();
            if(apartman_secenek == "-1")
            {
                var apartman_ismi = $("#apartman_name").val();
                var apartman_no = $("#apartman_number").val();
            }
            var daire_no = $("#daire_number").val();

            $.ajax({
                type: "POST",
                url: 'genel_kayit.php',
                data: {site_secenek: site_secenek,site_adi: site_isim, sehir: site_sehir,ilce: site_ilce,posta_kodu: site_posta_kodu,
                       apartman_secenek : apartman_secenek, apartman_adi: apartman_ismi, apartman_numara: apartman_no,daire_numara: daire_no},
                success: function(data) {
                    window.location = 'index.php';
                }
            });


        }
    </script>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo ">

<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->

            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE HEAD -->

            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->

            <!-- END PAGE BREADCRUMB -->
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-10">
                    <div class="portlet box blue" id="form_wizard_1">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i> Kullanıcı Kaydı <span class="step-title"></span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="somewhere.php" class="form-horizontal" id="submit_form" method="POST">
                                <div class="form-wizard">
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li>
                                                <a href="#tab1" data-toggle="tab" class="step">
												<span class="number">
												1 </span>
                                                    <span class="desc">
												<i class="fa fa-check"></i> Kullanıcı </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
                                                    <span class="desc">
												<i class="fa fa-check"></i> Site </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
                                                    <span class="desc">
												<i class="fa fa-check"></i> Apartman </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
                                                    <span class="desc">
												<i class="fa fa-check"></i> Daire </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div id="bar" class="progress progress-striped" role="progressbar">
                                            <div class="progress-bar progress-bar-success">
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="alert alert-danger display-none">
                                                <button class="close" data-dismiss="alert"></button>
                                                Lütfen doldurulması gereken alanları doldurunuz.
                                            </div>
                                            <div class="alert alert-success display-none">
                                                <button class="close" data-dismiss="alert"></button>
                                                Your form validation is successful!
                                            </div>
                                            <div class="tab-pane active" id="tab1">
                                                <h3 class="block">Kullanıcı Bilgilerinizi Doldurunuz</h3>
                                                <div class="form-group has-error">
                                                    <label class="control-label col-md-3">Adınız Soyadınız <span class="required">
													* </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input id="fullname" type="text" class="form-control" name="fullname"/>
                                                        <span class="help-block">
														Adınızı ve Soyadınızı Bir Boşluk Bırakarak Giriniz </span>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="control-label col-md-3">Kullanıcı Adı <span class="required">
													* </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input id="username" type="text" class="form-control" name="username"/>
                                                        <span class="help-block">
														Kullanıcı Adınızı giriniz. </span>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="control-label col-md-3">Şifre <span class="required">
													* </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="password" class="form-control" name="password" id="submit_form_password"/>
                                                        <span class="help-block">
														Şifrenizi giriniz </span>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="control-label col-md-3">Şifre (Tekrar) <span class="required">
													* </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="password" class="form-control" name="rpassword"/>
                                                        <span class="help-block">
														Şifrenizi onaylayınız </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <h3 class="block">Site Bilgilerini Doldurunuz</h3>
                                                <div class="form-group has-error">
                                                    <label class="control-label col-md-3">Aşağıdaki seçeneklerden biri sizin siteniz mi ?</label>
                                                    <div class="col-md-4">
                                                        <select name="country" id="site_list" class="form-control" onchange="siteMi();">
                                                            <option value=""></option>
                                                            <option value="-1" style="color: red;">Sitem Listede Değil</option>
                                                            <option value="-2" style="color: blue;">Bir Sitede oturmuyorum</option>
                                                            <?php
                                                                $sql = "SELECT * FROM `site`";
                                                                $res = mysqli_query($db,$sql);
                                                                while($row = mysqli_fetch_assoc($res))
                                                                {
                                                                    echo "<option value=\"".$row['id']."\">".$row['name']." (".$row['city']." ".$row['state']." ".$row['postal_code'].") </option>";
                                                                }
                                                            ?>
                                                        </select>
                                                        <span class="help-block">
														Lütfen seçeneklerden birini seçiniz </span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <h3 class="block">Apartman Bilgilerini Doldurunuz</h3>
                                                <div class="form-group has-error">
                                                    <label class="control-label col-md-3">Aşağıdaki seçeneklerden biri sizin apartmanınız mı ?</label>
                                                    <div class="col-md-4">
                                                        <select name="country" id="apartman_list" class="form-control" onchange="apartman();">
                                                            <option value=""></option>
                                                            <option value="-1" style="color: red;">Apartmanım Listede Değil</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `apartman`";
                                                            $res = mysqli_query($db,$sql);
                                                            while($row = mysqli_fetch_assoc($res))
                                                            {
                                                                echo "<option value=\"".$row['id']."\">".$row['name']." (No: ".$row['number'].") </option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <h3 class="block">Confirm your account</h3>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Daire No: <span class="required" aria-required="true">
													* </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input id="daire_number" type="text" class="form-control" name="phone">
                                                        <span class="help-block">
														Daire numaranızı giriniz </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="javascript:;" class="btn default button-previous">
                                                    <i class="m-icon-swapleft"></i> Geri </a>
                                                <a href="javascript:;" class="btn blue button-next">
                                                    Devam <i class="m-icon-swapright m-icon-white"></i>
                                                </a>
                                                <button type="button" href="index.php" class="btn green button-submit" onclick="kaydet()">
                                                    Kaydet <i class="m-icon-swapright m-icon-white"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/form-wizard.js"></script>
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        FormWizard.init();
    });
</script>

</body>

</html>
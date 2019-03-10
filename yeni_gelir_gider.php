<?php
   include('dbconnection.php');
   session_start();
   $apartman_id = $_SESSION['apartman_id'];
   $sql_apartman = "SELECT * FROM apartman WHERE id = '".$apartman_id."'";
   $apartman = mysqli_query($db, $sql_apartman);
   $row = mysqli_fetch_assoc($apartman);
   ?>
<!DOCTYPE html>
<html lang="en">
   <!--<![endif]-->
   <!-- BEGIN HEAD -->
   <head>
      <meta charset="utf-8"/>
      <title>Gelir Gider Ekle</title>
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
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/clockface/css/clockface.css"/>
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-summernote/summernote.css">
      <!-- END PAGE LEVEL STYLES -->
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
            <?php $page='aidat_takip';include('header.php'); ?>
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
               <!-- BEGIN PAGE TITLE -->
               <div class="page-title">
                  <h1>Aidat Takip Sistemi</h1>
               </div>
               <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
               <li>
                  <a href="index.php">Anasayfa</a>
                  <i class="fa fa-circle"></i>
               </li>
               <li>
                  <a href="aidat_takip_sayfasi.php">Aidat Takip Sistemi</a>
                  <i class="fa fa-circle"></i>
               </li>
               <li>
                  <a href=''>Yeni Gelir Gider Ekle</a>
               </li>
            </ul>
            <div class = "row">
               <div class = "col-md-12">
                  <?php $rol = $_SESSION['user_role']; ?>
                  <div class="alert alert-info">
                     <strong><?php echo $row['name']." ".$row['number']." numara" ?></strong> için gelir-gider ekleyin.
                  </div>
               </div>
            </div>
            <div class="portlet box blue-hoki">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-gift"></i>Gelir Gider Ekleme Formu
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  <form action="gelir_gider_ekle.php?apartman_id=<?php echo $row['id']; ?>" method = "post" class="form-horizontal">
                     <div class="form-body">
                        <div class="form-group">
                           <label class="control-label col-md-3">Gelir/Gider<span class="required" aria-required="true">
                           </span>
                           </label>
                           <div class="col-md-4">
                              <select class="form-control" name="gelirMi">
                                 <option value=1>Gelir</option>
                                 <option value=0>Gider</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Miktar(₺)</label>
                           <div class="col-md-9">
                              <div class="input-inline input-medium">
                                 <input  type="number" step="0.01" value="0" name="miktar" class="form-control">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Tarih</label>
                           <div class="col-md-3">
                              <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                 <input name = "tarih" type="text" class="form-control" readonly>
                                 <span class="input-group-btn">
                                 <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Açıklama</label>
                           <div class="col-md-9">
                              <textarea class="input-block-level" id="summernote_1" name="description"> </textarea>
                           </div>
                        </div>
                        <div class="form-actions">
                           <div class="row">
                              <div class="col-md-offset-3 col-md-9">
                                 <button type="submit" class="btn btn-circle blue">Kaydet</button>
                              </div>
                           </div>
                        </div>
                  </form>
                  <!-- END FORM-->
                  </div>
               </div>
               <!-- END PAGE CONTENT-->
            </div>
         </div>
         <!-- END CONTENT -->
      </div>
      <!-- END CONTAINER -->
      <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
      <!-- BEGIN CORE PLUGINS -->
      <!--[if lt IE 9]>
      <script src="../../assets/global/plugins/respond.min.js"></script>
      <script src="../../assets/global/plugins/excanvas.min.js"></script>
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
      <script type="text/javascript" src="assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
      <script type="text/javascript" src="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
      <script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
      <script type="text/javascript" src="assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
      <script type="text/javascript" src="assets/global/plugins/clockface/js/clockface.js"></script>
      <script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
      <script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
      <script type="text/javascript" src="assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
      <script type="text/javascript" src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
      <script src="assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
      <script src="assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
      <script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
      <!-- END PAGE LEVEL PLUGINS -->
      <!-- BEGIN PAGE LEVEL SCRIPTS -->
      <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
      <script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
      <script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
      <script src="assets/admin/pages/scripts/components-pickers.js"></script>
      <script src="assets/admin/pages/scripts/components-editors.js"></script>
      <!-- END PAGE LEVEL SCRIPTS -->
      <script>
         jQuery(document).ready(function() {
            // initiate layout and plugins
            Metronic.init(); // init metronic core components
         Layout.init(); // init current layout
         Demo.init(); // init demo features
            ComponentsPickers.init();
         });
      </script>
      <script>
         jQuery(document).ready(function() {
            // initiate layout and plugins
            Metronic.init(); // init metronic core components
         Layout.init(); // init current layout
         Demo.init(); // init demo features
            ComponentsEditors.init();
         });
      </script>
   </body>
   <!-- END BODY -->
</html>

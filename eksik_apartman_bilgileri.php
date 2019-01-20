<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <title>Apartman Kayıt</title>
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
      <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
      <!-- END PAGE LEVEL SCRIPTS -->
      <!-- BEGIN THEME STYLES -->
      <link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
      <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
      <link href="assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
      <link id="style_color" href="../../assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css"/>
      <link href="assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
      <!-- END THEME STYLES -->
      <link rel="shortcut icon" href="favicon.ico"/>
   </head>
   <body class="page-header-fixed page-sidebar-closed-hide-logo">
      <div class = "row" style="margin-top: 10%; margin-left: 20%; margin-right: 5%;">
           <div class="col-md-10">
               <!-- BEGIN Portlet PORTLET-->
               <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                     <div class="caption">
                        <i class="icon-info"></i>Bilgilendirme
                     </div>
                  </div>
                  <div class="portlet-body">
                     <div class="scroller" style="height:50px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                        Eğer sitede oturmuyorsanız sakin olun -DON'T PANİC- az önce doldurduğunuz site adını seçip, apartman ismini site adı ile aynı giriniz. (42) 
                     </div>
                  </div>
               </div>
               <!-- END Portlet PORTLET-->
         </div>
         <div class="col-md-10">
             <div class="portlet box blue-hoki">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="fa fa-pencil"></i>Sistemde kayıtlı bir adresiniz yok lütfen formu doldurun
                  </div>
                  <div class="tools">
                     <a href="javascript:;" class="collapse" data-original-title="" title="">
                     </a>
                  </div>
               </div>
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  <form action="eksik_apartman_kayit" class="horizontal-form" method="post">
                     <div class="form-body">
                        <h3 class="form-section">Apartman Bilgileri</h3>
                        <div class="row">
                           <label class="col-md-2 control-label" for="form_control_1">Site</label>
                              <div class="col-md-10">
                                 <div class="form-group">
                                    <?php include('dbconnection.php'); 
                                    $sql = "SELECT * FROM beckdoor.site";
                                    $siteler = $db->query($sql); ?>
                                    <select class="select2_category form-control" name = "site_id" tabindex="1">
                                       <?php while($row = $siteler->fetch_assoc()) { ?>
                                       <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                             
                           </div>
                        <div class="row" style= "margin-top: 10px;">
                            <label class="col-md-2 control-label" for="form_control_1">İsim</label>
                            <div class="col-md-4">
                              <div class="form-group">
                                 <input type="text" class="form-control" name= "isim">
                              </div>
                           </div>
                           <label class="col-md-2 control-label" for="form_control_1">Numara</label>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <input type="number" class="form-control" name= "numara">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-actions right">
                        <button type="submit" class="btn blue"><i class="fa fa-check"></i>Devam</button>
                     </div>
                  </form>
                  <!-- END FORM-->
               </div>
            </div>
         </div>
      </div>
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
      <script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
      <!-- END PAGE LEVEL PLUGINS -->
      <!-- BEGIN PAGE LEVEL SCRIPTS -->
      <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
      <script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
      <script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
      <script src="assets/admin/pages/scripts/form-samples.js"></script>
      <!-- END PAGE LEVEL SCRIPTS -->
      <script>
         jQuery(document).ready(function() {    
         // initiate layout and plugins
         Metronic.init(); // init metronic core components
         Layout.init(); // init current layout
         Demo.init(); // init demo features
         FormSamples.init();
         });
      </script>
      <!-- END JAVASCRIPTS -->
   </body>
   <!-- END BODY -->
</html>
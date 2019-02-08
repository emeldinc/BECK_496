<?php
   include('dbconnection.php');
   session_start();
   $rol = $_SESSION['user_role'];
   if($rol != "yonetici") {
      echo '<script type="text/javascript">';
      echo 'alert("Sayfayı görüntüleyebilmek için yönetici olmalısınız");';
      echo 'window.location.href = "index.php";';
      echo '</script>';
   }
   $apartman_id = $_SESSION['apartman_id'];
   
   $apartmandaki_daireler = array();
   $sql_daire = "SELECT * FROM daire WHERE ref_apartman_id = '".$apartman_id."'";
   $daireler = $db->query($sql_daire);
   while($row = $daireler->fetch_assoc()) {
      array_push($apartmandaki_daireler, $row);
   }
   
   $sql_apartman_adi = "SELECT * FROM apartman WHERE id = '".$apartman_id."'";
   $apartman_adi = $db->query($sql_apartman_adi);
   $apartman_bilgileri = $apartman_adi->fetch_assoc();
   
   
   $gelir_giderler = array();
   $sql_gelir_gider = "SELECT * FROM gelir_gider WHERE ref_apartman_id = '".$apartman_id."'";
   $gelir_gider = $db->query($sql_gelir_gider);
   while($row = $gelir_gider->fetch_assoc()) {
      array_push($gelir_giderler, $row);
   }
   
   $toplam_gelir = 0;
   $toplam_gider = 0;
   $toplam_para = 0;
   foreach ($gelir_giderler as $value) {
   
      if($value['gelirMi'] == 1) {
         $toplam_gelir += $value['amount'];
      }
      else if($value['gelirMi'] == 0) {
         $toplam_gider += $value['amount'];
      }
   
      $toplam_para += $value['amount'];
   }
   
   $aidatlar = array();
   $toplam_aidat = 0;
   $odenmis_aidat = 0;
   $odenmemis_aidat = 0;
   foreach ($apartmandaki_daireler as $value) {
      $sql_aidat = "SELECT * FROM aidat,daire WHERE ref_daire_id = '".$value['id']."' AND daire.id = '".$value['id']."'";
      $aidat = $db->query($sql_aidat);
      while($row = $aidat->fetch_assoc()) {
      array_push($aidatlar, $row);
      }
   }
   
   
   
   
   
   foreach ($aidatlar as $value) {
      if($value['odendiMi'] == 1) {
         $odenmis_aidat += $value['amount'];
      }
      else if($value['odendiMi'] == 0) {
         $odenmemis_aidat += $value['amount'];
      }
   
      $toplam_aidat += $value['amount'];
   }
   $yıl = date("Y");
   $ay_gelir_gider = array();
   $sql_ay_gelir = "SELECT  * FROM    gelir_gider
                                       WHERE   `date` >= '".$yıl."-02-01' 
                                       AND     `date` <= '".$yıl."-12-31'
                                       AND     ref_apartman_id = '".$apartman_id."'";
   $ay_gelirler = $db->query($sql_ay_gelir);
   
   while($row = $ay_gelirler->fetch_assoc()) {
      array_push($ay_gelir_gider, $row);
   }
   
   $a = array();
   foreach ($ay_gelirler as $value) {
   
      $unixtime = strtotime($value['date']);
      $ay = date('m', $unixtime);
   
      if(!array_key_exists($ay, $a)) {
         $a[$ay] = 0;
      }
      
      if($value['gelirMi'] == 1) {
         $a[$ay] += $value['amount'];
      }
      else {
         $a[$ay] -= $value['amount'];
      }
      
   }
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <!--<![endif]-->
   <!-- BEGIN HEAD -->
   <head>
      <meta charset="utf-8"/>
      <title>Aidat Takip Sistemi | Grafikler</title>
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
      <!--Load the AJAX API-->
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
               <!-- BEGIN PAGE HEAD -->
               <div class="page-head">
                  <!-- BEGIN PAGE TITLE -->
                  <div class="page-title">
                     <h1>Aidat Takip Sistemi | Grafikler</h1>
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
                     <a href="">Grafikler</a>
                  </li>
               </ul>
               <div class = "row">
                  <div class = "col-md-6">
                     <div class="portlet box yellow">
                        <div class="portlet-title">
                           <div class="caption">
                              </i>Ay - Toplam Kazanç
                           </div>
                        </div>
                        <div class="portlet-body">
                           <?php if(empty($a)) { ?>
                           Henüz bir veri girilmemiş...
                           <?php } else { ?>
                           <div id="columnchart_material" style = "width:100%; height:250px;"></div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class = "col-md-6">
                     <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                           <div class="caption">
                              </i>Daire - Ödenmemiş Aidat
                           </div>
                        </div>
                        <div class="portlet-body">
                           <?php if(empty($aidatlar)) { ?>
                           Henüz bir veri girilmemiş...
                           <?php } else { ?>
                           <div id="barchart_material" style="width: 100%; height: 250px;"></div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
               <br />
               <div class="portlet box purple">
                  <div class="portlet-title">
                     <div class="caption">
                        </i>Toplam Gelir-Gider
                     </div>
                  </div>
                  <div class="portlet-body">
                     <?php if($toplam_gelir == 0 && $toplam_gider == 0) { ?>
                     Henüz bir veri girilmemiş...
                     <?php } else { ?>
                     <div id="chart_div" style = "width:100%; height:250px;"></div>
                     <?php } ?>
                  </div>
               </div>
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
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
         google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);
         
         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ['Daire','Ödenmemiş Aidat'],
             <?php foreach ($aidatlar as $x) {
            if($x['odendiMi'] == 0) { ?>
                  [<?php echo $x['number']; ?>, <?php echo $x['amount']; ?>],
             <?php  }
            } ?>
            ]);
         
           var options = {
             chart: {
               title: 'Aidatlar',
               subtitle: 'Dairelere göre ödenmemiş aidatlar',
             },
             colors: ['#e0440e', '#e6693e'],
             bars: 'horizontal' // Required for Material Bar Charts.
           };
         
           var chart = new google.charts.Bar(document.getElementById('barchart_material'));
         
           chart.draw(data, google.charts.Bar.convertOptions(options));
         }
      </script>
      <script type="text/javascript">
         // Load the Visualization API and the corechart package.
         google.charts.load('current', {'packages':['corechart']});
         
         // Set a callback to run when the Google Visualization API is loaded.
         google.charts.setOnLoadCallback(drawChart);
         
         // Callback that creates and populates a data table,
         // instantiates the pie chart, passes in the data and
         // draws it.
         function drawChart() {
         
           // Create the data table.
           var data = new google.visualization.DataTable();
           data.addColumn('string', 'Topping');
           data.addColumn('number', 'Slices');
           data.addRows([
             ['Gelir', <?php echo $toplam_gelir; ?>],
             ['Gider', <?php echo $toplam_gider; ?>]
           ]);
         
           // Set chart options
           var options = {'title':'Toplam Gelir/Gider'
                          };
         
           // Instantiate and draw our chart, passing in some options.
           var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
           chart.draw(data, options);
         }
      </script>
      <script type="text/javascript">
         google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);
         
         function drawChart() {
           var data = google.visualization.arrayToDataTable([
           ['Ay','Gelir'],
           <?php foreach($a as $key => $value) { ?>
         
               [<?php echo $key; ?>,<?php echo $value; ?>],
         
           <?php }  ?>
         
            ]);
         
           var options = {
             chart: {
               title: 'Toplam Gelir/Gider Ayrıntılı',
               subtitle: 'Aylara göre toplam gelen para (- ise para kaybedilmiş)'
             }
           };
         
           var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
         
           chart.draw(data, google.charts.Bar.convertOptions(options));
         }
      </script>
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
      <!-- END PAGE LEVEL PLUGINS -->
      <!-- BEGIN PAGE LEVEL SCRIPTS -->
      <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
      <script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
      <script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
      <!-- END PAGE LEVEL SCRIPTS -->
   </body>
   <!-- END BODY -->
</html>
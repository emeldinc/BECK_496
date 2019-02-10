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
   	$sql_aidat = "SELECT * FROM aidat WHERE ref_daire_id = '".$value['id']."'";
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
?>
<!DOCTYPE html>
<html lang="en">
   <!--<![endif]-->
   <!-- BEGIN HEAD -->
   <head>
      <meta charset="utf-8"/>
      <title>Aidat Takip Sistemi</title>
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
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
      <link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
      <!-- END GLOBAL MANDATORY STYLES -->
      <!-- BEGIN PAGE LEVEL STYLES -->
      <link href="assets/admin/pages/css/timeline-old.css" rel="stylesheet" type="text/css"/>
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
                     <a href="#">Aidat Takip Sistemi</a>
                  </li>
               </ul>
               <div class="page-actions">
                  <div class="btn-group">
                     <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                     <span class="hidden-sm hidden-xs">Seçenekler&nbsp;</span><i class="fa fa-angle-down"></i>
                     </button>
                     <ul class="dropdown-menu" role="menu">
                        <li>
                           <a href="yeni_aidat.php">
                           <i class="icon-plus"></i> Yeni Aidat Ekle </a>
                        </li>
                        <li>
                           <a href="yeni_gelir_gider.php">
                           <i class="icon-plus"></i> Yeni Gelir-Gider Ekle </a>
                        </li>
                     </ul>
                  </div>
                 <a href = "grafikler.php" class="btn btn-sm btn-primary">Grafikler</a>
               </div>
               <br />
               <div class="row margin-top-10">
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="dashboard-stat2">
                        <div class="display">
                           <div class="number">
                              <h3 class="font-green-sharp"><?php echo $toplam_gelir; ?><small class="font-green-sharp">₺</small></h3>
                              <small>TOPLAM GELİR</small>
                           </div>
                           <div class="icon">
                              <i class="icon-plus"></i>
                           </div>
                        </div>
                        <div class="progress-info">
                           <div class="progress">
                              <span style="width: <?php
                                 $toplam_para = ($toplam_para == 0) ? 1 : $toplam_para;
                                 echo round((100*$toplam_gelir)/$toplam_para)."%";?>" class="progress-bar progress-bar-success green-sharp">
                              <span class="sr-only">76% progress</span>
                              </span>
                           </div>
                           <div class="status">
                              <div class="status-title">
                                 Yüzde
                              </div>
                              <div class="status-number">
                                 <?php
                                    $toplam_para = ($toplam_para == 0) ? 1 : $toplam_para;
                                    echo round((100*$toplam_gelir)/$toplam_para)."%";?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="dashboard-stat2">
                        <div class="display">
                           <div class="number">
                              <h3 class="font-red-haze"><?php echo $toplam_gider; ?><small class="font-red-haze">₺</small></h3>
                              <small>TOPLAM GİDER</small>
                           </div>
                           <div class="icon">
                              <i class="icon-close"></i>
                           </div>
                        </div>
                        <div class="progress-info">
                           <div class="progress">
                              <span style="width: <?php
                                 $toplam_para = ($toplam_para == 0) ? 1 : $toplam_para;
                                 echo round((100*$toplam_gider)/$toplam_para)."%";?>" class="progress-bar progress-bar-success red-haze">
                              </span>
                           </div>
                           <div class="status">
                              <div class="status-title">
                                 Yüzde
                              </div>
                              <div class="status-number">
                                 <?php
                                    $toplam_para = ($toplam_para == 0) ? 1 : $toplam_para;
                                    echo round((100*$toplam_gider)/$toplam_para)."%";?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="dashboard-stat2">
                        <div class="display">
                           <div class="number">
                              <h3 class="font-blue-sharp"><?php echo $odenmemis_aidat; ?><small class="font-blue-sharp">₺</small></h3>
                              <small>ÖDENMEMİŞ AİDAT</small>
                           </div>
                           <div class="icon">
                              <i class="icon-basket"></i>
                           </div>
                        </div>
                        <div class="progress-info">
                           <div class="progress">
                              <span style="width: <?php
                                 $toplam_aidat = ($toplam_aidat == 0) ? 1 : $toplam_aidat;
                                 echo round((100*$odenmemis_aidat)/$toplam_aidat)."%";?>" class="progress-bar progress-bar-success blue-sharp">
                              </span>
                           </div>
                           <div class="status">
                              <div class="status-title">
                                 Yuzde
                              </div>
                              <div class="status-number">
                                 <?php
                                    $toplam_aidat = ($toplam_aidat == 0) ? 1 : $toplam_aidat;
                                    echo round((100*$odenmemis_aidat)/$toplam_aidat)."%";?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="dashboard-stat2">
                        <div class="display">
                           <div class="number">
                              <h3 class="font-purple-soft"><?php echo count($apartmandaki_daireler); ?></h3>
                              <small>APARTMANDAKİ DAİRE SAYISI</small>
                           </div>
                           <div class="icon">
                              <i class="icon-home"></i>
                           </div>
                        </div>
                        <div class="progress-info">
                           <div class="progress">
                              <span style="width: 100%" class="progress-bar progress-bar-success blue-sharp">
                              </span>
                           </div>
                           <div class="status">
                              <div class="status-title">
                                 Yuzde
                              </div>
                              <div class="status-number">
                                 100%
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- END PAGE BREADCRUMB -->
               <!-- END PAGE HEADER-->
               <!-- BEGIN PAGE CONTENT-->
               <div class = "row">
                  <div class="col-md-6 col-sm-12">
                     <!-- BEGIN EXAMPLE TABLE PORTLET-->
                     <div class="portlet box yellow">
                        <div class="portlet-title">
                           <div class="caption">
                              </i>Aidat Tablosu
                           </div>
                        </div>
                        <div class="portlet-body">
                           <table class="table table-striped table-bordered table-hover" id="sample_2">
                              <thead>
                                 <tr>
                                    <th>
                                       Daire
                                    </th>
                                    <th>
                                       Miktar
                                    </th>
                                    <th>
                                       Tarih
                                    </th>
                                    <th>
                                       Durum
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach($aidatlar as $aidat) {
                                    $sql = "SELECT * FROM daire WHERE id = '".$aidat['ref_daire_id']."'";
                                         $res = mysqli_query($db,$sql);
                                         $row = mysqli_fetch_assoc($res);
                                         ?>
                                 <tr class="odd gradeX">
                                    <td>
                                       <?php echo "Daire ".$row['number'];?>
                                    </td>
                                    <td>
                                       <?php echo $aidat['amount'];?>
                                    </td>
                                    <td>
                                       <?php echo $aidat['date'];?>
                                    </td>
                                    <td>
                                       <?php if($aidat['odendiMi'] == 1) { ?>
                                       <span class="label label-sm label-success">
                                       Ödendi </span>
                                       <?php } else { ?>
                                       <span class="label label-sm label-danger">
                                       Ödenmedi </span>
                                       <?php } ?>
                                    </td>
                                    <td>
                                       <?php if($aidat['odendiMi'] == 0) { ?>
                                       <a href="aidat_durum_degistir.php?durum=1&aidat_id=<?php echo $aidat['id']; ?>" class="btn btn-xs green">
                                       <i class="glyphicon glyphicon-ok"></i>
                                       </a>
                                       <?php } else { ?>
                                       <a href="aidat_durum_degistir.php?durum=0&aidat_id=<?php echo $aidat['id']; ?>" class="btn btn-xs red">
                                       <i class="glyphicon glyphicon-remove"></i>
                                       </a>
                                       <?php } ?>
                                    </td>
                                    <td>
                                       <a class="btn btn-xs default" data-toggle="modal" href="#responsive<?php echo $aidat['id']; ?>">
                                       Düzenle</a>
                                    </td>
                                    <td>
                                       <a href="aidat_sil.php?aidat_id=<?php echo $aidat['id']; ?>" class="btn btn-xs yellow" onclick = " return confirm('Silmek istediğinize emin misiniz?');">
                                       Sil <i class="glyphicon glyphicon-remove"></i>
                                       </a>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- END EXAMPLE TABLE PORTLET-->
                  </div>
                  <div class="col-md-6 col-sm-12">
                     <!-- BEGIN EXAMPLE TABLE PORTLET-->
                     <div class="portlet box purple">
                        <div class="portlet-title">
                           <div class="caption">
                              <?php echo "<strong>".$apartman_bilgileri['name']."</strong>"; ?> Gelir Gider Tablosu
                           </div>
                        </div>
                        <div class="portlet-body">
                           <table class="table table-striped table-bordered table-hover" id="sample_3">
                              <thead>
                                 <tr>
                                    <th>
                                       Açıklama
                                    </th>
                                    <th>
                                       Miktar
                                    </th>
                                    <th>
                                       Tarih
                                    </th>
                                    <th>
                                       Durum
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach($gelir_giderler as $gelir_gider) { ?>
                                 <tr class="odd gradeX">
                                    <td>
                                       <?php echo $gelir_gider['description']; ?>
                                    </td>
                                    <td>
                                       <?php echo $gelir_gider['amount'];?>
                                    </td>
                                    <td>
                                       <?php echo $gelir_gider['date'];?>
                                    </td>
                                    <td>
                                       <?php if($gelir_gider['gelirMi'] == 1) { ?>
                                       <span class="label label-sm label-success">
                                       Gelir </span>
                                       <?php } else { ?>
                                       <span class="label label-sm label-danger">
                                       Gider </span>
                                       <?php } ?>
                                    </td>
                                    <td>
                                       <a class="btn btn-xs default" data-toggle="modal" href="#responsive2<?php echo $gelir_gider['id']; ?>">
                                       Düzenle</a>
                                    </td>
                                    <td>
                                       <a href="gelir_gider_sil.php?gelir_gider_id=<?php echo $gelir_gider['id']; ?>" class="btn btn-xs yellow" onclick = " return confirm('Silmek istediğinize emin misiniz?');">
                                       Sil <i class="glyphicon glyphicon-remove"></i>
                                       </a>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- END EXAMPLE TABLE PORTLET-->
                  </div>
                  <?php foreach ($aidatlar as $aidat ) { ?>
                  <div id="responsive<?php echo $aidat['id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                              <h4 class="modal-title">Aidat Düzenle</h4>
                           </div>
                           <div class="modal-body">
                              <form action="aidat_duzenle.php?aidat_id=<?php echo $aidat['id']; ?>" method = "post" class="form-horizontal">
                                 <div class="form-body">
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Aidat Miktarı(₺)</label>
                                       <div class="col-md-9">
                                          <div class="input-inline input-medium">
                                             <input  type="number" step="0.01" value="<?php echo $aidat['amount']; ?>" name="miktar" class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-3">Ödenecek Tarih</label>
                                       <div class="col-md-3">
                                          <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                             <input name = "tarih" type="text" class="form-control" value = "<?php echo $aidat['date']; ?>" readonly>
                                             <span class="input-group-btn">
                                             <button class="btn default"  type="button"><i class="fa fa-calendar"></i></button>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-actions">
                                       <div class="row">
                                          <div class="col-md-offset-3 col-md-9">
                                             <button type="submit" class="btn btn-circle blue">Düzenle</button>
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
               <?php } ?>
               <?php foreach ($gelir_giderler as $gelir_gider ) { ?>
               <div id="responsive2<?php echo $gelir_gider['id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                           <h4 class="modal-title">Gelir Gider Düzenle</h4>
                        </div>
                        <div class="modal-body">
                           <form action="gelir_gider_duzenle.php?gelir_gider_id=<?php echo $gelir_gider['id']; ?>" method = "post" class="form-horizontal">
                              <div class="form-body">
                                 <div class="form-group">
                                    <label class="control-label col-md-3">Miktar(₺)</label>
                                    <div class="col-md-9">
                                       <div class="input-inline input-medium">
                                          <input  type="number" step="0.01" value="<?php echo $gelir_gider['amount']; ?>" name="miktar" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-3">Tarih</label>
                                    <div class="col-md-3">
                                       <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                          <input name = "tarih" type="text" value = "<?php echo $gelir_gider['date']; ?>" class="form-control" readonly>
                                          <span class="input-group-btn">
                                          <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-3">Açıklama</label>
                                    <div class="col-md-9">
                                       <textarea   class="input-block-level" name="description"><?php echo $gelir_gider['description']; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="form-actions">
                                    <div class="row">
                                       <div class="col-md-offset-3 col-md-9">
                                          <button type="submit" class="btn btn-circle blue">Düzenle</button>
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
            <?php } ?>
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
      <script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
      <script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
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
      <!-- END CORE PLUGINS -->
      <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
      <script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
      <script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
      <script src="assets/admin/pages/scripts/table-managed.js"></script>
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
         });
      </script>
      <script>
         jQuery(document).ready(function() {
            Metronic.init(); // init metronic core components
         Layout.init(); // init current layout
         Demo.init(); // init demo features
            TableManaged.init();
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
      <!-- END JAVASCRIPTS -->
   </body>
   <!-- END BODY -->
</html>

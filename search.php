<?php
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
<title>Arama Sonuçları</title>
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
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link href="assets/admin/pages/css/search.css" rel="stylesheet" type="text/css"/>
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
<body class="page-header-fixed page-sidebar-closed-hide-logo ">
<?php $page='search';include('header.php'); ?>
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<span class= "timeline-body-title font-blue-madison"><h4><b>Arama Sonuçları</b></h4></span>
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom tabbable-noborder">
						<ul class="nav nav-tabs">
							<li class="active">
								<a data-toggle="tab" href="#tab_1_2">
								Duyurular için Sonuçlar </a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_1_3">
								Oylamalar için Sonuçlar</a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_1_4">
								Etkinlikler için Sonuçlar </a>
							</li>
						</ul>
						<div class="tab-content">
							<div id="tab_1_2" class="tab-pane active">
                <?php
                $search = $_GET['query'];
                if($search == NULL){
                  echo $db->error;
                  echo "<script> alert('Aranacak kelime girilmemistir...') </script>";

                }
                $arr_duyuru_id=array();
                $index = 0;
                $arr_sql = "SELECT * FROM duyuru WHERE id ";
                $arr_res = mysqli_query($db,$arr_sql);
                while ($a=mysqli_fetch_array($arr_res)){
                  if($search != NULL){
                    if(strstr($a['title'],$search)){
                      $arr_duyuru_id[$index] = $a['id'];
                      $index = $index + 1;
                    }
                    else if(strstr($a['description'],$search)){
                      $arr_duyuru_id[$index] = $a['id'];
                      $index = $index + 1;
                    }
                  }


                }
                sort($arr_duyuru_id); //Son eklenenleri ustte gostermek icin
                $index = $index - 1;

                while($index >= 0){
                  $sql = "SELECT * FROM duyuru ";
                  $res = mysqli_query($db,$sql);

                  while ($b=mysqli_fetch_array($res)){
                    if($index == -1)
                      continue;

                    if(($arr_duyuru_id[$index] == $b['id'])){
                      $index = $index - 1;

                      $duyuru_id = $b['id'];
                      $date = $b['now_date'];
                      $ref_site_id = $b['ref_site_id'];
                      $ref_user_id = $b['ref_user_id'];
                      $ref_apartman_id = $b['ref_apartman_id'];
                      $title = $b['title'];
                      $description= $b['description'];
                      $image_path = NULL;
                      $sql2 = "SELECT * FROM user WHERE id = '$ref_user_id'";
                      $result = mysqli_query($db,$sql2);
                      $row = mysqli_fetch_assoc($result);
                      if (mysqli_affected_rows($db) >= 1) {
                        $ref_username = $row['username'];
                        $image_path = $row['image_path'];
                      }
                      else{
                        $db->error;
                      }
                      if(($ref_site_id != 0)&&($ref_site_id == $_SESSION['site_id'])||($ref_apartman_id == $_SESSION['apartman_id'])){

                 ?>
                <div class="row">
							    <div class="col-md-6">
										<div class="booking-result">
											<div class="booking-info">
												<h2>
												<a href="duyuru_detaylari.php?id=<?php echo $duyuru_id; ?>">
												<?php echo $title; ?> </a>
												</h2>
												<p>
													<?php
                          echo $description;
                        ?>
												</p>
											</div>
										</div>
									</div>
								</div>
                <?php }}}} ?>
                </div>
							<!--end tab-pane-->
							<div id="tab_1_3" class="tab-pane">
                <?php
                $site_id = $_SESSION['site_id'];
                $apartman_id = $_SESSION['apartman_id'];
                $search = $_GET['query'];
                $sql_oylama = "SELECT * FROM oylama";
                $res = mysqli_query($db,$sql_oylama);
                while($row = mysqli_fetch_assoc($res))
                {
                  if(($site_id != 0)&&($site_id == $row['ref_site_id'])||($apartman_id == $row['ref_apartman_id'])){
                    $title = $row['title'];
                    $description = $row['description'];
                    if($search != NULL ){
                ?>
                <div class="row">
							    <div class="col-md-6">
										<div class="booking-result">
											<div class="booking-info">
												<h2>
  												<a href="oylamalar.php">
    												<?php
                            if(strstr($title,$search)){
                              echo $title;
                            } ?> </a>
  											</h2>
  											<p>
  												<?php
                          if(strstr($description,$search)){
                            echo $description;
                          }
                          ?>
												</p>
											</div>
										</div>
									</div>
								</div>
              <?php } } } ?>
              </div>

							<!--end tab-pane-->
							<div id="tab_1_4" class="tab-pane">
                <?php
                $search = $_GET['query'];
                $site_id = $_SESSION['site_id'];
                $apartman_id = $_SESSION['apartman_id'];
                $sql_etkinlik = "SELECT * FROM etkinlik";
                $res = mysqli_query($db,$sql_etkinlik);
                while($row = mysqli_fetch_assoc($res))
                {
                  if(($site_id != 0)&&($site_id == $row['ref_site_id'])||($apartman_id == $row['ref_apartman_id'])){
                    $description = $row['description'];
                    if($search != NULL ){
                ?>
                <div class="row">
							    <div class="col-md-6">
										<div class="booking-result">
											<div class="booking-info">
												<h2>
  												<a href="index.php">
    												<?php
                              if(strstr($description,$search)){
                                echo $description;
                              }
                          ?> </a>
  											</h2>

											</div>
										</div>
									</div>
								</div>
              <?php } } } ?>

							</div>
							<!--end tab-pane-->
						</div>
					</div>
				</div>
				<!--end tabbable-->
			</div>
			<!-- END PAGE CONTENT-->

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
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/search.js"></script>
<script>
jQuery(document).ready(function() {
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   Search.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

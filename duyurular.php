<?php
      session_start();
      include('dbconnection.php');

?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Duyurular</title>
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
<link href="assets/admin/pages/css/timeline-old.css" rel="stylesheet" type="text/css"/>
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
			<?php $page='duyurular';include('header.php'); ?>
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Duyurular</h1>
				</div>
				<!-- END PAGE TITLE -->
				<!-- BEGIN PAGE TOOLBAR -->
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="index.php">Anasayfa</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="duyurular.php">Duyurular</a>
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->

			<div class="page-actions">
				<div class="btn-group">
					<button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span class="hidden-sm hidden-xs">Seçenekler&nbsp;</span><i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="duyuruekle.php">
							<i class="icon-docs"></i> Yeni Duyuru Ekle </a>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-share"></i> Paylaş </a>
						</li>
					</ul>
				</div>
			</div>
			<br />
      <div class="portlet light">
				<div class="portlet-body">
          <?php
          $arr_duyuru_id=array();
          $index = 0;
          $arr_sql = "SELECT * FROM duyuru WHERE id ";
          $arr_res = mysqli_query($db,$arr_sql);
          while ($a=mysqli_fetch_array($arr_res)){
            $arr_duyuru_id[$index] = $a['id'];
            $index = $index + 1;
          }
          sort($arr_duyuru_id); //Son eklenenleri ustte gostermek icin
          $index = $index - 1;
          $renkler = array("red", "yellow", "green", "blue");
          $count= -1;

          while($index >= 0){
            $sql = "SELECT * FROM duyuru ";
            $res = mysqli_query($db,$sql);

            while ($b=mysqli_fetch_array($res)){
              if($index == -1)
                continue;

              if(($arr_duyuru_id[$index] == $b['id'])){
                $index = $index - 1;
                if($count == 3)
                  $count = 0;
                else
                  $count = $count + 1;
                $duyuru_id = $b['id'];
                $date = $b['now_date'];
                $ref_site_id = $b['ref_site_id'];
                $ref_user_id = $b['ref_user_id'];
                $ref_apartman_id = $b['ref_apartman_id'];
                $title = $b['title'];
                $description= $b['description'];
                $image_path = NULL;
                $sql2 = "SELECT * FROM `user` WHERE id = '$ref_user_id'";
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
						<div class="col-md-12">
							<ul class="timeline">
								<li class="timeline-<?php echo $renkler[$count];?>">
									<div class="timeline-time">
										<span class="timeline-body-title font-blue-madison"><?php
                    echo $date;?>
										</span>
                    <span class= "time"><?php echo $ref_username;
                     ?>
                   <img alt="" class="img-circle" img border=1 width=70 height=70 src="<?php echo $image_path; ?>"/></span>
									</div>
									<div class="timeline-icon">
										<i class="icon-pin"></i>
									</div>
									<div class="timeline-body">
										<h2>  <?php echo $title;
                    ?></h2>
										<div class="timeline-content">
                      <?php echo $description;
                     ?>
										</div>
										<div class="timeline-footer">
											<a href="duyuru_detaylari.php?id=<?php echo $duyuru_id; ?>" class="nav-link pull-right">
											Daha fazlasını gör <i class="m-icon-swapright m-icon-white"></i>
											</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
        <?php }
      }
      }


      }?>
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
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

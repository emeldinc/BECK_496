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
   <body class="page-header-fixed page-sidebar-closed-hide-logo ">
      <!-- BEGIN HEADER -->
      <div class="page-header navbar navbar-fixed-top">
         <!-- BEGIN HEADER INNER -->
         <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
               <a href="index.html">
               <img src="assets/admin/layout4/img/becklogo.png" alt="logo" class="logo-default"/>
               </a>
               <div class="menu-toggler sidebar-toggler">
                  <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
               </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN PAGE ACTIONS -->
            <!-- DOC: Remove "hide" class to enable the page header actions -->
            <!-- END PAGE ACTIONS -->
            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
               <!-- BEGIN HEADER SEARCH BOX -->
               <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
               <form class="search-form" action="extra_search.html" method="GET">
                  <div class="input-group">
                     <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                     <span class="input-group-btn">
                     <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                     </span>
                  </div>
               </form>
               <!-- END HEADER SEARCH BOX -->
               <!-- BEGIN TOP NAVIGATION MENU -->
               <div class="top-menu">
                  <ul class="nav navbar-nav pull-right">
                     <li class="separator hide">
                     </li>
                     <!-- BEGIN NOTIFICATION DROPDOWN -->
                     <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                     <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span class="badge badge-success">
                        7 </span>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="external">
                              <h3><span class="bold">12 pending</span> notifications</h3>
                              <a href="extra_profile.html">view all</a>
                           </li>
                           <li>
                              <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">just now</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-success">
                                    <i class="fa fa-plus"></i>
                                    </span>
                                    New user registered. </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">3 mins</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-danger">
                                    <i class="fa fa-bolt"></i>
                                    </span>
                                    Server #12 overloaded. </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">10 mins</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-warning">
                                    <i class="fa fa-bell-o"></i>
                                    </span>
                                    Server #2 not responding. </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">14 hrs</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-info">
                                    <i class="fa fa-bullhorn"></i>
                                    </span>
                                    Application error. </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">2 days</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-danger">
                                    <i class="fa fa-bolt"></i>
                                    </span>
                                    Database overloaded 68%. </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">3 days</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-danger">
                                    <i class="fa fa-bolt"></i>
                                    </span>
                                    A user IP blocked. </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">4 days</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-warning">
                                    <i class="fa fa-bell-o"></i>
                                    </span>
                                    Storage Server #4 not responding dfdfdfd. </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">5 days</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-info">
                                    <i class="fa fa-bullhorn"></i>
                                    </span>
                                    System Error. </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time">9 days</span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-danger">
                                    <i class="fa fa-bolt"></i>
                                    </span>
                                    Storage server failed. </span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <!-- END NOTIFICATION DROPDOWN -->
                     <li class="separator hide">
                     </li>
                     <!-- BEGIN INBOX DROPDOWN -->
                     <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                     <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-envelope-open"></i>
                        <span class="badge badge-danger">
                        4 </span>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="external">
                              <h3>You have <span class="bold">7 New</span> Messages</h3>
                              <a href="inbox.html">view all</a>
                           </li>
                           <li>
                              <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                 <li>
                                    <a href="inbox.html?a=view">
                                    <span class="photo">
                                    <img src="assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
                                    </span>
                                    <span class="subject">
                                    <span class="from">
                                    Lisa Wong </span>
                                    <span class="time">Just Now </span>
                                    </span>
                                    <span class="message">
                                    Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="inbox.html?a=view">
                                    <span class="photo">
                                    <img src="assets/admin/layout3/img/avatar3.jpg" class="img-circle" alt="">
                                    </span>
                                    <span class="subject">
                                    <span class="from">
                                    Richard Doe </span>
                                    <span class="time">16 mins </span>
                                    </span>
                                    <span class="message">
                                    Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="inbox.html?a=view">
                                    <span class="photo">
                                    <img src="assets/admin/layout3/img/avatar1.jpg" class="img-circle" alt="">
                                    </span>
                                    <span class="subject">
                                    <span class="from">
                                    Bob Nilson </span>
                                    <span class="time">2 hrs </span>
                                    </span>
                                    <span class="message">
                                    Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="inbox.html?a=view">
                                    <span class="photo">
                                    <img src="assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
                                    </span>
                                    <span class="subject">
                                    <span class="from">
                                    Lisa Wong </span>
                                    <span class="time">40 mins </span>
                                    </span>
                                    <span class="message">
                                    Vivamus sed auctor 40% nibh congue nibh... </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="inbox.html?a=view">
                                    <span class="photo">
                                    <img src="assets/admin/layout3/img/avatar3.jpg" class="img-circle" alt="">
                                    </span>
                                    <span class="subject">
                                    <span class="from">
                                    Richard Doe </span>
                                    <span class="time">46 mins </span>
                                    </span>
                                    <span class="message">
                                    Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <!-- END INBOX DROPDOWN -->
                     <li class="separator hide">
                     </li>
                     <!-- BEGIN TODO DROPDOWN -->
                     <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                     <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-calendar"></i>
                        <span class="badge badge-primary">
                        3 </span>
                        </a>
                        <ul class="dropdown-menu extended tasks">
                           <li class="external">
                              <h3>You have <span class="bold">12 pending</span> tasks</h3>
                              <a href="page_todo.html">view all</a>
                           </li>
                           <li>
                              <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                 <li>
                                    <a href="javascript:;">
                                    <span class="task">
                                    <span class="desc">New release v1.2 </span>
                                    <span class="percent">30%</span>
                                    </span>
                                    <span class="progress">
                                    <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
                                    </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="task">
                                    <span class="desc">Application deployment</span>
                                    <span class="percent">65%</span>
                                    </span>
                                    <span class="progress">
                                    <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">65% Complete</span></span>
                                    </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="task">
                                    <span class="desc">Mobile app release</span>
                                    <span class="percent">98%</span>
                                    </span>
                                    <span class="progress">
                                    <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">98% Complete</span></span>
                                    </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="task">
                                    <span class="desc">Database migration</span>
                                    <span class="percent">10%</span>
                                    </span>
                                    <span class="progress">
                                    <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">10% Complete</span></span>
                                    </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="task">
                                    <span class="desc">Web server upgrade</span>
                                    <span class="percent">58%</span>
                                    </span>
                                    <span class="progress">
                                    <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">58% Complete</span></span>
                                    </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="task">
                                    <span class="desc">Mobile development</span>
                                    <span class="percent">85%</span>
                                    </span>
                                    <span class="progress">
                                    <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">85% Complete</span></span>
                                    </span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="task">
                                    <span class="desc">New UI release</span>
                                    <span class="percent">38%</span>
                                    </span>
                                    <span class="progress progress-striped">
                                    <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">38% Complete</span></span>
                                    </span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <!-- END TODO DROPDOWN -->
                     <!-- BEGIN USER LOGIN DROPDOWN -->
                     <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                     <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                           <span class="username username-hide-on-mobile">
                           <?php echo $_SESSION['firstname']; ?> </span>
                           <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                           <?php   $user_id = $_SESSION['user_id'];
                             $sql = "SELECT * FROM user ";
                             $res = mysqli_query($db,$sql);
                             while ($b=mysqli_fetch_array($res)){
                               if($user_id == $b['id']){
                                   $image = $b['image_path'];
                                   $username = $b['username'];
                                   $firstname = $b['firstname'];
                                   $lastname = $b['lastname']; ?>
                           <img alt="" class="img-circle" src="<?php echo $image;?>"/>
                         <?php }}?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                           <li>
                              <a href="profil.php">
                              <i class="icon-user"></i> Profil </a>
                           </li>
                           <li>
                              <a href="index.php">
                              <i class="icon-calendar"></i>Takvim </a>
                           </li>
                           <li class="divider">
                           </li>
                           <li>
                              <a href="cikis.php">
                              <i class="icon-key"></i> Çıkış Yap </a>
                           </li>
                        </ul>
                     </li>
                     <!-- END USER LOGIN DROPDOWN -->
                  </ul>
               </div>
               <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
         </div>
         <!-- END HEADER INNER -->
      </div>
      <!-- END HEADER -->
      <div class="clearfix"></div>
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
               <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                  <li>
                     <a href="index.php">
                     <i class="icon-home"></i>
                     <span class="title">Anasayfa</span>
                     </a>
                  </li>
                  <li>
                     <a href="mesajlar.php">
                     <i class="icon-envelope"></i>
                     <span class="title">Mesajlar</span>
                     </a>
                  </li>
                  <li>
                     <a href="duyurular.php">
                     <i class="icon-pin"></i>
                     <span class="title">Duyurular</span>
                     </a>
                  </li>
                  <li>
                     <a href="oylamalar.php">
                     <i class="icon-bar-chart"></i>
                     <span class="title">Oylamalar</span>
                     </a>
                  </li>
                  <li class="start active">
                     <a href="aidat_takip_sayfasi.php">
                     <i class="icon-wallet"></i>
                     <span class="title">Aidat Takibi</span>
                     </a>
                  </li>
                  <li>
                     <a href="javascript:;">
                     <i class="icon-settings"></i>
                     <span class="title">Kayıt İşlemleri</span>
                     </a>
                     <ul class="sub-menu">
                        <li>
                           <a href="eksik_site_bilgileri.php">
                           <i class="icon-pencil"></i>
                           Adres Ekle</a>
                        </li>
                        <li>
                           <a href="role_degistir.php">
                           <i class="icon-pencil"></i>
                           Rol Değiştir</a>
                        </li>
                     </ul>
                  </li>
                  <li>
                     <a href="hakkimizda.php">
                     <i class="icon-info"></i>
                     <span class="title">Hakkımızda</span>
                     </a>
                  </li>
               </ul>
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
                  <div id="columnchart_material" style = "width:100%; height:250px;"></div>
               </div>
               <div class = "col-md-6">
                  <div id="barchart_material" style="width: 100%; height: 250px;"></div>
               </div>
            </div>
            <br />
            <div id="chart_div" style = "width:100%; height:250px;"></div>



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
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
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
             ['Mushrooms', 3],
             ['Onions', 1],
             ['Olives', 1],
             ['Zucchini', 1],
             ['Pepperoni', 2]
           ]);

           // Set chart options
           var options = {'title':'How Much Pizza I Ate Last Night'
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
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017'
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

<?php
   include('dbconnection.php');
       if(session_id() == '') {
           session_start();
           $user_id = $_SESSION['user_id'];
        $sql_user_daire = "SELECT * FROM user_daire WHERE ref_user_id = '".$user_id."'";
        $user_daire = $db->query($sql_user_daire);
        $daire_idleri = array();
        $konum_array = array();
   
   
        while($row = $user_daire->fetch_assoc()) {
            array_push($daire_idleri, $row['ref_daire_id']);
        }
   
        foreach ($daire_idleri as $daire_id) {
   
            $sql_daire_bilgileri = "SELECT * FROM daire WHERE id = '$daire_id'";
            $daire = mysqli_query($db,$sql_daire_bilgileri);
            $row_daire = mysqli_fetch_assoc($daire);
            $apartman_id = $row_daire['ref_apartman_id'];
            $sql_apartman_bilgileri = "SELECT * FROM apartman WHERE id = '$apartman_id'";
            $apartman = mysqli_query($db,$sql_apartman_bilgileri);
            $row_apartman = mysqli_fetch_assoc($apartman);
            $site_id = $row_apartman['ref_site_id'];
            $sql_konum_bilgileri = "SELECT * FROM site,apartman,daire WHERE site.id = '$site_id'
            AND apartman.id = '$apartman_id' AND daire.id = '$daire_id'";
            $konum = mysqli_query($db,$sql_konum_bilgileri);
            $row_konum = mysqli_fetch_assoc($konum);
            array_push($konum_array,$row_konum);
   
        }
   
        if($_SESSION['daire_id'] == '' && $_SESSION['apartman_id'] == '' && $_SESSION['site_id'] == '') {
           $_SESSION['daire_id'] = $konum_array[0]['id'];
           $_SESSION['apartman_id'] = $konum_array[0]['ref_apartman_id'];
           $_SESSION['site_id'] = $konum_array[0]['ref_site_id'];
        }
   
    }
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
<!--[if IE 8]> 
<html lang="en" class="ie8 no-js">
   <![endif]-->
   <!--[if IE 9]> 
   <html lang="en" class="ie9 no-js">
      <![endif]-->
      <!--[if !IE]><!-->
      <html lang="en" class="no-js">
         <!--<![endif]-->
         <!-- BEGIN HEAD -->
         <head>
            <meta charset="utf-8"/>
            <title>Anasayfa</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1" name="viewport"/>
            <meta content="" name="description"/>
            <meta content="" name="author"/>
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
            <!-- END GLOBAL MANDATORY STYLES -->
            <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
            <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
            <!-- END PAGE LEVEL PLUGIN STYLES -->
            <!-- BEGIN PAGE STYLES -->
            <link href="assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
            <link href="assets/global/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"/>
            <!-- END PAGE STYLES -->
            <!-- BEGIN THEME STYLES -->
            <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
            <link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
            <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
            <link href="assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
            <link href="assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
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
            <?php $page='index';include('header.php'); ?>
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb hide">
               <li class="active">
                  Anasayfa
               </li>
            </ul>
            <div class = "row">
               <form action="daire_degistir.php" method="POST">
                  <div class="col-md-7">
                     <strong>Daire Değiştir-></strong>
                     <div class="form-group" style= "margin-top: 3%; width: 350px; display: inline-block;">
                        <select class="select2_category form-control" name = "ids" tabindex="1">
                           <?php
                              $daire_id = $_SESSION['daire_id'];
                              foreach ($konum_array as $value) {
                                  if($value['id'] == $daire_id) { ?>
                           <option value="<?php echo $value['id'];?>,<?php echo $value['ref_apartman_id'];?>,<?php echo $value['ref_site_id'];?>"selected>
                              <?php echo $value['city']." ".$value['state']." ".$value['name']." ".
                                 $value['number']." numaralı daire"?>
                           </option>
                           <?php }
                              else { ?>
                           <option value="<?php echo $value['id'];?>,<?php echo $value['ref_apartman_id'];?>,<?php echo $value['ref_site_id'];?>">
                              <?php echo $value['city']." ".$value['state']." ".$value['name']." ".
                                 $value['number']." numaralı daire"?>
                           </option>
                           <?php }
                              }?>
                        </select>
                     </div>
                     <div class="form-actions" style="display: inline-block; margin-left: 5%; margin-bottom: -1.5%">
                        <button type="submit" class="btn blue pull-right">
                        Git <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="portlet box green-meadow calendar">
                     <div class="portlet-title">
                        <div class="caption">
                           <i class="fa fa-calendar"></i>Takvim
                        </div>
                     </div>
                     <div class="portlet-body">
                        <div class="row">
                           <div class="col-md-3 col-sm-12">
                              <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                              <h3 class="event-form-title">Taşınabilir Etkinlikler</h3>
                              <div id="external-events">
                                 <form class="inline-form">
                                    <input type="text" value="" class="form-control" placeholder="Etkinlik Başlığı..." id="event_title"/><br/>
                                    <a href="javascript:;" id="event_add" class="btn default">
                                    Etkinlik Ekle </a>
                                 </form>
                                 <hr/>
                                 <div id="event_box">
                                 </div>
                                 <br />
                                 <label for="drop-remove">
                                 <input type="checkbox" id="drop-remove"/>Taşıdıktan sonra kutudan çıkar </label>
                                 <hr class="visible-xs"/>
                              </div>
                              <br />
                              * Aynı başlığa sahip etkinlikleri takvime birden fazla kez eklemek için sürükledikten sonra sayfanın yenilenmesini bekleyin...
                              <br />
                              <br />
                              ** Silmek istediğiniz etkinlik için takvimden etkinliğe sol tıklayın.
                              <br />
                              <br />
                              *** Geçmiş etkinlikler kırmızı, bugünün etkinlikleri sarı, ve gelecek etkinlikler yeşil renkle gösterilmiştir. Eğer takvimde hiç olmayan bir etkinlik eklerseniz mavi gözükür.
                              <!-- END DRAGGABLE EVENTS PORTLET-->
                           </div>
                           <div class="col-md-9 col-sm-12">
                              <div id="calendar" class="has-toolbar">
                              </div>
                           </div>
                        </div>
                        <!-- END CALENDAR PORTLET-->
                     </div>
                  </div>
               </div>
            </div>
            <div class = "row">
               <div class="col-md-4 col-sm-12">
                  <!-- BEGIN PORTLET-->
                  <div class="portlet light">
                     <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                           <i class="icon-globe theme-font-color hide"></i>
                           <span class="caption-subject theme-font-color bold uppercase">YAKLAŞMAKTA OLAN ETKİNLİKLER</span>
                           <br />
                           <span class="caption-subject">(10 gün içerisindeki etkinlikler)</span>
                           
                        </div>
                     </div>
                     <div class="portlet-body">
                        <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                           <ul class="feeds">
                            <?php 
                            $site_id_x = $_SESSION['site_id'];
                            $apartman_id_x = $_SESSION['apartman_id'];
                            $sql_etkinlikler = "SELECT * FROM beckdoor.etkinlik WHERE ref_apartman_id = '".$apartman_id_x."' AND ref_site_id = '".$site_id_x."' AND start_date IS NOT NULL";
                            $etkinlikler = array();
                            $result_x = $db->query($sql_etkinlikler);
                            if ($result_x->num_rows > 0) {
                                while($row = $result_x->fetch_assoc()) {
                                    array_push($etkinlikler, $row);
                                }
                            }
                            if(empty($etkinlikler)) { ?>
                               <li>
                                 <div class="col1">
                                    <div class="cont">
                                       <div class="desc">
                                            Yakın zamanda bir etkinlik gözükmüyor.
                                        </div>
                                    </div>
                                 </div>
                                </li> 
                            <?php }
                            else {
                            function sortFunction( $a, $b ) {
                                return strtotime($a["start_date"]) - strtotime($b["start_date"]);
                            }
                            usort($etkinlikler, "sortFunction");
                            $time = time();
                            $kontrol = strtotime($etkinlikler[count($etkinlikler)-1]['start_date']);
                            $x = $kontrol - $time;
                            $gün_kontrol = round($x / (60 * 60 * 24))+1;
                            if($gün_kontrol <= 0) { ?>
                                <li>
                                 <div class="col1">
                                    <div class="cont">
                                       <div class="desc">
                                            Yakın zamanda bir etkinlik gözükmüyor.
                                        </div>
                                    </div>
                                 </div>
                                </li> 
                            <?php } 
                            foreach ($etkinlikler as $etkinlik) { 
                                     $time_etkinlik = strtotime($etkinlik['start_date']);
                                     $datediff = $time_etkinlik - $time;
                                     $kalan_gün = round($datediff / (60 * 60 * 24))+1; 
                                     if(1 <= $kalan_gün && $kalan_gün <= 10) { ?>
                                 <li>
                                 <div class="col1">
                                    <div class="cont">
                                       <div class="cont-col1">
                                          <div class="label label-sm label-success">
                                             <i class="fa fa-bullhorn"></i>
                                          </div>
                                       </div>
                                       <div class="cont-col2">
                                          <div class="desc">
                                            <?php echo $etkinlik['description']; ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col2">
                                    <div class="date">
                                        <strong><?php echo $kalan_gün." gün sonra"; ?></strong>
                                    </div>
                                 </div>
                              </li>
                            <?php } 

                                }
                            } ?>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <!-- END PORTLET-->
               </div>
                <div class="col-md-4 col-sm-12">
                  <!-- BEGIN PORTLET-->
                  <div class="portlet light">
                     <div class="portlet-title">
                        <div class="caption caption-md">
                           <i class="icon-bar-chart theme-font-color hide"></i>
                           <a href="oylamalar.php" class="caption-subject theme-font-color bold uppercase"><i class="icon-bar-chart"></i>&nbsp; Oylamalar &nbsp;</a>
                        </div>
                     </div>
                     <div class="portlet-body">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 305px;">
                           <div class="scroller" style="height: 305px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
                              <div class="general-item-list">
                                 <?php
                                    $sql_oylama = "SELECT * FROM `oylama` ";
                                    $res = mysqli_query($db,$sql_oylama);
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $sql_toplamoy = "SELECT * FROM `oy` WHERE ref_oylama_id = ".$row['id'];
                                        mysqli_query($db,$sql_toplamoy);
                                        $toplamoy = mysqli_affected_rows($db);
                                    ?>
                                 <div class="item">
                                    <div class="item-head">
                                       <div class="item-details">
                                          <a href="" class="item-name primary-link"><?php echo $row['title']; ?></a>
                                          <span class="item-label"><?php echo $row['description']; ?></span>
                                          <cite> <?php echo "Kullanılan Oy: ".$toplamoy; ?> </cite>
                                       </div>
                                    </div>
                                    <div class="item-body">
                                       <br>
                                       <div class="progress">
                                          <?php
                                             $sql_oy_tipi = "SELECT * FROM `oy_tipi` WHERE ref_oylama_id = ".$row['id'];
                                             $innerres = mysqli_query($db,$sql_oy_tipi);
                                             $counter = 0;
                                             while($innerrow = mysqli_fetch_assoc($innerres))
                                             {
                                                 $sql_oy = "SELECT * FROM `oy` WHERE ref_oy_tipi_id = ". $innerrow['id'] . " AND ref_oylama_id = ".$row['id'];
                                                 mysqli_query($db,$sql_oy);
                                                 $sayi = mysqli_affected_rows($db);
                                                 if($sayi == 0)
                                                     $yuzde = 0;
                                                 else
                                                     $yuzde = (int)(($sayi/$toplamoy)*100);
                                                 if($counter%4 == 0)
                                                     $renk = "success";
                                                 else if($counter%4 == 1)
                                                     $renk = "warning";
                                                 else if($counter%4 == 2)
                                                     $renk = "danger";
                                                 else
                                                     $renk = "primary";
                                                 echo "<div class=\"progress-bar progress-bar-$renk\" style=\"width: $yuzde%\">
                                                         <label>%$yuzde ".$innerrow['description']."</label>
                                                       </div>";
                                                 $counter++;
                                             }
                                             ?>
                                       </div>
                                    </div>
                                 </div>
                                 <?php
                                    }
                                    ?>
                              </div>
                           </div>
                           <div class="slimScrollBar" style="background: rgb(215, 220, 226); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 305px;"></div>
                           <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
                        </div>
                     </div>
                  </div>
                  <!-- END PORTLET-->
               </div>
               <?php
                  $top_duyuru = 0;
                  $que = "SELECT * FROM duyuru ";
                  $rs = mysqli_query($db,$que);
                  
                  while ($b=mysqli_fetch_array($rs)){
                    $ref_site_id = $b['ref_site_id'];
                    $ref_user_id = $b['ref_user_id'];
                    $ref_apartman_id = $b['ref_apartman_id'];
                  
                    $sql2 = "SELECT * FROM user WHERE id = '$ref_user_id'";
                    $result = mysqli_query($db,$sql2);
                    $row = mysqli_fetch_assoc($result);
                  
                    if(($ref_site_id != 0)&&($ref_site_id == $_SESSION['site_id'])||($ref_apartman_id == $_SESSION['apartman_id'])){
                      $top_duyuru = $top_duyuru +1;
                    }
                  }
                  
                   ?>
               <div class="col-md-4 col-sm-12">
                  <!-- BEGIN PORTLET-->
                  <div class="portlet light">
                     <div class="portlet-title">
                        <div class="caption caption-md">
                           <i class="icon-bar-chart theme-font-color hide"></i>
                           <a href = "duyurular.php" class="caption-subject theme-font-color bold uppercase"><i class="icon-pin"></i> Duyurular&nbsp <?php echo $top_duyuru; ?></a>
                        </div>
                     </div>
                     <div class="portlet-body">
                        <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
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
                           <div class="general-item-list">
                              <div class="item">
                                 <div class="item-head">
                                    <div class="item-details">
                                       <img class="item-pic" src="<?php echo $image_path; ?>">
                                       <a href="" class="item-name primary-link"><?php echo $ref_username; ?></a>
                                       <span class="item-label"><?php echo $date; ?></span>
                                    </div>
                                 </div>
                                 <div class="item-body">
                                    <b>  <?php echo $title; ?></b>
                                    <div class="timeline-footer">
                                       <a href="duyuru_detaylari.php?id=<?php echo $duyuru_id; ?>" class="nav-link pull-right">
                                       Duyuru detaylarını gör <i class="fa fa-arrow-right"></i>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php }}}} ?>
                        </div>
                     </div>
                  </div>
                  <!-- END PORTLET-->
               </div>
            </div>
            <div class = "row">
               <div class="col-md-12 col-sm-12">
                  <!-- BEGIN PORTLET-->
                  <div class="portlet light ">
                     <div class="portlet-title">
                        <div class="caption caption-md">
                           <i class="icon-bar-chart theme-font-color hide"></i>
                           <span class="caption-subject theme-font-color bold uppercase">Sales Summary</span>
                           <span class="caption-helper hide">weekly stats...</span>
                        </div>
                        <div class="actions">
                           <div class="btn-group btn-group-devided" data-toggle="buttons">
                              <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                              <input type="radio" name="options" class="toggle" id="option1">Today</label>
                              <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                              <input type="radio" name="options" class="toggle" id="option2">Week</label>
                              <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                              <input type="radio" name="options" class="toggle" id="option2">Month</label>
                           </div>
                        </div>
                     </div>
                     <div class="portlet-body">
                        <div class="row list-separated">
                           <div class="col-md-3 col-sm-3 col-xs-6">
                              <div class="font-grey-mint font-sm">
                                 Total Sales
                              </div>
                              <div class="uppercase font-hg font-red-flamingo">
                                 13,760 <span class="font-lg font-grey-mint">$</span>
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-6">
                              <div class="font-grey-mint font-sm">
                                 Revenue
                              </div>
                              <div class="uppercase font-hg theme-font-color">
                                 4,760 <span class="font-lg font-grey-mint">$</span>
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-6">
                              <div class="font-grey-mint font-sm">
                                 Expenses
                              </div>
                              <div class="uppercase font-hg font-purple">
                                 11,760 <span class="font-lg font-grey-mint">$</span>
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-6">
                              <div class="font-grey-mint font-sm">
                                 Growth
                              </div>
                              <div class="uppercase font-hg font-blue-sharp">
                                 9,760 <span class="font-lg font-grey-mint">$</span>
                              </div>
                           </div>
                        </div>
                        <ul class="list-separated list-inline-xs hide">
                           <li>
                              <div class="font-grey-mint font-sm">
                                 Total Sales
                              </div>
                              <div class="uppercase font-hg font-red-flamingo">
                                 13,760 <span class="font-lg font-grey-mint">$</span>
                              </div>
                           </li>
                           <li>
                           </li>
                           <li class="border">
                              <div class="font-grey-mint font-sm">
                                 Revenue
                              </div>
                              <div class="uppercase font-hg theme-font-color">
                                 4,760 <span class="font-lg font-grey-mint">$</span>
                              </div>
                           </li>
                           <li class="divider">
                           </li>
                           <li>
                              <div class="font-grey-mint font-sm">
                                 Expenses
                              </div>
                              <div class="uppercase font-hg font-purple">
                                 11,760 <span class="font-lg font-grey-mint">$</span>
                              </div>
                           </li>
                           <li class="divider">
                           </li>
                           <li>
                              <div class="font-grey-mint font-sm">
                                 Growth
                              </div>
                              <div class="uppercase font-hg font-blue-sharp">
                                 9,760 <span class="font-lg font-grey-mint">$</span>
                              </div>
                           </li>
                        </ul>
                        <div id="sales_statistics" class="portlet-body-morris-fit morris-chart" style="height: 260px">
                        </div>
                     </div>
                  </div>
                  <!-- END PORTLET-->
               </div>
            </div>
           
            <div class="row">
               <div class="col-md-6 col-sm-6">
                  <!-- BEGIN REGIONAL STATS PORTLET-->
                  <div class="portlet light ">
                     <div class="portlet-title">
                        <div class="caption caption-md">
                           <i class="icon-bar-chart theme-font-color hide"></i>
                           <span class="caption-subject theme-font-color bold uppercase">Regional Stats</span>
                        </div>
                        <div class="actions">
                           <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                           <i class="icon-cloud-upload"></i>
                           </a>
                           <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                           <i class="icon-wrench"></i>
                           </a>
                           <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">
                           </a>
                           <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                           <i class="icon-trash"></i>
                           </a>
                        </div>
                     </div>
                     <div class="portlet-body">
                        <div id="region_statistics_loading">
                           <img src="assets/admin/layout/img/loading.gif" alt="loading"/>
                        </div>
                        <div id="region_statistics_content" class="display-none">
                           <div class="btn-toolbar margin-bottom-10">
                              <div class="btn-group btn-group-circle" data-toggle="buttons">
                                 <a href="" class="btn grey-salsa btn-sm active">
                                 Users </a>
                                 <a href="" class="btn grey-salsa btn-sm">
                                 Orders </a>
                              </div>
                              <div class="btn-group pull-right">
                                 <a href="" class="btn btn-circle grey-salsa btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                 Select Region <span class="fa fa-angle-down">
                                 </span>
                                 </a>
                                 <ul class="dropdown-menu pull-right">
                                    <li>
                                       <a href="javascript:;" id="regional_stat_world">
                                       World </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;" id="regional_stat_usa">
                                       USA </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;" id="regional_stat_europe">
                                       Europe </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;" id="regional_stat_russia">
                                       Russia </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;" id="regional_stat_germany">
                                       Germany </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div id="vmap_world" class="vmaps display-none">
                           </div>
                           <div id="vmap_usa" class="vmaps display-none">
                           </div>
                           <div id="vmap_europe" class="vmaps display-none">
                           </div>
                           <div id="vmap_russia" class="vmaps display-none">
                           </div>
                           <div id="vmap_germany" class="vmaps display-none">
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- END REGIONAL STATS PORTLET-->
               </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
            </div>
            </div>
            <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
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
            <script src="assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
            <script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
            <script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
            <script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
            <script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
            <script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
            <script src="assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
            <script src="assets/global/plugins/moment.min.js"></script>
            <script src="assets/global/plugins/fullcalendar/fullcalendar.js"></script>
            <script src="assets/global/plugins/fullcalendar/lang/tr.js"></script>
            <!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
            <script src="assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
            <script src="assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
            <script src="assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
            <script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
            <script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
            <script src="assets/admin/pages/scripts/index3.js" type="text/javascript"></script>
            <script src="assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
            <script src="assets/admin/pages/scripts/calendar.js"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <script>
               jQuery(document).ready(function() {
                   Metronic.init(); // init metronic core componets
                   Layout.init(); // init layout
                   Demo.init(); // init demo features
                   Index.init(); // init index page
                   Tasks.initDashboardWidget(); // init tash dashboard widget
               });
            </script>
            <script>
               jQuery(document).ready(function() {
                  // initiate layout and plugins
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                Demo.init(); // init demo features
                Calendar.init();
               });
            </script>
            <!-- END JAVASCRIPTS -->
         </body>
         <!-- END BODY -->
      </html>
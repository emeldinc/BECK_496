<?php
if(session_id() == '') {
    session_start();
  }
$que = "SELECT * FROM duyuru ";
$rs = mysqli_query($db,$que);
$notification_top = 0;
$title_arr = array();
$date_arr = array();
$index = 0;
while ($a=mysqli_fetch_array($rs)){
  $ref_site_id = $a['ref_site_id'];
  $ref_user_id = $a['ref_user_id'];
  $ref_apartman_id = $a['ref_apartman_id'];

  $sql2 = "SELECT * FROM user WHERE id = '$ref_user_id'";
  $result = mysqli_query($db,$sql2);
  $row = mysqli_fetch_assoc($result);
  $date = $a['now_date'];
  date_default_timezone_set('Europe/Istanbul');
  $now = date('Y-m-d H:i:s');
  $duyuru_date = strtotime($a['now_date']);
  $diff = abs(strtotime($now) - $duyuru_date);

  if($diff < 86400){

    $date_time = 0;
    $minute = floor($diff / 60);
    $hour = floor($minute / 60);

    if($hour > 0){
      $date_time = "$hour saat önce";
    }
    else{
      $date_time = "$minute dk önce";
    }
    if(($ref_site_id != 0)&&($ref_site_id == $_SESSION['site_id'])||($ref_apartman_id == $_SESSION['apartman_id'])){
      $notification_top = $notification_top +1;
      $title_arr[$index] = $a['title'];
      $date_arr[$index] = $date_time;
      $index = $index +1;

    }
  }
}
echo $notification_top;
$index = $notification_top - 1;

$sql_for_events = "SELECT * FROM etkinlik WHERE ref_apartman_id = '".$_SESSION['apartman_id']."' AND ref_site_id = '".$_SESSION['site_id']."'";
$events_arr = array();
$events = mysqli_query($db,$sql_for_events);
while($event_row = mysqli_fetch_assoc($events)) {
  array_push($events_arr,$event_row);
}




?>
<!-- BEGIN HEADER -->
      <div class="page-header navbar navbar-fixed-top">
         <!-- BEGIN HEADER INNER -->
         <div class="page-header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
               <a href="index.php">
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
               <form class="search-form" action="search.php" method="GET">
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
                        <?php echo $notification_top; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="external">
                              <h3><span class="bold">24 saat içerisindeki </span> duyurular</h3>
                              <a href="duyurular.php">view all</a>
                           </li>

                           <li>
                              <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <?php
                                while($index > -1 ){

                                 ?>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time"><?php echo $date_arr[$index]; ?></span>
                                    <span class="details">
                                    <span class="label label-sm label-icon label-warning">
                                    <i class="fa fa-bell-o"></i>
                                    </span>
                                  <?php echo $title_arr[$index]; ?> </span>
                                    </a>
                                 </li>
                                   <?php $index = $index -1;} ?>
                              </ul>
                           </li>

                        </ul>
                     </li>

                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-calendar"></i>

                        </a>
                        <ul class="dropdown-menu">
                           <li class="external">
                              <h3><span class="bold">Tamamlanan etkinlikler </span> </h3>

                           </li>

                           <li>
                              <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <?php
                                function sortFunctionE( $a, $b ) {
                                  return strtotime($b["start_date"]) - strtotime($a["start_date"]);
                                }
                                usort($events_arr, "sortFunctionE");
                                foreach($events_arr as $event) {
                                if(strtotime($event["start_date"]) < strtotime("now")) { ?>
                                 <li>
                                    <a href="javascript:;">
                                    <span class="time"><?php echo $event['start_date']; ?></span>
                                    <span class="details">
                                    <span class="label label-sm label-success">Tamamlandı</span>
                                    </span>
                                    <?php echo $event['description']; ?> </span>
                                    </a>
                                 </li>
                                <?php
                                  }
                                } ?>
                              </ul>
                           </li>

                        </ul>
                     </li>

                     <!-- END NOTIFICATION DROPDOWN -->
                     <li class="separator hide">
                     </li>
                     <!-- BEGIN INBOX DROPDOWN -->
                     <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                     <li onmouseover = "reset_count();" class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-envelope-open"></i>
                        <span id = "count2" class="badge badge-danger">
                        </span>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="external">
                              <h3><span class="bold"></span>yeni mesajlar</h3>
                              <a href="mesajlar.php">hepsini göster</a>
                           </li>
                           
                           <li>
                              <ul id ="messages" class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                  
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <!-- END INBOX DROPDOWN -->
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
                    <li class="<?php if($page == 'index'){ echo 'active';} ?>">
                        <a href="index.php">
                            <i class="icon-home"></i>
                            <span class="title">Anasayfa</span>
                        </a>
                    </li>
                    <li class="<?php if($page == 'mesajlar'){ echo 'active';} ?>">
                        <a href="mesajlar.php">
                            <i class="icon-envelope"></i>
                            <span class="title">Mesajlar</span>

                        </a>
                    </li>
                    <li class="<?php if($page == 'duyurular'){ echo 'active';} ?>">
                        <a href="duyurular.php">
                            <i class="icon-pin"></i>
                            <span class="title">Duyurular</span>

                        </a>
                    </li>
                    <li class="<?php if($page == 'oylamalar'){ echo 'active';} ?>">
                        <a href="oylamalar.php">
                            <i class="icon-bar-chart"></i>
                            <span class="title">Oylamalar</span>
                        </a>
                    </li>
                    <li class="<?php if($page == 'aidat_takip'){ echo 'active';} ?>">
                        <a href="aidat_takip_sayfasi.php">
                            <i class="icon-wallet"></i>
                            <span class="title">Aidat Takibi</span>
                        </a>
                    </li>


                   <li>
                       <a href="yeni_ev_kayit.php">
                       <i class="icon-settings"></i>
                       <span class="title">Adres Ekle</span></a>
                   </li>
                   <li class = "<?php if($page == 'rol_degistir'){ echo 'active';} ?>">
                       <a href="role_degistir.php">
                       <i class="icon-pencil"></i>
                       <span class="title">Rol Değiştir</span></a>
                   </li>


                    <li class="<?php if($page == 'hakkimizda'){ echo 'active';} ?>">
                        <a href="hakkimizda.php">
                            <i class="icon-users"></i>
                            <span class="title">Hakkımızda</span>
                        </a>
                    </li>
                    <li class="<?php if($page == 'yardim'){ echo 'active';} ?>">
                        <a href="yardim.php">
                            <i class="icon-info"></i>
                            <span class="title">Yardım</span>
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

<script type="text/javascript">
  var _startCount = 0;
  var count = 0;
  document.getElementById("count2").innerHTML = _startCount;

  function reset_count() {
    count = 0;
  }

  setInterval(function(){
    var date = new Date();
    MyDateString = ('0' + date.getDate()).slice(-2) + '-'
       + ('0' + (date.getMonth()+1)).slice(-2) + '-'
       + date.getFullYear();
      $.ajax({
        url: "mesaj_getir.php?date="+date.toLocaleString(),
        type: 'POST',
        success: function(result) {
          var messages = $.parseJSON(result);
          count = count + messages.length;
          document.getElementById("count2").innerHTML = count;
          
          $.each( messages, function( key, value ) {
            var message = '';
            message += '<li>';
            message += '<a href="javascript:;">';
            message += '<span class="details">';
            message += '<span class="label label-sm label-success">'+value['username']+'</span>';
            message += '</span>';
            if(value['content'].length > 32) {
              message +=  '<span>'+" "+value['content'].substring(0,32)+"..."+'</span>';
            }
            else { 
              message +=  '<span>'+" "+value['content']+'</span>';
            }
            message += '</a>';
            message += '</li>';
           $("#messages").append(message);
          }); 
        }
      });
  }, 5000);
</script>

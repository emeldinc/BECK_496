<?php
session_start();
include('dbconnection.php');

$sql_messages = "SELECT * FROM mesaj WHERE 
      mesaj.ref_site_id = '".$_SESSION['site_id']."'
      AND mesaj.ref_apartman_id = '".$_SESSION['apartman_id']."'";

$sql_adres = "SELECT * FROM apartman,site WHERE
      apartman.id = '".$_SESSION['apartman_id']."'
      AND site.id = '".$_SESSION['site_id']."'";

$result_adres = $db->query($sql_adres);
$row_adres = $result_adres->fetch_assoc();

$result_message = $db->query($sql_messages);
$message_arr = array();
if ($result_message->num_rows > 0) {
    while($row_message = $result_message->fetch_assoc()) {
        array_push($message_arr,$row_message);
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
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Mesajlar</title>
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
    <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
    <link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
    <link href="assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/pages/css/timeline.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/pages/css/todo.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    <style>
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: black !important;
            opacity: 1; /* Firefox */
        }
    </style>
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
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-sidebar-fixed page-sidebar-closed-hide-logo">
<?php $page='mesajlar';include('header.php'); ?>

<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="index.php">Anasayfa</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="mesajlar.php">Mesajlar</a>
    </li>
</ul>

<div class="portlet box blue tabbable">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-send"></i>
            Chatroom <?php echo $row_adres['city']." ".$row_adres['state']." ".$row_adres['name']." ".$row_adres['number']; ?>
        </div>
    </div>
    <div class="portlet-body">
        <div class="page-quick-sidebar-wrapper" style = "height:600px !important;">
            <div class="page-quick-sidebar">
                <div class="page-quick-sidebar-chat">
                    <div class="page-quick-sidebar-item">
                        <div class="page-quick-sidebar-chat-user">
                            <div class="page-quick-sidebar-chat-user-messages">
                                <?php foreach($message_arr as $message) {
                                    $time = strtotime($message['date']);
                                    $newformat = date('d-m-Y H:i',$time); ?>
                                    <div class="post out">
                                        <!--<img class="avatar" alt="" src="../../assets/admin/layout/img/avatar3.jpg"/> -->
                                        <div class="message">
                                            <span class="arrow"></span>
                                            <strong class="name"><?php echo $message['username']; ?></strong>
                                            <strong class="datetime"><?php echo $newformat; ?></strong>
                                            <span class="body">
											 <?php echo $message['content']; ?> </span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="page-quick-sidebar-chat-user-form">
                                <div class="input-group">
                                    <input style = "background-color: #D1D2D3; fo" type="text" class="form-control" placeholder="Mesajınızı buraya yazın...">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn blue"><i class="icon-paper-clip"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





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
<!-- BEGIN PAGE PLUGINS & SCRIPTS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script src="assets/admin/pages/scripts/todo.js" type="text/javascript"></script>
<!-- END PAGE PLUGINS & SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/timeline.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        Todo.init(); // init todo page
        Timeline.init(); // init timeline page
    });
    var QuickSidebar = function () {
        var size = '<?php echo count($message_arr); ?>';
        // Handles quick sidebar chats
        var handleQuickSidebarChat = function () {
            var wrapper = $('.page-quick-sidebar-wrapper');
            var wrapperChat = wrapper.find('.page-quick-sidebar-chat');

            var initChatSlimScroll = function () {
                var chatUsers = wrapper.find('.page-quick-sidebar-chat-users');
                var chatUsersHeight;

                chatUsersHeight = wrapper.height() - wrapper.find('.nav-justified > .nav-tabs').outerHeight();

                // chat user list
                Metronic.destroySlimScroll(chatUsers);
                chatUsers.attr("data-height", chatUsersHeight);
                Metronic.initSlimScroll(chatUsers);

                var chatMessages = wrapperChat.find('.page-quick-sidebar-chat-user-messages');
                var chatMessagesHeight = chatUsersHeight - wrapperChat.find('.page-quick-sidebar-chat-user-form').outerHeight() - wrapperChat.find('.page-quick-sidebar-nav').outerHeight();

                // user chat messages
                Metronic.destroySlimScroll(chatMessages);
                chatMessages.attr("data-height", chatMessagesHeight);
                Metronic.initSlimScroll(chatMessages);
            };

            initChatSlimScroll();
            Metronic.addResizeHandler(initChatSlimScroll); // reinitialize on window resize

            wrapper.find('.page-quick-sidebar-chat-users .media-list > .media').click(function () {
                wrapperChat.addClass("page-quick-sidebar-content-item-shown");
            });

            wrapper.find('.page-quick-sidebar-chat-user .page-quick-sidebar-back-to-list').click(function () {
                wrapperChat.removeClass("page-quick-sidebar-content-item-shown");
            });
            var chatContainer = wrapperChat.find(".page-quick-sidebar-chat-user-messages");
            var getLastPostPos = function() {
                var height = 0;
                chatContainer.find(".post").each(function() {
                    height = height + $(this).outerHeight();
                });

                return height;
            };
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
                        $.each( messages, function( key, value ) {
                            var message = '';
                            message += '<div class="post '+ 'out' +'">';
                            message += '<div class="message">';
                            message += '<span class="arrow"></span>';
                            message += '<strong class="name">'+value['username']+'</strong>&nbsp;';
                            message += '<strong class="datetime">' + (MyDateString+" "+('0' + (date.getHours())).slice(-2) + ':' + ('0' + (date.getMinutes())).slice(-2)) + '</strong>';
                            message += '<span class="body">';
                            message += " "+value['content'];
                            message += '</span>';
                            message += '</div>';
                            message += '</div>';
                            message = $(message);
                            chatContainer.append(message);
                            chatContainer.slimScroll({
                                scrollTo: getLastPostPos()
                            });
                        });
                    }
                });
            }, 5000);

            var handleChatMessagePost = function (e) {
                e.preventDefault();


                var input = wrapperChat.find('.page-quick-sidebar-chat-user-form .form-control');

                var text = input.val();
                if (text.length === 0) {
                    return;
                }

                var preparePost = function(dir, time, name, message) {
                    var tpl = '';
                    tpl += '<div class="post '+ dir +'">';
                    tpl += '<div class="message">';
                    tpl += '<span class="arrow"></span>';
                    tpl += '<strong class="name">'+name+'</strong>&nbsp;';
                    tpl += '<strong class="datetime">' + time + '</strong>';
                    tpl += '<span class="body">';
                    tpl += " "+message;
                    tpl += '</span>';
                    tpl += '</div>';
                    tpl += '</div>';
                    return tpl;
                };



                var  username = '<?php echo $username; ?>';
                var time = new Date();
                MyDateString = ('0' + time.getDate()).slice(-2) + '-'
                    + ('0' + (time.getMonth()+1)).slice(-2) + '-'
                    + time.getFullYear();
                var message = preparePost('out', (MyDateString+" "+('0' + (time.getHours())).slice(-2) + ':' + ('0' + (time.getMinutes())).slice(-2)), username, text);
                message = $(message);
                chatContainer.append(message);
                $.ajax({
                    url: "mesaj_ekle.php?sender="+username+"&date="+time.toLocaleString()+"&content="+text,
                    type: 'POST',
                    success: function(result) {}
                });


                chatContainer.slimScroll({
                    scrollTo: getLastPostPos()
                });

                input.val("");

            };

            wrapperChat.find('.page-quick-sidebar-chat-user-form .btn').click(handleChatMessagePost);
            wrapperChat.find('.page-quick-sidebar-chat-user-form .form-control').keypress(function (e) {
                if (e.which == 13) {
                    handleChatMessagePost(e);
                    return false;
                }
            });
        };


        return {

            init: function () {

                handleQuickSidebarChat(); // handles quick sidebar's chats

            }
        };

    }();
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

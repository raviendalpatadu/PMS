<?php
require_once '../../control/config.php';
$template = new template();
?>

<!DOCTYPE html>
<html lang="en">

<!--<head>-->
<?php $template->getHead(); ?>
<link rel="stylesheet" href="../../../lib/css/fullcalendar.css">
<!--</head>-->

<body>
<div class="loader"></div>

    <!--<header>-->
    <?php $template->getHeader(); ?>
    <!--</header>-->

    <!--<Sidebar menu>-->
    <?php $template->getSidebar(); ?>
    <!--</Sidebar>-->



    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"></div>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <h1>Calendar</h1>
                    <div class="widget-box widget-calendar">
                        <!-- <div class="widget-content"> -->
                        <div class="panel-left">
                            <div id="fullcalendar"></div>
                            <!-- </div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--Footer-part-->
        <?php $template->getFooter(); ?>
        <!--Script-part-->
        <?php $template->getScript(); ?>
        <?php $template->getDataTables(); ?>
        <script src="../../../lib/js/fullcalendar.min.js"></script>
        <script>
            $(document).ready(function() {

                $('#fullcalendar').fullCalendar({
                    eventLimit: true,
                    editable: false,
                    themeSystem: 'bootstrap',
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },
                    // height: 475,
                    // eventClick: function(event) {
                    //     console.log(event.caseId);
                    //     console.log(event.clientId);
                    //     var caseId = event.caseId;
                    //     var clientId = event.clientId;
                    //     window.location.replace("caseupdate.php?clientId=" + clientId + "&caseId=" + caseId + "&resultTemplate=single&caseType=" + event.description + "&from=calender");
                    // },
                    // eventMouseover: function(calEvent, jsEvent) {
                    //     var tooltip = '<div class="tooltipevent" style="width:auto;height:auto;background:#17a2b8;color:white;font-weight:bold;padding:5px;border-radius:15px;position:absolute;z-index:10001;">' + calEvent.description + '</div>';
                    //     var $tooltip = $(tooltip).appendTo('body');

                    //     $(this).mouseover(function(e) {
                    //         $(this).css('z-index', 10000);
                    //         $tooltip.fadeIn('500');
                    //         $tooltip.fadeTo('10', 1.9);
                    //     }).mousemove(function(e) {
                    //         $tooltip.css('top', e.pageY + 10);
                    //         $tooltip.css('left', e.pageX + 20);
                    //     });
                    // },

                    // eventMouseout: function(calEvent, jsEvent) {
                    //     $(this).css('z-index', 8);
                    //     $('.tooltipevent').remove();
                    // },

                    eventSources: [

                        // your event source
                        {
                            url: '../../model/userMgt/_calendar.php', // use the `url` property
                        }

                        // any other sources...

                    ]
                });

            });
        </script>
<?php $template->alertDate($_SESSION['login_type']); ?>
        

</body>

</html>
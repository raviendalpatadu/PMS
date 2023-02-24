<?php
require_once '../../control/config.php';
$template = new template();
?>


<!DOCTYPE html>
<html lang="en">

<!--<head>-->
<link rel="stylesheet" href="../../../lib/css/daterangepicker.css">
<?php $template->getHead(); ?>
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
            <h3>Sales</h3>
            <!-- graph -->
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                            <h5>Sales Quantity</h5>

                            <div id="reportrange" style="background: transparent; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: auto; float:right;">
                                <i class="icon-calendar"></i>&nbsp;
                                <span id="dat"> </span><i class="icon-sort-down" style="float: right;"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <canvas id="lineChart" style="width: 100%; height:250px;"></canvas>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                            <h5>Sales Quantity</h5>

                            <div id="reportrange" style="background: transparent; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: auto; float:right;">
                                <i class="icon-calendar"></i>&nbsp;
                                <span id="datt"> </span><i class="icon-sort-down" style="float: right;"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <canvas id="pieChart" style="width: 100%; height:250px;"></canvas>

                        </div>
                    </div>
                </div>
            </div>

            <!-- table -->
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Sales</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>

                                        <th>Drug Name</th>
                                        <th>Sales Date</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = 'SELECT * from tbl_sales, tbl_drug WHERE tbl_sales.sales_drugId = tbl_drug.drug_id ORDER BY sales_date Asc ';
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute(array());
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr class="gradeX">

                                            <td><?php echo $row['drug_name']; ?></td>
                                            <td><?php echo $row['sales_date']; ?></td>
                                            <td><?php echo $row['sales_quantity']; ?></td>
                                            <td>Rs.<?php echo $row['sales_price']; ?> </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
    <?php $template->alertDate($_SESSION['login_type']); ?>
    <script src="../../../lib/js/Chart.js"></script>
    <script src="../../../lib/js/daterangepicker.js"></script>

    <script>
        $(document).ready(function() {

            // datepicker
            var myChart;

            function chart(xNames, data) {
                var ctx = $('#lineChart').get(0).getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: xNames,
                        datasets: [{
                            label: 'Sales Quantity',
                            data: data.bar,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Chart.js Stacked Line/Bar Chart'
                            }
                        },
                        scales: {
                            y: {
                                stacked: true
                            }
                        }
                    },
                });

                var ctx = $('#pieChart').get(0).getContext('2d');
                pieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.pie.name,
                        datasets: [{
                            label: 'My First Dataset',
                            data: data.pie.qty,
                            backgroundColor: data.pie.colour,
                            hoverOffset: 4
                        }]
                    }
                });
            }

            $(function() {

                var start = moment();
                var end = moment().subtract(6, 'days');

                function cb(start, end) {

                    $('#dat, #datt').html(start.format('Do MMMM YYYY') + ' - ' + end.format('Do MMMM YYYY'));

                    $('#dat, #datt').on('apply.daterangepicker', function(event, picker) {
                        event.stopImmediatePropagation();
                        var fDate = picker.startDate.format('YYYY-MM-DD');
                        var eDate = picker.endDate.format('YYYY-MM-DD');
                        $.ajax({
                            type: "POST",
                            url: "../../model/userMgt/_salesChart.php",
                            data: {
                                pie: 'pie',
                                startdate: fDate,
                                enddate: eDate,
                            },
                            success: function(data, status) {
                                var data = JSON.parse(data);
                                console.log(data)
                                var xNames = [];
                                fDate = moment(fDate);
                                eDate = moment(eDate);
                                console.log('f' + fDate.format('YYYY-MM-DD'));
                                console.log('e' + eDate.format('YYYY-MM-DD'));
                                if (fDate.format('YYYY-MM-DD') == eDate.format('YYYY-MM-DD')) {
                                    xNames.push(picker.startDate.format('dddd'));
                                } else {
                                    while (fDate <= eDate) {
                                        xNames.push(fDate.format('DD-MMM-YYYY'));
                                        fDate = moment(fDate).clone().add(1, 'days');
                                        fDate = moment(fDate);
                                    }
                                }
                                console.log(xNames)
                                // var delayed;
                                myChart.destroy();
                                pieChart.destroy();
                                $('#lineChart').css({
                                    "width": "100%",
                                    "height": "250px"
                                });
                                chart(xNames, data);
                            }
                        });
                    });
                }

                $('#dat, #datt').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    drops: 'down',
                    linkedCalendars: false
                }, cb);

                cb(start, end);
            });

            
            // chart
            $.ajax({
                type: "POST",
                url: "../../model/userMgt/_salesChart.php",
                data: {
                    "bar": 'bar',
                    "pie":'pie'
                },

                success: function(data) {
                    var data = JSON.parse(data);
                    var startOfWeek = moment();
                    var endOfWeek = moment().subtract(6, 'days');
                    console.log(data);
                    var xNames = [];
                    while (startOfWeek >= endOfWeek) {
                        xNames.push(endOfWeek.format("dddd"));
                        endOfWeek = endOfWeek.clone().add(1, 'd');
                    }
                    // var delayed;
                    chart(xNames, data);
                }
            });


        });
    </script>



</body>

</html>
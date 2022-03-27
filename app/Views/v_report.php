<html style="height: auto; min-height: 100%;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Scrumification</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="https://se.buu.ac.th/gami_ossd/assets/dist/img/logo.svg">
    <link rel="stylesheet" href="<?= base_url() . "/assets/theme/css/theme.min.css"?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://se.buu.ac.th/gami_ossd/assets/dist/css/KanitPrompt.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@300&amp;display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />

    <style>
        * {
            font-family: 'Kanit', sans-serif !important;
        }

        .container {
            max-width: 100%;
        }

        .chart {
            height: 100%;
        }

        .con_chart {
            padding: 20px;
            margin: 50px;
            box-shadow: 1px 1px 5px 3px rgba(100, 100, 100, 0.2);
        }

        .con_chart>* {
            font-family: 'Bai Jamjuree', sans-serif !important;
        }

        tspan {
            font-weight: bold;
        }

        #profile_image {
            border-radius: 50%;
        }

        nav.fluid-container {
            background-color: white !important;
            box-shadow: 1px 1px 5px 3px rgba(100, 100, 100, 0.2);
        }

        .bi-box-arrow-right {
            font-weight: bold;
            display: none;
        }

        @media (max-width: 500px) {
            .info {
                font-size: 12px;
            }

            .btn-logout {
                padding: 0px;
                width: 40% !important;
            }

            .btn {
                font-size: 5px;
            }

            #profile_image {
                display: none;
            }

            .info_usr {
                margin-top: 5px;
                margin-left: 10px;
                width: 60% !important;
            }

            .logo_sys a {
                display: none;
            }
        }
    </style>

</head>

<body class="skin-blue sidebar-mini /*sidebar-collapse*/" style="height: auto; min-height: 100%;">
    <main class="main" id="top">
        <nav class="fluid-container sticky-top p-2">
            <div class="d-flex justify-content-between">
                <div class="logo_sys">
                    <img class="me-3" src="<?= base_url() . "/assets/img/logo.png" ?>" style="width: 45px">
                    <a href="<?= base_url() . "/report" ?>">ระบบโหวต</a>
                </div>

                <div class="info">
                    <a class="me-2" href="<?php echo base_url() . '/User_manage'?>">จัดการผู้ใช้</a>
                    <a class="me-2" href="<?php echo base_url() . '/report'?>">ผลการโหวต</a>
                    <img src="https://dummyimage.com/40x40/000/fff" id="profile_image">
                    <span class="ms-2 info_usr"><?= $_SESSION["usr_full_name"]?></span>
                    <a class="btn-logout ms-2 btn btn-outline-danger waves-effect" style="font-weight: bold;" href="<?= base_url() . "/logout" ?>">Log out</a>
                </div>
            </div>
        </nav>
        <div class="con_chart">
            <div id="chart"></div>
        </div>
    </main>
    <!-- highcharts -->
    <!-- <script src="https://se.buu.ac.th/gami_ossd/assets/dist/js/highcharts.js"></script> -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- Pusher -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script src="<?= base_url() . "/assets/vendors/bootstrap/bootstrap.min.js"?>"></script>
    <script src="<?= base_url() . "/assets/vendors/is/is.min.js"?>"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?= base_url() . "/assets/theme/js/theme.js"?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">

    <script>
    var h_screen = $(window).height() - 200;
    var gold_url = "<?= base_url() . "/assets/img/gold_crown.png"?>"
    var sliver_url = "<?= base_url() . "/assets/img/sliver_crown.png"?>"
    var bronze_url = "<?= base_url() . "/assets/img/broezn_crown.png"?>"
    var default_formatter = {
        enabled: true,
        useHTML: true,
        verticalAlign: 'top',
        crop: false,
        overflow: 'none',
        x: 0,
        y: -40,
        formatter: function() {
            return '<div style="text-align: center;" class="tooltip-title-font"><br>' + this.y + '</div>'
        }
    }

    var gold_formatter = {
        enabled: true,
        useHTML: true,
        y: -70,
        formatter: function() {
            return '<div style="text-align: center;" class="tooltip-title-font"><img width="45px"  src="' + gold_url + '"></img><br>' + this.y + '</div>'
        }
    }

    var sliver_formatter = {
        enabled: true,
        useHTML: true,
        y: -70,
        formatter: function() {
            return '<div style="text-align: center;" class="tooltip-title-font"><img width="45px"  src="' + sliver_url + '"></img><br>' + this.y + '</div>'
        }
    }

    var bronze_formatter = {
        enabled: true,
        useHTML: true,
        y: -70,
        formatter: function() {
            return '<div style="text-align: center;" class="tooltip-title-font"><img width="45px"  src="' + bronze_url + '"></img><br>' + this.y + '</div>'
        }
    }

    // Set data bar chart
    var data_bar_chart = [{
        name: "คะแนน ",
        showInLegend: false,
        dataLabels: default_formatter,
        data: [{
                y: <?php echo $cluster[0]->cst_total_score ?>
            },
            {
                y: <?php echo $cluster[1]->cst_total_score ?>
            },
            {
                y: <?php echo $cluster[2]->cst_total_score ?>
            },
            {
                y: <?php echo $cluster[3]->cst_total_score ?>
            },
            {
                y: <?php echo $cluster[4]->cst_total_score ?>
            },
            {
                y: <?php echo $cluster[5]->cst_total_score ?>
            },
            {
                y: <?php echo $cluster[6]->cst_total_score ?>
            },
            {
                y: <?php echo $cluster[7]->cst_total_score ?>
            },
            {
                y: <?php echo $cluster[8]->cst_total_score ?>
            }
        ]
    }];

    // Set bar char
    var bar_chart = Highcharts.chart('chart', {
        chart: {
            height: h_screen,
            type: 'column'
        },
        title: {
            text: 'Open Source Software Developers Camp #10'
        },
        xAxis: {
            categories: [
                'มกุล 0',
                'มกุล 1',
                'มกุล 2',
                'มกุล 3 & 9',
                'มกุล 4',
                'มกุล 5',
                'มกุล 6',
                'มกุล 7',
                'มกุล 8',
            ],
            labels: {
                useHTML: true,
                formatter: function() {
                    return '<img src="https://se.buu.ac.th/gami_ossd/assets/dist/img/cluster/cluster' + this.value.substring(this.value.length - 1) + '.png" style="width: 30px; vertical-align: middle" /><span style="font-size:14px;font-weight:700"> ' + this.value + '</span>';
                }
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'คะแนน'
            },
        },
        tooltip: {
            headerFormat: '<span style="font-size:20px; padding: 10px">{point.key}</span><table style="width: 120px">',
            pointFormat: '<tr><td style="background-color: white;color:{series.color};padding:10;">{series.name}<br><b>{point.y}</b> </td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: data_bar_chart,
    });
    // Highcharts.setOptions({
    var colors = ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'];
    // });


    function findIndicesOfMax(inp, count) {
        var outp = new Array();
        for (var i = 0; i < inp.length; i++) {
            outp.push(i);
            if (outp.length > count) {
                outp.sort(function(a, b) {
                    return inp[b].y - inp[a].y;
                });
                outp.pop();
            }
        }
        return outp;
    }

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher1 = new Pusher('b485b70127147958e1fa', {
        cluster: 'ap1'
    });

    var channel = pusher1.subscribe('pusher_score');
    channel.bind('up_score', function(data) {
        for (var i = 0; i < data.length; i++) {
            data_bar_chart[0].data[i].y += Number(data[i]);
            data_bar_chart[0].data[i].dataLabels = '';
        }
        rated();
        // rated(data);
    });

    var pusher2 = new Pusher('e07bc6c3ee7696ad0104', {
        cluster: 'ap1'
    });

    var channel = pusher2.subscribe('pusher_score');
    channel.bind('up_score', function(data) {
        for (var i = 0; i < data.length; i++) {
            data_bar_chart[0].data[i].y += Number(data[i]);
            data_bar_chart[0].data[i].dataLabels = '';
        }
        rated();
    });


    function rated() {

        var indices = findIndicesOfMax(data_bar_chart[0].data, 3);

        data_bar_chart[0].data[indices[0]].dataLabels = gold_formatter;

        data_bar_chart[0].data[indices[1]].dataLabels = sliver_formatter;

        data_bar_chart[0].data[indices[2]].dataLabels = bronze_formatter;

        bar_chart.update({
            series: data_bar_chart
        });
    }

    $(document).ready(function() {
        data_bar_chart[0].data[0].color = '#058DC7';
        data_bar_chart[0].data[1].color = '#50B432';
        data_bar_chart[0].data[2].color = '#ED561B';
        data_bar_chart[0].data[3].color = '#CD0000';
        data_bar_chart[0].data[4].color = '#24CBE5';
        data_bar_chart[0].data[5].color = '#FFA500';
        data_bar_chart[0].data[6].color = '#8B658B';
        data_bar_chart[0].data[7].color = '#FFF263';
        data_bar_chart[0].data[8].color = '#6AF9C4';

        rated();

        bar_chart.update({
            series: data_bar_chart
        });
    });
    </script>
    </section>
    </div>

    </div>
</body>

</html>
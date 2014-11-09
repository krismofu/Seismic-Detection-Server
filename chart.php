<?php
/*
require_once('DB_Functions.php');

$db = new DB_Functions();

$result = $db->queryAll();

echo '<pre>';
     
     while ($row = mysql_fetch_assoc($result)) {
              print_r($row);
     }


echo '</pre>';
*/
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script src="../<?php echo basename(__DIR__); ?>/assets/js/jquery-1.11.1.min.js"></script>
        <script src="../<?php echo basename(__DIR__); ?>/assets/js/highstock.js"></script>
        <script src="../<?php echo basename(__DIR__); ?>/assets/js/exporting.js"></script>

        <style type="text/css">
            ${demo.css}
        </style>
        
        <script type="text/javascript">
            $(function () {

                Highcharts.setOptions({
                    global : {
                        useUTC : false
                    }
                });

                // Create the chart
                $('#container').highcharts('StockChart', {
                    chart : {
                        events : {
                            load : function() {
                                // set up the updating of the chart each second
                                var series = this.series[0];
                                var series2 = this.series[1];
                                var series3 = this.series[2];
                                var series4 = this.series[3];
                                setInterval(function() {
                                    var x = (new Date()).getTime(), // current time
                                        y = Math.random();
                                        z = Math.random();
                                        a = Math.random();
                                    series.addPoint([x, a], false, true);
                                    series2.addPoint([x, a], true, true);
                                    series3.addPoint([x, a], true, true);
                                    series4.addPoint([x, a], true, true);
                                }, 1000);
                            }
                        }
                    },

                    rangeSelector: {
                        buttons: [{
                            count: 1,
                            type: 'minute',
                            text: '1M'
                        }, {
                            count: 5,
                            type: 'minute',
                            text: '5M'
                        }, {
                            type: 'all',
                            text: 'All'
                        }],
                        inputEnabled: false,
                        selected: 0
                    },

                    title : {
                        text : 'Live random data'
                    },

                    exporting: {
                        enabled: false
                    },


                    legend: {
                        enabled: true
                    },

                    series: [{
                                name: 'Random data 1',
                                data: (function() {
                                    // generate an array of random data
                                    var data = [],
                                        time = (new Date()).getTime(),
                                        i;
                 
                                    for (i = -19; i <= 0; i++) {
                                        data.push({
                                            x: time + i * 1000,
                                            y: 0
                                        });
                                    }
                                    return data;
                                })()
                             },
                             {
                                name: 'Random data 2',
                                data: (function() {
                                    // generate an array of random data
                                    var data = [],
                                        time = (new Date()).getTime(),
                                        i;
                 
                                    for (i = -19; i <= 0; i++) {
                                        data.push({
                                            x: time + i * 1000,
                                            y: 0
                                        });
                                    }
                                    return data;
                                })()
                             },
                             {
                                name: 'Random data 3',
                                data: (function() {
                                    // generate an array of random data
                                    var data = [],
                                        time = (new Date()).getTime(),
                                        i;
                 
                                    for (i = -19; i <= 0; i++) {
                                        data.push({
                                            x: time + i * 1000,
                                            y: 0
                                        });
                                    }
                                    return data;
                                })()
                             },
                             {
                                name: 'Random data 4',
                                data: (function() {
                                    // generate an array of random data
                                    var data = [],
                                        time = (new Date()).getTime(),
                                        i;
                 
                                    for (i = -19; i <= 0; i++) {
                                        data.push({
                                            x: time + i * 1000,
                                            y: 0
                                        });
                                    }
                                    return data;
                                })()
                             }]
                });
            });
        </script>

    </head>
    <body>
      
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </body>
</html>

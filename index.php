<?php
require_once('DB_Functions.php');
$db = new DB_Functions();
$result = $db->getUpdate();

$data = array();

$date = new DateTime();
$timestamp = $date->getTimestamp() * 1000;

/*create array of data contains x = 0 */
for($i = -19; $i < 0; $i++) {
    $data[] = [
        'x' => $timestamp + $i * 1000, 
        'y' => 0
    ];
}

$devices = array();

foreach ($result as $key => $value) {
    $devices[] = [
        'name' => $key,
        'data' => $data
    ];
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>
        <script type="text/javascript" src="../<?php echo basename(__DIR__); ?>/assets/js/jquery-2.1.1.min.js"></script>
        <style type="text/css">
            ${demo.css}
        </style>
<script type="text/javascript">

var devices = 
    <?php
       echo json_encode($devices);
    ?>
    ;
    
//var jsonDevices = $.parseJSON(devices);

$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
 
        var chart;
        $('#container').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                zoomType: 'x',
                events: {
                    load: function() {                      
                        
                        var series = this.series;
                        setInterval(function() {
                            $.get("../<?php echo basename(__DIR__); ?>/update_stream.php",function(data,status){
                                var raw = JSON.parse(data);
                                var x = (new Date()).getTime();

                                /*
                                if the number of device was changed
                                than reload the page
                                */
                                if(raw.n != series.length)
                                    window.location = "";

                                for (var i = 0; i < raw.data.length; i++ ) {
                                    console.log("data = "+raw.data[i]);
                                    series[i].addPoint([x, parseInt(raw.data[i])], true, true);
                                }

                            });        
                            
                        }, 1000);

                        /*
                        // set up the updating of the chart each second
                        var series = this.series;

                        setInterval(function() {
                            
                            $.get("../<?php echo basename(__DIR__); ?>/update_stream.php",function(data,status){

                                var raw = JSON.parse(data);

                                console.log("Data: " + raw.n + "\nStatus: " + status);

                                var x = (new Date()).getTime(); // current time
                                console.log("this.series.length = "+series.length);

                                
                                for (var i = 0; i < raw.data.length; i++ ) {
                                    //seriesData.addPoint([x, Math.random()], true, true);
                                    console.log("data = "+raw.data[i]);
                                    series[i].addPoint([x, raw.data[i]], true, true);
                                }
                            });                  
                        }, 1000);
                        */
                    }
                }
            },
            title: {
                text: 'Live random data'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: [
            {
                title: {
                    text: 'Scala'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            }],
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: true
            },
            exporting: {
                enabled: false
            },
            series: devices
        });
    });
 
});
</script>
    </head>
    <body>
<script src="../<?php echo basename(__DIR__); ?>/assets/js/highcharts.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </body>
</html>
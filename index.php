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

		<script type="text/javascript" src="../<?php echo basename(__DIR__); ?>/assets/js/jquery-2.1.1.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
<script>
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
                events: {
                    load: function() {
 
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

                            series.addPoint([x, 0], false, true);
                            series2.addPoint([x, z], true, true);
                            series3.addPoint([x, y], true, true);
                            series4.addPoint([x, a], true, true);
                        }, 1000);
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
 
});
</script>
	</head>
	<body>
<script src="../<?php echo basename(__DIR__); ?>/assets/js/highcharts.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>

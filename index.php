<?php
    require_once('DB_Functions.php');

    $db = new DB_Functions();
    $result = $db->getUpdate();
    $threshold = $db->getThreshold();

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
        <title>Seismic Monitor</title>
        <script type="text/javascript" src="../<?php echo basename(__DIR__); ?>/assets/js/jquery-2.1.1.min.js"></script>
        <style type="text/css">
            
            ${demo.css}

            .alert {
                background-color: red;
            }
        
        </style>
        <script type="text/javascript">

            function doNotif (raw, registeredDevices) {
                $('#soundFX')[0].play();

                // because red is stuning 
                $('body').addClass('alert');

                //populate notification box
                $('#timeAccure').html(new Date());
                $('#totalDevice').html(registeredDevices);
                $('#totalVote').html(raw.data.length);

                var list = $('#list');
                if(list.children().length == 0) {   
                    for (var i = 0; i < raw.data.length; i++ ) {
                        list.append('<p>'+raw.data[i].device+'</p>');
                    }
                }

                //display notification
                $('#alertBox').css('display', 'block');

                /*
                setInterval(function(){
                    $('body').removeClass('alert');
                }, 5000);
                */
            }

            var devices = <?php echo json_encode($devices); ?>;

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

                                            /** 
                                            if alert != false
                                            show notifications
                                            */
                                            if(raw.alert == true) {
                                                console.log("red alert");
                                                doNotif(raw, series.length);
                                            }

                                            console.log("alert = "+raw.alert);

                                            for (var i = 0; i < raw.data.length; i++ ) {
                                               // console.log("data = "+raw.data[i].scale);
                                                series[i].addPoint([x, parseInt(raw.data[i].scale)], true, true);
                                            }
                                        });        
                                        
                                    }, 1000);
                                }
                            }
                        },
                        title: {
                            text: 'Monitor Seismic'
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

        $(document).ready(function() {
            $('#inpThreshold').change(function() {
                var value = $(this).val();
                $.ajax({
                    type:'post',
                    data:'value='+value,
                    url:"../<?php echo basename(__DIR__); ?>/setThreshold.php",
                    success:function(data){
                       console.log(data);     
                    }
                });
            });
        });

        </script>
    </head>
    <body>
        <script src="../<?php echo basename(__DIR__); ?>/assets/js/highcharts.js"></script>
    
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        
        <div id="configure">
            <div>
                <label for="inpThreshold">Threshold :</label>
                <input id="inpThreshold" value="<?php echo $threshold; ?>" type="number" min="1">
            </div>
        </div>

        <audio id="soundFX">
            <source src="../<?php echo basename(__DIR__); ?>/assets/Alarm_-_Collision.ogg"></source>
            Update your browser to enjoy HTML5 audio!
        </audio>
        <div id="alertBox" style="display:none;">
            <center>
                <div>
                    <p><strong><span id="totalVote">4</span></strong> sensor from total of <strong><span id="totalDevice">6</span></strong> sensors, show earthquake activities at <strong><span id="timeAccure"></span></strong>.</p>
                </div>
                <div>
                    List of devices that detect the activity :
                    <ul id="list" style="list-style-type: none; ">
                        
                    </ul>
                </div>
                <div>
                    <p>Refresh page to remove this alert.</p>
                </div>
            </center>
        </div>
    </body>
</html>
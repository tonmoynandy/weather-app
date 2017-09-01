<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

require 'Weather.php';
//for($x=11;$x<=100;$x++){
    //copy("http://openweathermap.org/img/w/".$x."n.png","assets/icons/".$x."n.png");
    //copy("http://openweathermap.org/img/w/".$x."d.png","assets/icons/".$x."d.png");
//}
$w = new Weather();
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$tmp_type ='c';
$location = $w->_location($lat,$lon);
$currentWeather = $w->getCurrentWeather($lat,$lon);
$forecasts = $w->getforecastWeather($lat,$lon);
$graphData = $w->forcastGraphData($lat,$lon);
//$w->pr($location);


?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <title>Page Title</title>
    <script src="assets/js/jquery-1.10.2.min.js" ></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        
        var options = {
          legend: 'none',
          hAxis: { minValue: 0, maxValue: 9 },
          curveType: 'function',
          pointSize: 5,
          'backgroundColor': 'transparent',
           hAxis: {
            textStyle: {
              color: "#dadfe0"
            },
            gridlines: {
              color: "#dadfe0"
            },
            baselineColor: '#dadfe0'
          },
          vAxis: {
            textStyle: {
              color: "#dadfe0"
            },
            gridlines: {
              color: "#dadfe0"
            },
            baselineColor: '#dadfe0'
          },
        };
        
        var data = google.visualization.arrayToDataTable
            ([ ['Date', 'Temp'],
          <?php foreach($graphData as $index=>$g){ ?>
          ['<?php echo date('D',strtotime($index)) ;?>',  <?php echo $g['temp']  ?>],
          <?php }  ?> 
        ]);


        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        options.colors= ['#DF240F'];
        chart.draw(data, options);
        
        var data1 = google.visualization.arrayToDataTable
            ([ ['Date', 'Humidity',],
          <?php foreach($graphData as $index=>$g){ ?>
          ['<?php echo date('D',strtotime($index)) ;?>', <?php echo $g['humidity']  ?>],
          <?php }  ?> 
        ]);
            
        var chart1 = new google.visualization.LineChart(document.getElementById('chart_div1'));
        options.colors= ['#0E26DE'];
        chart1.draw(data1, options);
        
        var data2 = google.visualization.arrayToDataTable
            ([ ['Date', 'Clouds'],
          <?php foreach($graphData as $index=>$g){ ?>
          ['<?php echo date('D',strtotime($index)) ;?>', <?php echo $g['clouds']  ?>],
          <?php }  ?> 
        ]);
        var chart2 = new google.visualization.LineChart(document.getElementById('chart_div2'));
        options.colors= ['#25E010'];
        chart2.draw(data2, options);
      }
      $(function(){
         $(document).on('click', ".forecastLi",function(e){
             var elementIndex = $(".forecastLi").index(this);
             $(".forecastLi").removeClass('forecastLiActive');
             $(this).addClass('forecastLiActive');
             $(".forecastSubContainer").removeClass('forecastSubContainerActive');
             $(".forecastSubContainer:eq("+elementIndex+")").addClass('forecastSubContainerActive');
         });
         
         $(document).on('click','.forecastSubLiHeading',function(){
            $(".forecastSubLiHeading").removeClass('forecastSubLiHeadingActive');
            $(this).addClass('forecastSubLiHeadingActive');
            $('.forecastSubdetails').removeClass('forecastSubdetailsActive');
             $(this).parent().find('.forecastSubdetails').addClass('forecastSubdetailsActive');
         });
         
         $(document).on('click','.detailsWeatherLink',function(){
             $(".currentExtar").toggle();
             if ($(this).find('i').hasClass('glyphicon-chevron-down')) {
                $(this).find('i').removeClass('glyphicon-chevron-down');
                $(this).find('i').addClass('glyphicon-chevron-up');   
             }else{
                $(this).find('i').removeClass('glyphicon-chevron-up');
                $(this).find('i').addClass('glyphicon-chevron-down');   
             }
             
         });
      });
    </script>
</head>

<body>
<div class="container">
    <header >
        <a href="index.php" class="backHeader"><i class="glyphicon glyphicon-chevron-left"></i></a>
        <h2><?php echo $location['city_name']; ?></h2>
        
        <br class="spacer"/>
    </header>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="currentWeatherContainer">
                <div class="currentDate"><?php echo date("l, d F, Y",$currentWeather->dt);  ?></div>
                <div class="Current">
                    <div class="leftCurrent">
                        <i class="wi wi-thermometer"></i>
                        <span><?php echo $currentWeather->main->temp."&deg;" ?></span>
                        <img src="assets/icons/<?php echo $currentWeather->weather[0]->icon;  ?>.png" title="<?php echo $currentWeather->weather[0]->description;  ?>" alt="<?php echo $currentWeather->weather[0]->description;  ?>"/>
                    </div>
                    <div class="rightCurrent">
                        
                        <p>High&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $currentWeather->main->temp_max."&deg;" ?></p>
                        <p>Low&nbsp;&nbsp;:&nbsp;&nbsp; <?php echo $currentWeather->main->temp_min."&deg;" ?></p>
                    </div>
                    <div class="currentDescription">
                        <?php echo $currentWeather->weather[0]->description;  ?>
                        <a href="javascript:void(0)" class="detailsWeatherLink">Details <i class="glyphicon glyphicon-chevron-down"></i></a>
                    </div>
                    <div class="currentExtar">
                        <span><i class="wi wi-humidity"></i> <?php echo $currentWeather->main->humidity."%" ?></span>
                        <span><i class="wi wi-day-light-wind"></i> <?php echo $currentWeather->wind->speed." m/s" ?></span>
                        <span><i class="wi wi-cloudy"></i> <?php echo $currentWeather->clouds->all."%" ?></span>
                        <span><i class="wi wi-sunrise"></i> <?php echo $currentWeather->sys->sunrise ?></span>
                        <span><i class="wi wi-sunset"></i> <?php echo $currentWeather->sys->sunset ?></span>
                    </div>
                </div>
            </div>
          
    
    <div class="forecastContainer">
        <h2>Forecast</h2>
        <div class="forecastGraphContainer">
        <div class="forecastGraph">
            <div id="chart_div" ></div>
        </div>
        <div class="forecastGraph">
            <div id="chart_div1"></div>
        </div>
        <div class="forecastGraph">
            <div id="chart_div2"></div>
        </div>
        
        </div>
        <div style="clear:both"></div>
        <div class="forecastContainer">
            <ul class="forecastHeading">
            <?php if(count($forecasts)>0){ ?>
              <?php  foreach($forecasts as $index=>$f){ ?>
                <li  class="forecastLi <?php if($index == date('Y-m-d')) echo 'forecastLiActive'; ?> "  ><?php echo date('D',strtotime($index)); ?></li>
              <?php } ?>
            <?php } ?>
             </ul>
            <div class="forecastDetailsContainer">
                <?php if(count($forecasts)>0){ ?>
                    <?php   foreach($forecasts as $index=>$fore){  ?>
                      <div  class="forecastSubContainer <?php echo ( $index == date('Y-m-d'))? 'forecastSubContainerActive':'' ; ?>" >
                            <ul class="forecastSubUl">
                                
                        <?php foreach($fore as $cast ){ ?>
                        <li class="forecastSubLi">
                            <div class="forecastSubLiHeading"><span class="foreTimeSpan"><?php echo date('h:i A',$cast->dt)  ?></span>
                            <img align="right" class="foreTimeImg" src="assets/icons/<?php echo $cast->weather[0]->icon;  ?>.png" title="<?php echo $cast->weather[0]->description;  ?>" alt="<?php echo $cast->weather[0]->description;  ?>"/>
                            <br class="spacer" />
                            </div>
                            <div class="forecastSubdetails">
                            <ul class="forecastSubdetailsUl">
                                    <li>
                                        <div class="forecastTemp">
                                            <div class="leftForeSpan">
                                                <i class="wi wi-thermometer"></i> <?php echo $w->_temperature($cast->main->temp,'c')."&deg;";  ?>
                                            </div>
                                            <div class="rightForeSpan">
                                                <span>High : <?php echo $w->_temperature($cast->main->temp_max,'c')."&deg;";  ?></span>
                                                <span>Low : <?php echo $w->_temperature($cast->main->temp_min,'c')."&deg;";  ?></span>
                                                <span><?php echo $cast->weather[0]->description;  ?></span>
                                            </div>
                                            <br class="spacer" />
                                        </div>
                                        
                                    </li>
                            </ul>
                            <ul class="extraForcastUl">
                                    <li><i class="wi wi-humidity"> </i> <?php echo $cast->main->humidity." %" ;  ?> </li>
                                    <li><i class="wi wi-day-light-wind">  </i> <?php echo $cast->wind->speed." m/s" ;  ?></li>
                                    <li><i class="wi wi-cloudy">  </i> <?php echo $cast->clouds->all." %" ;  ?> </li>
                                    
                            </ul>
                            </div>
                        </li>
                        <?php } ?>
                            </ul>
                      </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>

</body>
</html>




<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/vendor/programster/google-charts/Animation.php');
require_once(__DIR__ . '/vendor/programster/google-charts/Legend.php');
require_once(__DIR__ . '/vendor/programster/google-charts/LineChart.php');
require_once(__DIR__ . '/vendor/programster/google-charts/LineChartArea.php');
require_once(__DIR__ . '/vendor/programster/google-charts/LineChartAxis.php');
require_once(__DIR__ . '/vendor/programster/google-charts/LineChartBackground.php');
require_once(__DIR__ . '/vendor/programster/google-charts/TextStyle.php');
require_once(__DIR__ . '/vendor/programster/google-charts/TrendLine.php');

function convertDataToChartForm($data)
{
    $newData = array();
    $firstLine = true;

    foreach ($data as $dataRow)
    {
        if ($firstLine)
        {
            $newData[] = array_keys($dataRow);
            $firstLine = false;
        }

        $newData[] = array_values($dataRow);
    }

    return $newData;
}

$data = array(
    array(
        'Section ID' => 1,
        '1 star target' => 1200,
        '2 star target' => 600,
        '3 star target' => 300,
        '4 star target' => 150,
        '5 star target' => 75,
        'Dataset 1 SRS' => 50,
        'Dataset 2 SRS' => 100,
    ),
    array(
        'Year' => 2,
        '1 star target' => 1200,
        '2 star target' => 600,
        '3 star target' => 300,
        '4 star target' => 150,
        '5 star target' => 75,
        'Dataset 1 SRS' => 300,
        'Dataset 2 SRS' => 400,
    ),
    array(
        'Year' => 3,
        '1 star target' => 1200,
        '2 star target' => 600,
        '3 star target' => 300,
        '4 star target' => 150,
        '5 star target' => 75,
        'Dataset 1 SRS' => 1000,
        'Dataset 2 SRS' => 460,
    ),
    array(
        'Year' => 4,
        '1 star target' => 1200,
        '2 star target' => 600,
        '3 star target' => 300,
        '4 star target' => 150,
        '5 star target' => 75,
        'Dataset 1 SRS' => 660,
        'Dataset 2 SRS' => 900,
    )
);
?>

<?php 


$lineChart = new Programster\GoogleCharts\LineChart(
    "curve_chart", 
    convertDataToChartForm($data), 
    "Risk Worm Star Rating"
);



$lineChart->setHorizontalAxis(new \Programster\GoogleCharts\LineChartAxis("Distance"));

$star5 = array('type' => 'area', 'color' => 'green', 'pointsVisible' => 'false', 'areaOpacity' => 0.7);
$star4 = array('type' => 'area', 'color' => 'yellow', 'pointsVisible' => 'false', 'areaOpacity' => 0.7);
$star3 = array('type' => 'area', 'color' => 'orange', 'pointsVisible' => 'false', 'areaOpacity' => 0.7);
$star2 = array('type' => 'area', 'color' => 'red', 'pointsVisible' => 'false', 'areaOpacity' => 0.7);
$star1 = array('type' => 'area', 'color' => 'black', 'pointsVisible' => 'false', 'areaOpacity' => 0.7);

$lineChart->setSeries(array(
    0 => $star1,
    1 => $star2,
    2 => $star3,
    3 => $star4,
    4 => $star5,
    )
);

$vAxis = new \Programster\GoogleCharts\LineChartAxis("Risk Level");
$vAxis->setBaseLineColor("green");
$vAxis->setMinValue(0);
$vAxis->setMaxValue(1200);

$lineChart->setVerticalAxis($vAxis);
$lineChart->setPointShape("diamond");
$lineChart->setPointsVisible(true);
$lineChart->setPointSize(6);
$lineChart->setSmoothedCurve();

$animation = new Programster\GoogleCharts\Animation(500,  "out");
$lineChart->setAnimation($animation);

$lineChart->setLineColors(array("white", "blue"));
#$lineChart->setBackground(new LineChartBackground("white", "black", 5));

##$chartArea = new Programster\GoogleCharts\LineChartArea("black");
#$chartArea->setHeight("100%");
#$lineChart->setChartArea($chartArea);
#
#$lineChart->setClickHandler("chartClickHandler");
#$lineChart->setSelectHandler("chartSelectHandler");
?>

<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       
  </head>
  <body>
    
    <div id="curve_chart" style="width:100%; height:100%"></div>
    
    <script>
        
        function chartClickHandler()
        {
            alert("click handler fired");
        }
        
        function chartSelectHandler()
        {
            alert("select handler fired");
        }
    </script>
    <?php echo $lineChart->getHtmlScript(); ?>
    
  </body>
</html>

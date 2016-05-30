<?php

require_once(__DIR__ . '/../ChartInterface.php');
require_once(__DIR__ . '/../Animation.php');
require_once(__DIR__ . '/../Legend.php');
require_once(__DIR__ . '/../LineChart.php');
require_once(__DIR__ . '/../ChartArea.php');
require_once(__DIR__ . '/../Axis.php');
require_once(__DIR__ . '/../Background.php');
require_once(__DIR__ . '/../TextStyle.php');
require_once(__DIR__ . '/../TrendLine.php');
require_once(__DIR__ . '/../Series.php');
require_once(__DIR__ . '/../ChartManager.php');

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

$lineChart2 = new Programster\GoogleCharts\LineChart(
    "curve_chart2", 
    convertDataToChartForm($data), 
    "SecondRisk Worm Star Rating"
);

#$legend = new Programster\GoogleCharts\Legend("right", "center");
#$lineChart->setLegend($legend);

$lineChart->setHorizontalAxis(new \Programster\GoogleCharts\Axis("Distance"));

$seriesConfig = new \Programster\GoogleCharts\Series();
$seriesConfig->setType("area");
$seriesConfig->setPointsVisible(false);
$seriesConfig->setVisibleInLegend(false);
$seriesConfig->setAreaOpacity(0.5);
$seriesConfig->setLineWidth(0);
$seriesConfig->setIsInteractive(false);

$star5 = clone $seriesConfig;
$star4 = clone $seriesConfig;
$star3 = clone $seriesConfig;
$star2 = clone $seriesConfig;
$star1 = clone $seriesConfig;

$star5->setColor("green");
$star4->setColor("yellow");
$star3->setColor("orange");
$star2->setColor("red");
$star1->setColor("black");

$lineChart->setSeries(array(
    0 => $star1,
    1 => $star2,
    2 => $star3,
    3 => $star4,
    4 => $star5,
    )
);

$vAxis = new \Programster\GoogleCharts\Axis("Risk Level");
$vAxis->setViewWindow(0, 1200);

$lineChart->setVerticalAxis($vAxis);
$lineChart->setPointShape("diamond");
$lineChart->setPointsVisible(true);
$lineChart->setPointSize(6);
$lineChart->setSmoothedCurve();

#$animation = new Programster\GoogleCharts\Animation(500,  "out");
#$lineChart->setAnimation($animation);

$lineChart->setLineColors(array("white", "blue"));
#$lineChart->setBackground(new Background("white", "black", 5));

$chartArea = new Programster\GoogleCharts\ChartArea("white");
$chartArea->setWidth("70%");
$chartArea->setHeight("70%");
$chartArea->setLeft("100");
$chartArea->setTop("100");
$lineChart->setChartArea($chartArea);
#
#$lineChart->setClickHandler("chartClickHandler");
#$lineChart->setSelectHandler("chartSelectHandler");

$chartBuilder = new Programster\GoogleCharts\ChartManager();
$chartBuilder->addChart($lineChart);
$chartBuilder->addChart($lineChart2);
?>

<html>
    <head>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <?php echo $chartBuilder->getHtml(); ?>
       
  </head>
  <body>
    
    <div id="curve_chart" style="width:100%; height:100%"></div>
    <div id="curve_chart2" style="width:300px; height:300px"></div>
    
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
    
    
  </body>
</html>

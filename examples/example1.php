<?php
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
        'data 1 SRS' => 600,
        'data 2 SRS' => 450,
    ),
    array(
        'Year' => 2,
        '1 star target' => 1200,
        '2 star target' => 600,
        '3 star target' => 300,
        '4 star target' => 150,
        '5 star target' => 75,
        'data 1 SRS' => 1000,
        'data 2 SRS' => 400,
    ),
    array(
        'Year' => 3,
        '1 star target' => 1200,
        '2 star target' => 600,
        '3 star target' => 300,
        '4 star target' => 150,
        '5 star target' => 75,
        'data 1 SRS' => 1170,
        'data 2 SRS' => 460,
    ),
    array(
        'Year' => 4,
        '1 star target' => 1200,
        '2 star target' => 600,
        '3 star target' => 300,
        '4 star target' => 150,
        '5 star target' => 75,
        'data 1 SRS' => 660,
        'data 2 SRS' => 1120,
    )
);
?>

<?php 

require_once(__DIR__ . '/LineChart.php'); 

$lineChart = new LineChart(
    "curve_chart", 
    convertDataToChartForm($data), 
    "Risk Worm Star Rating"
);



$lineChart->setHorizontalAxis(new LineChartAxis("Year"));

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

$vAxis = new LineChartAxis("Sales");
$vAxis->setBaseLineColor("green");
$vAxis->setMinValue(0);
$vAxis->setLabelInterval(5);

$lineChart->setVerticalAxis($vAxis);
$lineChart->setPointShape("diamond");
$lineChart->setPointsVisible(true);
$lineChart->setPointSize(20);
#$lineChart->setSmoothedCurve();

$animation = new Animation(500,  "out");
$lineChart->setAnimation($animation);

#$lineChart->setLineColors(array("green", "orange"));
#$lineChart->setBackground(new LineChartBackground("white", "black", 5));
#$lineChart->setChartArea(new LineChartArea("yellow"));
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

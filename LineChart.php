<?php

namespace Programster\GoogleCharts;


class LineChart
{
    private $m_options;
    private $m_anchorId;
    private $m_clickHandler; # name of javascript func to execute on click
    private $m_selectHandler;
    private $m_trendlines = array();
    
    
    /**
     * 
     * @param string $anchorId - ID of the html element the chart should go within.
     * @param type $data
     * @param type $title
     * @param Legend $smoothed
     * @param type $animationDuration - time in seconds to animate
     */
    public function __construct($anchorId, $data, $title)
    {
        $this->m_anchorId = $anchorId;
        $this->m_data = $data;
        $this->m_options['title'] = $title;
    }
    
    
    public function setWidth($width)
    {
        $this->m_options['width'] = $width;
    }
    
    
    public function setHeight($height)
    {
        $this->m_options['height'] = $height;
    }
    
    
    /**
     * Set the background color of the chart.
     * @param type $color
     */
    public function setBackground(LineChartBackground $background)
    {
        # @todo - validate color is hex code or english text for a color.
        $this->m_options['backgroundColor'] = $background;
    }
    
    
    /**
     * Set the colors of the data lines in the graph. Order matters.
     * @param array $colors - colors for the lines.
     */
    public function setLineColors(array $colors)
    {
        $this->m_options['colors'] = $colors;
    }
    
    
    public function setAnimation(Animation $animation)
    {
        $this->m_options['animation'] = $animation;
    }
    
    
    /**
     * Set the chart to have smoothed lines rather than straight lines.
     */
    public function setSmoothedCurve()
    {
        $this->m_options['curveType'] = "function";
    }
    
    
    public function setChartArea(LineChartArea $areaConfig)
    {
        $this->m_options['chartArea'] = $areaConfig;
    }
    
    
    /**
     * Set the handler for when the user clicks inside the graph. This could
     * be on an object or nothing at all.
     * @param type $funcName - name of the javascript function to handle the event
     * 
     */
    public function setClickHandler($funcName)
    {
        $this->m_clickHandler = $funcName;
    }
    
    
    /**
     * Set the handler for when the user clicks on objects in the line graph
     * This could be a data point or when they click on the legend.
     * @param type $funcName - name of the javascript function to handle the event
     * 
     */
    public function setSelectHandler($funcName)
    {
        $this->m_selectHandler = $funcName;
    }
    
    
    public function setHorizontalAxis(LineChartAxis $axis)
    {
        $this->m_options['hAxis'] = $axis;
    }
    
    
    public function setVerticalAxis(LineChartAxis $axis)
    {
        $this->m_options['vAxis'] = $axis;
    }
    
    
    public function setTitleTextStyle(TextStyle $style)
    {
        $this->m_options['titleTextStyle'] = $style;
    }
    
    
    public function setLegend(Legend $legend)
    {
        $this->m_options['legend'] = $legend;
    }
    
    
    /**
     * Set the width of the lines (default 2)
     * @param int $width - width of lines
     */
    public function setLineWidth($width)
    {
        $this->m_options['lineWidth'] = $width;
    }
    
    
    /**
     * Set the width of the lines (default 2)
     * @param int $width - width of lines
     */
    public function setPointShape($shape)
    {
        $allowedValues = array("circle", "triangle", "square", "diamond", "star", "polygon");
        
        if (!in_array($shape, $allowedValues))
        {
            throw new Exception("Invalid point shape: " . $shape);
        }
        
        $this->m_options['pointShape'] = $shape;
    }
    
    
    /**
     * Set the points to always be visible or not.
     * @param bool $isVisible
     */
    public function setPointsVisible($isVisible=true)
    {
        $this->m_options['pointsVisible'] = $isVisible;
    }
    
    /**
     * Set the points to always be visible or not.
     * @param bool $isVisible
     */
    public function setPointSize($size)
    {
        $this->m_options['pointSize'] = $size;
    }
    
    
    public function addTrendLine($seriesInteger, Trendline $trendLine)
    {
        $this->m_trendlines[$seriesInteger] = $trendLine;
    }
    
    
    public function setSeries(array$series)
    {
        $this->m_options['series'] = $series;
    }
    
    
    /**
     * Returns the relevant javascript for creating and producing the chart.
     */
    public function getHtmlScript()
    {
        if (count($this->m_trendlines) > 0)
        {
            $this->m_options['trendlines'] = json_decode(json_encode($this->m_trendlines, JSON_FORCE_OBJECT)); 
        }
        
        # debug hacks
        $this->m_options['seriesType'] = 'lines';
        $chartType = "ComboChart"; # LineChart
        
        print 
            '<script type="text/javascript">' . PHP_EOL .
            'google.charts.load(\'current\', {\'packages\':[\'corechart\']});' . PHP_EOL .
            'google.charts.setOnLoadCallback(drawChart);' . PHP_EOL .
            'function drawChart() {' . PHP_EOL . # contain the scope.
                "var data = google.visualization.arrayToDataTable(" . json_encode($this->m_data) . ");" . PHP_EOL .
                "var options = " . json_encode($this->m_options) . ";" . PHP_EOL .
                "var chart = new google.visualization." . $chartType . "(document.getElementById('" . $this->m_anchorId . "'));" . PHP_EOL;
        
        if ($this->m_clickHandler != null)
        {
            print "google.visualization.events.addListener(chart, 'click', " . $this->m_clickHandler . ");";
        }
        
        if ($this->m_selectHandler != null)
        {
            print "google.visualization.events.addListener(chart, 'select', " . $this->m_selectHandler . ");";
        }
        
        
        
        print "chart.draw(data, options);" . PHP_EOL . 
                
                
            "};" . PHP_EOL .
            "</script>";
    }
}

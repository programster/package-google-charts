<?php

namespace Programster\GoogleCharts;


class ChartManager
{
    private $m_charts;
    
    
    /**
     * 
     * @param string $anchorId - ID of the html element the chart should go within.
     * @param type $data
     * @param type $title
     * @param Legend $smoothed
     * @param type $animationDuration - time in seconds to animate
     */
    public function __construct($charts=array())
    {
        $this->m_charts = $charts;
    }
    
    
    public function addChart(ChartInterface $chart)
    {
        $this->m_charts[] = $chart;
    }
    
    
    /**
     * Returns the relevant javascript for creating and producing the chart.
     */
    public function getHtml()
    {
        $html =  
            '<script type="text/javascript">' . PHP_EOL .
            'google.charts.load(\'current\', {\'packages\':[\'corechart\']});' . PHP_EOL .
            'google.charts.setOnLoadCallback(initializeCharts);' . PHP_EOL .
            'function drawCharts() {' . PHP_EOL;
        
        foreach ($this->m_charts as $chart)
        {
            /* @var $chart ChartInterface */
            $html .= '{' . $chart->getHtml() . '}';
        }
            
        $html .=
            "};" . PHP_EOL .
                
            "function initializeCharts(){" .
                'drawCharts();' . PHP_EOL .
                'window.onresize = function(event){drawCharts();};' . PHP_EOL .
            "}" .
            "</script>";
        
        return $html;
    }
}

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
    public function getHtml(string $assignment) : string
    {
        $html =  
            '<script type="text/javascript">' . PHP_EOL .
                $assignment . ' = function() { 
                // This "defined" hack prevents us loading google charts twice.
                var defined = typeof google_charts_loaded !== typeof undefined ? true : false;
                
                if (!defined)
                {
                    google.charts.load(\'current\', {\'packages\':[\'corechart\']});
                    google_charts_loaded = true;
                }
                
                google.charts.setOnLoadCallback(initializeCharts);
                function drawCharts() {' . PHP_EOL;
        
        foreach ($this->m_charts as $chart)
        {
            /* @var $chart ChartInterface */
            $html .= '{' . $chart->getHtml() . '}';
        }
            
        $html .=
                "};
                
                function initializeCharts(){
                    drawCharts();
                    window.onresize = function(event){drawCharts();};
                }
            };
            </script>";
        
        return $html;
    }
}

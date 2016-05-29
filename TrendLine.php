<?php

namespace Programster\GoogleCharts;


class Trendline implements \JsonSerializable
{
    private $m_options;
    
    /**
     * Create a trendline
     * @param string $type - "linear", "exponential, or "polynomial"
     * @param string $color - color of the trendline (can be hex or "red" etc)
     * @param int $lineWidth - width of the trendline's line
     * @param type $pointSize
     * @param float $opacity - value between 0 and 1 (1 being fully visible)
     * @param bool $showR2 - whether to show the coeficient of determination in 
     *                      thelegend or trendline tooltip.
     */
    public function __construct($type, $color, $lineWidth, $pointSize, $opacity, $showR2)
    {
        $this->m_options['type'] = $type;
        $this->m_options['color'] = $color;
        $this->m_options['lineWidth'] = $lineWidth;
        $this->m_options['opacity'] = $opacity;
        $this->m_options['showR2'] = $showR2;
        $this->m_options['visibleInLegend'] = false;
        $this->m_options['pointSize'] = $pointSize;
    }
    
    
    /**
     * For trendlines of type: 'polynomial', the degree of the polynomial 
     * (2 for quadratic, 3 for cubic, and so on). (The default degree may 
     * change from 3 to 2 in an upcoming release of Google Charts.)
     * @var int $degree - default 3
     */
    public function setDegree($degree)
    {
        if ($this->m_options['type'] !== "polynomial")
        {
            throw new \Exception("Cannot set degree on a non polynomial trendline.");
        }
        
        $this->m_options['degree'] = $degree;
    }
    
    
    public function setLabel($label)
    {
        $this->m_options['visibleInLegend'] = true;
        $this->m_options['labelInLegend'] = $label;
    }
    
    
    public function jsonSerialize() 
    {
        return $this->m_options;
    }
}
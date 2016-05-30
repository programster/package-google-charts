<?php

namespace Programster\GoogleCharts;



class Axis implements \JsonSerializable
{
    private $m_options;
    
    
    public function __construct($title)
    {
        $this->m_options['title'] = $title;
    }
    
    
    /**
     * Set the position of the title.
     * @param type $position - one of "in", "out" or "none.
     * @throws \Exception
     */
    public function setTitlePosition($position)
    {
        $allowedValues = array("in", "out", "none");
        
        if (!in_array($position, $allowedValues))
        {
            throw new \Exception("Invalid position: " . $position);
        }
        
        $this->m_options['titlePosition'] = $position;
    }
    
    
    public function setBaseline($baseline)
    {
        $this->m_options['baseline'] = $baseline;
    }
    
    
    public function setBaseLineColor($color)
    {
        $this->m_options['baselineColor'] = $color;
    }
    
    
    public function setReverseDirection()
    {
        $this->m_options['direction'] = -1;
    }
    
    
    /**
     * 
     * @param type $format - none, decimal, scientific, currency, percent, short
     *                       long, or an ICU pattern for dates.
     */
    public function setFormat($format)
    {
        $this->m_options['format'] = $format;
    }
    
    
    public function setLogScale()
    {
        $this->m_options['logScale'] = "true";
    }
    
    
    public function setScaleType($type)
    {
        $allowedValues = array("null", "log", "mirrorLog");
        
        if (!in_array($type, $allowedValues))
        {
            throw new \Exception("Invalid scale type: " . $type);
        }
        
        if (isset($this->m_options['logScale']))
        {
            unset($this->m_options['logScale']);
        }
        
        $this->m_options['scaleType'] = $type;
    }
    
    
    public function setTextPosition($position)
    {
        $allowedValues = array("out", "in", "none");
        
        if (!in_array($position, $allowedValues))
        {
            throw new \Exception("Invalid text position value: " . $type);
        }
        
        $this->m_options['textPosition'] = $position;
    }
    
    
    public function setTextStyle(TextStyle $style)
    {
        $this->m_options['textStyle'] = $style;
    }
    
    
    public function setTitleTextStyle(TextStyle $style)
    {
        $this->m_options['titleTextStyle'] = $style;
    }
    
    
    public function setAllowContainerBoundaryTextCufoff()
    {
        $this->m_options['allowContainerBoundaryTextCufoff'] = true;
    }
    
    
    public function setSlantedText($isSlanted=true)
    {
        $this->m_options['slantedText'] = $isSlanted;
    }
    
    
    public function setSlantedTextAngle($degrees)
    {
        if ($degrees < 1) { $degrees = 1; }
        if ($degrees > 90) { $degrees = 90; }
        
        $this->m_options['slantedTextAngle'] = $degrees;
    }
    
    
    /**
     * How many horizontal axis labels to show, where 1 means show every label, 
     * 2 means show every other label, and so on. Default is to try to show as 
     * many labels as possible without overlapping. 
     * @param int $interval
     */
    public function setLabelInterval($interval)
    {
        $this->m_options['showTextEvery'] = $interval;
    }
    
    
    /**
     * Set the maximum value of this axis. You may want to be use 
     * setViewWindow instead depending on what you are trying to achieve.
     * @param mixed $maxValue
     */
    public function setMaxValue($maxValue)
    {
        $this->m_options['maxValue'] = $maxValue;
    }
    
    
    /**
     * Set the maximum value of this axis. You may want to be use 
     * setViewWindow instead depending on what you are trying to achieve.
     * @param mixed $minValue
     */
    public function setMinValue($minValue)
    {
        $this->m_options['minValue'] = $minValue;
    }
    
    
    public function jsonSerialize() 
    {
        return $this->m_options;
    }
    
    
    /**
     * Specify the cropping range of the axis.
     * @param mixed $min - "auto" or a value
     * @param mixed $max - "auto" or a value
     */
    public function setViewWindow($min="auto", $max="auto")
    {
        $viewWindow = array(
            'max' => $max,
            'min' => $min
        );
        
        $this->m_options['viewWindow'] = $viewWindow;
    }
}
<?php

namespace Programster\GoogleCharts;


class LineChartArea implements \JsonSerializable
{    
    private $m_options = array();
    
    
    public function __construct($backgroundColor)
    {
        $this->m_options['backgroundColor'] = $backgroundColor;
    }
    
    
    public function setTop($top)
    {
        $this->m_options['top'] = $top;
    }
    
    
    public function setLeft($left)
    {
        $this->m_options['left'] = $left;
    }
    
    
    public function setWidth($width)
    {
        $this->m_options['width'] = $width;
    }
    
    
    public function setHeight($height)
    {
        $this->m_options['height'] = $height;
    }
    
    
    public function jsonSerialize() 
    {
        return $this->m_options;
    }
}
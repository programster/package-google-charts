<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Programster\GoogleCharts;


class Series implements \JsonSerializable
{
    private $m_options = array();
    
    
    public function __construct(){}
    
    
    public function setType($type)
    {
        $allowedValues = array("area", "line");
        
        if (!in_array($type, $allowedValues))
        {
            throw new \Exception("Invalid series type: " . $type);
        }
        
        $this->m_options['type'] = $type;        
    }
    
    
    public function setColor($color)
    {
        $this->m_options['color'] = $color;        
    }
    
    
    public function setPointsVisible($pointsVisible)
    {   
        $this->m_options['pointsVisible'] = (bool)$pointsVisible;   
    }
    
    
    public function setVisibleInLegend($isVisible)
    { 
        $this->m_options['visibleInLegend'] = (bool)$isVisible;   
    }
    
    
    /**
     * If this is an "area" line then set the opacity of the fill color
     * @param float $opacity - value between 0 and 1
     */
    public function setAreaOpacity($opacity)
    {
        $this->m_options['areaOpacity'] = $opacity; 
    }
    
    
    public function setLineWidth($width)
    {
        $this->m_options['lineWidth'] = $width;
    }
    
    
    public function setIsInteractive($isInteractive)
    {
        $this->m_options['enableInteractivity'] = $isInteractive;
    }
    
    
    /**
     * Set the label as it will appear in the legend.
     * @param string $label
     */
    public function setLabelInLegend($label)
    {
        $this->m_options['labelInLegend'] = $label;
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
            throw new \Exception("Invalid point shape: " . $shape);
        }
        
        $this->m_options['pointShape'] = $shape;
    }
    

    public function jsonSerialize() { return $this->m_options;}
}
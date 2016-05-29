<?php

namespace Programster\GoogleCharts;



class Legend implements JsonSerializable
{
    public function __construct($position, $alignment)
    {
        $positionAllowedValues = array("bottom", "left", "in", "none", "right", "top");
        $alignmentAllowedValues = array("start", "center", "end");
        
        if (!in_array($position, $positionAllowedValues))
        {
            throw new Exception("Invalid legend position: " . $position);
        }
        
        if (!in_array($alignment, $alignmentAllowedValues))
        {
            throw new Exception("Invalid legend alignment: " . $position);
        }
        
        $this->m_options['position'] = $position;
        $this->m_options['alignment'] = $alignment;
    }
    
    
    public function setTextStyle(TextStyle $style)
    {
        $this->m_options['textStyle'] = $style;
    }
    
    
    public function jsonSerialize() { return $this->m_options; }
}
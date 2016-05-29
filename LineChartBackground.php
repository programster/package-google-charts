<?php

namespace Programster\GoogleCharts;


class LineChartBackground implements \JsonSerializable
{
    private $m_stroke;
    private $m_fill;
    private $m_strokeWidth;
    
    
    public function __construct($fillColor, $borderColor, $borderWidth)
    {
        $this->m_stroke = $borderColor;
        $this->m_strokeWidth = $borderWidth;
        $this->m_fill = $fillColor;
    }
    
    
    public function jsonSerialize() 
    {
        return array(
            'fill' => $this->m_fill,
            'strokeWidth' => $this->m_strokeWidth,
            'stroke' => $this->m_stroke
        );
    }
}
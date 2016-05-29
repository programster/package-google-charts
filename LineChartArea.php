<?php

namespace Programster\GoogleCharts;


class LineChartArea implements JsonSerializable
{
    private $m_backgroundColor;
    private $m_left = "auto";
    private $m_top = "auto";
    private $m_width = "auto";
    private $m_height = "auto";
    
    public function __construct($backgroundColor)
    {
        $this->m_backgroundColor = $backgroundColor;
    }

    public function jsonSerialize() 
    {
        return array(
            "backgroundColor" => $this->m_backgroundColor,
            "left" => $this->m_left,
            "top" => $this->m_top,
            "width" => $this->m_width,
            "height" => $this->m_height,
        );
    }
}
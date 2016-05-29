<?php

namespace Programster\GoogleCharts;


class TextStyle implements JsonSerializable
{
    private $m_color;
    private $m_isBold;
    private $m_isItalic;
    private $m_fontSize;
    
    
    public function __construct($color, $isBold = false, $isItalic = false)
    {
        $this->m_color = $color;
        $this->m_isBold = $isBold;
        $this->m_isItalic = $isItalic;
    }
    
    
    public function setFontSize($size)
    {
        $this->m_fontSize = $size;
    }
    
    
    public function jsonSerialize() 
    {
        $arrayForm = array(
            'color' => $this->m_color,
            'bold' => $this->m_isBold,
            'italic' => $this->m_isItalic
        );
        
        if (isset($this->m_fontSize) && $this->m_fontSize !== null)
        {
             $arrayForm['fontSize'] = $this->m_fontSize;
        }
        
        return $arrayForm;
    }
}
<?php

namespace Programster\GoogleCharts;


class Animation implements \JsonSerializable
{
    private $m_duration;
    private $m_easing;
    private $m_startup;
    
    
    /**
     * 
     * @param int $duration - duration of animation in milliseconds
     * @param string $easing - linear, in, out, or inAndOut
     * @param bool $startup - Determines if the chart will animate on the 
     *                        initial draw. If true, the chart will start at 
     *                        the baseline and animate to its final state. 
     */
    public function __construct($duration, $easing = "linear", $startup = true)
    {
        $this->m_duration = $duration;
        $this->m_easing = $easing;
        $this->m_startup = $startup;
    }
    

    public function jsonSerialize() 
    {
        return array(
            'duration' => $this->m_duration,
            'easing' => $this->m_easing,
            'startup' => $this->m_startup
        );
    }

}
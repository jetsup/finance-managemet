<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChartBubble extends Component
{
    public $width;
    public $height;
    /**
     * Create a new component instance.
     */
    public function __construct($width = null, $height = null)
    {
        //
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chart-bubble');
    }
}

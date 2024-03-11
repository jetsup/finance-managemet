<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormBubble extends Component
{
    public $method;
    public $action;
    /**
     * Create a new component instance.
     */
    public function __construct( $method = null, $action = null) {
        //
        $this->method = $method;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-bubble');
    }
}

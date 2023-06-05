<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request; 

class ModalCenter extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $size;

    public function __construct($title, $size = null)
    {
        //
        $this->title = $title;
        $this->size = $size;
    }

    /** 
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-center');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormSuppliers extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $data;
    public function __construct($title, $data)
    {
        //
        $this->title = $title;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-suppliers', [
            'title' => $this->title,
            'data' => $this->data
        ]);
    }
}

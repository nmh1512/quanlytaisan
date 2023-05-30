<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $name;

    public function __construct($title, $name)
    {
        //
        $this->title = $title;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-modal', [
            'title' => $this->title,
            'name' => $this->name
        ]);
    }
}

<?php

namespace App\View\Components;

use App\Models\CategoryAssets;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormTypeAssets extends Component
{
    /**
     * Create a new component instance.
     */
    public $categoryAssets;
    public $title;
    public $data;
    public $years;

    public function __construct($title, $data)
    {
        //
        $this->title = $title;
        $this->data = $data;
        $this->categoryAssets = CategoryAssets::latest()->get();
        $this->years = $this->getYearsBorn();
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-type-assets', [
            'title' => $this->title,
            'data' => $this->data,
            'categoryAssets' => $this->categoryAssets,
            'years' => $this->years
        ]);
    }

    public function getYearsBorn() : array {

        $currentYear = date('Y');
        $year = [];
        for($i = $currentYear; $i >= $currentYear - 100; $i--) {
            $year[] = $i;
        }
        return $year;
    }
}

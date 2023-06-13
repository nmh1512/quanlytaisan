<?php

namespace App\View\Components;

use App\Models\CategoryAssets;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $data;
    public $formName;
    public $selects;
    public $formContent;
    public $styleOfGrid;
    
    public function __construct(...$data)
    {
        //
        $this->title = $data['title'];
        $this->data = $data['model'];
        $this->formName = $data['form_data'];
        $this->selects = $data['selectFeilds'] ?? [];
        $this->styleOfGrid = $data['grid'] ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if($this->formName == 'delete' || $this->formName == 'disable' || $this->formName == 'enable') {
            return view('components.delete', [
                'text' => $this->formName == 'delete' ? 'xóa' : ($this->formName == 'disable' ? 'vô hiệu hóa' : 'kích hoạt'),
                'title' => $this->title,
                'name' => $this->data->name ?? $this->data->code
            ]);
        }
        $formContent = view('components.form.'. $this->formName, [
            'title' => $this->title,
            'data' => $this->data,
            'selects' => $this->selects,
            'routes' => Route::getRoutes()->getRoutesByName('home.*')
        ])->render();

        return view('components.form.form', [
            'styleOfGrid' => $this->styleOfGrid,
            'formContent' => $formContent,
        ]);
    }
}

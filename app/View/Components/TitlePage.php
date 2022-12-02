<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TitlePage extends Component
{
    public $title;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $class)
    {
        $this->title = $title;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.title-page');
    }
}

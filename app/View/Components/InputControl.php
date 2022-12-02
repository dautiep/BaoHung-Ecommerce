<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputControl extends Component
{
    public $input;
    public $control;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($input, $control)
    {
        $this->input = $input;
        $this->control = $control;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-control');
    }
}

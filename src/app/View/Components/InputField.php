<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputField extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $value;
    public $type;
    public $errorMessage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name, 
        $label, 
        $placeholder = '', 
        $value = '', 
        $type = 'text', 
        $errorMessage = ''
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->type = $type;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input-field');
    }
}

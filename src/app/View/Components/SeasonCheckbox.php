<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SeasonCheckbox extends Component
{
    public $name;
    public $selectedSeasons;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $selectedSeasons = [])
    {
        $this->name = $name;
        $this->selectedSeasons = $selectedSeasons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.season-checkbox');
    }
}

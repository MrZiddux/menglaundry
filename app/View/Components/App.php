<?php

namespace App\View\Components;

use Illuminate\View\Component;

class App extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $btm, $script;
    public function __construct($title = null, $btm = null, $script = null)
    {
        $this->title = $title ?? '';
        $this->btm = $btm ?? '';
        $this->script = $script ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app');
    }
}

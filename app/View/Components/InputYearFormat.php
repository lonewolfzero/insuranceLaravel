<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputYearFormat extends Component
{
    public $all;
    public $id;
    public $name;
    public $class;
    public $var;
    public $defval;
    public $style;
    public $isrequired;
    public $isdisabled;
    public $isreadonly;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $all = null,
        $id = null,
        $name = null,
        $class = null,
        $var = null,
        $defval = null,
        $style = null,
        $isrequired = false,
        $isdisabled = false,
        $isreadonly = false
    ) {
        $this->all = $all;
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
        $this->var = $var;
        $this->defval = $defval;
        $this->style = $style;
        $this->isrequired = $isrequired;
        $this->isdisabled = $isdisabled;
        $this->isreadonly = $isreadonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input-year-format');
    }
}

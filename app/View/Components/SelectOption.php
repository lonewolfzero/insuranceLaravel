<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectOption extends Component
{
    public $all;
    public $id;
    public $name;
    public $class;
    public $text;
    public $var;
    public $master;
    public $col1;
    public $col2;
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
        $text = "",
        $var = null,
        $master = null,
        $col1 = null,
        $col2 = null,
        $isrequired = false,
        $isdisabled = false,
        $isreadonly = false
    ) {
        $this->all = $all;
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
        $this->text = $text;
        $this->var = $var;
        $this->master = $master;
        $this->col1 = $col1;
        $this->col2 = $col2;
        $this->isrequired = (bool)$isrequired;
        $this->isdisabled = (bool)$isdisabled;
        $this->isreadonly = (bool)$isreadonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-option');
    }
}

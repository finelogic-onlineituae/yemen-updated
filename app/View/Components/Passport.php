<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Passport extends Component
{
    /**
     * Create a new component instance.
     */
    public $existingPassport;
    public $useExistingPassport;
    public $issued_by;
    public $issued_on;

    public function __construct($existingPassport, $useExistingPassport, $issued_by = null, $issued_on = null)
    {
        $this->useExistingPassport = $useExistingPassport;
        $this->existingPassport = $existingPassport;
        $this->issued_by = $issued_by;
        $this->issued_on = $issued_on;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.passport');
    }
}

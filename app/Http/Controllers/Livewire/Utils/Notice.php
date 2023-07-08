<?php

namespace App\Http\Controllers\Livewire\Utils;

use Livewire\Component;

class Notice extends Component
{
    protected $listeners = ['notifySuccess', 'notifyError'];

    public function render()
    {
        return view('components.utils.notice');
    }

    public function notifySuccess($item = null)
    {
        session()->flash('success', $item);
    }

    public function notifyError($item = null)
    {
        session()->flash('error', $item);
    }
}

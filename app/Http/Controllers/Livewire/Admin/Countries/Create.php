<?php

namespace App\Http\Controllers\Livewire\Admin\Countries;

use App\Models\Country;
use Livewire\Component;

class Create extends Component
{
    public $form = [];

    public function render()
    {
        return view('admin.countries.form');
    }

    public function rules()
    {
        return [
            'form.name' => 'required|min:2|max:255',
        ];
    }

    public function submit()
    {
        $data = $this->validate($this->rules());

        Country::query()->create($data['form']);

        notify_success("Country created successfully!");

        return redirect()->to(route('admin.countries.index'));
    }
}

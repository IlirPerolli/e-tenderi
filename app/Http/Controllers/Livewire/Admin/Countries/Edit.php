<?php

namespace App\Http\Controllers\Livewire\Admin\Countries;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public Country $country;

    public array $form = [];

    public function mount(Country $slug)
    {
        $this->country = $slug;
        $this->form = $this->country->toArray();
    }

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
        $data = $this->validate($this->rules())['form'];

        $this->country->update($data);

        notify_success('Country updated successfully.');

        return redirect()->to(route('admin.countries.index'));
    }
}

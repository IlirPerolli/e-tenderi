<?php

namespace App\Http\Controllers\Livewire\Admin\Cities;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{
    public array $form = [];
    public Collection $countries;

    public function mount()
    {
        $this->mountCountries();
    }

    public function render()
    {
        return view('admin.cities.form');
    }

    public function rules()
    {
        return [
            'form.name' => 'required|min:2|max:255',
            'form.country_id' => 'required|integer|exists:countries,id'
        ];
    }

    public function submit()
    {
        $data = $this->validate($this->rules());

        City::query()->create($data['form']);

        notify_success("City created successfully!");

        return redirect()->to(route('admin.cities.index'));
    }

    protected function mountCountries(): void
    {
        $this->countries = Country::query()->get();
    }
}

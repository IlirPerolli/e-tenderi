<?php

namespace App\Http\Controllers\Livewire\Admin\Cities;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Collection;
use Livewire\Component;

class Edit extends Component
{
    public City $city;

    public array $form = [];
    public Collection $countries;

    public function mount(City $slug)
    {
        $this->city = $slug;
        $this->form = $this->city->toArray();
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
        $data = $this->validate($this->rules())['form'];

        $this->city->update($data);

        notify_success('City updated successfully.');

        return redirect()->to(route('admin.cities.index'));
    }

    protected function mountCountries(): void
    {
        $this->countries = Country::query()->get();
    }
}

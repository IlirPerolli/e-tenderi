<?php

namespace App\Http\Controllers\Livewire\Admin\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $form = [];

    public function render()
    {
        return view('admin.companies.form');
    }

    public function rules()
    {
        return [
            'form.name' => 'required|min:2|max:255',
            'form.description' => 'nullable|max:10000',
            'form.image_path' => ['required', 'mimes:jpg,jpeg,png,bmp,tiff'],
        ];
    }

    public function submit()
    {
        $data = $this->validate($this->rules());

        $file = $data['form']['image_path'];

        $path = $file->storePublicly();

        $data['form']['image_path'] = $path;

        Company::query()->create($data['form']);

        notify_success("Company created successfully!");

        return redirect()->to(route('admin.companies.index'));
    }
}
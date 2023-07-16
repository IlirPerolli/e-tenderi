<?php

namespace App\Http\Controllers\Livewire\Admin\Providers;

use App\Models\Provider;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public array $form = [];

    public function render()
    {
        return view('admin.providers.form');
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

        Provider::query()->create($data['form']);

        notify_success("Provider created successfully!");

        return redirect()->to(route('admin.providers.index'));
    }
}

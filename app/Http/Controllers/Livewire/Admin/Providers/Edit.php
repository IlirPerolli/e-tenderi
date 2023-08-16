<?php

namespace App\Http\Controllers\Livewire\Admin\Providers;

use App\Models\Provider;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public Provider $provider;

    public $form = [];
    public $uploadedPhoto;
    public $preview_url;

    public function mount(Provider $slug)
    {
        $this->provider = $slug;
        $this->form = $this->provider->toArray();

        $this->preview_url = $this->form['image_path'];
    }

    public function updatedFormImagePath(){
        $this->uploadedPhoto = true;
    }

    public function render()
    {
        return view('admin.providers.form');
    }

    public function updatedFormResourcePath(){
        $this->uploadedPhoto = true;
    }

    public function rules()
    {
        return [
            'form.name' => 'required|min:2|max:255',
            'form.description' => 'nullable',
        ];
    }

    public function submit()
    {
        $data = $this->validate($this->rules())['form'];

        if ($resourcePath = $this->form['image_path']) {
            if ($resourcePath instanceof TemporaryUploadedFile) {

                $path = $resourcePath->storePublicly();

                $data['image_path'] = $path;
            }
        }

        $this->provider->update($data);

        notify_success('Provider updated successfully.');

        return redirect()->to(route('admin.providers.index'));
    }
}

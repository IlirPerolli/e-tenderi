<?php

namespace App\Http\Controllers\Livewire\Admin\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public Company $company;

    public $form = [];
    public $uploadedPhoto;
    public $preview_url;

    public function mount(Company $slug)
    {
        $this->company = $slug;
        $this->form = $this->company->toArray();

        $this->preview_url = $this->form['image_path'];
    }

    public function updatedFormImagePath(){
        $this->uploadedPhoto = true;
    }

    public function render()
    {
        return view('admin.companies.form');
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

        $this->company->update($data);

        notify_success('Company updated successfully.');

        return redirect()->to(route('admin.companies.index'));
    }
}

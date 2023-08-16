<div>
    <form wire:submit.prevent="submit()">
        <x:utils.card>
            <x:slot name="title">Create Provider</x:slot>
            <x:slot name="subtitle">General Provider Information</x:slot>

            <div class="space-y-6 sm:space-y-5">
                <div class="space-y-6 sm:space-y-5">
                    <div
                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-secondary-200 sm:pt-5">
                        <span class="block  text-secondary-700">
                            Name
                        </span>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <x:form.input class="w-full" id="form.name" name="form.name" wire:model.defer="form.name"
                                          placeholder="Name..."/>
                        </div>
                    </div>

                </div>
                <div class="space-y-6 sm:space-y-5">
                    <div class="space-y-6 sm:space-y-5">
                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-secondary-200 sm:pt-5">
                        <span class="block  text-secondary-700">
                            Description
                        </span>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <x:form.text-area class="w-full" id="form.description" name="form.description"
                                              wire:model.defer="form.description" placeholder="Description..."/>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="space-y-6 sm:space-y-5">
                    <div
                        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-secondary-200 sm:pt-5">
                        <span class="block  text-secondary-700 dark:text-secondary-100">
                            Photo
                        </span>
                        <div class="mt-2 sm:mt-1 sm:col-span-2">
                            <div class="flex items-center max-w-xl space-x-4">
                                <div
                                    class="h-24 sm:h-32 w-32 sm:w-48 bg-secondary-100 dark:bg-gray-800 rounded-lg overflow-hidden outline outline-offset-4 @if(isset($form['image_path'])) outline-primary-400 @else outline-tertiary-400 @endif outline-dashed">
                                    @if ($uploadedPhoto ?? false)
                                        <img class="w-full h-full object-cover rounded-md"
                                             src="{{$form['image_path']->temporaryUrl()}}" alt="thumbnail"/>
                                    @else
                                        @php $coverImage = $preview_url ?? $form['image_path'] ?? null; @endphp
                                        @if ($coverImage)
                                            <img class="w-full h-full object-cover rounded-md"
                                                 src="{{!$coverImage instanceof \Illuminate\Http\UploadedFile ? resourceUrl($coverImage) : $form['image_path']->temporaryUrl()}}"
                                                 alt="thumbnail"/>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    <label for="form.image_path"
                                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white dark:text-neutral-100 dark:bg-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-600 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 cursor-pointer">
                                        <span>Select File</span>
                                    </label>
                                    @if(isset($form['image_path']) && $form['image_path'] instanceof \Livewire\TemporaryUploadedFile)
                                        <h1 class="text-xs text-secondary-900">
                                            {{$form['image_path']->getClientOriginalName()}}
                                        </h1>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                <x:form.error for="form.image_path"/>
                                <x:form.loading-input>
                                    <input type='file' class="hidden" id="form.image_path"
                                           accept="image/*" wire:model="form.image_path"/>
                                </x:form.loading-input>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mt-8 border-t border-gray-200 pt-5">
                    <div class="flex justify-end">
                        <div class="flex items-center space-x-3 ml-3 inline-flex rounded-md">
                            <div wire:loading wire:target="submit">
                                <x:icons.loader class="w-6 h-6"/>
                            </div>
                            <x:primary-button>
                                Submit
                            </x:primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </x:utils.card>
    </form>
</div>

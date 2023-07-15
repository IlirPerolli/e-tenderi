<div>
    <form wire:submit.prevent="submit()">
        <x:utils.card>
            <x:slot name="title">Create Country</x:slot>
            <x:slot name="subtitle">General Country Information</x:slot>

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

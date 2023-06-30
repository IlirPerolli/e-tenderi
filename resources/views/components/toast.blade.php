<div x-data="{ openNotice : true }"
     x-init="() => { if(openNotice){setTimeout(function(){openNotice = false},10000)} }"
     x-cloak
     wire:key="{{rand(1,1000000)}}"
     class="z-10 fixed bottom-0 right-0 left-0 top-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-end sm:justify-end">
    <div x-show="openNotice"
         x-transition:enter="transform ease-out duration-00 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="max-w-sm w-full bg-secondary-800 shadow-lg rounded-lg pointer-events-auto">
        <div class="rounded-md p-4 bg-secondary-800">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-white">
                        {{$slot}}
                    </p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1">
                        <button
                                @click="openNotice = false"
                                class="inline-flex rounded-md p-1.5 text-secondary-900">
                            <span class="sr-only">Dismiss</span>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L6 4.58579L10.2929 0.292893C10.6834 -0.0976311 11.3166 -0.0976311 11.7071 0.292893C12.0976 0.683417 12.0976 1.31658 11.7071 1.70711L7.41421 6L11.7071 10.2929C12.0976 10.6834 12.0976 11.3166 11.7071 11.7071C11.3166 12.0976 10.6834 12.0976 10.2929 11.7071L6 7.41421L1.70711 11.7071C1.31658 12.0976 0.683417 12.0976 0.292893 11.7071C-0.0976311 11.3166 -0.0976311 10.6834 0.292893 10.2929L4.58579 6L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
                                      fill="#F5F5F5"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<body class="font-sans antialiased" x-data="{ darkMode: false }" x-init="
    if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      localStorage.setItem('darkMode', JSON.stringify(true));
    }
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" x-cloak>
<div class="ml-2">
    <button type="button" x-on:click="darkMode = !darkMode"
            x-bind:class="darkMode ? 'bg-blue-500' : 'bg-blue-900'"
            class="px-6 py-4 rounded-md transition-colors duration-200 ease-in-out relative overflow-hidden">
        <span x-show="darkMode"
              x-transition:enter="transition duration-300 transform"
              x-transition:enter-start="-translate-x-full"
              x-transition:enter-end="translate-x-0"
              class="absolute inset-0 flex justify-center items-center">
            <x:icons.sun class="h-5 w-5 text-yellow-500 fill-current transition duration-1000 ease-in-out"/>
        </span>
        <span x-show="!darkMode"
              x-transition:enter="transition duration-300 transform"
              x-transition:enter-start="translate-x-full"
              x-transition:enter-end="translate-x-0"
              class="absolute inset-0 flex justify-center items-center">
            <x:icons.moon class="h-5 w-5 text-white fill-current transition duration-1000 ease-in-out"/>
        </span>
    </button>
</div>
</body>
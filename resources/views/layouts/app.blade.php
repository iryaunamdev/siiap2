<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIIAP') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Laravolt" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiase min-h-screen max-w-screen bg-gray-100">
    <header class="block">
        @livewire('navigation-menu')
    </header>
    <main class="block min-h-screen pt-16 flex flex-nowwrap text-start border bg-gray-50 dark:border-zinc-900 dark:bg-zinc-700">
        @livewire('sys.sidemenu')
        <div class="container w-full py-8 px-8">
            <x-notifications />
            {{ $slot }}
            <footer class="bottom-0 z-20 w-full  p-4 mt-4 md:flex md:items-center md:justify-between md:p-6">
            <span class="text-xs m-auto text-center">Sistema Integral de Información Académica de Posgrado<br>
                Instituto de Radioastronomía y Astrofísica</span>
        </footer>
        </div>

    </main>


    <x-banner />

    {{--
    <div class="">
        <main class="block min-h-screen pt-16 flex flex-nowwrap text-start border bg-gray-50 dark:border-zinc-900 dark:bg-zinc-700">
            @livewire('sys.sidemenu')
            <div class="container h-full w-auto bg-red">
                {{ $slot }}
                <footer class="absolute bottom-0 z-20 w-full p-4 mt-4 md:flex md:items-center md:justify-between md:p-6">
                    <div class="m-auto text-xs text-center">Sistema Integral de Información Académica de Posgrado<br>
                        Instituto de Radioastronomía y Astrofísica</div>
                </footer>
            </div>
        </main>
        {{--
        <!-- Page Content -->
        <div class="relative w-full h-full items-start justify-center border bg-gray-50 dark:border-zinc-900 dark:bg-zinc-700">
            @livewire('sys.sidemenu')
            <main class="w-auto text-start min-h-screen" id="content">
                {{ $slot }}
        <footer class="absolute bottom-0 z-20 w-full p-4 mt-4 md:flex md:items-center md:justify-between md:p-6">
            <div class="m-auto text-xs text-center">Sistema Integral de Información Académica de Posgrado<br>
                Instituto de Radioastronomía y Astrofísica</div>
        </footer>
        </main>
    </div>
    --}}

    @stack('modals')
    @livewireScripts
</body>
@stack('scripts')

</html>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('head-tag')
    @vite('resources/css/app.css')
</head>

<body x-data="{ open: false }" class="bg-slate-100">
    <div class="flex lg:gap-3 w-full relative ">
        <div class="lg:basis-[13%] relative flex-grow">
            <x-Sidebar />
        </div>
        <div class="lg:basis-[87%] w-full flex-grow">
            <div class="h-screen bg-black absolute min-h-full w-screen z-10 bg-opacity-50" x-show="open">
            </div>
            <div class="p-2 flex flex-col">
                <x-Header />
                <div class="p-2 bg-white rounded drop-shadow mt-3  overflow-auto flex-grow">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @yield('bottom')
</body>

</html>

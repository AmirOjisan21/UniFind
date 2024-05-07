<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Unifind</title>

        @vite(['resources/css/app.css','resources/js/app.js'])

        @include('comp.menu')

    </head>
    <body class="antialiased z-0 font-mono">
        <section class="bg-white dark:bg-gray-900 px-12">
            <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400 px-12">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{$ksajs->name}}</h2>
                    <p class="mb-4">{{$ksajs->description}}</p>
                    <h3>Open Hours</h3>
                    <P>{{$ksajs->open_hours}}</p>
                    <P>{{$ksajs->important_details}}
                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <img class="w-full rounded-lg" src="{{ asset('/images/' . $ksajs->image) }}" alt="office content 1">
                </div>
            </div>
        </section>

        <a href="{{ route('ksajs')}}"
            class="inline-flex items-center px-10 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            Return
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                aria-hidden="true"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    </body>
</html>

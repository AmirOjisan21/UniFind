<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Unifind</title>

        <script src="{{asset('build/assets/app.js')}}">
            </script>
        <link rel="stylesheet" href="{{asset('build/assets/app.css')}}">
        @vite(['resources/css/app.css','resources/js/app.js'])

        @include('comp.menu')

    </head>
    <body class="antialiased z-0" >
        <div class=" max-width: 100% mx-auto px-16 py-10 font-mono grid-rows-3 grid gap-10 bg-slate-50">
            <div class="relative max-width: 100% rounded-xl py-10 bg-white shadow-xl ring-1 ring-black/20 grid gap-6 md:grid-cols-2 md:grid-rows-1">
                <div class="px-6 content-center text-center">
                    <div class="text-5xl font-Medium text-blue-800 py-6">
                        <h1>Welcome To</h1>
                        <h1>UPSI Unifind</h1>
                    </div>
                    <div class="text-base text-center content-center inline-block py-6">
                        <div class=""><h1>A one stop hub to look for buldings , locations and current events within the UPSI campuses</h1></div>
                    </div>
                </div>
                <div class="contet-center">
                    <img src="{{ asset('image/Logo.png') }}" class="w-4/6 rounded-full mx-auto" />
                </div>
            </div>
            <div class="relative max-width: 100% rounded-xl py-10 bg-white shadow-xl ring-1 ring-black/20 grid gap-2 md:grid-cols-2 md:grid-rows-1">
                <div class="contet-center">
                    <img src="{{ asset('image/KSAS.jpg') }}" class="w-5/6 rounded-md mx-auto" />
                </div>
                <div class="px-6 content-center grid gap-3 text-center">
                    <div class="text-3xl grid-rows-1 py-6">
                        <h1 class="text-5xl font-medium text-blue-800">Kampus Sultan Azlan Shah (KSAS)</h1>
                    </div>
                    <div class="text-base text-center content-center inline-block py-4">
                        <div class="pt-4"><h1>KSAS is the newer out of the two UPSI campuses and is located in Proton City</h1></div>
                    </div>
                    <div class="font-mono grid-cols-1 text-center content-center py-6">
                        <a href="{{ route('ksaspub') }}" class= "bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100  rounded-full px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">KSAS MAP</a>
                    </div>
                    
                </div>
            </div>
            <div class="relative max-width: 100% rounded-xl py-10 bg-white shadow-xl ring-1 ring-black/20 grid gap-2 md:grid-cols-2 md:grid-rows-1">
                <div class="px-6 content-center grid gap-3 text-center">
                    <div class="text-3xl grid-rows-1 py-6">
                        <h1 class="text-5xl font-medium text-blue-800">Kampus Sultan Abdul Jalil Shah (KSAJS)</h1>
                    </div>
                    <div class="text-base text-center content-center inline-block py-4">
                        <div class="pt-4"><h1>KSAJS is the older out of the two UPSI campuses and is located in Tajong Malim</h1></div>
                    </div>
                    <div class="font-mono grid-cols-1 text-center content-center py-6">
                        <a href="{{ route('ksajs') }}" class= "bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100  rounded-full px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">KSAJS MAP</a>
                    </div>
                </div>
                <div class="contet-center">
                    <img src="{{ asset('image/KSAJS.jpg') }}" class="w-5/6 rounded-md mx-auto" />
                </div>
            </div>
          
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    </body>
</html>

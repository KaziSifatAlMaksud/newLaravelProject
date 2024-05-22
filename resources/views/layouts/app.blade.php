<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- favicon start --}}
   <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="./assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
  {{-- favicon end --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('build/assets/app-CbR7y7aL.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-CyBtEQIt.css') }}">

    <title>@yield('title', 'Default Title') - {{ config('app.name', 'Laravel') }}</title>
</head>
<body>

    <main class="w-full pb-6">
        <header class="md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3 flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4">
            <nav class="w-full mx-auto flex flex-wrap justify-between basis-full items-center" aria-label="Global">
                <a href="{{route('dashboard')}}" 0 class="sm:order-1 flex-none text-xl font-semibold "> <img class="w-[110px]" src="/assets/images/logo_horizontal2.png" alt="" /> </a>
                <div class="sm:order-3 flex items-center gap-x-2">
                    <div class="hs-dropdown relative inline-flex">
                        {{-- <img class="xl:size-[71px] size-[55px] rounded-full" src=" {{ !empty($profile_info) && !empty($profile_info->image) ? asset('uploads/' . $profile_info->image) : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg' }}" /> --}}
                        <img class="w-[40px] rounded-[76px]" src=" {{ !empty($profile_info) && !empty($profile_info->image) ? asset('uploads/' . $profile_info->image) : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg' }}" />


                        <div class=" hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 bg-white shadow-md rounded-lg p-2 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" aria-labelledby="hs-dropdown-default">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black-2 hover:bg-primary-20 focus:ring-2 focus:ring-blue-20   " href="{{route('profile.edit')}}">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-primary-20 focus:ring-2 focus:ring-blue-20">
                                    Logout
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </nav>
        </header>


        @yield('main')
    </main>

    <!-- Optional scripts area for extending views -->
    @yield('script')
    <script src="./node_modules/preline/dist/preline.js"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="./assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    @vite('resources/css/app.css')
    @vite('resources/css/style.css')
    @vite('resources/js/app.js')
    <script src="{{ asset('build/assets/app-CbR7y7aL.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-2DXyPuh3.css') }}">

</head>
<body>
    <main class="login-page py-10 px-4 h-[100vh]">
        <div>
            <div class="flex justify-center items-center">
                <img class="md:w-[180px] w-[120px] origin-top-left " src="./assets/images/logo.png" />
            </div>
            <div class="flex justify-center items-center">
                <div class="w-[513px] md:px-[69px] py-[40px] px-6 md:py-[79px] bg-white rounded-[20px] shadow backdrop-blur-[100px] flex-col justify-center items-center gap-[15px] md:gap-[34px] inline-flex">


                    <label for="themeSwitcherOne" class="border  inline-flex cursor-pointer select-none items-center justify-between w-full rounded-md bg-white  p-1 shadow-md">

                        <input type="checkbox" name="themeSwitcherOne" id="themeSwitcherTow" class="sr-only theme-switch" />

                        <span class="flex items-center space-x-1.5 rounded py-2 px-4 text-sm font-medium bg-gray-100  text-primary admin-label" style="width: 50%; justify-content:center;">

                            Admin

                        </span>


                        <a href="{{route('user_login')}}" class="flex items-center space-x-1.5 rounded py-2 px-4 text-sm font-medium text-gray-700  user-label" style="width: 50%; justify-content:center;">

                            User
                        </a>

                    </label>
                    <div class="self-stretch h-7 flex-col justify-center items-center gap-4 flex">
                        <div class="md:text-[28px] text-[20px] font-semibold leading-7">
                            Admin Login
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul class="mt-3 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form method="POST" action="{{ route('login') }}" class="self-stretch flex-col justify-start items-start md:gap-6 gap-4 flex">

                        @csrf
                        <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                            <div class="self-stretch justify-start items-start gap-3 inline-flex">
                                <div class="grow shrink basis-0 text-slate-700 md:text-base text-[14px] font-normal  capitalize leading-none">
                                    Email
                                </div>
                            </div>
                            <div class="self-stretch justify-start items-start gap-2 inline-flex">
                                <input type="email" id="input-email-label" name="email" class="input_custom" placeholder="Enter your email" />
                            </div>
                        </div>

                        <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                            <div class="self-stretch justify-start items-start inline-flex">
                                <div class="grow shrink basis-0 text-slate-700 md:text-base text-[14px] font-normal  capitalize leading-none">
                                    Password
                                </div>
                                <div class="text-right text-primary md:text-base text-[14px] font-normal  capitalize leading-none">
                                    Forgot？
                                </div>
                            </div>


                            <div class="self-stretch flex-col justify-start items-start gap-2 flex">
                                <div class="self-stretch  rounded-lg justify-start items-center gap-[5px] inline-flex">

                                    <input type="password" id="input-password-label" name="password" class="input_custom" placeholder="Enter your password" />
                                </div>
                            </div>
                        </div>
                        <div class="self-stretch pt-2">
                            <button type="submit" class="btn-primary w-full">
                                Login
                            </button>
                        </div>

                    </form>
                    <div class="self-stretch">
                        {{-- <div class="self-stretch">
                            <button type="button" class="btn-secondary w-full ">
                                <img src="./assets/images/google.png"> Continue with Google
                            </button>
                        </div> --}}
                        <div class="self-stretch pt-3">
                            <div class="flex gap-2 md:text-[16px] text-[14px] justify-center">
                                <p>Don't have an account?</p> <a href="{{route('register')}}" class="text-primary underline">SignUp</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>
</html>

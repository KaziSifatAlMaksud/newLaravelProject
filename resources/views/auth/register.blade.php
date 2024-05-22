<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignUp</title>

    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="./assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    <script src="{{ asset('build/assets/app-CbR7y7aL.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-2DXyPuh3.css') }}">


</head>
<body>
    <main class="login-page py-10 mb-12 px-4 h-[100vh]">
        <div>
            <div class="flex justify-center items-center">
                <img class="md:w-[180px] w-[120px] origin-top-left " src="./assets/images/logo.png" />
            </div>
            <div class="flex justify-center items-center">
                <div class="w-[513px] md:px-[69px] py-[40px] px-6 md:py-[79px] bg-white rounded-[20px] shadow backdrop-blur-[100px] flex-col justify-center items-center gap-[15px] md:gap-[34px] inline-flex">

                    <div class="self-stretch h- flex-col justify-center items-center gap-4 flex">
                        <div class="md:text-[28px] text-[20px] font-semibold leading-7">
                            Sign Up
                        </div>
                    </div>



                    <form action="{{ route('register') }}" method="POST" class="self-stretch flex-col justify-start items-start md:gap-6 gap-4 flex">

                        @csrf

                        <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                            <div class="self-stretch justify-start items-start gap-3 inline-flex">
                                <div class="grow shrink basis-0 text-slate-700 md:text-[16px] text-[14px] font-normal  capitalize leading-none">
                                    Name
                                </div>
                            </div>
                            <div class="self-stretch justify-start items-start gap-2 inline-flex">
                                <input type="text" id="input-name-label" required name="name" class="input_custom" placeholder="Enter your name" value="{{ old('name') }}" />


                            </div>
                        </div>
                        @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                            <div class="self-stretch justify-start items-start gap-3 inline-flex">
                                <div class="grow shrink basis-0 text-slate-700 md:text-[16px] text-[14px] font-normal  capitalize leading-none">
                                    Email
                                </div>
                            </div>
                            <div class="self-stretch justify-start items-start gap-2 inline-flex">
                                <input type="email" id="input-label" name="email" required class="input_custom" placeholder="Enter your email" value="{{ old('email') }}" />


                            </div>
                        </div>
                        @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                            <div class="self-stretch justify-start items-start inline-flex">
                                <div class="grow shrink basis-0 text-slate-700 md:text-[16px] text-[14px] font-normal  capitalize leading-none">
                                    Password
                                </div>
                            </div>
                            <div class="self-stretch flex-col justify-start items-start gap-2 flex">
                                <div class="self-stretch  rounded-lg justify-start items-center gap-[5px] inline-flex">

                                    <input type="password" id="input-password-label" class="input_custom" name="password" required placeholder="Enter your password" value="{{ old('password') }}" />



                                </div>
                            </div>

                        </div>
                        @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror


                        <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                            <div class="self-stretch justify-start items-start inline-flex">
                                <div class="grow shrink basis-0 text-slate-700 md:text-[16px] text-[14px] font-normal  capitalize leading-none">
                                    Confirm Password
                                </div>
                            </div>
                            <div class="self-stretch flex-col justify-start items-start gap-2 flex">
                                <div class="self-stretch  rounded-lg justify-start items-center gap-[5px] inline-flex">

                                    <input type="password" id="input-password-label" name="password_confirmation" class="input_custom" required placeholder="Enter your confirm password" value="{{ old('password_confirmation') }}" />


                                </div>
                            </div>
                        </div>

                        @error('password_confirmation')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror



                        <div class="self-stretch pt-3">
                            <button type="submit" class="btn-primary w-full">
                                Create Account
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
                            <div class="flex gap-2 justify-center md:text-[16px] text-[14px]">
                                <p>Already have an account?</p> <a href="{{route('login')}}" class="text-primary underline">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        $.ajax({
            url: '{{ route("register") }}'
            , method: 'POST', // Make sure this is 'POST' for registrations
            data: {}
            , success: function(response) {
                console.log(response);
            }
        });

    </script>
</body>
</html>

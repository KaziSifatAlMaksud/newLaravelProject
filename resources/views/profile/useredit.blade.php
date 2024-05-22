<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Settings</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])


    <script src="{{ asset('build/assets/app-CbR7y7aL.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-2DXyPuh3.css') }}">



    <link rel="stylesheet" href="./styles/style.css" />
</head>
<body>
    <main class="w-full pb-6">
        <!-- navbar section -->

        <!-- navbar section -->
        <header class=" md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3 flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4 z-50">

            <nav class="w-full sm:container mx-auto flex flex-wrap justify-between basis-full items-center" aria-label="Global">






                <a class="sm:order-1 flex-none text-xl font-semibold " href="{{ route('chat') }}"><img class="w-[110px]" src="/assets/images/logo_horizontal2.png" alt="" /></a>

                <div class="sm:order-3 flex items-center gap-x-2">
                    <div class="hs-dropdown relative inline-flex">



                        <img class="w-10 h-10 rounded-full" src=" {{ $childuserInfo->profile ? asset('uploads/' . $childuserInfo->profile) : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg' }}" alt="User Profile Image" />




                        <div class="z-50 hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 bg-white shadow-md rounded-lg p-2 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" aria-labelledby="hs-dropdown-default">
                            <a href="{{ route('userprofile') }}" class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-primary-20 focus:ring-2 focus:ring-blue-20" type="button">
                                Profile
                            </a>
                            <form id="logout-form" action="{{ route('user_logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-primary-20 focus:ring-2 focus:ring-blue-20">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>


        @if ($childuserInfo)


        <!-- profile settings section -->
        <section class="md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3">
            <div class="flex flex-col">
                <div class="flex flex-col self-center mt-10 w-full max-md:mt-10 max-md:max-w-full">
                    <div class="text-lg font-semibold leading-[10px] text-zinc-800 max-md:max-w-full">
                        Profile Settings
                    </div>

                    <form action="{{ route('child_user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $childuserInfo->id }}">


                        <div class="flex flex-col justify-center mt-6 bg-white rounded-lg shadow-sm max-md:max-w-full">
                            <div class="flex flex-col justify-center items-start px-6 py-5 text-xs font-medium leading-5 text-primary rounded border-b border-solid border-zinc-100 max-md:px-5 max-md:max-w-full">
                                <div class="justify-center p-3 rounded-lg bg-blue-600 bg-opacity-10">
                                    Personal Information
                                </div>
                            </div>
                            <div class="flex flex-col md:px-7 lg:px-14 px-3  md:py-12 py-8 md:mx-5 mx-2 mt-5 rounded-lg border border-solid border-zinc-100">
                                <div>
                                    <div class="relative inline-block  border" style="width: 40%; height: 200px;  position: relative;">

                                        <img class="inline-block md:size-[510px]  rounded" style="width: 100%; height: 100%; object-fit: cover; " id="cover-img" src="{{ $childuserInfo->cover_photo ? asset('uploads/' . $childuserInfo->cover_photo) : 'default-cover.jpg' }}" alt="Cover Image Description" />

                                        <span class="absolute top-[12px] end-[9px] block p-[6px] border-[4px] border-white rounded-full transform -translate-y-1/2 translate-x-1/2 text-white bg-primary">
                                            <input type="file" name="cover_photo" class="absolute w-full h-full opacity-0" id="cover-image" />

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera md:size-[18px] size-[13px]">
                                                <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                                <circle cx="12" cy="13" r="3" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="md:flex-row flex flex-col mt-6 gap-10 items-center text-base font-semibold text-zinc-800">
                                        <div class="relative inline-block">
                                            <img class="inline-block md:size-[110px] size-20 rounded-full" id="profile-img" src="{{ $childuserInfo->profile ? asset('uploads/' . $childuserInfo->profile) : 'default-profile.jpg' }}" alt="Image Description" />




                                            <span class="absolute top-[12px] end-[9px] block p-[6px] border-[4px] border-white rounded-full transform -translate-y-1/2 translate-x-1/2 text-white bg-primary">
                                                <input type="file" name="profile" class="absolute w-full h-full opacity-0" id="profile-image" />

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera md:size-[18px] size-[13px]">
                                                    <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                                    <circle cx="12" cy="13" r="3" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="mt-11 text-base font-semibold leading-[150%] mb-5 text-zinc-800">
                                        Profile :
                                    </div>
                                    <div class="grid md:grid-cols-2 md:gap-6 gap-4">
                                        <div>
                                            <label for="input-label" class="block text-sm font-medium mb-2 ">Name</label>
                                            <input type="text" id="input-label" name="name" class="input_custom" placeholder="Enter your name" value="{{$childuserInfo &&  $childuserInfo->name ? $childuserInfo->name : '' }}" readonly />




                                        </div>
                                        <div>
                                            <label for="input-label" class="block text-sm font-medium mb-2 ">Email</label>
                                            <input type="email" id="input-label" name="email" class="input_custom" placeholder="Enter your email address" value="{{$childuserInfo &&  $childuserInfo->email ? $childuserInfo->email : '' }}" readonly />



                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="mt-12 text-base font-semibold leading-[150%] mb-5 text-zinc-800">
                                        Personal information :
                                    </div>
                                    <div class="grid md:grid-cols-2 md:gap-6 gap-4">

                                        <div>
                                            <label for="status" class="block text-sm font-medium mb-2">Account Status:</label>


                                            <select id="status" name="status" class="input_custom" style="border: 1px solid #ccc; padding: 8px; width: 100%;">


                                                <option value="" disabled {{ empty($childuserInfo->status) ? 'selected' : '' }}>Account Status</option>
                                                <option value="0" {{ (!empty($childuserInfo) && $childuserInfo->status == '0') ? 'selected' : '' }}>Active</option>
                                                <option value="1" {{ (!empty($childuserInfo) && $childuserInfo->status == '1') ? 'selected' : '' }}>Deactivate</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col justify-center items-end px-16 py-6 mt-12 text-sm font-medium leading-5 text-center text-white rounded-none border-t border-gray-100 border-solid max-md:pl-5 max-md:mt-10 max-md:max-w-full">
                                <button type="submit" class="justify-center px-3.5 py-3.5 bg-blue-700 rounded">

                                    Save Changes
                                </button>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </main>

    @else
    <script>
        window.location.href = "{{ route('user_login') }}"; // Use JavaScript for redirection

    </script>
    @endif



    <script src="./node_modules/preline/dist/preline.js"></script>
    <script>
        let loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById("profile-img");
                if (event.target.files[0].type.match("image.*")) {
                    output.src = reader.result;
                } else {
                    event.target.value = "";
                    alert("please select a valid image");
                }
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        };
        // for profile photo update
        let ProfileChange = document.querySelector("#profile-image");
        ProfileChange.addEventListener("change", loadFile);

    </script>
    <script>
        let loadCoverPhoto = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById("cover-img");
                if (event.target.files[0].type.match("image.*")) {
                    output.src = reader.result;
                } else {
                    event.target.value = "";
                    alert("Please select a valid image for the cover photo.");
                }
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        };

        // Event listener for cover photo update
        let coverPhotoChange = document.querySelector("#cover-image");
        coverPhotoChange.addEventListener("change", loadCoverPhoto);

    </script>


</body>
</html>

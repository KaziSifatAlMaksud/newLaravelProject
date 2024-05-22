@extends('layouts.app')
@section('title', 'Edit Profile')
@section('main')

<!-- profile settings section -->
<section class="md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3">
    <div class="flex flex-col">
        <div class="flex flex-col self-center mt-10 w-full max-md:mt-10 max-md:max-w-full">
            <div class="text-lg font-semibold leading-[10px] text-zinc-800 max-md:max-w-full">
                Profile Settings
            </div>
            <div class="flex flex-col justify-center mt-6 bg-white rounded-lg shadow-sm max-md:max-w-full">
                <div class="flex flex-col justify-center items-start px-6 py-5 text-xs font-medium leading-5 text-primary rounded border-b border-solid border-zinc-100 max-md:px-5 max-md:max-w-full">
                    <div class="justify-center p-3 rounded-lg bg-blue-600 bg-opacity-10">
                        <a href="{{route('dashboard')}}"> <b> Home </b> </a> / Personal Information


                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col md:px-7 lg:px-14 px-3  md:py-12 py-8 md:mx-5 mx-2 mt-5 rounded-lg border border-solid border-zinc-100">
                        <div>
                            <div class="font-semibold leading-[150%] mb-5 text-zinc-800">Photo :</div>
                            <div class="md:flex-row flex flex-col mt-6 gap-10 items-center text-base font-semibold text-zinc-800">
                                <div class="relative inline-block">


                                    <img class="inline-block md:size-[110px] size-20 rounded-full" id="profile-img" src="{{ $profile_info && $profile_info->image ? asset('uploads/' . $profile_info->image) : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg' }}" alt="Image Description" />

                                    <span class="absolute top-[12px] end-[9px] block p-[6px] border-[4px] border-white rounded-full transform -translate-y-1/2 translate-x-1/2 text-white bg-primary">
                                        <input type="file" name="image" class="absolute w-full h-full opacity-0" id="profile-image" />
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-camera md:size-[18px] size-[13px]">
                                            <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                            <circle cx="12" cy="13" r="3" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="inline-flex rounded-lg shadow-sm">
                                    <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 -ms-px first:rounded-s-lg first:ms-0 last:rounded-e-lg text-sm font-medium focus:z-10 border border-gray-200 bg-primary text-white shadow-sm hover:bg-blue-900 disabled:opacity-50 disabled:pointer-events-none">
                                        Change
                                    </button>

                                    <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 -ms-px first:rounded-s-lg first:ms-0 last:rounded-e-lg text-sm font-medium focus:z-10 border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none ">
                                        Remove
                                    </button>
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
                                    <input type="text" id="input-label" name="name" class="input_custom" value="{{$user &&  $user->name  ? $user->name  : '' }}" placeholder="Enter your name" />


                                </div>
                                <div>
                                    <label for="input-label" class="block text-sm font-medium mb-2 ">Email</label>
                                    <input type="email" id="input-label" class="input_custom" value="{{$user &&  $user->email  ? $user->email  : '' }}" disabled placeholder="Enter your email address" />


                                </div>
                            </div>
                        </div>


                        <div>
                            <div class="mt-12 text-base font-semibold leading-[150%] mb-5 text-zinc-800">
                                Personal information :
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 gap-4">
                                <div>
                                    <label for="input-label" class="block text-sm font-medium mb-2 ">Address</label>
                                    <input type="text" id="input-label" class="input_custom" name="address" value=" {{$profile_info && $profile_info->address ?  $profile_info->address : '' }}" placeholder="address" />





                                </div>
                                <div>
                                    <label for="input-label" class="block text-sm font-medium mb-2 ">Contact Number</label>
                                    <input type="tel" id="input-label" class="input_custom" name="phone" value=" {{$profile_info && $profile_info->phone ?  $profile_info->phone : '' }}" placeholder="contact details" />



                                </div>


                                <div>
                                    <label for="gender-select" class="block text-sm font-medium mb-2">Gender</label>
                                    <select id="gender-select" name="gender" class="input_custom" style="border: 1px solid #ccc; padding: 8px; width: 100%;">
                                        <option value="" disabled {{ empty($profile_info->gender) ? 'selected' : '' }}>Select your gender</option>
                                        <option value="M" {{ (!empty($profile_info) && $profile_info->gender == 'M') ? 'selected' : '' }}>Male</option>
                                        <option value="F" {{ (!empty($profile_info) && $profile_info->gender == 'F') ? 'selected' : '' }}>Female</option>
                                        <option value="O" {{ (!empty($profile_info) && $profile_info->gender == 'O') ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>


                                <div>
                                    <label for="input-label" class="block text-sm font-medium mb-2 ">Country</label>
                                    <input type="text" id="input-label" class="input_custom" placeholder="Country" name="country" value=" {{$profile_info && $profile_info->country ?  $profile_info->country : '' }}" />



                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label for="bio" class="block text-sm font-medium mb-2">Bio</label>
                                <textarea name="bio" id="bio" class="py-3 px-4 border block w-full border-gray-200 rounded-lg text-sm focus:border-primary-20 focus:ring-primary-20 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:focus:ring-gray-600" rows="8" placeholder="Enter your bio here..." aria-label="Bio">
                                {{ old('bio', $profile_info->bio ?? '') }}



                                </textarea>
                            </div>





                        </div>


                    </div>

                    <div class="flex flex-col justify-center items-end px-16 py-6 mt-12 text-sm font-medium leading-5 text-center text-white rounded-none border-t border-gray-100 border-solid max-md:pl-5 max-md:mt-10 max-md:max-w-full">
                        <button type="submit" class="justify-center px-3.5 py-3.5 bg-blue-700 rounded text-white">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>




        </div>
    </div>
    </div>
</section>

@endsection


@section('script')
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



@endsection

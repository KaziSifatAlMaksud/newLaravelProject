@extends('layouts.app')
@section('title', 'Dashboard')
@section('main')

<section class="md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3 pt-6">
    <div class="w-full">
        <div class="p-6 flex gap-6 rounded-[7px] shadow" style="
              background-image: url(./assets/images/profile_bannar.png);
              background-size: cover;
              background-position: center;
            ">
            <div class="w-fit">
                <div class="relative">




                    <img class="xl:size-[71px] size-[55px] rounded-full" src=" {{ !empty($profile_info) && !empty($profile_info->image) ? asset('uploads/' . $profile_info->image) : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg' }}" />

                    <div class="xl:size-[15.53px] size-[12px] xl:right-[5px] right-[2px] bottom-0 absolute border border-white bg-green rounded-full" style="background: rgb(1, 172, 1);"></div>
                </div>
            </div>
            <div class="flex flex-col lg:gap-6 gap-3 xl:pt-3 pt-2">
                <div class="">
                    <div class="text-white xl:text-xl text-lg font-bold leading-tight">
                        {{$user && $user->name ? $user->name : ''}}


                    </div>

                    <div class="text-gray-2 text-xs font-medium leading-3">
                        {{$user && $user->email ? $user->email : ''}}


                    </div>
                </div>


                <div class="flex justify-start gap-12 items-center">
                    <div class="w-fit">
                        <p class="text-center text-white xl:text-[22px] text-[16px] font-bold">
                            {{$countchildUsers ?? '0'}}
                        </p>
                        <p class="text-gray-200 text-xs font-medium">User</p> <!-- Modified text-gray-2 to text-gray-200 if using Tailwind CSS -->
                    </div>

                    <div class="w-fit">
                        <p class="text-center text-white xl:text-[22px] text-[16px] font-bold">
                            {{$countVideo ?? '0'}}
                        </p>
                        <p class="text-gray-200 text-xs font-medium">Total Videos</p> <!-- Same modification as above -->
                    </div>
                </div>





            </div>
        </div>
    </div>


    <div class="py-6 flex felx md:flex-row flex-col-reverse gap-6 ">
        <div>
            <button type="button" class="btn-primary w-full" data-hs-overlay="#hs-vertically-centered-modal">
                Add User
            </button>

            <div id="hs-vertically-centered-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
                <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                    <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto ">
                        <div class="flex justify-between items-center py-3 px-4  ">
                            <h3 class="font-bold text-gray-800 ">

                            </h3>
                            <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none " data-hs-overlay="#hs-vertically-centered-modal">
                                <span class="sr-only">Close</span>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>


                        <div class="md:px-[70px] px-[20px] pb-[40px] overflow-y-auto">
                            <div class="text-neutral-800 md:text-[28px] text-[18px] pb-6 text-center font-semibold leading-7">Add People</div>
                            <form action="{{ route('createpeople') }}" method="post" class="self-stretch flex-col justify-start items-start gap-6 flex">

                                @csrf

                                <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                                    <div class="self-stretch justify-start items-start gap-3 inline-flex">
                                        <div class="grow shrink basis-0 text-slate-700 md:text-base text-sm font-normal  capitalize leading-none">
                                            Name
                                        </div>
                                    </div>
                                    <div class="self-stretch justify-start items-start gap-2 inline-flex border">
                                        <input type="text" name="name" id="input-name-label" class="py-3 px-4 block w-full border-gray-2 rounded-lg text-sm focus:border-blue-20 focus:ring-blue-20 disabled:opacity-50 disabled:pointer-events-none placeholder:text-sm " placeholder="Enter your name" />
                                    </div>
                                </div>
                                <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                                    <div class="self-stretch justify-start items-start gap-3 inline-flex">
                                        <div class="grow shrink basis-0 text-slate-700 md:text-base text-sm font-normal  capitalize leading-none">
                                            Username <em class="text-red-700" >*</em>
                                        </div>
                                    </div>
                                    <div class="self-stretch justify-start items-start gap-2 inline-flex border">
                                        <input type="text" required name="username" id="input-email-label" class="py-3 px-4 block w-full border-gray-2 rounded-lg text-sm focus:border-blue-20 focus:ring-blue-20 disabled:opacity-50 disabled:pointer-events-none placeholder:text-sm   " placeholder="Enter your Username" />
                                    </div>
                                </div>
                                <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                                    <div class="self-stretch justify-start items-start gap-3 inline-flex">
                                        <div class="grow shrink basis-0 text-slate-700 md:text-base text-sm font-normal  capitalize leading-none">
                                            Email
                                        </div>
                                    </div>
                                    <div class="self-stretch justify-start items-start gap-2 inline-flex border">
                                        <input type="email" name="email" id="input-email-label" class="py-3 px-4 block w-full border-gray-2 rounded-lg text-sm focus:border-blue-20 focus:ring-blue-20 disabled:opacity-50 disabled:pointer-events-none placeholder:text-sm   " placeholder="Enter your mail" />
                                    </div>
                                </div>
                                <div class="self-stretch flex-col justify-start items-start gap-3 flex">
                                    <div class="self-stretch justify-start items-start inline-flex">
                                        <div class="grow shrink basis-0 text-slate-700 md:text-base text-sm font-normal  capitalize leading-none">
                                            New Password
                                        </div>
                                    </div>
                                    <div class="self-stretch flex-col justify-start items-start gap-2 flex">
                                        <div class="self-stretch  rounded-lg justify-start items-center gap-[5px] inline-flex border">

                                            <input type="password" name="password" id="input-password-label" class="py-3 px-4 block w-full border-gray-2 rounded-lg text-sm focus:border-blue-20 focus:ring-blue-20 disabled:opacity-50 disabled:pointer-events-none   placeholder:text-sm   " placeholder="Enter your password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="self-stretch pt-3">
                                    <button type="submit" class="btn-primary w-full">
                                        ADD
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="relative flex rounded-lg shadow-sm">
                <input type="text" id="hs-trailing-button-add-on-with-icon-and-button" name="hs-trailing-button-add-on-with-icon-and-button" class="bg-white py-3 px-4 ps-11 block w-full border-gray-2 rounded-s-lg text-sm focus:z-10 focus:border-blue-20 focus:ring-blue-20 disable placeholder:text-smd:opacity-50 disabled: placeholder:text-smpointer-events-none    placeholder:text-gray-2" placeholder="Search People" />
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <svg class="flex-shrink-0 size-4 text-gray-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                </div>
                <button type="button" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md bg-primary text-white hover:bg-blue disabled:opacity-50 disabled:pointer-events-none">
                    Search
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" id="successAlert" role="alert">

        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>

        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg onclick="closeAlert()" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">

                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>

    @endif

    @if(session('delete'))

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" id="successAlert" role="alert">

        <strong class="font-bold">Deleted!</strong>

        <span class="block sm:inline">The record has been successfully deleted.</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg onclick="closeAlert()" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>

    @endif







</section>


{{-- {{$childUsers}} --}}

<!-- user card section -->
<section id="container" class="md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3 ">
    <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-6">
        @if(!empty($childUsers))
        @foreach($childUsers as $childUser )

        <a class="w-full flex flex-col bg-white shadow-sm rounded-lg hover:shadow-lg transition " href="/people_profile/{{$childUser->id}}">

            <div class="relative">
                <img src="{{ !empty($childUser) && !empty($childUser->cover_photo) ?  asset('uploads/' . $childUser->cover_photo) :'https://spruko.com/demo/tailwind/ynex/dist/assets/images/media/team-covers/1.jpg'}}" class="w-full h-[100px] relative bg-blue-700 bg-opacity-20 rounded-tl-lg rounded-tr-lg" alt="" />



                <span class="absolute pt-[71px] px-[20px] top-0 left-0">
                    <div class="w-16 h-16 rounded-full border-4 border-blue border-opacity-20 justify-center items-center inline-flex">
                        <img class="w-14 h-14 relative rounded-full" src=" {{ !empty($childUser) && !empty($childUser->profile) ?  asset('uploads/' . $childUser->profile) :'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg'}}" alt="" />

                    </div>
                </span>
            </div>
            <div>
                <div class="w-fit pl-[92px] pt-[10px] flex-col justify-start items-start inline-flex">
                    <div class=" h-6 justify-start items-center inline-flex">
                        <div class="w-fit h-6 text-zinc-800 text-base font-semibold font-['Inter'] leading-normal" id="serchbyname">
                            {{$childUser &&  $childUser->name ? $childUser->name : ''  }}
                        </div>
                    </div>
                    <div class="self-stretch h-[18px] justify-start items-center inline-flex">
                        <div class="w-fit h-[18px] text-neutral-400 text-xs font-normal font-['Inter'] leading-[18px]" id="searchbyemail">
                            {{$childUser &&  $childUser->email ? $childUser->email : ''  }}

                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-[20px] flex w-full border-dashed border-t-[1.5px] border-[#e3e4e5]">
                <div class="text-center w-[33%] py-4">
                    <p class="text-[13px] text-zinc-800 font-semibold leading-tight">
                        videos
                    </p>
                    <p class="text-neutral-400 text-xs font-normal leading-[18px]">
                        @if ($childUser->videoinfo_count > 0)
                        {{ $childUser->videoinfo_count }}
                        @else
                        {{ '00' }}
                        @endif
                    </p>
                </div>
                <div class="text-center w-[33%] py-4 border-dashed border-x-[1.5px] border-[#e3e4e5]">
                    <p class="text-[13px] text-zinc-800 font-semibold leading-tight">
                        Images
                    </p>
                    <p class="text-neutral-400 text-xs font-normal leading-[18px]">
                        00
                    </p>
                </div>
                <div class="text-center w-[33%] py-4">
                    <p class="text-[13px] text-zinc-800 font-semibold leading-tight">
                        Creation Date

                    </p>
                    <p class="text-neutral-400 text-xs font-normal leading-[18px]">
                        {{ $childUser && $childUser->created_at ? $childUser->created_at->format('d/m/Y') : 'DD/MM/YYYY' }}




                    </p>
                </div>
            </div>
        </a>


        @endforeach
        @else
        <p>Noting is abilable there ..</p>
        @endif
    </div>
</section>






@endsection


@section('script')
<script>
    function closeAlert() {
        document.getElementById('successAlert').style.display = 'none';
    }

</script>






@endsection

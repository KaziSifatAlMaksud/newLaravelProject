@extends('layouts.app')
@section('title', 'User Dashbord')
@section('main')
{{-- <style>
    #drop-area.highlight {
        border-color: #0774e8;
    }

</style> --}}

<section class="md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3 pt-6">
    <div class="w-full">
        <div class="p-6 flex gap-6 rounded-[7px] shadow" style="background-image: url({{ !empty($childUser) && !empty($childUser->cover_photo) ? asset('uploads/' . $childUser->cover_photo) : asset('/assets/images/profile_bannar.png') }});

              background-size: cover;
              background-position: center;
            ">


            <div class="w-fit">
                <div class="relative">
                    <img class="xl:size-[71px] size-[55px] rounded-full" src="{{ !empty($childUser) && !empty($childUser->profile) ?  asset('uploads/' . $childUser->profile) :'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg'}}" />


                    <div class="xl:size-[15.53px] size-[12px] xl:right-[5px] right-[2px] bottom-0 absolute border border-white  rounded-full" style="background: green;"></div>
                </div>
            </div>
            <div class="flex flex-col lg:gap-6 gap-3 xl:pt-3 pt-2">
                <div class="">
                    <div class="text-white xl:text-xl text-lg font-bold leading-tight">
                        {{ $childUser && $childUser->name ?  $childUser->name : ''}}
                    </div>

                    <div class="text-gray-2 text-xs font-medium leading-3">
                        {{ $childUser && $childUser->email ?  $childUser->email : ''}}
                    </div>
                </div>
                <div class="flex justify-start space-x-12">
                    <div class="w-fit">
                        <p class="text-center text-white xl:text-[22px] text-[16px] font-bold">
                            {{$videoCount ?? '0'}}
                        </p>
                        <p class="text-gray-2 text-xs font-medium">Videos</p>
                    </div>
                    <div class="w-fit">
                        <p class="text-center text-white xl:text-[22px] text-[16px] font-bold">
                            {{$photoCount ?? '0'}}
                        </p>
                        <p class="text-gray-2 text-xs font-medium">Photos</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>







<!-- card section -->
<section id="container" class="md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3 pt-10">


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

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" class="errorAlert" role="alert">
        <strong class="font-bold">Error!</strong>
        @foreach ($errors->all() as $error)
        <div>
            <span class="block sm:inline">{{ $error }}.</span>
        </div>
        @endforeach
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="closeAlert(this)">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    @endif




    <div class="flex justify-between">
        <div class="flex gap-2 items-center w-full">

            <div class="flex justify-between items-center w-full">
                <div class="pt-1">
                    <button type="button" class="btn-primary w-full" data-hs-overlay="#hs-vertically-centered-modal">
                        Upload video +
                    </button>
                </div>
                <div class="pt-1">
                    <button type="button" data-hs-overlay="#hs-vertically-modal" class="btn-primary flex items-center justify-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md">

                        Settings
                    </button>
                </div>
            </div>



            <div id="hs-vertically-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
                <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                    <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                        <div class="flex justify-between items-center py-3 px-4 border-b ">
                            <div class="flex gap-1 items-center">
                                <img class="h-4" src="/assets/images/bar.png" alt="bar.pmg" />
                                <p class="text-zinc-800 text-[18px] text-center font-semibold">
                                    Re-Set User Password..
                                </p>
                            </div>
                            <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none " data-hs-overlay="#hs-vertically-modal">

                                <span class="sr-only">Close</span>
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>


                        <form action="{{ route('password.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">

                            <div class="md:px-[30px] px-[25px] mt-6 pb-[30px] pt-[3px] overflow-y-auto">
                                <div class="pb-3">
                                    <label for="input-label" class="block text-xs font-medium mb-2 ">Enter Old Password:</label>
                                    <input type="password" name="old_password" id="input-label" class="py-2 border px-4 block w-full border-gray-200 rounded-lg text-xs focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Enter Your Old Password" />



                                </div>

                                <div class="pb-3">
                                    <label for="input-label" class="block text-xs font-medium mb-2 ">Enter New password</label>
                                    <input type="password" name="new_password" id="input-label" class="py-2 border px-4 block w-full border-gray-200 rounded-lg text-xs focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Enter New password" />



                                </div>
                                <div class="pb-3">
                                    <label for="input-label" class="block text-xs font-medium mb-2 "> Confirm password </label>

                                    <input type="password" name="confirm_password" id="input-label" class="py-2 border px-4 block w-full border-gray-200 rounded-lg text-xs focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Enter New password" />



                                </div>
                                <input type="hidden" name="child_id" value="{{ $childUser->id ?? '' }}">
                                <div class="flex justify-between w-full">
                                    <button type="submit" class="btn-primary mt-3">Upload Password</button>
                        </form>

                        <form action="/delete-account" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="child_id" value="{{ $childUser->id ?? '' }}">
                            <!-- More rounded corners with Tailwind CSS -->
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg mt-3" onclick="return confirm('Are you sure you want to delete your account? This cannot be undone!');">
                                Delete Account
                            </button>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>




    <div id="hs-vertically-centered-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b ">
                    <div class="flex gap-1 items-center">
                        <img class="h-4" src="/assets/images/bar.png" alt="bar.pmg" />
                        <p class="text-zinc-800 text-[18px] text-center font-semibold">
                            Upload Video
                        </p>
                    </div>
                    <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none " data-hs-overlay="#hs-vertically-centered-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('video.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="md:px-[30px] px-[25px] mt-6 pb-[30px] pt-[3px] overflow-y-auto">
                        <div class="pb-3">
                            <label for="input-label" class="block text-xs font-medium mb-2 ">Title <em class="text-red-600">*</em></label>
                            <input type="text" name="title" id="input-label" class="py-2 px-4 block w-full border-gray-200 rounded-lg text-xs focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Enter video title" />

                        </div>

                        <div class="pb-3">
                            <label for="input-label" class="block text-xs font-medium mb-2 ">Description</label>
                            <input type="text" name="description" id="input-label" class="py-2 px-4 block w-full border-gray-200 rounded-lg text-xs focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none " placeholder="Enter video title" />
                        </div>
                        <input type="text" hidden name="child_id" value=" {{ $childUser && $childUser->id ?  $childUser->id : ''}}">



                   

                       <div id="drop-area" class="flex flex-col justify-center rounded-lg border-2 border-dashed border-gray-200 md:px-20 px-12 py-16 text-center gap-2" 
                            ondrop="dropHandler(event);" 
                            ondragover="dragOverHandler(event);" 
                            ondragenter="dragEnterHandler(event);" 
                            ondragleave="dragLeaveHandler(event);">
                            <p id="drop-text" class="text-zinc-500 text-xs">
                                Drag and drop your attachment here
                            </p>
                            <p class="text-zinc-500 text-xs">or</p>
                            <input type="file" id="fileInput" name="attachment" 
                                class="block w-full border border-gray-200 shadow-sm rounded-lg text-xs focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" 
                                accept="*/*" 
                                onchange="fileInputChangeHandler(event)" />
                        </div>
                        <button class="btn-primary mt-3">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    </div>
    </div>


    <div class="grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 gap-6 pt-6">

   @if($videos->isNotEmpty())
        @foreach($videos as $video)
            <div class="flex flex-col gap-1 cursor-pointer w-full md:w-1/2 lg:w-1/3" onclick="openModal('{{$video->title}}', '{{$video->description}}', '{{ asset('uploads/' . $video->file) }}', 'video', {{$video->id}})">
                <div class="media-wrapper" style="position: relative; width: 100%; border-radius: 10px; padding-top: 56.25%;">
                    <video style="position: absolute; top: 0; left: 0; width: 100%; border-radius: 10px; height: 100%;" controls>
                        <source src="{{ asset('uploads/' . $video->file) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <p class="w-fit pt-2 2xl:text-[16px] font-medium lg:text-[14px] md:text-[12px] text-[14px]">
                    {{ $video->title }}
                </p>
            </div>
        @endforeach
    @endif

    @if($images->isNotEmpty())
        @foreach($images as $image)
            <div class="flex flex-col gap-1 cursor-pointer w-full md:w-1/2 lg:w-1/3" onclick="openModal('{{$image->title}}', '{{$image->description}}', '{{ asset('uploads/' . $image->file) }}', 'image', {{$image->id}})">
                <div class="media-wrapper" style="position: relative; width: 100%; border-radius: 10px; padding-top: 56.25%;">
                    <img src="{{ asset('uploads/' . $image->file) }}" alt="{{ $image->title }}" style="position: absolute; top: 0; left: 0; width: 100%; border-radius: 10px; height: 100%; object-fit: cover;">
                </div>
                <p class="w-fit pt-2 2xl:text-[16px] font-medium lg:text-[14px] md:text-[12px] text-[14px]">
                    {{ $image->title }}
                </p>
            </div>
        @endforeach
    @endif
<!-- Preview Modal -->
<div id="previewModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle"></h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" id="modalDescription"></p>
                            <div id="modalContent" class="mt-4">
                                <!-- Video or Image will be injected here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm" onclick="deleteFile()">
                    Delete
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
</section>
@endsection


@section('script')
<script src="./node_modules/preline/dist/preline.js"></script>



<script>
    function openModal(title, description, filePath, fileType, fileId) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('previewModal').classList.remove('hidden');

        const modalContent = document.getElementById('modalContent');
        modalContent.innerHTML = '';

        if (fileType === 'video') {
            const videoElement = document.createElement('video');
            videoElement.setAttribute('controls', '');
            videoElement.style.width = '100%';
            videoElement.style.borderRadius = '10px';

            const sourceElement = document.createElement('source');
            sourceElement.setAttribute('src', filePath);
            sourceElement.setAttribute('type', 'video/mp4');

            videoElement.appendChild(sourceElement);
            modalContent.appendChild(videoElement);
        } else if (fileType === 'image') {
            const imgElement = document.createElement('img');
            imgElement.setAttribute('src', filePath);
            imgElement.setAttribute('alt', title);
            imgElement.style.width = '100%';
            imgElement.style.borderRadius = '10px';

            modalContent.appendChild(imgElement);
        }

        // Store file ID for deletion
        document.getElementById('previewModal').dataset.fileId = fileId;
    }

    function closeModal() {
        document.getElementById('previewModal').classList.add('hidden');
    }

    function deleteFile() {
        const fileId = document.getElementById('previewModal').dataset.fileId;
        window.location.href = `/delete-file/${fileId}`;
    }
</script>


<script>
  function dragOverHandler(event) {
    event.preventDefault();
    event.stopPropagation();
    document.getElementById("drop-area").classList.add("highlight");
  }

  function dragEnterHandler(event) {
    event.preventDefault();
    event.stopPropagation();

    // Get the file name from the drag event and display it
    const files = event.dataTransfer.files;
    if (files.length > 0) {
      const fileName = files[0].name;
      document.getElementById("drop-text").innerText = `Drop ${fileName} here`;
    }

    document.getElementById("drop-area").classList.add("highlight");
  }

  function dragLeaveHandler(event) {
    event.preventDefault();
    event.stopPropagation();
    document.getElementById("drop-area").classList.remove("highlight");
    document.getElementById("drop-text").innerText = "Drag and drop your attachment here";
  }

  function dropHandler(event) {
    event.preventDefault();
    event.stopPropagation();
    document.getElementById("drop-area").classList.remove("highlight");
    document.getElementById("drop-text").innerText = "Drag and drop your attachment here";

    const files = event.dataTransfer.files;
    handleFiles(files);
  }

  function fileInputChangeHandler(event) {
    const files = event.target.files;
    handleFiles(files);
  }

  function handleFiles(files) {
    for (const file of files) {
      const fileName = file.name.toLowerCase();
      const fileExtension = fileName.substring(fileName.lastIndexOf("."));
      const fileType = file.type;

      if (fileType.startsWith('video/') && file.size > 100 * 1024 * 1024) {
        alert("Video files must be less than 100MB.");
        return;
      } else if (fileType.startsWith('image/') && file.size > 3 * 1024 * 1024) {
        alert("Image files must be less than 3MB.");
        return;
      } else {
        console.log("File accepted:", file);
        // Perform desired actions with the file, like uploading to a server
      }
    }
  }
</script>



@endsection

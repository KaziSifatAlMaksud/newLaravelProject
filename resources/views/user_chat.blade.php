<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" class="light" data-header-styles="light" data-menu-styles="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Style Css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="styles/style.css" />

    <!-- Simplebar Css -->
    <link rel="stylesheet" href="../assets/libs/simplebar/simplebar.min.css">

    <!-- Color Picker Css -->

    <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/nano.min.css">

    {{-- added by my self --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>

<body>



    <main class="w-full pb-6">

        <!-- navbar section -->
        <header class=" md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3 flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4 z-50">

            <nav class="w-full sm:container mx-auto flex flex-wrap justify-between basis-full items-center" aria-label="Global">

                {{-- <ul>
                    @foreach(session()->all() as $key => $value)
                    <li>{{ $key }}: {{ $value }}</li>
                @endforeach
                </ul> --}}






                <a class="sm:order-1 flex-none text-xl font-semibold " href="#"><img class="w-[110px]" src="/assets/images/logo_horizontal2.png" alt="" /></a>
                <div class="sm:order-3 flex items-center gap-x-2">
                    <div class="hs-dropdown relative inline-flex">
                        <img class="w-[40px] rounded-[76px]" src="{{ $childuserInfo->profile ? asset('uploads/' . $childuserInfo->profile) : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg' }} " alt="" />




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

        {{-- <button id="refresh-messages">Refresh Messages</button> --}}



        @if ($childuserInfo)
        <div class="lg:px-[120px]">
            <!-- Start::main-content -->
            <div class="lg:px-3 px-6">

                <div class="main-chart-wrapper p-2 gap-2 lg:flex">

                    <div class="chat-info lg:block hidden border" style="display: none;">

                        <div class="flex items-center justify-between w-full p-4 border-b">
                            <div>
                                <h5 class="font-semibold mb-0 text-[1.25rem] !text-defaulttextcolor ">Messages</h5>
                            </div>



                        </div>
                        <div class="chat-search p-4 ">
                            <div class="input-group">
                                <input type="text" class="form-control !bg-light border-0 !rounded-s-md" placeholder="Search Chat" aria-describedby="button-addon2">
                                <button aria-label="button" class="ti-btn ti-btn-light bg-[#f3f6f8] !rounded-s-none !mb-0" type="button" id="button-addon2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search text-[#8c9097] ri-search-line">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="m21 21-4.3-4.3" /></svg>
                                </button>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show  !border-0 chat-users-tab" id="users-tab-pane" aria-labelledby="users-item" role="tabpanel" tabindex="0">
                                <ul class="list-none mb-0 mt-6 chat-users-tab" id="chat-msg-scroll">
                                    <li class="!pb-0 !pt-0">
                                        <p class="text-[#8c9097]  text-[0.6875rem] font-semibold mb-2 opacity-[0.7]">HISTORY</p>

                                    </li>

                                    <li class="checkforactive chat-msg-unread">
                                        <a href="javascript:void(0);" onclick="changeTheInfo(this,'Emiley Jackson','2','online')">
                                            <div class="flex items-start">
                                                <div class="me-1 leading-none">
                                                    <span class="avatar avatar-md online me-2 avatar-rounded">
                                                        <img src="https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg" alt="img">
                                                    </span>
                                                </div>
                                                <div class="flex-grow">
                                                    <p class="mb-0 font-semibold">

                                                        <span class="ltr:float-right rtl:float-left text-[#8c9097]  font-normal text-[0.6875rem]">12:24PM</span>
                                                    </p>
                                                    <p class="text-[0.75rem] mb-0 chat-msg-typing ">
                                                        <span class="chat-msg !text-green">Typing...</span>
                                                        <span class="chat-read-icon ltr:float-right rtl:float-left align-middle"><i class="ri-check-double-fill"></i></span>
                                                        <span class="badge bg-success/10 !rounded-full text-success ltr:float-right rtl:float-left">2</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>



                                </ul>
                            </div>
                            <div id="groups-tab-pane">
                            </div>
                            <div id="calls-tab-pane">

                            </div>
                        </div>
                    </div>
                    <div class="main-chat-area !block  border">
                        <div class="sm:flex items-center p-2 border-b">
                            <div class="flex items-center leading-none">
                                <span class="avatar avatar-lg online me-4 avatar-rounded chatstatusperson">
                                    <img class="chatimageperson" src="{{ $mainuserInfo->profileInfo ? asset('uploads/' . $mainuserInfo->profileInfo->image) : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg' }} " alt="img">


                                </span>
                                <div class="flex-grow">
                                    <p class="mb-1 font-semibold text-[.875rem]">

                                        <a href="javascript:void(0);" class="chatnameperson responsive-userinfo-open !text-defaulttextcolor ">{{$mainuserInfo && $mainuserInfo->name ?  $mainuserInfo->name  : '' }}</a>

                                    </p>
                                    <p class="text-[#8c9097]  mb-0 chatpersonstatus !text-defaultsize">online</p>
                                </div>
                            </div>
                            <div class="flex ms-auto hidden">
                                <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-outline-light !text-[0.95rem] font-semibold responsive-chat-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" /></svg>
                                </button>
                            </div>
                        </div>


                        <div class="chat-content" id="main-chat-content">
                            <ul class="list-none">
                                {{-- <li class="chat-day-label ">
                                    <span class="bg-blue-600 bg-opacity-10 text-primary">Today</span>
                                </li> --}}

                                <div id="message-container"></div>

                                <div id="message-container-is"></div>


                            </ul>
                        </div>
                        <div class="chat-footer">
                            <input class="form-control w-full input_custom  !mx-2 !rounded-md" id="search-input" placeholder="Type your message here..." type="text">
                            <a aria-label="anchor" class="ti-btn bg-primary text-white  ti-btn-icon ti-btn-send" id="ti-btn-send" href="javascript:void(0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send-horizontal">
                                    <path d="m3 3 3 9-3 9 19-9Z" />
                                    <path d="M6 12h16" /></svg>
                            </a>
                        </div>
                    </div>
                    <div class="chat-user-details border" id="chat-user-details">
                        <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-outline-light my-1 ms-2 responsive-chat-close2 xxl:hidden"> <i class="ri-close-line"></i> </button>
                        <div class="text-center mb-[3rem]">
                            <span class="avatar avatar-rounded online avatar-xxl me-2 mb-4 chatstatusperson">
                                <img class="chatimageperson" src="{{ $childuserInfo->profile ? asset('uploads/' . $childuserInfo->profile) : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg' }} " alt="img">

                            </span>
                            <p class="mb-1 text-[0.9375rem] font-semibold text-defaulttextcolor  leading-none chatnameperson ">{{ $childuserInfo &&  $childuserInfo->name ?  $childuserInfo->name : ''}}</p>



                            <p class="text-[0.75rem] text-[#8c9097]  !mb-4"><span class="chatnameperson">{{ $childuserInfo &&  $childuserInfo->email ?  $childuserInfo->email : ''}}</span></p>

                        </div>

                       <div class="mb-0">
    <div class="font-semibold mb-4 text-defaultsize">
        Photos &amp; Videos
        <span class="badge bg-primary/10 !rounded-full text-primary ms-1">{{ $countVideo ?? '0' }}</span>
        <span class="ltr:float-right rtl:float-left text-[0.6875rem]">
            <a href="javascript:void(0);" class="text-primary underline" id="toggleButton"><u>View All</u></a>
        </span>
    </div>
    <div class="grid grid-cols-12 gap-2 hidden" id="targetElement">
        @if ($uservideos && $uservideos->count() > 0)
            @foreach ($uservideos as $media)
                <div class="xl:col-span-6 lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-4">
                    @if (in_array(strtolower($media->file_type), ['jpeg', 'jpg', 'png', 'gif', 'svg']))
                        <img src="{{ asset('uploads/' . $media->file) }}" alt="image" style="max-width: 100%; height: auto;">
                    @elseif (in_array(strtolower($media->file_type), ['mp4', 'mkv']))
                        <video width="100%" height="auto" controls>
                            <source src="{{ asset('uploads/' . $media->file) }}" type="video/{{ strtolower($media->file_type) === 'mkv' ? 'x-matroska' : 'mp4' }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
            @endforeach
        @else
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <span class="font-medium">No Videos & Photos are Available!</span> Please log in after some time or try again.
            </div>
        @endif
    </div>
</div>



                    </div>
                </div>
            </div>
        </div>


        @else
        <script>
            window.location.href = "{{ route('user_login') }}"; // Use JavaScript for redirection

        </script>
        @endif




<script>
    $(document).ready(function() {
        function fetchMessages() {
            $.ajax({
                url: '/messages',
                type: 'GET',
                success: function(response) {
                    console.log('AJAX response:', response); // Log the response for debugging
                    $('#message-container').empty();
                    $.each(response.messages, function(index, message) {
                        var messageTime = new Date(message.created_at).toLocaleTimeString();
                        var messageContent = message.content ? message.content.title : 'No content available';
                        var messageDescription = message.content ? message.content.description : '';
                        var childuserInfo = response.user_info;
                        var mainuserInfo = response.mainuser_info;
                        var receiverAvatar = mainuserInfo && mainuserInfo.profile_info && mainuserInfo.profile_info.image
                            ? 'uploads/' + mainuserInfo.profile_info.image
                            : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg';

                        var mediaElement = '';
                        if (message.content && message.content.file && message.content.file_type) {
                            var fileType = message.content.file_type.toLowerCase();
                            if (['jpeg', 'jpg', 'png', 'gif', 'svg'].includes(fileType)) {
                                mediaElement = `<img src="uploads/${message.content.file}" alt="image" style="max-width: 250px; max-height: 250px;">`;
                            } else if (['mp4', 'mkv'].includes(fileType)) {
                                mediaElement = `
                                    <video controls width="250">
                                        <source src="uploads/${message.content.file}" type="video/${fileType === 'mkv' ? 'x-matroska' : 'mp4'}">
                                        Your browser does not support the video tag.
                                    </video>`;
                            }
                        }

                        var htmlContent = `
                            <li class="chat-item-end">
                                <div class="chat-list-inner">
                                    <div class="me-3">
                                        <span class="chatting-user-info">
                                            <span class="msg-sent-time">
                                                <span class="chat-read-mark align-middle inline-flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check size-[12px] text-green mr-1">
                                                        <path d="M18 6 7 17l-5-5" />
                                                        <path d="m22 10-7.5 7.5L13 16" />
                                                    </svg>
                                                </span>${messageTime}</span> You
                                        </span>
                                        <div class="main-chat-msg flex justify-end items-end">
                                            <div>
                                                <p class="mb-0">${messageContent}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="chat-item-start">
                                <div class="chat-list-inner">
                                    <div class="chat-user-profile">
                                        <span class="avatar avatar-md online avatar-rounded chatstatusperson">
                                            <img class="chatimageperson" src="${receiverAvatar}" alt="img">
                                        </span>
                                    </div>
                                    <div class="ms-3">
                                        <span class="chatting-user-info">
                                            <span class="chatnameperson">${mainuserInfo ? mainuserInfo.name : 'Unknown'}</span>
                                        </span>
                                        <p>${messageDescription}</p>
                                        <div class="main-chat-msg">
                                            <div>${mediaElement}</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;

                        $('#message-container').append(htmlContent);
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error fetching messages:', error);
                }
            });
        }

        fetchMessages(); // Call function to fetch messages
    });
</script>



        {{-- for get the infomationa end  --}}

        <script>
    $(document).ready(function() {
        $('#ti-btn-send').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            var content = $('#search-input').val().toString();
            if (content.trim() === '') return;

            $.ajax({
                url: '/send-message',
                type: 'POST',
                data: {
                    content: content,
                    "_token": "{{ csrf_token() }}" // CSRF token for Laravel, resolved at page load
                },
                success: function(response) {
                    $('#search-input').val(''); // Clear the input field
                    var receiverAvatar = response.parentInfo && response.parentInfo.profile_info && response.parentInfo.profile_info.image 
                        ? 'uploads/' + response.parentInfo.profile_info.image 
                        : 'https://spruko.com/demo/tailwind/ynex/dist/assets/images/faces/21.jpg';

                    $('#message-container-is').append(`
                        <li class="chat-item-end">
                            <div class="chat-list-inner">
                                <div class="me-3">
                                    <span class="chatting-user-info">
                                        <span class="msg-sent-time">
                                            <span class="chat-read-mark align-middle inline-flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check size-[12px] text-green mr-1">
                                                    <path d="M18 6 7 17l-5-5" />
                                                    <path d="m22 10-7.5 7.5L13 16" />
                                                </svg>
                                            </span>${response.sentTime || 'Now'}
                                        </span> You
                                    </span>
                                    <div class="main-chat-msg flex justify-end items-end">
                                        <div>
                                            <p class="mb-0">${content}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    `);

                    if (response.answer) {
                        var mediaElement = '';
                        if (response.answer.file_type && ['jpeg', 'jpg', 'png', 'gif', 'svg'].includes(response.answer.file_type.toLowerCase())) {
                            mediaElement = `<img src="uploads/${response.answer.file}" alt="image" style="max-width: 250px; max-height: 250px;">`;
                        } else if (response.answer.file_type && ['mp4', 'mkv'].includes(response.answer.file_type.toLowerCase())) {
                            mediaElement = `
                                <video controls width="250">
                                    <source src="uploads/${response.answer.file}" type="video/${response.answer.file_type.toLowerCase() === 'mkv' ? 'x-matroska' : 'mp4'}">
                                    Your browser does not support the video tag.
                                </video>`;
                        } else {
                            mediaElement = '<p>No media available.</p>';
                        }

                        $('#message-container-is').append(`
                            <li class="chat-item-start">
                                <div class="chat-list-inner">
                                    <div class="chat-user-profile">
                                        <span class="avatar avatar-md online avatar-rounded chatstatusperson">
                                            <img class="chatimageperson" src="${receiverAvatar}" alt="img">
                                        </span>
                                    </div>
                                    <div class="ms-3">
                                        <span class="chatting-user-info">
                                            <span class="chatnameperson">${response.parentInfo.name || 'Unknown'}</span> 
                                        </span>
                                        <p> ${response.answer.description} </p>
                                        <div class="main-chat-msg">
                                            <div>${mediaElement}</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error sending message: ' + error);
                }
            });
        });
    });
</script>

        <!-- End::content  -->

        </div>

        <!-- Back To Top -->
        <div class="scrollToTop">
            <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
        </div>

        <div id="responsive-overlay"></div>

        <!-- Preline JS -->
        <script src="../assets/libs/preline/preline.js"></script>

        <!-- popperjs -->
        <script src="../assets/libs/@popperjs/core/umd/popper.min.js"></script>

        <!-- Color Picker JS -->
        <script src="../assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

        <!-- sidebar JS -->
        <script src="../assets/js/defaultmenu.js"></script>

        <!-- sticky JS -->
        <script src="../assets/js/sticky.js"></script>

        <!-- Switch JS -->
        <script src="../assets/js/switch.js"></script>

        <!-- Simplebar JS -->
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#search-input').autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "{{ route('autocomplete') }}"
                            , dataType: "json"
                            , data: {
                                term: request.term
                            }
                            , success: function(data) {
                                response(data);
                            }
                        });
                    }
                    , minLength: 2
                    , position: {
                        my: "left bottom"
                        , at: "left top"
                        , collision: "flip"
                    }
                    , open: function(event, ui) {
                        // Corrected method to add classes to the autocomplete widget
                        $(this).autocomplete("widget").addClass("bg-white shadow-lg border-0 rounded-lg mt-1");
                    }
                    , select: function(event, ui) {
                        this.value = ui.item.value;
                        return false;
                    }
                });
            });

        </script>




        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toggleButtons = document.querySelectorAll('[data-modal-toggle]');
                const closeButtons = document.querySelectorAll('[data-modal-hide]');

                toggleButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const target = document.getElementById(button.getAttribute('data-modal-target'));
                        target.classList.toggle('hidden');
                        target.setAttribute('aria-hidden', target.classList.contains('hidden'));
                    });
                });

                closeButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const target = document.getElementById(button.getAttribute('data-modal-hide'));
                        target.classList.add('hidden');
                        target.setAttribute('aria-hidden', 'true');
                    });
                });
            });

            document.getElementById("toggleButton").addEventListener("click", function() {
                var target = document.getElementById("targetElement");
                target.classList.toggle("hidden");
            });

        </script>



        <!-- Custom-Switcher JS -->
        <script src="../assets/js/custom-switcher.js"></script>

        <!-- Chat JS -->
        <script src="../assets/js/chat.js"></script>

        <!-- Custom JS -->
        <script src="../assets/js/custom.js"></script>
</body>

</html>

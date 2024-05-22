  <header class="md:px-[30px] lg:px-[50px] 2xl:px-[120px] px-3 flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4">
      <nav class="w-full mx-auto flex flex-wrap justify-between basis-full items-center" aria-label="Global">
          <!-- Logo link to the dashboard -->
          <a class="sm:order-1 flex-none text-xl font-semibold " href="{{ route('dashboard') }}">
              <img class="w-[110px]" src="{{ asset('assets/images/logo_horizontal2.png') }}" alt="Logo" />
          </a>
          <!-- User profile and dropdown menu -->
          <div class="sm:order-3 flex items-center gap-x-2">
              <div class="hs-dropdown relative inline-flex">
                  <img class="w-[40px] rounded-full" src="{{ asset('assets/images/user.jpg') }}" alt="User avatar" />

                  <div class="hs-dropdown-menu transition-all duration-300 opacity-0 hidden min-w-40 bg-white shadow-md rounded-lg p-2 mt-2">
                      <!-- Profile edit link -->
                      <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-gray-100" href="{{ route('profile.edit') }}">
                          Profile
                      </a>
                      <!-- Logout form -->
                      <form method="POST" action="{{ route('logout') }}" class="inline">
                          @csrf
                          <button type="submit" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-black hover:bg-gray-100">
                              Logout
                          </button>
                      </form>
                  </div>
              </div>
          </div>
      </nav>
  </header>

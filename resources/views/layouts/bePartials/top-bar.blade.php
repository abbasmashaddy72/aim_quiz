<div class="float-right sm:float-none top-bar">
    <!-- BEGIN: Breadcrumb -->
    {{ $breadcrumb }}
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Dark Mode Switcher-->
    <div class="mr-4">
        <button id="theme-toggle" type="button"
            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                    fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <!-- END: Dark Mode Switcher-->
    <!-- BEGIN: Account Menu -->
    <div class="w-10 h-10 dropdown">
        <div class="relative flex items-center justify-center w-10 h-10 text-xl text-white uppercase rounded-full shadow-lg bg-primary dropdown-toggle"
            role="button" aria-expanded="false" data-tw-toggle="dropdown">
            {{ Auth::user()->initials }}</div>
        <div class="w-56 dropdown-menu">
            <ul class="text-white dropdown-content bg-primary">
                <li class="p-2">
                    <div class="font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">
                        {{ Auth::user()->roles->first()->name ?? '' }}</div>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="{{ route('admin.profile.update') }}" class="dropdown-item hover:bg-white/5"><i
                            data-feather="user" class="w-4 h-4 mr-2"></i>Profile</a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5">
                        <i data-feather="help-circle" class="w-4 h-4 mr-2"></i>
                        Help
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="dropdown-item hover:bg-white/5">
                            <i data-feather="toggle-right"class="w-4 h-4 mr-2"></i>
                            Logout
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>

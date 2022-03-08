{{-- menu --}}
<nav class="fixed transform  top-0 left-0 w-64 h-full">
    {{-- logo --}}
    <div class="flex justify-between lg:justify-center items-center sidebar-logo py-3 px-2 ">
        <a href="#" class="space-x-3 flex items-center justify-center">
            <img class="logo-brand w-14 h-14" src="{{url('assets/images/insaf-dark.png')}}">
            <span class="logo-title">
                <h3 class="font-bold text-3xl uppercase">insaf</h3>
            </span>
        </a>
        <button onclick="toggleSidebar()" class="lg:hidden btn-sidebar focus:outline-none hover:shadow-sm bg-white rounded-lg px-2 py-2 w-10 h-10 frl items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
         </button>
    </div>
 
    {{-- sidebar menu --}}
    <div class="flex flex-col block sidebar-menu pb-5">
        {{-- @if ($dynamic_menu)
        <div class="treeview" x-data="{ open: false }">
            <a @click="open=true" href="#" class="btn-dropdown-sidebar block relative focus:bg-gray-900 focus:bg-opacity-10 hover:bg-gray-900 hover:bg-opacity-10 transition duration-200 flex items-center px-4 py-3 space-x-3">
                <span class="icon-sidebar w-8 h-8 flex items-center justify-center">
                    <img src="{{url('assets/icons/svg/headphone.svg')}}">
                </span>
                <span class="label-sidebar font-medium text-gray-900">
                    Basic Services
                </span>
                <span class="absolute inset-y-0 right-0 flex items-center justify-center w-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </a>
            <div x-show="open" @click.away="open = false" class="dropdown-sidebar bg-gray-900 static bg-opacity-10 clearfix px-0">
                @foreach ($dynamic_menu as $menu)
                @if(!$menu->icon)
                <a href="{!!route($menu->url)!!}" class="block hover:bg-gray-900 hover:bg-opacity-5 flex items-center px-6 py-2">{{$menu->menu}}</a>
                @endif
                @endforeach
            </div>
        </div>
        @endif --}}

        @foreach ($dynamic_menu as $menu)
            @if ($menu->url != '#')
                <a href="{!!route($menu->url)!!}" @if($menu->menu == 'Dashboard') target="_blank" @endif class="block hover:bg-gray-900 hover:bg-opacity-10 transition duration-200 flex items-center px-4 py-3 space-x-3">
                    <span class="icon-sidebar w-8 h-8 flex items-center justify-center">
                        {!!$menu->icon!!}
                    </span>
                    <span class="label-sidebar font-medium text-gray-900">
                        {{$menu->menu}}
                    </span>
                </a>
                @elseif($menu->url == '#')
                <div class="treeview" x-data="{ open: false }">
                    <a @click="open=true" href="#" class="btn-dropdown-sidebar block relative focus:bg-gray-900 focus:bg-opacity-10 hover:bg-gray-900 hover:bg-opacity-10 transition duration-200 flex items-center px-4 py-3 space-x-3">
                        <span class="icon-sidebar w-8 h-8 flex items-center justify-center">
                            {{-- <img src="{{url('assets/icons/svg/headphone.svg')}}"> --}}
                            {!!$menu->icon!!}
                        </span>
                        <span class="label-sidebar font-medium text-gray-900">
                            {{-- Basic Services --}}
                            {{$menu->menu}}
                        </span>
                        <span class="absolute inset-y-0 right-0 flex items-center justify-center w-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </a>
                    <div x-show="open" @click.away="open = false" class="dropdown-sidebar bg-gray-900 static bg-opacity-10 clearfix px-0">
                        @foreach ($dynamic_sub_menu as $sub_menu)
                            <a href="{{route($sub_menu->url)}}" class="block hover:bg-gray-900 hover:bg-opacity-5 flex items-center px-6 py-2">{{$sub_menu->sub_menu}}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <span class="py-1 px-3 mx-2 my-2 font-bold block border-b-2 border-t-2 border-gray-800"></span>
    
        <a href="{{ route('users.insaf') }}" class="hidden @stack('active.user') block hover:bg-gray-900 hover:bg-opacity-10 transition duration-200 flex items-center px-4 py-3 space-x-3">
            <span class="icon-sidebar w-8 h-8 flex items-center justify-center">
                <img src="{{url('assets/icons/svg/user1.svg')}}">
            </span>
            <span class="label-sidebar font-medium text-gray-900">
                User
            </span>
        </a>
        <a href="#" class="hidden block hover:bg-gray-900 hover:bg-opacity-10 transition duration-200 flex items-center px-4 py-3 space-x-3">
            <span class="icon-sidebar w-8 h-8 flex items-center justify-center">
                <img src="{{url('assets/icons/svg/superadmin.svg')}}">
            </span>
            <span class="label-sidebar font-medium text-gray-900">
                Super Admin
            </span>
        </a>
        
    </div>
</nav>
{{-- navbar --}}
<div class="topbar sticky top-0 z-10 w-full h-20 flex item-center justify-between py-6 px-5">
    <div class="left flex items-center space-x-6">
        <button onclick="toggleSidebar()" class="btn-sidebar focus:outline-none hover:shadow-sm bg-white rounded-lg px-2 py-2 w-10 h-10 frl items-center justify-center">
           <img src="{{url('assets/icons/svg/hamburger.svg')}}" alt="">
        </button>
        <div class="hidden lg:block">
            <h1 class="text-xl font-bold">INSAF</h1>
            <small class="text-gray-600">Welcome back, nice to see you</small>
        </div>
    </div>

    <div class="right flex items-center justify-end space-x-4 lg:space-x-10">
        <div class="hidden lg:flex items-center">
            <form action="">
                <div class="hidden flex justify-center items-center relative input-group">
                    <input type="text" name="" class="w-full py-3 lg:py-3 pr-4 lg:pr-5 pl-14 lg:pl-16 text-xs font-base rounded-lg outline-none active form-control" id="" placeholder="Search..." autocomplete="off">
                    <span class="absolute flex items-center justify-center h-full py-2 px-5 lg:px-6 inset-y-0 left-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                </div>
            </form>
        </div>
        <div class="relative items-center" x-data="{ open: false }">
            <a href="#" @click="open=true" class=" relative focus:outline-none focus:bg-yellow-300 flex p-1 rounded">
                <img src="{{url('assets/icons/svg/lonceng.svg')}}" class="w-6" alt="">
                <span class="absolute top-0 right-0 flex h-4 w-4">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500"></span>
                </span>
            </a>
            <div x-show="open" @click.away="open = false" class="dropdown-notif absolute -right-5 lg:right-0 rounded-md overflow-hidden shadow-lg clearfix px-0 w-52 lg:w-80 mt-4 h-80 overflow-y-auto">
                <span class="w-full sticky top-0 block text-center font-bold px-3 py-2 bg-yellow-300"> Notifications (1.400) </span>
                @for ($i = 1; $i <= 20; $i++)
                <a href="#" class="block hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-500 px-6 py-3">Nested menu </a>
                @endfor
            </div>
        </div>
        <div class="relative items-center" x-data="{ open: false }">
            <a href="#" @click="open=true" class=" relative flex focus:outline-none focus:bg-yellow-300 p-1 rounded">
                <img src="{{url('assets/icons/svg/conversations.svg')}}" class="w-7" alt="">
                <span class="absolute top-0 right-0 flex h-4 w-4">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500"></span>
                </span>
            </a>
            <div x-show="open" @click.away="open = false" class="dropdown-notif absolute -right-5 lg:right-0 rounded-md overflow-hidden shadow-lg bg-white clearfix px-0 w-52 lg:w-80 mt-4 h-auto">
                <span class="w-full block text-center font-bold px-3 py-2 bg-yellow-300"> Chats (26)</span>
                <a href="#" class="block hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-500 px-6 py-3">Nested menu </a>
                <a href="#" class="block hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-500 px-6 py-3">Nested menu </a>
            </div>
        </div>
        <div class="relative items-center" x-data="{ open: false }">
            <a href="#" @click="open=true" class="relative flex items-center space-x-1 lg:space-x-4">
                <span class="hidden lg:flex flex-col justify-center items-end">
                    <label class="font-medium text-sm">{{session()->get('username')}}</label>
                    <small class="text-xs text-gray-400">{{session()->get('level')}}</small>
                </span>
                <img class="rounded-full w-12 h-12 flex items-center justify-center overflow-hidden" src="{{url('assets/images/user.png')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="7" viewBox="0 0 26.107 12.049">
                    <path id="Icon" d="M0,26.107,9.311,13.053,0,0H2.738l9.31,13.053L2.738,26.107Z" transform="translate(26.107) rotate(90)" fill="#222649"/>
                  </svg>
                  
            </a>
            <div x-show="open" @click.away="open = false" class="dropdown-profile absolute right-0 rounded-md overflow-hidden shadow-lg bg-white clearfix px-0 w-52 lg:w-64 mt-4 h-auto">
                <a href="#" class="block hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-500 px-6 py-3">Profile </a>
                <a href="#" class="block hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-500 px-6 py-3">Change Password </a>
                <div x-data="{ open: false }" class="block">
                    <a href="#" class="modal-open block bg-red-700 hover:bg-red-500 flex items-center text-gray-100 px-6 py-3" @click="open = true">Logout </a>
                    <div x-show="open" class="modal z-50 fixed w-full h-full top-0 left-0 flex items-center justify-center">
                        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
                
                        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                            <!-- Add margin if you want to see some of the overlay behind the modal-->
                            <div class="modal-content py-4 text-left px-6">
                                <!--modal title-->
                                <div class="flex justify-between items-center pb-3">
                                    <p class="text-2xl font-bold"></p>
                                    <div class="modal-close cursor-pointer z-50">
                                    </div>
                                </div>
                                {{-- modal header --}}
                                <div class="modal-header w-full flex items-center justify-center py-2">
                                    <img class="w-16 lg:w-24" src="http://127.0.0.1:8000/assets/images/insaf-logo-dark.png">
                                </div>
                                {{-- modal body --}}
                                <div class="modal-body w-full text-center p-4">
                                    <h2 class="text-lg lg:text-2xl font-bold">Are you sure to logout ?</h2>
                                </div>
                                {{-- modal- foooter --}}
                                <div class="modal-footer w-full flex justify-center py-4 space-x-3">
                                    <a href="#" @click="open = false" class="flex items-center justify-center px-4 p-3 rounded-lg w-32 bg-white text-gray-900 hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 modal-close">Cancel</a>
                                    <a href="{{route('logout.insaf')}}" class="flex items-center justify-center px-4 p-3 rounded-lg w-32 bg-red-600 text-white focus:ring-2 focus:ring-red-600 hover:bg-red-500">Logout</a>
                
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

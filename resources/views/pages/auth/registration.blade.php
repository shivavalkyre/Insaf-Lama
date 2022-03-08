@extends('layouts.auth', ['title' => 'Registration - INSAF'])

@section('content')
<div class="w-full h-full rounded card-auth">

    {{-- Header --}}
    <div class="w-full h-1/4 py-2 lg:py-4 block flex flex-col justify-center items-center header">
        <img class="w-16 lg:w-24" src="http://127.0.0.1:8000/assets/images/insaf-logo-dark.png">
        <h1 class="mt-10 text-2xl lg:text-5xl font-bold">Information & Safety</h1>
    </div>

    {{-- Forms --}}
    <div class="w-full h-3/4 px-3 lg:px-28 lg:pb-0 pt-5 lg:pt-12 body">
        <form action="{{route('processregistration.insaf')}}" method="post">
            @csrf
            <div class="flex flex-col my-1 form-group">
                <div class="flex justify-center items-center relative input-group">
                    <input type="text" name="username"
                        class="w-full py-3 lg:py-3 pr-4 lg:pr-8 pl-14 lg:pl-16 text-sm lg:text-lg font-bold rounded-lg outline-none border-2 active form-control"
                        id="" placeholder="Username" autocomplete="off">
                    <span class="absolute flex items-center justify-center h-full py-3 px-5 lg:px-6 inset-y-0 left-0">
                        <img class="w-4 lg:w-5" src="http://127.0.0.1:8000/assets/icons/svg/user.svg">
                    </span>
                </div>
                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                    Info here !
                </span>
            </div>
            <div class="flex flex-col mt-5 lg:mt-8 lg:mb-3 form-group">
                <div class="flex justify-center items-center relative input-group">
                    <input type="text" name="email"
                        class="w-full py-3 lg:py-3 pr-4 lg:pr-8 pl-14 lg:pl-16 text-sm lg:text-lg font-bold rounded-lg outline-none border-2 active form-control"
                        id="" placeholder="Email" autocomplete="off">
                    <span class="absolute flex items-center justify-center h-full py-3 px-5 lg:px-6 inset-y-0 left-0">
                        <img class="w-4 lg:w-5" src="http://127.0.0.1:8000/assets/icons/svg/email.svg">
                    </span>
                </div>
                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                    Info here !
                </span>
            </div>
            <div class="flex flex-col mb-3 mt-5 lg:mt-8 lg:mb-3  form-group">
                <div class="flex justify-center items-center relative input-group">
                    <input type="password" name="password" class="w-full py-3 lg:py-3 pr-4 lg:pr-8 pl-14 lg:pl-16 text-sm lg:text-lg font-bold rounded-lg outline-none border-2 active form-control show-hide-pw" id="" placeholder="Password" autocomplete="off">
                    <span class="input-append px-3 show-password cursor-pointer absolute flex items-center justify-center inset-y-0 right-0" id="toggle-pw">
                        <svg id="eye-show" class="show" xmlns="http://www.w3.org/2000/svg" width="26.721" height="17.814" viewBox="0 0 26.721 17.814">
                            <path id="Icon_awesome-eye" data-name="Icon awesome-eye" d="M26.56,12.73a14.88,14.88,0,0,0-13.2-8.23,14.882,14.882,0,0,0-13.2,8.23,1.5,1.5,0,0,0,0,1.354,14.88,14.88,0,0,0,13.2,8.23,14.882,14.882,0,0,0,13.2-8.23A1.5,1.5,0,0,0,26.56,12.73Zm-13.2,7.358a6.68,6.68,0,1,1,6.68-6.68A6.68,6.68,0,0,1,13.361,20.088Zm0-11.134a4.422,4.422,0,0,0-1.174.176,2.22,2.22,0,0,1-3.1,3.1,4.443,4.443,0,1,0,4.278-3.279Z" transform="translate(0 -4.5)" fill="#858585"/>
                            </svg>

                            <svg id="eye-hide" class="hidden" xmlns="http://www.w3.org/2000/svg" width="28.721" height="19.814" viewBox="0 0 45 36">
                            <path id="Icon_awesome-eye-slash" data-name="Icon awesome-eye-slash" d="M22.5,28.125a10.087,10.087,0,0,1-10.048-9.359l-7.376-5.7a23.435,23.435,0,0,0-2.582,3.909,2.275,2.275,0,0,0,0,2.052A22.552,22.552,0,0,0,22.5,31.5a21.84,21.84,0,0,0,5.477-.735l-3.649-2.823a10.134,10.134,0,0,1-1.828.184ZM44.565,32.21,36.792,26.2a23.291,23.291,0,0,0,5.713-7.177,2.275,2.275,0,0,0,0-2.052A22.552,22.552,0,0,0,22.5,4.5,21.667,21.667,0,0,0,12.142,7.151L3.2.237a1.125,1.125,0,0,0-1.579.2L.237,2.211a1.125,1.125,0,0,0,.2,1.579L41.8,35.763a1.125,1.125,0,0,0,1.579-.2l1.381-1.777a1.125,1.125,0,0,0-.2-1.579ZM31.648,22.226,28.884,20.09a6.663,6.663,0,0,0-8.164-8.573,3.35,3.35,0,0,1,.655,1.984,3.279,3.279,0,0,1-.108.7l-5.176-4A10.006,10.006,0,0,1,22.5,7.875,10.119,10.119,0,0,1,32.625,18a9.885,9.885,0,0,1-.977,4.226Z" transform="translate(0 0)" fill="#858585"/>
                            </svg>                          
                    </span>
                    <span class="absolute flex items-center justify-center h-full py-3 px-5 lg:px-6 inset-y-0 left-0">
                        <img class="w-4 lg:w-5" src="http://127.0.0.1:8000/assets/icons/svg/lock.svg">
                    </span>
                </div>
                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                    Info here !
                </span>
            </div>
            <div class="flex flex-col mb-3 mt-5 lg:mt-8 lg:mb-3  form-group">
                <div class="flex justify-center items-center relative input-group">
                    <input type="password" name="confirmation_password"
                        class="w-full py-3 lg:py-3 pr-4 lg:pr-8 pl-14 lg:pl-16 text-sm lg:text-lg font-bold rounded-lg outline-none border-2 active form-control show-hide-pw"
                        id="" placeholder="Retype Password" autocomplete="off">
                    <span class="absolute flex items-center justify-center h-full py-3 px-5 lg:px-6 inset-y-0 left-0">
                        <img class="w-4 lg:w-5" src="http://127.0.0.1:8000/assets/icons/svg/lock.svg">
                    </span>
                </div>
                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                    Info here !
                </span>
            </div>
            {{-- <div class="flex justify-between items-center my-3 lg:my-10 px-3">
                <div class="w-2/5 flex text-sm lg:text-base items-center justify-start">Password strength</div>
                <div class="w-3/5 flex items-center justify-end gap-2">
                    <span class="py-px w-1/3 h-2 bg-white rounded-md"></span>
                    <span class="py-px w-1/3 h-2 bg-white rounded-md"></span>
                    <span class="py-px w-1/3 h-2 bg-white rounded-md"></span>
                </div>
            </div> --}}
            <div class="flex flex-col items-start justify-between lg:flex-row mb-3 mt-5 lg:mt-10 lg:mb-3  form-group">
                <button type="submit"
                    class=" flex items-center duration-75 justify-center shadow-xl hover:shadow-none w-full lg:w-56 focus:outline-none focus:ring-4 ring-gray-500 bg-black py-3 lg:py-3 lg:px-10 text-white rounded-lg font-medium text-base lg:text-base hover:bg-gray-800 my-2 lg:my-0">Create
                    Account</button>

                <a href="{{ route('login.insaf') }}"
                    class=" flex items-center duration-75 justify-center hover:shadow-xl w-full lg:w-56 outline-none ring-1 focus:outline-none ring-gray-900 bg-transparent py-2 lg:py-3 lg:px-10 text-black rounded-lg font-medium text-base lg:text-base hover:bg-gray-800 hover:text-white my-2 lg:my-0">Login</a>
            </div>
            {{-- <button class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Open Modal</button> --}}
  
        </form>

        @if ($errors->any())
            <div class="bg-red-400 p-4 rounded-md mt-3 lg:mt-7">
                <h3 class="text-lg font-semibold mb-3">Registration Failed !</h3>
                <ul class="list-outside">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                              </svg>
                              &nbsp;
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <!--Modal-->
    @if(session()->has('success'))
    <div x-data="{ open: true }">
        <div class="modal  fixed w-full h-full top-0 left-0 flex items-center justify-center" x-show="open">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-100 overflow-y-auto">

                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <!--modal title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold"></p>
                        <div class="modal-close cursor-pointer z-50">
                            <svg @click="open = false" class=" fill-current text-black font-bold" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    {{-- modal header --}}
                    <div class="modal-header w-full flex items-center justify-center py-2">
                        <img class="w-16 lg:w-24" src="http://127.0.0.1:8000/assets/images/insaf-logo-dark.png">
                    </div>
                    {{-- modal body --}}
                    <div class="modal-body w-full text-center p-4">
                        <h2 class="text-lg lg:text-2xl font-bold">Registration Successfull !</h2>
                        <p>Please open your email to verify your account.</p>
                    </div>
                    {{-- modal- foooter --}}
                    <div class="modal-footer w-full flex justify-center py-4">
                        <button type="button" @click="open = false" class="flex focus:outline-none items-center justify-center px-4 p-3 rounded-lg w-full bg-gray-900 text-white hover:bg-gray-700">Close</button>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection

@push('active.teams')
active
@endpush

@push('before_styles')

@endpush

@push('after_styles')

@endpush

@push('before_scripts')

@endpush

@push('after_scripts')

@endpush

@push('before_scripts_utility')

@endpush

@push('after_scripts_utility')

@endpush

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
                    <input type="password" name="password"  pattern="(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                        class="w-full py-3 lg:py-3 pr-4 lg:pr-8 pl-14 lg:pl-16 text-sm lg:text-lg font-bold rounded-lg outline-none border-2 active form-control"
                        id="" placeholder="Password" autocomplete="off">
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
                        class="w-full py-3 lg:py-3 pr-4 lg:pr-8 pl-14 lg:pl-16 text-sm lg:text-lg font-bold rounded-lg outline-none border-2 active form-control"
                        id="" placeholder="Retype Password" autocomplete="off">
                    <span class="absolute flex items-center justify-center h-full py-3 px-5 lg:px-6 inset-y-0 left-0">
                        <img class="w-4 lg:w-5" src="http://127.0.0.1:8000/assets/icons/svg/lock.svg">
                    </span>
                </div>
                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                    Info here !
                </span>
            </div>
            <div class="flex justify-between items-center my-3 lg:my-10 px-3">
                <div class="w-2/5 flex text-sm lg:text-base items-center justify-start">Password strength</div>
                <div class="w-3/5 flex items-center justify-end gap-2">
                    <span class="py-px w-1/3 h-2 bg-white rounded-md"></span>
                    <span class="py-px w-1/3 h-2 bg-white rounded-md"></span>
                    <span class="py-px w-1/3 h-2 bg-white rounded-md"></span>
                </div>
            </div>
            <div class="flex flex-col items-start justify-between lg:flex-row mb-3 mt-5 lg:mt-8 lg:mb-3  form-group">
                <button type="submit"
                    class=" flex items-center justify-center shadow-xl hover:shadow-none w-full lg:w-56 focus:outline-none focus:ring-4 ring-gray-500 bg-black py-3 lg:py-3 lg:px-10 text-white rounded-lg font-medium text-base lg:text-base hover:bg-gray-800 my-2 lg:my-0">Create
                    Account</button>

                <a href="{{ route('login.insaf') }}"
                    class=" flex items-center justify-center hover:shadow-xl w-full lg:w-56 outline-none ring-1 focus:outline-none ring-gray-900 bg-transparent py-2 lg:py-3 lg:px-10 text-black rounded-lg font-medium text-base lg:text-base hover:bg-gray-800 hover:text-white my-2 lg:my-0">Login</a>
            </div>
            {{-- <button class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Open Modal</button> --}}
  
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <!--Modal-->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div
                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--modal title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold"></p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-white font-bold" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
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
                    <a href="#" target="_blank" class="flex items-center justify-center px-4 p-3 rounded-lg w-full bg-gray-900 text-white hover:bg-gray-700">Open Email</a>
                    {{-- <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button> --}}
                </div>

            </div>
        </div>
    </div>

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
<script>
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };
    
    
    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    
     
  </script>
@endpush

@push('after_scripts')

@endpush

@push('before_scripts_utility')

@endpush

@push('after_scripts_utility')

@endpush

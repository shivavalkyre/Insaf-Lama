@extends('layouts.auth', ['title' => 'Login - INSAF'])

@section('content')
<div class="w-full h-full rounded card-auth">

    <div class="w-full h-2/5 py-3 lg:py-4 flex flex-col justify-center items-center header ">
        <img class="w-16 lg:w-24" src="/assets/images/insaf-logo-dark.png">
        <h1 class="mt-10 text-2xl lg:text-5xl font-bold">Information & Safety</h1>
    </div>

    <div class="w-full h-2/5 px-3 lg:px-28 py-0 body">
        <form action="{{route('processlogin.insaf')}}" method="post">
            @csrf
            <div class="flex flex-col my-1 form-group">
                <div class="flex justify-center items-center relative input-group">
                    <input type="text" name="username" class="w-full py-3 lg:py-3 pr-4 lg:pr-8 pl-14 lg:pl-16 text-sm lg:text-lg font-bold rounded-lg outline-none border-2 active form-control" id="" placeholder="Username" autocomplete="off">
                    <span class="absolute flex items-center justify-center h-full py-3 px-5 lg:px-6 inset-y-0 left-0">
                        <img class="w-4 lg:w-5" src="http://127.0.0.1:8000/assets/icons/svg/user.svg">
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
            <div class="flex justify-between items-center my-6 form-group px-1">
                <div class="flex items-center">
                    <div class="form-custom-checkbox">
                        <label class="checkbox flex  cursor-pointer items-center">
                            <span class="checkbox__input">
                                <input type="checkbox" name="checkbox">
                                <span class="checkbox__control">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                        <path fill="none" stroke="currentColor" stroke-width="3" d="M1.73 12.91l6.37 6.37L22.79 4.59"></path></svg>
                                </span>
                            </span>
                            <span class="radio__label">Ingatkan saya</span>
                        </label>
                    </div>
                </div>
                <div class="flex items-center justify-end">
                    <a href="{{ route('reset_password.insaf') }}" class="font-bold text-xs lg:text-sm hover:text-gray-700">Lupa Password Anda ?</a>
                </div>
            </div>
            <div class="flex justify-center items-center mt-8 form-group px-1">
                <button type="submit" class=" flex items-center justify-center shadow-xl w-full lg:w-32 focus:outline-none focus:ring-4 ring-gray-500 bg-black py-3 lg:py-3 lg:px-20 text-white rounded-lg font-medium text-base lg:text-lg hover:bg-gray-800">Masuk</button>
            </div>
        </form>
    </div>

    {{-- alert session info --}}
    @if(session()->has('error'))
    <div class="w-full relative flex flex-col space-y-2 items-center justify-center" x-data="{ open: true }">
        <div class="px-7 py-5 flex items-center justify-between w-full max-w-md  rounded-md bg-red-400" x-show="open">
            <div class="flex items-center space-x-3 ">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                      </svg>
                </div>
                <div>
                    <h3 class="text-gray-800 text-lg font-medium">{{ session()->get('error') }}</h3>
                </div>
            </div>
            <div class="flex items-center">
                <button type="button" class="focus:outline-none" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </button>
            </div>
        </div>
    </div>
    @endif
    @if(session()->has('success'))
    <div class="w-full relative flex flex-col space-y-2 items-center justify-center" x-data="{ open: true }">
        <div class="px-7 py-5 flex items-center justify-between w-full max-w-md  rounded-md bg-green-200" x-show="open">
            <div class="flex items-center space-x-3 ">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                </div>
                <div>
                    <h3 class="text-gray-800 text-lg font-medium">{{ session()->get('success') }}</h3>
                </div>
            </div>
            <div class="flex items-center">
                <button type="button" class="focus:outline-none" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                </button>
            </div>
        </div>
    </div>
    @endif

    <div class="flex items-end justify-center py-8 lg:py-3 items-end justify-center w-full h-1/5 bottom-0">
        <span class="text-xs lg:text-base">
            Belum punya akun ? <a class="font-bold hover:text-gray-700" href="{{ route('registration.insaf') }}">Daftar Sekarang</a>
        </span>
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
    
@endpush

@push('after_scripts')
    
@endpush

@push('before_scripts_utility')
    
@endpush

@push('after_scripts_utility')
    
@endpush
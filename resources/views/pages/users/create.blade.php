@extends('layouts.main', ['title' => 'Create User - INSAF'])

@php
$date = date('d/m/Y H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Create User</h1>
</div>

<div x-data="{ openTab: 1 }">
    <div class="w-full pt-4">
        <form action="{{route('users.insaf')}}" method="get">
            @csrf
            {{-- step 1 --}}
            <div x-show="openTab === 1" class="space-y-3">
                {{-- content 1--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex flex-col item-center mb-16">
                        <div class="">
                            <div class="relative flex items-center justify-center p-7 overflow-hidden w-52 h-52 rounded-lg bg-yellow-400 border-4 border-yellow-300">
                                <div class="absolute inset-0" id="imgPrev"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="109.422" height="109.422" viewBox="0 0 109.422 109.422">
                                    <path id="Path_99" data-name="Path 99" d="M118.711,118.711A27.355,27.355,0,1,0,91.355,91.355,27.435,27.435,0,0,0,118.711,118.711Zm0,13.678c-18.123,0-54.711,9.233-54.711,27.355v13.678H173.422V159.744C173.422,141.622,136.833,132.389,118.711,132.389Z" transform="translate(-64 -64)" fill="#171717"/>
                                </svg>                                  
                            </div>
                        </div>
                        <div class="flex flex-col my-1 form-group-1 mt-6">
                            <div class="relative">
                                <label for="upload-image" class="absolute flex items-center justify-center rounded-lg cursor-pointer font-bold bg-yellow-400 hover:bg-yellow-300 w-52 h-12 upload-image">
                                    Upload Foto Profile
                                </label>
                                <input type="file" name="" id="upload-image" class="fileupload hidden w-32 h-10 bg-yellow-400" 
                                    autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="nama_lenkgap" class="active form-control" id="" placeholder="Nama Lengkap"
                                    autocomplete="off">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jabatan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="jabatan" id="" class="active form-control">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                                <span class="input-append pointer-events-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28.261" height="16.031"
                                        viewBox="0 0 28.261 16.031">
                                        <path id="Icon_awesome-caret-down" data-name="Icon awesome-caret-down"
                                            d="M2.7,13.5H27.153a1.9,1.9,0,0,1,1.34,3.241L16.27,28.975a1.9,1.9,0,0,1-2.69,0L1.355,16.741A1.9,1.9,0,0,1,2.7,13.5Z"
                                            transform="translate(-0.794 -13.5)" fill="#171717" />
                                    </svg>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Email</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="" id="" class="active form-control">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">No. Handphone </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="" id="" class="active form-control">
                                {{-- <span class="input-append">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                      </svg>
                                </span> --}}
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Password</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="password" placeholder="Password" name="password" id="" class="active form-control show-hide-pw">
                                <span class="input-append w-10 show-password cursor-pointer" id="toggle-pw">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26.721" height="17.814" viewBox="0 0 26.721 17.814">
                                        <path id="Icon_awesome-eye" data-name="Icon awesome-eye" d="M26.56,12.73a14.88,14.88,0,0,0-13.2-8.23,14.882,14.882,0,0,0-13.2,8.23,1.5,1.5,0,0,0,0,1.354,14.88,14.88,0,0,0,13.2,8.23,14.882,14.882,0,0,0,13.2-8.23A1.5,1.5,0,0,0,26.56,12.73Zm-13.2,7.358a6.68,6.68,0,1,1,6.68-6.68A6.68,6.68,0,0,1,13.361,20.088Zm0-11.134a4.422,4.422,0,0,0-1.174.176,2.22,2.22,0,0,1-3.1,3.1,4.443,4.443,0,1,0,4.278-3.279Z" transform="translate(0 -4.5)" fill="#171717"/>
                                      </svg>
                                      
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg">Simpan</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>

@endsection

@push('securite')
active-menu
@endpush

@push('before_styles')

@endpush

@push('after_styles')

@endpush

@push('before_scripts')

@endpush

@push('after_scripts')
<script>
    $(document).ready(function () {
        
        $("#toggle-pw").click(function () {
            if ($(".show-hide-pw").attr("type") == "password")
            {
                //Change type attribute
                $(".show-hide-pw").attr("type", "text");
            } 
            else
            {
                //Change type attribute
                $(".show-hide-pw").attr("type", "password");
            }
        });
    });
</script>
@endpush

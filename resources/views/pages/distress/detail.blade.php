@extends('layouts.main', ['title' => 'Distress - '. $title ." | ". "INSAF"])

@section('content')
{{-- section detail --}}
<div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3">
    <div class="flex items-center justify-between py-7 text-center px-12">
        <h1 class="text-2xl font-bold text-yellow-500">{{ $title }}</h1>
        <div class="relative" x-data="{ open: false }">
            <a href="#" @click="open=true"  class="btn-table-add">
                <span class="label">Buat Room Chat Distress</span>
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                        <path id="Icon_material-add" data-name="Icon material-add" d="M32.5,21.786H21.786V32.5H18.214V21.786H7.5V18.214H18.214V7.5h3.571V18.214H32.5Z" transform="translate(-7.5 -7.5)" fill="#fff"/>
                      </svg>                      
                </span>
            </a>
            <div x-show="open" x-init="setTimeout(() => show = false, 8000)"
                x-transition:enter="transition duration-200 transform ease-out"
                x-transition:enter-start="scale-75"
                x-transition:leave="transition duration-100 transform ease-in"
                x-transition:leave-end="opacity-0 scale-90" class=" overlay-modal fixed flex items-center justify-center z-50 fixed w-screen h-screen bg-gray-900 bg-opacity-70 flex inset-0 px-2">
                <div class="modal relative bg-white overflow-hidden rounded-xl w-full max-w-screen-lg h-auto z-50">
                    <div class="modal-header flex items-center justify-between p-5 bg-gray-100">
                        <div class="flex items-center space-x-3">
                            <img class="logo-brand w-7" src="{{url('assets/images/insaf-dark.png')}}">
                            <h4 class="text-lg font-semibold text-gray-900">Buat Room Chat Distress</h4>
                        </div>
                        <div>
                            <a href="#" @click="open=false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                            </a>
                        </div>
                    </div>
                    <form action="" method="get">
                        <div class="py-6 px-5 modal-body space-y-4">                            
                            @csrf
                            
                            <div class="flex justify-between space-x-8">
                                <div class="flex flex-col my-1 form-group-1">
                                    <label class="font-bold mb-2 text-left">Nama Room Distress <span class="text-red-500">*</span></label>
                                    <div class="flex justify-center items-center relative input-group-1">
                                        <input type="text" name="" class="active form-control" id="" value="{{ $title }}" placeholder="Nama Room Chat"
                                            autocomplete="off" required>
                                    </div>
                                    <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                        Info here !
                                    </span>
                                </div>                    
                                <div class="flex flex-col my-1 form-group-1">
                                    <label class="font-bold mb-2 text-left">Waktu Kejadian</label>
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="" id="" value="<?php echo date("d M Y H:m", strtotime($distress["waktu_kejadian"])); ?>" class="active form-control">
                                    </div>
                                    <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                        Info here !
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex flex-col justify-between" x-data="{ open: false }">
                                <div class="flex flex-col lg:flex-row space-x-4 justify-between items-center mb-2">
                                    <label class="font-bold mb-2 text-left">Partisipan Chat</label>
                                    <button @click="open = true" type="button" class="transition duration-75 focus:outline-none focus:ring-2 focus:ring-gray-500 bg-gray-900 hover:bg-gray-800 text-white font-medium flex items-center justify-center p-1 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                          </svg>
                                    </button>
                                </div>
                                <div x-show="open" class="flex w-full p-5 bg-gray-100 border border-gray-300 rounded-md">
                                    <table id="table-1" class="custom-1">
                                        <thead class="w-full">
                                            <tr>
                                                <th>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                      </svg>
                                                </th>
                                                <th>Username</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $row)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="paticipant[]" value="{{$row->id}}">
                                                </td>
                                                <td>{{$row->username}}</td>
                                                <td>{{$row->email}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer bg-gray-300 flex items-center justify-end py-3 space-x-2 px-5">
                            <button @click="open=false" type="button" class="transition duration-100 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:bg-gray-500 hover:bg-gray-500 text-gray-800 font-medium hover:text-white  flex items-center justify-center py-2 px-5 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="transition duration-100 focus:outline-none focus:ring-4 focus:ring-red-400 focus:bg-red-500 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-medium flex items-center justify-center py-2 px-5 rounded-lg">
                                Buat Room
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="flex px-10 pb-10">
        <table class="w-full">
            <tbody>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Jenis Distress</span> 
                        <br>
                        <span class="text-xl font-bold mt-2">{{ $distress['jenis_distress'] }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Sumber Informasi Awal</span>
                        <br>
                        <span class="text-xl font-bold mt-2">{{ $distress['sumber_informasi_awal'] }}</span>
                    </td>
                </tr>
                <tr class="">
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Lokasi Kejadian</span> 
                        <br>
                        <span class="text-xl font-bold mt-2">{{ $distress['lokasi_kejadian'] }}</span>
                    </td>
                </tr>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Waktu Kejadian</span>
                        <br>
                        <span class="text-xl font-bold mt-2"><?php echo date("d m Y | H:m", strtotime($distress["waktu_kejadian"])); ?></span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Waktu Selesai</span> 
                        <br>
                        <span class="text-xl font-bold mt-2"><?php echo date("d m Y | H:m", strtotime($distress["waktu_selesai"])); ?></span>
                    </td>
                </tr>
                <tr class="">
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Deskripsi Kejadian</span> 
                        <br>
                        <span class="text-lg font-bold mt-2">{{ str_replace("\r","<br/>", $distress['deskripsi_assesment']) }}</span>
                    </td>
                </tr>
                <tr class="">
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-3 font-bold text-yellow-400">Informasi Distress Kapal</span> 
                        <br>
                        <br>
                        <span class="space-x-3">
                            @foreach($distressdetail as $datadistressdetail)
								<button class="bg-yellow-400 py-2 px-5 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-300 text-black font-bold text-lg">{{ $datadistressdetail['ship_name'] }}</button>
							@endforeach
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
{{-- section chat participant distress --}}
<div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3 mt-5 px-7 py-10">
    <h1 class="text-2xl font-bold text-gray-900 mb-10">DISTRESS COMMUNICATION</h1>
    <div class="grid grid-cols-2 lg:grid-cols-2 w-full gap-8">
        <div class="relative flex items-center space-x-5 border-2 border-yellow-300 duration-75 hover:shadow-md rounded-md h-32">
            <div class="absolute top-0 right-0">
                    <div class="w-auto relative font-bold " x-data="{ open: false }">
                        <button type="button" @click="open=true" id="dropdown-button" class="items-center justify-center focus:outline-none p-2 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36.049" height="20.449" viewBox="0 0 36.049 20.449">
                            <path id="Icon_awesome-caret-down" data-name="Icon awesome-caret-down" d="M3.22,13.5h31.2a2.42,2.42,0,0,1,1.71,4.135l-15.593,15.6a2.43,2.43,0,0,1-3.431,0L1.51,17.635A2.42,2.42,0,0,1,3.22,13.5Z" transform="translate(-0.794 -13.5)" fill="#fdb815"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" id="dropdown" class="dropdown absolute right-0 w-40 mr-2 bg-white border border-yellow-300 rounded-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-md text-center font-medium text-gray-800 border-b hover:bg-gray-100 hover:text-gray-900">Jadikan OSC</a>
                        </div>
                    </div>
                </div>
            <div class="px-3">
                <div class="overflow-hidden rounded-full w-24 h-24 flex items-center justify-center">
                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                </div>
            </div>
            <div class="">
                <h5 class="text-xl font-bold text-gray-900">Tedy Hidayat</h5>
                <span class="text-gray-500">Kabasarnas</span>
            </div>
        </div>
        <div class="relative flex items-center space-x-5 border-2 border-yellow-300 duration-75 hover:shadow-md rounded-md h-32">
            <div class="absolute top-0 right-0">
                    <div class="w-auto relative font-bold " x-data="{ open: false }">
                        <button type="button" @click="open=true" id="dropdown-button" class="items-center justify-center focus:outline-none p-2 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36.049" height="20.449" viewBox="0 0 36.049 20.449">
                            <path id="Icon_awesome-caret-down" data-name="Icon awesome-caret-down" d="M3.22,13.5h31.2a2.42,2.42,0,0,1,1.71,4.135l-15.593,15.6a2.43,2.43,0,0,1-3.431,0L1.51,17.635A2.42,2.42,0,0,1,3.22,13.5Z" transform="translate(-0.794 -13.5)" fill="#fdb815"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" id="dropdown" class="dropdown absolute right-0 w-40 mr-2 bg-white border border-yellow-300 rounded-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-md text-center font-medium text-gray-800 border-b hover:bg-gray-100 hover:text-gray-900">Jadikan OSC</a>
                        </div>
                    </div>
                </div>
            <div class="px-3">
                <div class="overflow-hidden rounded-full w-24 h-24 flex items-center justify-center">
                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                </div>
            </div>
            <div class="">
                <h5 class="text-xl font-bold text-gray-900">Tedy Hidayat</h5>
                <span class="text-gray-500">Kabasarnas</span>
            </div>
        </div>
        <div class="relative flex items-center space-x-5 border-2 border-yellow-300 duration-75 hover:shadow-md rounded-md h-32">
            <div class="absolute top-0 right-0">
                    <div class="w-auto relative font-bold " x-data="{ open: false }">
                        <button type="button" @click="open=true" id="dropdown-button" class="items-center justify-center focus:outline-none p-2 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36.049" height="20.449" viewBox="0 0 36.049 20.449">
                            <path id="Icon_awesome-caret-down" data-name="Icon awesome-caret-down" d="M3.22,13.5h31.2a2.42,2.42,0,0,1,1.71,4.135l-15.593,15.6a2.43,2.43,0,0,1-3.431,0L1.51,17.635A2.42,2.42,0,0,1,3.22,13.5Z" transform="translate(-0.794 -13.5)" fill="#fdb815"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" id="dropdown" class="dropdown absolute right-0 w-40 mr-2 bg-white border border-yellow-300 rounded-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-md text-center font-medium text-gray-800 border-b hover:bg-gray-100 hover:text-gray-900">Jadikan OSC</a>
                        </div>
                    </div>
                </div>
            <div class="px-3">
                <div class="overflow-hidden rounded-full w-24 h-24 flex items-center justify-center">
                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                </div>
            </div>
            <div class="">
                <h5 class="text-xl font-bold text-gray-900">Tedy Hidayat</h5>
                <span class="text-gray-500">Kabasarnas</span>
            </div>
        </div>
        <div class="relative flex items-center space-x-5 border-2 border-yellow-300 duration-75 hover:shadow-md rounded-md h-32">
            <div class="absolute top-0 right-0">
                    <div class="w-auto relative font-bold " x-data="{ open: false }">
                        <button type="button" @click="open=true" id="dropdown-button" class="items-center justify-center focus:outline-none p-2 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36.049" height="20.449" viewBox="0 0 36.049 20.449">
                            <path id="Icon_awesome-caret-down" data-name="Icon awesome-caret-down" d="M3.22,13.5h31.2a2.42,2.42,0,0,1,1.71,4.135l-15.593,15.6a2.43,2.43,0,0,1-3.431,0L1.51,17.635A2.42,2.42,0,0,1,3.22,13.5Z" transform="translate(-0.794 -13.5)" fill="#fdb815"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" id="dropdown" class="dropdown absolute right-0 w-40 mr-2 bg-white border border-yellow-300 rounded-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-md text-center font-medium text-gray-800 border-b hover:bg-gray-100 hover:text-gray-900">Jadikan OSC</a>
                        </div>
                    </div>
                </div>
            <div class="px-3">
                <div class="overflow-hidden rounded-full w-24 h-24 flex items-center justify-center">
                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                </div>
            </div>
            <div class="">
                <h5 class="text-xl font-bold text-gray-900">Tedy Hidayat</h5>
                <span class="text-gray-500">Kabasarnas</span>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center pt-10">
        <a href="{{route('distress_chat_room.insaf')}}" target="_blank" class="bg-red-500 hover:bg-rose-500 duration-75 py-2 px-7 rounded-lg focus:outline-none focus:ring-4 focus:ring-red-300 text-white font-bold text-lg">Live Chat</a>
    </div>
</div>

<div class="rounded-lg w-full overflow-hidden h-auto space-y-3 py-5 mt-4 px-2">
    <a href="{{route('distress.insaf')}}" class="px-10 py-3 rounded-lg font-bold hover:bg-yellow-300 bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300">Kembali</a>
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

@endpush



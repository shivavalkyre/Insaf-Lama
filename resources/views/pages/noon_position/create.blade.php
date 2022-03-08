@extends('layouts.main', ['title' => 'Create Noon Position - INSAF'])

@php
$date = date('Y-m-d H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Create Noon Position</h1>
</div>

<div x-data="{ openTab: 1 }">
    <div class="w-full pt-4">
        <form action="{{route('noon_position_store.insaf')}}" method="post">
            @csrf
            {{-- step 1 --}}
            <div x-show="openTab === 1" class="space-y-3">
                {{-- content 1--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nomor Jurnal <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="no_jurnal" class="readonly form-control" id="" value="{{ $no_jurnal }}"
                                    autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Tanggal <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="tgl_jurnal" class="readonly form-control" id="" value=" {{ $date }}"
                                    autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12 py-3">
                        <h2 class="text-2xl font-bold text-black">Data Kapal</h2>
                    </div>
        
                    <div class="flex item-center justify-between" x-data="{ open: false }">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nama Kapal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="ship_name" class="form-control readonly" readonly>
                                <button type="button" class="modal-open focus:outline-none input-append" @click="open = true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30.621" height="30.621" viewBox="0 0 30.621 30.621">
                                        <g id="Icon_feather-search" data-name="Icon feather-search" transform="translate(-3 -3)">
                                          <path id="Path_57" data-name="Path 57" d="M28.5,16.5a12,12,0,1,1-12-12A12,12,0,0,1,28.5,16.5Z" fill="none" stroke="#171717" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                          <path id="Path_58" data-name="Path 58" d="M31.5,31.5l-6.525-6.525" fill="none" stroke="#171717" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                        </g>
                                      </svg>                          
                                </button>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="z-100 modal fixed w-screen h-screen inset-0 bg-black bg-opacity-30 flex items-center justify-center" 
                            x-show="open"
                            x-transition:enter="transition duration-75 transform ease-out"
                            x-transition:leave="transition duration-75 transform ease-in"
                            x-transition:leave-end="opacity-0">                        
                            <div class="modal-container relative bg-white w-full lg:w-4/5 mx-auto rounded shadow-lg z-50 overflow-auto h-4/5">
                                      
                                <!-- Add margin if you want to see some of the overlay behind the modal-->
                                <div class="modal-content text-left">
                                    {{-- modal header --}}
                                    <div class="modal-header w-full flex items-start justify-between sticky top-0 bg-white px-4 py-3">
                                        <div>
                                            <div class="flex w-full lg:w-72 sticky top-0">
                                                <div class="flex flex-col my-1 space-y-3 form-group-1">
                                                    <label for="" class="font-bold text-lg">Search</label>
                                                    <div class="flex justify-center items-center relative input-group-1">
                                                        <input type="text" name="" class="active form-control" id="saerchOutside" placeholder="Cari Kapal" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-close cursor-pointer z-50" >
                                            <svg @click="open = false" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 50 50">
                                                <path id="Icon_ionic-md-close" data-name="Icon ionic-md-close" d="M57.523,12.523l-5-5-20,20-20-20-5,5,20,20-20,20,5,5,20-20,20,20,5-5-20-20Z" transform="translate(-7.523 -7.523)"/>
                                              </svg>                                              
                                        </div>
                                    </div>
                                    {{-- modal body --}}
                                    <div class="modal-body w-full text-center p-4">
                                        <div class="">
                                            <div class="my-2">
                                                <table id="table-3" class="">
                                                    <thead class="w-full">
                                                        <tr>
                                                            <th>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                                  </svg>
                                                            </th>
                                                            <th>Nama Kapal</th>
                                                            <th>MMSI</th>
                                                            <th>IMO</th>
                                                            <th>Bendera</th>
                                                            <th>Call Sign</th>
                                                            <th>Length</th>
                                                            <th>Width</th>
                                                            <th>Tipe Kapal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kapal as $row)
                                                        <tr>
                                                            <td>
                                                                <input type="radio" name="mmsi_kapal" value="{{$row['mmsi']}}"> 
                                                            </td>
                                                            <td>{{$row['ship_name']}}</td>
                                                            <td>{{$row['mmsi']}}</td>
                                                            <td>{{$row['imo']}}</td>
                                                            <td>{{$row['flag']}}</td>
                                                            <td>{{$row['call_sign']}}</td>
                                                            <td>{{$row['length']}}</td>
                                                            <td>{{$row['width']}}</td>
                                                            <td>{{$row['ship_type']}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- modal- foooter --}}
                                    <div class="modal-footer absolute bottom-0 w-full flex justify-end items-center bg-white px-5 py-7">
                                            <button type="button" @click="open = false" onclick="getKapal()" class="bg-yellow-400 hover:bg-yellow-300 py-3 px-7 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-medium text-lg">Pilih Kapal</button>
                                            
                                    </div>
                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">IMO </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="imo" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Call Sign </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="call_sign" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
            
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Bendera </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="flag" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">MMSI </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="mmsi" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
    
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Status Bernavigasi <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="status_nav" id="" class="active form-control">
                                    <option value="" selected disabled>- Pilih Status Bernavigasi -</option>
                                    @foreach ($status_navigation as $item)
                                    <option value="{{$item['id']}}">{{$item['ais_status_navigation']}}</option>
                                    @endforeach
                                </select>
                                <span class="input-append">
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

                </div>
                {{-- button --}}
                <div class="mt-3 bg-white py-5 px-3 rounded-lg flex items-center justify-between">
                    <div class="ml-0 lg:ml-3">
                        <span class="font-bold text-2xl">
                            <span><</span>
                            <span class="text-yellow-400">1</span>
                            <span>/</span>
                            <span>2</span>
                            <span>></span>
                        </span>
                    </div>
                    <div class="space-x-3">
                        <a href="{{route('noon_position.insaf')}}" class="bg-white py-3 px-10 hover:bg-gray-300 rounded-lg w-auto focus:outline-none text-gray-600 font-bold text-lg"> Batal </a>
                        <button type="button" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg" @click="openTab = 2">Lanjutkan</button>
                    </div>
                </div>
            </div>
            {{-- step 2 --}}
            <div x-show="openTab === 2" class="space-y-3">
                {{-- content 1--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex item-center justify-between space-x-12 py-3">
                        <h2 class="text-2xl font-bold text-black">Informasi Noon Position</h2>
                    </div>
        
                    <div class="flex flex-col space-y-4 w-1/2">
                        <div class="flex flex-col">
                            <label class="font-bold mb-3">Longitude </label>
                            <div class="flex space-x-3">
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="degree1" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="minute1" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="second1" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                           "
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction1" id="" class="active form-control">
                                            <option value="" selected disabled>--</option>
                                            <option value="W">W</option>
                                            <option value="E">E</option>
                                        </select>
                                        <span class="input-append">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28.261" height="16.031"
                                                viewBox="0 0 28.261 16.031">
                                                <path id="Icon_awesome-caret-down" data-name="Icon awesome-caret-down"
                                                    d="M2.7,13.5H27.153a1.9,1.9,0,0,1,1.34,3.241L16.27,28.975a1.9,1.9,0,0,1-2.69,0L1.355,16.741A1.9,1.9,0,0,1,2.7,13.5Z"
                                                    transform="translate(-0.794 -13.5)" fill="#171717" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-bold mb-3">Latitude </label>
                            <div class="flex space-x-3">
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="degree2" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="minute2" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="second2" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                           ''
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction2" id="" class="active form-control">
                                            <option value="" selected disabled>--</option>
                                            <option value="N">N</option>
                                            <option value="S">S</option>
                                        </select>
                                        <span class="input-append">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28.261" height="16.031"
                                                viewBox="0 0 28.261 16.031">
                                                <path id="Icon_awesome-caret-down" data-name="Icon awesome-caret-down"
                                                    d="M2.7,13.5H27.153a1.9,1.9,0,0,1,1.34,3.241L16.27,28.975a1.9,1.9,0,0,1-2.69,0L1.355,16.741A1.9,1.9,0,0,1,2.7,13.5Z"
                                                    transform="translate(-0.794 -13.5)" fill="#171717" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex item-center space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Haluan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="haluan" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">&deg;</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kecepatan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="kecepatan" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">Knot</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nama Lokasi Pelaporan Noon Position </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="nama_lokasi_perairan" class="active form-control" id="" autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">            
                        <div class="flex items-end justify-center space-x-3 my-1 form-group-1">
                            <div class="w-full space-y-3">
                                <label class="font-bold mb-2">Pelabuhan Asal <span class="text-red-500">*</span></label>
                                <div class="relative flex justify-center items-center relative input-group-1">
                                    <select name="pelabuhan_asal" id="" class="active form-control">
                                        <option value="" selected disabled>- Pilih Pelabuhann Asal -</option>
                                        <option value="1">Tanjunng Priok</option>
                                    </select>
                                    <span class="input-append">
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
                        <div class="flex items-end justify-center space-x-3 my-1 form-group-1">
                            <div class="w-full space-y-3">
                                <label class="font-bold mb-2">Pelabuhan Tujuan <span class="text-red-500">*</span></label>
                                <div class="relative flex justify-center items-center relative input-group-1">
                                    <select name="pelabuhan_tujuan" id="" class="active form-control">
                                        <option selected disabled value="">- Pilih Pelabuhan Tujuan -</option>
                                        <option value="2">Merak</option>
                                    </select>
                                    <span class="input-append">
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
                    </div>

                    <div class="flex item-center space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jumlah Awak Kapal</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="jumlah_awak" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">Orang</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jumlah Penumpang</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="jumlah_penumpang" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">Orang</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jenis Muatan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="jenis_muatan" id="" autocomplete="off" class="active form-control">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kondisi Awak Kapal </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="kondisi_awak_kapal" class="active form-control" id="" autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kondisi Kapal </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="kondisi_kapal" class="active form-control" id="" autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Posisi BBM Kapal </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="posisi_bbm" class="active form-control" id="" autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                    
                </div>
                {{-- content 2--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex item-center justify-between space-x-12 py-3">
                        <h2 class="text-2xl font-bold text-black">Informasi Cuaca Kapal</h2>
                    </div>
        
                    <div class="flex item-center space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kecepatan Angin</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="kecepatan_angin" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">m/s</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Temperatur</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="temperature" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">&deg;Celcius</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                    <div class="flex item-center space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Arus</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="arus" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">Knot | N</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kelembapan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="kelembapan" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">%</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                    <div class="flex item-center space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Curah Hujan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="curah_hujan" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">mm/s</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Arah Angin</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="arah_angin" id="" autocomplete="off" class="active form-control">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                    <div class="flex item-center space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Tinggi Glombang</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="tinggi_gelombang" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">Meter</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jarak Penglihatan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="jarak_penglihatan" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">KM</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                    <div class="flex item-center space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Pasang Surut</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="pasang_surut" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">CM</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Tekanan Udara</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="tekanan_udara" id="" autocomplete="off" class="active form-control">
                                <span class="input-append">
                                    <span class="font-bold">hPa</span>
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                    <div class="flex item-center space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Keterangan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <textarea rows="4" cols="10" name="remark_keterangan" id="" autocomplete="off" class="active form-control"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                </div>
                {{-- button --}}
                <div class="mt-3 space-x-3 bg-white py-5 px-3 rounded-lg flex items-center justify-between">
                    <div class="ml-0 lg:ml-3">
                        <span class="font-bold text-2xl">
                            <span><</span>
                            <span class="text-yellow-400">2</span>
                            <span>/</span>
                            <span>2</span>
                            <span>></span>
                        </span>
                    </div>
                    <div class="space-x-3">
                        <a href="{{route('noon_position.insaf')}}" class="bg-white py-3 px-10 hover:bg-gray-300 rounded-lg w-auto focus:outline-none text-gray-600 font-bold text-lg"> Batal </a>
                        <button type="button" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg" @click="openTab = 1">Sebelumnya</button>
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
{{-- function get kapal by mmsi --}}
<script>
    function getKapal() {
        var mmsi_kapal = $('input[name=mmsi_kapal][type=radio]:checked').val();

        var url = '/ships/get_ship/'+mmsi_kapal;
        $.getJSON(url, function (data) {
            var ship = data['data'][0];
            $("input[name=ship_name][type=text]").val(ship['ship_name']);
            $("input[name=flag][type=text]").val(ship['flag']);
            $("input[name=call_sign][type=text]").val(ship['call_sign']);
            $("input[name=imo][type=text]").val(ship['imo']);
            $("input[name=mmsi][type=text]").val(ship['mmsi']);
        });
    }
</script>

{{-- hide input search custom data table --}}
<script>
    $(document).ready(function () {
        $('#table-3_dataTables_length').css('margin-top', '-100px');
        $('#table-3_filter').css('margin-top', '-100px');
        $('#table-3_filter').css('margin-bottom', '0px');
        $('#table-3_filter label').css('visibility', 'hidden');
    });
</script>

<script>
    function stepper() {
      return {
        step: 1,
        next() {
            this.step > 3 ? null : this.step = this.step + 1;
        },
        prev() {
            this.step < 2 ? null : this.step = this.step - 1;
        },
        idContainsStep() {
          return $el.id.includes(step);
        }
      }
    }
</script>
<script>
    $(document).ready(function(){
      $("#searchShip").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > 1)
        });
      });
    });
</script>

@endpush

@extends('layouts.main', ['title' => 'VTS - Create Ship Arrival - INSAF'])

@php
$date = date('d/m/Y H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">(VTS) Create Ship Arrival</h1>
</div>

<div x-data="{ openTab: 1 }">
    <div class="w-full pt-4">
        <form action="{{route('ship_arrival.insaf')}}" method="get">
            @csrf
            {{-- step 1 --}}
            <div x-show="openTab === 1" class="space-y-3">
                {{-- content 1--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nomor Jurnal <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="nomor_jurnal" class="readonly form-control" id="" value="001"
                                    autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Tanggal & Jam <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="tanggal_jam" class="readonly form-control" id="" autocomplete="off"
                                    value="{!!$date!!}" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jenis Pelayaran <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="sumber_informasi_awal" id="" class="active form-control">
                                    <option value="">1</option>
                                    <option value="">2</option>
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
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Agen Kapal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="sumber_informasi_awal" id="" class="active form-control">
                                    <option value="">1</option>
                                    <option value="">2</option>
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
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Sumber Informasi Awal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="sumber_informasi_awal" id="" class="active form-control">
                                    <option value="">1</option>
                                    <option value="">2</option>
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

                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Keterangan Tambahan Sumber Informasi Awal</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="" class="form-control active" id="" cols="30" rows="4"></textarea>
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
                        <h2 class="text-2xl font-bold text-black">Data Kapal</h2>
                    </div>
        
                    <div class="flex item-center justify-between space-x-6">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nama Kapal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" class="form-control readonly" readonly>
                                <button type="button" class="modal-open focus:outline-none input-append">
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

                        <div class="flex flex-col w-full lg:w-1/5 justify-end my-1">
                            <a href="#" class="btn-table-add mb-2" @click="open=true">
                                <span class="label">Tambah Data</span>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                        <path id="Icon_material-add" data-name="Icon material-add" d="M32.5,21.786H21.786V32.5H18.214V21.786H7.5V18.214H18.214V7.5h3.571V18.214H32.5Z" transform="translate(-7.5 -7.5)" fill="#fff"/>
                                      </svg>                      
                                </span>
                            </a>
                        </div>
                    </div>
            
                    <div class="flex item-center justify-between space-x-12">
                    
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Perusahaan Pelayaran </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="waktu_kejadian" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">IMO </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="waktu_kejadian" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Call Sign </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="waktu_kejadian" class="readonly form-control" id="" autocomplete="off" readonly>
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
                                <input type="text" name="waktu_kejadian" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">MMSI </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="waktu_kejadian" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">GT </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="waktu_kejadian" class="readonly form-control" id="" autocomplete="off" readonly>
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
                                <select name="sumber_informasi_awal" id="" class="active form-control">
                                    <option value="">1</option>
                                    <option value="">2</option>
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

                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Keterangan Tambahan Sumber Informasi Awal</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="" class="form-control active" id="" cols="30" rows="4"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div>
                    
                </div>
                {{-- content 3--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex item-center justify-between space-x-12 py-3">
                        <h2 class="text-2xl font-bold text-black">Posisi Pelaporan</h2>
                    </div>
        
                    <div class="flex flex-col space-y-4 w-1/2">
                        <div class="flex flex-col">
                            <label class="font-bold mb-3">Longitude </label>
                            <div class="flex space-x-3">
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            "
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                           '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="jenis_securite" id="" class="active form-control">
                                            <option value="N">N</option>
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
                                        <input type="text" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            "
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                           '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="jenis_securite" id="" class="active form-control">
                                            <option value="N">W</option>
                                            <option value="E">S</option>
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

                    <div class="flex item-center justify-between space-x-12">
                        
                        <div class="flex items-end justify-center space-x-3 my-1 form-group-1">
                            <div class="w-full space-y-3">
                                <label class="font-bold mb-2">Pelabuhan Asal <span class="text-red-500">*</span></label>
                                <div class="relative flex justify-center items-center relative input-group-1">
                                    <select name="sumber_informasi_awal" id="" class="active form-control">
                                        <option value="">1</option>
                                        <option value="">2</option>
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
                            <div class="">

                                <a href="#" class="p-2 w-12 h-12 mb-1 bg-yellow-400 rounded-md focus:outline-none focus:ring-4 focus:ring-yellow-200 flex items-center justify-center hover:bg-yellow-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.51" height="31.51" viewBox="0 0 31.51 31.51">
                                        <path id="Icon_material-add" data-name="Icon material-add" d="M39.01,25.506h-13.5v13.5H21v-13.5H7.5V21H21V7.5h4.5V21h13.5Z" transform="translate(-7.5 -7.5)" fill="#171717"/>
                                        </svg>                                  
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-end justify-center space-x-3 my-1 form-group-1">
                            <div class="w-full space-y-3">
                                <label class="font-bold mb-2">Pelabuhan Tujuan <span class="text-red-500">*</span></label>
                                <div class="relative flex justify-center items-center relative input-group-1">
                                    <select name="sumber_informasi_awal" id="" class="active form-control">
                                        <option value="">1</option>
                                        <option value="">2</option>
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
                            <div class="">

                                <a href="#" class="p-2 w-12 h-12 mb-1 bg-yellow-400 rounded-md focus:outline-none focus:ring-4 focus:ring-yellow-200 flex items-center justify-center hover:bg-yellow-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.51" height="31.51" viewBox="0 0 31.51 31.51">
                                        <path id="Icon_material-add" data-name="Icon material-add" d="M39.01,25.506h-13.5v13.5H21v-13.5H7.5V21H21V7.5h4.5V21h13.5Z" transform="translate(-7.5 -7.5)" fill="#171717"/>
                                        </svg>                                  
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">ETA </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="waktu_kejadian" class="active form-control" id="" autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kurs Tengah <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="nomor_jurnal" class="active form-control" id="" value="0"
                                    autocomplete="off" >
                                <span class="input-append font-bold text-xl">
                                    Rupiah
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
    
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Total Tagihan <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="nomor_jurnal" class="active form-control" id="" value="0"
                                    autocomplete="off" >
                                <span class="input-append font-bold text-xl">
                                    Rupiah
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
                        {{-- <span class="font-bold text-2xl">
                            <span><</span>
                            <span class="text-yellow-400">1</span>
                            <span>/</span>
                            <span>2</span>
                            <span>></span>
                        </span> --}}
                    </div>
                    <div>
                        <button type="submit" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>


<!--Modal-->
<div class="z-50 modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-full lg:w-4/5 mx-auto rounded shadow-lg z-50 overflow-y-auto h-4/5">

        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                viewBox="0 0 18 18">
                <path
                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content text-left px-6">
            {{-- modal header --}}
            <div class="modal-header w-full flex items-center justify-between sticky top-0 bg-white px-4 py-2">
                <div>
                    <div class="flex w-full lg:w-72 sticky top-0">
                        <div class="flex flex-col my-1 space-y-3 form-group-1">
                            <label for="" class="font-bold text-lg">Search Ship</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="waktu_kejadian" class="active form-control" id="searchShip" placeholder="Search by MMSI or Name" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black font-bold" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            {{-- modal body --}}
            <div class="modal-body w-full text-center p-4">
                <div class="">
                    <div class="my-2">
                        <table class="table table-auto">
                            <thead class="">
                                <tr class="">
                                    <th></th>
                                    <th class="text-center">IMO</th>
                                    <th class="text-center">Nama Kapal</th>
                                    <th class="text-center">Agen</th>
                                    <th class="text-center">Call Sign</th>
                                    <th class="text-center">MMSI</th>
                                    <th class="text-center">Length</th>
                                    <th class="text-center">Width</th>
                                    <th class="text-center">Tipe Sensor</th>
                                    <th class="text-center">Tipe Kapal</th>
                                </tr>
                            </thead>
                            <tbody class="overflow-y-auto" id="tbody" style="height: 50vh;">
                                @for ($i = 0; $i < 10; $i++)
                                    <tr class="">
                                        <td class="">
                                            <input name="pilih_kapal" id="kapal1" type="radio">
                                        </td>
                                        <td class="">112313</td>
                                        <td class="">MV. Estuari Mas</td>
                                        <td class="">Agen Beras</td>
                                        <td class="">ESTUARIMAS 3</td>
                                        <td class="">9999</td>
                                        <td class="">100</td>
                                        <td class="">2011</td>
                                        <td class="">CCTV</td>
                                        <td class="">GT01234</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- modal- foooter --}}
            <div class="modal-footer w-full flex justify-end items-center sticky bottom-0 bg-white px-10 py-4">
                <button type="button" class="bg-yellow-400 py-3 px-7 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-300 text-black font-medium text-lg">Pilih Kapal</button>
            </div>

        </div>
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

    // $("#searchShip").on("keyup", function() {
    //     var value = $(this).val();

    //     $("#tbody tr").filter(function(index) {
    //         if (index !== 0) {

    //             $row = $(this);

    //             var id = $row.find("td:first").text();

    //             if (id.indexOf(value) !== 0) {
    //                 $row.hide();
    //             }
    //             else {
    //                 $row.show();
    //             }
    //         }
    //     });
    // });
</script>
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

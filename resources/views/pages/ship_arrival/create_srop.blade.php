@extends('layouts.main', ['title' => 'SROP - Create Ship Arrival - INSAF'])

@php
$date = date('Y-m-d\TH:i:s');
// $date = date('Y-m-d H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">(SROP) Create Ship Arrival</h1>
</div>

<div x-data="{ openTab: 1 }">
    <div class="w-full pt-4">
        <form action="{{route('ship_arrival_store.insaf')}}" method="POST">
            @csrf
            {{-- step 1 --}}
            <div x-show="openTab === 1" class="space-y-3">
                {{-- content 1--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nomor Jurnal <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="no_jurnal" class="readonly form-control" id="" value="{{$no_jurnal}}"
                                    autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Tanggal & Jam <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="datetime-local" name="tanggal" class="readonly form-control" id="" autocomplete="off"
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
                                <select name="jenis_pelayaran" id="jenis_pelayaran" class="active form-control">
                                    <option value="" selected disabled>- Pilih Jenis Pelayaran -</option>
                                    @foreach ($jenis_pelayaran as $row)
                                        <option value="{{$row['id']}}">{{$row['value']}}</option>
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
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Agen Kapal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="agen" id="" class="active form-control">
                                    <option value="" selected disabled>- Pilih Agen Kapal -</option>
                                    @foreach ($agen_kapal as $row)
                                        <option value="{{$row['id']}}">{{$row['value']}}</option>
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
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Sumber Informasi Awal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="sumber_informasi" id="pintu_kedatangan" class="active form-control">
                                    {{-- <option value="" selected disabled>- Pilih Sumber Informasi Awal -</option> --}}
                                    @foreach ($sumber_informasi_awal as $row)
                                        <option value="{{$row['id']}}" selected>{{$row['value']}}</option>
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

                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Keterangan Tambahan Sumber Informasi Awal</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="keterangan" class="form-control active" id="" cols="30" rows="4"></textarea>
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
        
                    <div class="flex item-center justify-between space-x-0" x-data="{ open: false }">
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
                        {{-- modal ships --}}
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
                        {{-- end modal ships --}}
                        {{-- <div class="flex flex-col w-full lg:w-1/5 justify-end my-1 pl-5">
                            <a href="#" class="btn-table-add mb-2" @click="open=true">
                                <span class="label">Tambah Data</span>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                        <path id="Icon_material-add" data-name="Icon material-add" d="M32.5,21.786H21.786V32.5H18.214V21.786H7.5V18.214H18.214V7.5h3.571V18.214H32.5Z" transform="translate(-7.5 -7.5)" fill="#fff"/>
                                      </svg>                      
                                </span>
                            </a>
                        </div> --}}
                    </div>
            
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Perusahaan Pelayaran </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="perusahaan_pelayaran" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
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
                                <input type="text" name="mmsi" class="readonly form-control" id="mmsi_total_tagihan" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">GT </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="gt_kapal" class="readonly form-control" id="" autocomplete="off" readonly>
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
                                <select name="status_bernavigasi" id="" class="active form-control">
                                    <option value="" selected disabled>- Pilih Status Bernavigasi -</option>
                                    @foreach ($status_bernavigasi as $row)
                                    <option value="{{$row['id']}}">{{$row['ais_status_navigation']}}</option>
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

                    {{-- <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Keterangan Tambahan Sumber Informasi Awal</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="keteragnan_tambahan_sumber_informasi_awal" class="form-control active" id="" cols="30" rows="4"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div> --}}
                    
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

                    <div class="flex item-center justify-between space-x-12">
                        
                        <div class="flex items-end justify-center space-x-3 my-1 form-group-1">
                            <div class="w-full space-y-3">
                                <label class="font-bold mb-2">Pelabuhan Asal <span class="text-red-500">*</span></label>
                                <div class="relative flex justify-center items-center relative input-group-1">
                                    <select name="pelabuhan_asal" id="" class="active form-control">
                                        <option value="" selected disabled>- Pilih Pelabuhan Asal -</option>
                                        @foreach ($pelabuhan as $row)
                                        <option value="{{$row['id']}}">{{$row['value']}}</option>
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
                            <div class="">

                                {{-- <a href="#" class="p-2 w-12 h-12 mb-1 bg-yellow-400 rounded-md focus:outline-none focus:ring-4 focus:ring-yellow-200 flex items-center justify-center hover:bg-yellow-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.51" height="31.51" viewBox="0 0 31.51 31.51">
                                        <path id="Icon_material-add" data-name="Icon material-add" d="M39.01,25.506h-13.5v13.5H21v-13.5H7.5V21H21V7.5h4.5V21h13.5Z" transform="translate(-7.5 -7.5)" fill="#171717"/>
                                        </svg>                                  
                                </a> --}}
                            </div>
                        </div>
                        
                        <div class="flex items-end justify-center space-x-3 my-1 form-group-1">
                            <div class="w-full space-y-3">
                                <label class="font-bold mb-2">Pelabuhan Tujuan <span class="text-red-500">*</span></label>
                                <div class="relative flex justify-center items-center relative input-group-1">
                                    <select name="pelabuhan_tujuan" id="" class="active form-control">
                                        <option value="" selected disabled>- Pilih Pelabuhan Asal -</option>
                                        @foreach ($pelabuhan as $row)
                                        <option value="{{$row['id']}}">{{$row['value']}}</option>
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
                            <div class="">

                                {{-- <a href="#" class="p-2 w-12 h-12 mb-1 bg-yellow-400 rounded-md focus:outline-none focus:ring-4 focus:ring-yellow-200 flex items-center justify-center hover:bg-yellow-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.51" height="31.51" viewBox="0 0 31.51 31.51">
                                        <path id="Icon_material-add" data-name="Icon material-add" d="M39.01,25.506h-13.5v13.5H21v-13.5H7.5V21H21V7.5h4.5V21h13.5Z" transform="translate(-7.5 -7.5)" fill="#171717"/>
                                        </svg>                                  
                                </a> --}}
                            </div>
                        </div>

                        <div class="flex items-end justify-center space-x-3 my-1 form-group-1">
                            <div class="hidden">
                                <div class="w-full space-y-3">
                                    <label class="font-bold mb-2">Pier / Dermaga <span class="text-red-500">*</span></label>
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="dermaga" id="" class="active form-control">
                                            <option value="" selected disabled>- Pilih Pelabuhan Asal -</option>
                                            @foreach ($dermaga as $row)
                                            <option value="{{$row['id']}}">{{$row['value']}}</option>
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
                                <div class="">
    
                                    {{-- <a href="#" class="p-2 w-12 h-12 mb-1 bg-yellow-400 rounded-md focus:outline-none focus:ring-4 focus:ring-yellow-200 flex items-center justify-center hover:bg-yellow-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="31.51" height="31.51" viewBox="0 0 31.51 31.51">
                                            <path id="Icon_material-add" data-name="Icon material-add" d="M39.01,25.506h-13.5v13.5H21v-13.5H7.5V21H21V7.5h4.5V21h13.5Z" transform="translate(-7.5 -7.5)" fill="#171717"/>
                                            </svg>                                  
                                    </a> --}}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">ETA </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="datetime-local" name="eta" value="{{$date}}" class="active form-control" id="" autocomplete="off" >
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
                    <div>
                        <button type="button" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg" @click="openTab = 2">Lanjutkan</button>
                    </div>
                </div>
            </div>
            {{-- step 2 --}}
            <div x-show="openTab === 2" class="space-y-3">
                {{-- content 1--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Preamble </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="preamble" class="readonly form-control" id="hasil_preamble" autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Isi Berita</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="isi_berita" class="form-control active" id="isi_berita_kapal" cols="30" rows="4"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div>

                    <div class="mt-6">
                        <h3 class="mt-4 font-bold text-lg">Berita Tambahan</h3>
                        
                        
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_1" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Jenis Muatan</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_1" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_2" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Lokasi Sandar</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_2" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_3" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Lokasi STS</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_3" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_4" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Karantina</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_4" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_5" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Pemeriksaan Bea Cukai</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_5" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_6" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Pemeriksaan Imigrasi</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_6" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_7" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Bunker Bahan Bakar</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_7" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_8" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Bunker Air Tawar</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_8" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_9" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Ship Chandler</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_9" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_10" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Suku Cadang</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_10" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_11" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Layanan Perbaikan Kapal</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_11" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_12" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Ambulance</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_12" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_13" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Layanan Medis</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_13" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_14" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Layanan Fumigasi</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_14" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_15" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Layanan Crewing</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_15" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_16" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Permintaan Layanan Sertifikasi dan Buku Pelaut</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_16" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center w-full" x-data="{accept: false}">
                            <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                    <input type="checkbox" value="1" name="berita_tambahan_17" class="opacity-0 cursor-pointer absolute" x-model="accept">
                                    <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                </div>
                                <span class="text-lg font-medium">Informasi / Permintaan Lain</span>
                            </div>
                            <div class="flex flex-col w-full lg:w-1/2 my-1 form-group-1">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="isi_berita_tambahan_17" :class="{ 'readonly' : !accept, 'active' : accept}" class="form-control" id=""
                                        autocomplete="off"  x-bind:disabled="!accept">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">CK <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="ck" class="readonly  form-control" id="hasil_ck" value="/"
                                    autocomplete="off" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kurs Tengah <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="kurs_tengah" class="active form-control" id="kurs_tengah" value="0"
                                    autocomplete="off" readonly>
                                <span class="input-append font-bold text-xl">
                                    Rupiah
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Tagihan LSC <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="tagihan_lsc" class="active form-control" id="tagihan_lsc" value="0"
                                    autocomplete="off" readonly>
                                <span class="input-append font-bold text-xl">
                                    Rupiah
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Tagihan LLC <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="tagihan_llc" class="active form-control" id="tagihan_llc" value="0"
                                    autocomplete="off" readonly>
                                <span class="input-append font-bold text-xl">
                                    Rupiah
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Total Tagihan <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="total_tagihan" class="active form-control" readonly id="hasil_total_tagihan" value="0"
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

                    <div class="mt-2 mb-4 flex justify-end">
                        <button type="button" onclick="cekTotalTagihan()" class="flex items-center justify-center py-3 px-2 space-x-2 bg-gray-800 py-3 px-10 hover:bg-gray-900 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-gray-400 text-white font-bold text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                            Cek Total Tagihan
                        </button>
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
    function getKapal() {
        var mmsi_kapal = $('input[name=mmsi_kapal][type=radio]:checked').val();

        // $.getJSON('http://127.0.0.1:8000/admin/noon_position/get_kapal/' + mmsi_kapal, function (data) {
        var url = '/ships/get_ship/'+mmsi_kapal;
        $.getJSON(url, function (data) {
            var ship = data['data'][0];
            $("input[name=ship_name][type=text]").val(ship['ship_name']);
            $("input[name=flag][type=text]").val(ship['flag']);
            $("input[name=call_sign][type=text]").val(ship['call_sign']);
            $("input[name=imo][type=text]").val(ship['imo']);
            $("input[name=mmsi][type=text]").val(ship['mmsi']);
            $("input[name=perusahaan_pelayaran][type=text]").val(ship['perusahaan_pelayaran_id']);
            $("input[name=gt_kapal][type=text]").val(ship['gt']);
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

{{-- cek kurs tengah dan total tagihan --}}
<script>
    /* Fungsi formatRupiah */
    // function formatRupiah(angka, prefix){
    //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
    //     split   		= number_string.split(','),
    //     sisa     		= split[0].length % 3,
    //     rupiah     		= split[0].substr(0, sisa),
    //     ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
    //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
    //     if(ribuan){
    //         separator = sisa ? '.' : '';
    //         rupiah += separator + ribuan.join('.');
    //     }
    
    //     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    //     return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    // }
    function formatRupiah(angka){
        var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }
    function cekTotalTagihan() {
        
        var _token = $('meta[name="csrf-token"]').attr('content');
        var isi_berita = $('#isi_berita_kapal').val();
        var mmsi = $('input[type=text]#mmsi_total_tagihan').val();
        var jenis_pelayaran = $('#jenis_pelayaran').val(); // 1 Dalam Neger 2 LUar Negeri
        var pintu_kedatangan = $('#pintu_kedatangan').val(); // 1 VTS 2 SROP 
        var url = '{{route("ship_arrival_cek_tagihan.insaf")}}'

        if(isi_berita == '' || mmsi == null || jenis_pelayaran == null || pintu_kedatangan == null)
        {
            alert('Isi berita masih kosong !, Belum ada kapal yang dipilih !, Jenis pelayaran belum dipilih !')
        }
        else
        {
        
            $.ajax({
                url: url,
                type: "POST",
                dataType:'json',
                data: {
                    _token: _token,
                    mmsi: mmsi,
                    pintu_kedatangan: pintu_kedatangan,
                    jenis_pelayaran: jenis_pelayaran,
                    isi_berita: isi_berita,
                },
                success: function (data) {
                    // console.log(data)
                var tagihan = data;
                $("input[name=tagihan_llc][type=text]#tagihan_llc").val(tagihan['tagihan_llc']);
                $("input[name=tagihan_lsc][type=text]#tagihan_lsc").val(tagihan['tagihanLsc']);
                $("input[name=ck][type=text]#hasil_ck").val(tagihan['ck']);
                $("input[type=text]#kurs_tengah").val(tagihan['kurs_tengah']);
                $("input[name=preamble][type=text]#hasil_preamble").val(tagihan['preamble']);
                $("input[type=text]#hasil_total_tagihan").val(tagihan['total_tagihan']);
                    console.log(data);
                },
                error: function (param) {
                    console.log(param);
                }
            });
        }
    }
</script>
@endpush

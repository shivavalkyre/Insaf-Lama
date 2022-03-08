@extends('layouts.main', ['title' => 'Create Securite - INSAF'])

@php
$date = date('Y-m-d H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Create Securite</h1>
</div>
<div x-data="{ openTab: 1 }">
    <div class="w-full pt-4">
        <form action="{{route('securite_store.insaf')}}" method="get">
            @csrf
            {{-- step 1 --}}
            <div x-show="openTab === 1" class="space-y-3">
                <div class="p-9 rounded-lg bg-white w-full h-auto space-y-3">
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
                                <input type="text" name="tanggal" class="readonly form-control" id="" autocomplete="off"
                                    value="{!!$date!!}" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12">
                
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jenis Securite <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="jenis_securite" id="" class="active form-control">
                                    <option value="" selected disabled>- Pilih Jenis Securite -</option>
                                    @foreach ($jenis_securite as $item)
                                    <option value="{{$item['id']}}">{{$item['jenis_securite']}}</option>
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
                            <label class="font-bold mb-2">Waktu Kejadian <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="datetime-local" name="waktu_kejadian" class="active form-control" id="" autocomplete="off">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                
                    </div>

                    <div class="flex items-center">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Sumber Informasi Awal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="sumber_informasi_awal" id="" class="active form-control">
                                    <option value="" selected disabled>- Pilih Sumber Informasi Awal -</option>
                                    @foreach ($sumber_informasi_awal as $item)
                                    <option value="{{$item['id']}}">{{$item['sumber_informasi']}}</option>
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

                    <div class="flex items-center">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Keterangan Lainnya <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <textarea name="keterangan_lainnya" class="active form-control" id="" cols="30" rows="4"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-lg bg-white w-full h-auto" x-data="handler()">
                    <h2 class="text-2xl mb-4 font-bold">Pelapor</h2>
                    <div class="overflow-x-auto overflow-y-auto">
                        <div class="w-100 py-3 flex items-center">
                            <button type="button" id="addelementfileupload" @click="addNewField()" class="focus:outline-none btn-table-add">
                                <span class="label">Tambah Pelapor</span>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                        <path id="Icon_material-add" data-name="Icon material-add"
                                            d="M32.5,21.786H21.786V32.5H18.214V21.786H7.5V18.214H18.214V7.5h3.571V18.214H32.5Z"
                                            transform="translate(-7.5 -7.5)" fill="#fff" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div class="my-2">
                            <table class="table table-auto my-3">
                                <thead class="">
                                    <tr>
                                        <th>No</th>
                                        <th class="text-left">Nama Pelapor</th>
                                        <th class="text-left">Kontak Pelapor</th>
                                        <th class="text-left">Instansi</th>
                                        <th class="text-left">Tanggal Lapor</th>
                                        <th class="text-left">Info Tambahan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="overflow-auto">
                                    <template x-for="(field, index) in fields" :key="index">
                                        <tr>
                                            <td class=" text-center font-bold" x-text="index + 1"></td>
                                            <td class="">
                                                <input x-model="field.nama_pelapor" type="text" name="nama_pelapor[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100" placeholder="Nama Pelapor">
                                            </td>
                                            <td class="">
                                                <input x-model="field.kontak_pelapor" type="text" name="kontak_pelapor[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100" placeholder="Kontak Pelapor">
                                            </td>
                                            <td class="">
                                                <input x-model="field.instansi_pelapor" type="text" name="instansi_pelapor[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100" placeholder="Instansi">
                                            </td>
                                            <td class="">
                                                <input x-model="field.tanggal_lapor" type="datetime-local" name="tanggal_lapor[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100">
                                            </td>
                                            <td class="">
                                                <textarea x-model="field.info_tambahan_pelapor" rows="2" type="text" name="info_tambahan_pelapor[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100"></textarea>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="bg-red-500 my-1 p-2 rounded focus:outline-none focus:ring-2 ring-red-400 w-10 h-10"
                                                    @click="removeField(index)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="80%"
                                                        height="27.266" viewBox="0 0 24.839 27.266">
                                                        <g id="Icon_feather-trash-2" data-name="Icon feather-trash-2"
                                                            transform="translate(1.5 1.5)">
                                                            <path id="Path_46" data-name="Path 46" d="M4.5,9H26.339"
                                                                transform="translate(-4.5 -4.147)" fill="none" stroke="#fff"
                                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="3" />
                                                            <path id="Path_47" data-name="Path 47"
                                                                d="M24.486,7.853V24.839a2.427,2.427,0,0,1-2.427,2.427H9.927A2.427,2.427,0,0,1,7.5,24.839V7.853m3.64,0V5.427A2.427,2.427,0,0,1,13.567,3H18.42a2.427,2.427,0,0,1,2.427,2.427V7.853"
                                                                transform="translate(-5.073 -3)" fill="none" stroke="#fff"
                                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="3" />
                                                            <path id="Path_48" data-name="Path 48" d="M15,16.5v7.28"
                                                                transform="translate(-6.507 -5.58)" fill="none" stroke="#fff"
                                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="3" />
                                                            <path id="Path_49" data-name="Path 49" d="M21,16.5v7.28"
                                                                transform="translate(-7.654 -5.58)" fill="none" stroke="#fff"
                                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="3" />
                                                        </g>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <h2 class="text-2xl mb-4 font-bold">Data Kapal</h2>
                
                    <div class="flex item-center justify-between" x-data="{ open: false }">
                
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nama Kapal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" class="form-control readonly" name="ship_name" readonly>
                                <button type="button" @click="open = true" class="modal-open focus:outline-none input-append">
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
                                <input type="text" name="imo" class="active form-control" id="" autocomplete="off">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Call Sign </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="call_sign" class="active form-control" id="" autocomplete="off">
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
                                <input type="text" name="flag" class="active form-control" id="" autocomplete="off">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">MMSI </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="mmsi" class="active form-control" id="" autocomplete="off">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    
                    </div>
                
                    <div class="flex item-center justify-between space-x-12">
                
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Status Bernavigasi</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="status_navigation" id="" class="active form-control">
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

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Pelabuhan Asal</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="pelabuhan_asal" id="" class="active form-control">
                                    <option value="" selected disabled>- Pilih Pelabuhan Asal -</option>
                                    @foreach ($nama_pelabuhan as $item)
                                    <option value="{{$item['id']}}">{{$item['nama_pelabuhan']}}</option>
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
                            <label class="font-bold mb-2">Pelabuhan Tujuan</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="pelabuhan_tujuan" id="" class="active form-control">
                                    <option value="" selected disabled>- Pilih Pelabuhan Tujuan -</option>
                                    @foreach ($nama_pelabuhan as $item)
                                    <option value="{{$item['id']}}">{{$item['nama_pelabuhan']}}</option>
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
                            <label class="font-bold mb-2">Info Tambahan </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="info_tambahan" class="active form-control" id="" autocomplete="off">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    
                
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
                                           ''
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction1" id="" class="active form-control">
                                            <option value="E">E</option>
                                            <option value="W">W</option>
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
                                           "
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction2"  id="" class="active form-control">
                                            <option value="S">S</option>
                                            <option value="N">N</option>
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
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">

                    <div class="flex item-center justify-between space-x-12 py-3">
                        <h2 class="text-2xl font-bold text-black">Informasi Securite</h2>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nama Lokasi Terlapor</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="nama_lokasi_terlapor" class="active form-control" id="" value=""
                                    autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-4 w-1/2">
                        <div class="flex flex-col">
                            <label class="font-bold mb-3">Longitude </label>
                            <div class="flex space-x-3">
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="degree3" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="minute3" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="second3" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            ''
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction3" id="" class="active form-control">
                                            <option value="E">E</option>
                                            <option value="W">W</option>
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
                                        <input type="text" name="degree4" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="minute4" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="second4" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                        "
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction4" id="" class="active form-control">
                                            <option value="S">S</option>
                                            <option value="N">N</option>
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
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Deskripsi Laporan SECURITE dan Asesmen Situasi</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="deskripsi_laporan_securite" class="form-control active" id="" cols="30" rows="4"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div x-data="{ open: false }">
                            <div class="flex flex-col my-1 form-group-1">
                                <label class="font-bold mb-2">Memerlukan tindakan ?</label>
                                <div class="flex items-center space-x-3">
                                    <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                        <input type="radio" @click="open = true" name="memerlukan_tindakan" class="form-radio h-5 w-5" value="true" id="radio_yes" autocomplete="off">
                                        <label for="radio_yes">Yes</label>
                                    </div>
                                    <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                        <input type="radio" @click="open = false" name="memerlukan_tindakan" class="form-radio h-5 w-5" value="false" id="radio_no" autocomplete="off">
                                        <label for="radio_no">No</label>
                                    </div>
                                </div>
                                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                    Info here !
                                </span>
                            </div>
                            {{-- <div class="flex flex-col my-1 form-group-1 mt-2" x-show="open">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" name="waktu_kejadian" value="{{$date}}" class="readonly form-control" id="" autocomplete="off" readonly>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Tindakan Yang Diperlukan/Keterangan</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="deskripsi_tindakan" class="form-control active" id="" cols="30" rows="4"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Master OnBoard <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="mob" class="active form-control" id="" value=""
                                    autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">No Handphone <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="nohp1" class="active form-control" id="" autocomplete="off"
                                    value="" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">2nd Officer <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="sec_officer" class="active form-control" id="" value=""
                                    autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">No Handphone <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="nohp2" class="active form-control" id="" autocomplete="off"
                                    value="" >
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
{{-- add row pelapor --}}
<script>
    function handler() {
        return {
            fields: [],
            addNewField() {
                this.fields.push({
                    nama_pelapor: '',
                    kontak_pelapor: '',
                    instansi_pelapor: '',
                    tanggal_lapor: '',
                    info_tambahan_pelapor: '',
                });
            },
            removeField(index) {
                this.fields.splice(index, 1);
            }
        }
    }
</script>

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
@endpush

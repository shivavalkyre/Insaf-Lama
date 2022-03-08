@extends('layouts.main', ['title' => 'Create Distress - INSAF'])

@php
$date = date('d/m/Y H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Create Distress</h1>
</div>

<div x-data="{ openTab: 1 }">
    <div class="w-full pt-4">
        <form action="{{route('distress.insaf')}}" method="post">
            @csrf
            {{-- step 1 --}}
            <div x-show="openTab === 1" class="space-y-3">
                {{-- content 1--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nomor Jurnal <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="no_jurnal" class="readonly form-control" id="" value="{{ ($distress == []) ? $no_jurnal : $distress['no_jurnal'] }}"
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
                                    value="{{ ($distress == []) ? $date : $distress['tanggal'] }}" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jenis Distress <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="jenis_distress" id="" class="active form-control">
                                    <option value="" selected disabled>- Pilih Jenis Distress -</option>
                                    @foreach ($jenis_distress as $item)
                                    <option value="{{$item['id']}}" <?php echo ($distress == []) ? '' : ($distress['jenis_distress'] == $item['id'] ? 'selected' : '') ?>>{{$item['jenis_distress']}}</option>
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
                            <label class="font-bold mb-2">Sumber Informasi Awal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="sumber_informasi" id="" class="active form-control">
                                    @if($distress == [])
										<option value="" selected disabled>- Pilih Sumber Informasi Awal -</option>
									@endif
                                    @foreach ($sumber_informasi_awal as $item)
										<option value="{{$item['id']}}" <?php echo ($distress == []) ? '' : ($distress['sumber_informasi'] == $item['id'] ? 'selected' : '') ?>>{{$item['sumber_informasi_awal']}}</option>
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
                            <label class="font-bold mb-2">Judul Distress <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="judul_distress" class="form-control active" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                </div>
                {{-- content 2--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto" x-data="handler()">
                    <h2 class="text-2xl mb-4 font-bold">Pelapor</h2>
                    <div class="overflow-x-auto overflow-y-auto">
                        <div class="w-100 py-3 px-2 flex items-center">
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
                                                <input x-model="field.txt1" type="text" name="txt1[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100" placeholder="Nama Pelapor">
                                            </td>
                                            <td class="">
                                                <input x-model="field.txt2" type="text" name="txt2[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100" placeholder="Kontak Pelapor">
                                            </td>
                                            <td class="">
                                                <input x-model="field.txt3" type="text" name="txt3[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100" placeholder="Instansi">
                                            </td>
                                            <td class="">
                                                <input x-model="field.txt4" type="date" name="txt4[]"
                                                    class="border-2 focus:outline-none focus:border-yellow-300 my-1 border-gray-200 rounded-lg w-full p-2 bg-gray-100">
                                            </td>
                                            <td class="">
                                                <textarea x-model="field.txt5" rows="2" type="text" name="txt5[]"
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
                {{-- content 3--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto" x-data="handler()">
                    <h2 class="text-2xl mb-2 font-bold">Kapal dalam kondisi distress</h2>
                    <br>
                    <div class="overflow-x-auto overflow-y-auto">
                        <div class="w-100 py-3 px-2 flex items-center" x-data="{ open: false }">
                            <button type="button" @click="open = true" type="button" id="addelementfileupload" @click="addNewField()" class="focus:outline-none btn-table-add">
                                <span class="label">Tambah Kapal</span>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                        <path id="Icon_material-add" data-name="Icon material-add"
                                            d="M32.5,21.786H21.786V32.5H18.214V21.786H7.5V18.214H18.214V7.5h3.571V18.214H32.5Z"
                                            transform="translate(-7.5 -7.5)" fill="#fff" />
                                    </svg>
                                </span>
                            </button>
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
                                                            <input type="text" name="" autofocus class="active form-control" id="saerchOutside" placeholder="Cari Kapal" autocomplete="off">
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
                                                                <th>GT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($kapal as $row)
                                                            <tr id="rowship{{$row['mmsi']}}">
                                                                <td> 
                                                                    <div class="flex items-center w-full lg:w-1/2 space-x-3">
                                                                        <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                                            <input type="checkbox" name="mmsi_kapal" class="memerlukan_bantuan opacity-0 cursor-pointer absolute"
                                                                            value="{{$row['mmsi']}}"
                                                                            data-shipname="{{$row['ship_name']}}"
                                                                            data-mmsi="{{$row['mmsi']}}"  
                                                                            data-imo="{{$row['imo']}}"
                                                                            data-flag="{{$row['flag']}}"
                                                                            data-callsign="{{$row['call_sign']}}" 
                                                                            data-length="{{$row['length']}}" 
                                                                            data-width="{{$row['width']}}" 
                                                                            data-shiptype="{{$row['ship_type']}}" 
                                                                            data-gt="{{$row['gt']}}"
                                                                            >
                                                                            <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                                                        </div>
                                                                        <span class="text-lg font-medium"></span>
                                                                    </div>
                                                                </td>
                                                                <td>{{$row['ship_name'] ?? '-'}}</td>
                                                                <td>{{$row['mmsi'] ?? '-'}}</td>
                                                                <td>{{$row['imo'] ?? '-'}}</td>
                                                                <td>{{$row['flag'] ?? '-'}}</td>
                                                                <td>{{$row['call_sign'] ?? '-'}}</td>
                                                                <td>{{$row['length'] ?? '-'}}</td>
                                                                <td>{{$row['width'] ?? '-'}}</td>
                                                                <td>{{$row['ship_type'] ?? '-'}}</td>
                                                                <td>{{$row['gt'] ?? '-'}}</td>
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
                        <div class="my-2">
                            <table class="table table-auto my-3">
                                <thead class="">
                                    <tr>
                                        <th class="text-left">Nama Kapal</th>
                                        <th class="text-left">Tipe Kapal</th>
                                        <th class="text-left">GT</th>
                                        <th class="text-left">Call Sign</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="appendRowShip" class="">
                                    {{-- <div id="appendRowShip"></div> --}}
                                </tbody>
                            </table>
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
                            <span>3</span>
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
                    <h2 class="text-2xl mb-4 font-bold">Informasi Distress</h2>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nama Lokasi Kejadian <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="lokasi_kejadian_child" class="active form-control" id="nama_lokasi_kejadian" value=""
                                    autocomplete="off">
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
                                        <input type="text" name="degree1_child" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="minute1_child" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="second1_child" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                           "
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction1_child" id="" class="active form-control">
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
                                        <input type="text" name="degree2_child" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="minute2_child" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="second2_child" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                           ''
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction2_child" id="" class="active form-control">
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
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Waktu Kejadian <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="datetime-local" name="waktu_kejadian_child" class="active form-control" id="waktu_kejadian" value=""
                                    autocomplete="off">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Waktu Selesai</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="datetime-local" name="waktu_selesai_child" class="active form-control" id="waktu_selesai" value=""
                                    autocomplete="off">
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Deskripsi Kejadian dan Asesmen Situasi</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="deskripsi_assesment_child" class="form-control active" id="deskripsi_situasi_distress" cols="30" rows="10"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Upload Foto Kejadian Distress</label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="file" name="foto_kejadian_distress_child" id="upload-image" class="fileupload form-control active">
                                <span class="absolute inset-y-0 right-0 flex items-center justify-center rounded-tr-lg rounded-br-lg px-5 bg-yellow-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>                        
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col my-1 form-group-1"></div>
                    </div>

                    <div class="flex item-center justify-between relative">
                        <div class="flex flex-col my-1  form-group-1 pr-7">
                            <div class="relative flex items-center justify-center p-7 overflow-hidden w-full h-96 rounded-lg bg-gray-100 border-4 border-yellow-300">
                                <div class="absolute inset-0" id="imgPrev"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>                 
                            </div>
                        </div>
                        <div class="flex flex-col my-1  form-group-1">
                        </div>
                    </div>

                </div>
                {{-- button --}}
                <div class="mt-3 bg-white py-5 px-3 rounded-lg flex items-center justify-between">
                    <div class="ml-0 lg:ml-3">
                        <span class="font-bold text-2xl">
                            <span><</span>
                            <span class="text-yellow-400">2</span>
                            <span>/</span>
                            <span>3</span>
                            <span>></span>
                        </span>
                    </div>
                    <div class="space-x-3">
                        <button type="button" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg" @click="openTab = 1">Sebelumnya</button>
                        <button type="button" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg" @click="openTab = 3">Lanjutkan</button>
                    </div>
                </div>
            </div>

            {{-- step 3 --}}
            <div x-show="openTab === 3" class="space-y-3">
                {{-- content 1--}}
                <div id="appendRowShipDetail"></div>

                {{-- CONTOH ELEMENT DINAMIS DETAIL DATA KAPAL DISTRESS: dihidden agar tidak muncul --}}
                <div class="hidden p-6 rounded-lg bg-white w-full my-3 h-auto space-y-3" x-data="{ open: false }">
                    {{-- dinamis dari jumlah kapal distres yg dipilih kapal --}}
                    <div class="header-card flex justify-between items-center">
                        <h2 class="text-2xl mb-4 underline font-bold">MV. Estuari Mas</h2>
                        <button @click="open = ! open" type="button" class="focus:outline-none bg-yellow-300 p-3 rounded-md hover:bg-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                              </svg>
                        </button>
                    </div>
                    <div x-show="open" class="mt-3">
                        <div class="flex item-center space-x-12">
                            <div class="flex flex-col my-1 form-group-1">
                                <label class="font-bold mb-2">Jumlah Awak Kapal</label>
                                <div class="relative flex justify-center items-center relative input-group-1">
                                    <input type="text" name="" id="" autocomplete="off" class="active form-control">
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
                                    <input type="text" name="" id="" autocomplete="off" class="active form-control">
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
                                    <input type="text" name="" id="" autocomplete="off" class="active form-control">
                                </div>
                                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                    Info here !
                                </span>
                            </div>
                        </div>
    
                        <div class="flex flex-col" x-data="{ open: false }">
                            <div class="flex flex-col my-1 form-group-1">
                                <label class="font-bold mb-2">Memerlukan Bantuan  ?</label>
                                <div class="flex items-center space-x-3">
                                    <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                        <input type="radio" @click="open = true" name="" class="form-radio h-5 w-5" value="1" id="radio_yes" autocomplete="off">
                                        <label for="radio_yes">Yes</label>
                                    </div>
                                    <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                        <input onclick="$('.memerlukan_bantuan').val('')" type="radio" @click="open = false" name="memerlukan_bantuan_child" class="form-radio h-5 w-5" value="0" id="radio_no" autocomplete="off" checked>
                                        <label for="radio_no">No</label>
                                    </div>
                                </div>
                                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                    Info here !
                                </span>
                            </div>
                            <div class="flex flex-col item-center w-full mt-4" x-show="open">
                                <label class="font-bold mb-2">Jenis Bantuan</label>
                                <div class="flex flex-col lg:flex-row">
                                    <div class="space-y-2 flex flex-col my-2 form-group-1">
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Tugboat Assistance</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Medical Assistance</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Ambulance</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">TMAS</span>
                                        </div>
                                    </div>
                                    <div class="space-y-2 flex flex-col my-2 form-group-1">
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="jenis_bantuan_child_child" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Fire FIghting</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Oil Spill Combatting</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">HNS Spill Combatting</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Securite Assitance</span>
                                        </div>
                                    </div>
                                    <div class="space-y-2 flex flex-col my-2 form-group-1">
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Cargo Evacuation</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">DG Cargo Handling</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Search and Rescue</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Salvage</span>
                                        </div>
                                    </div>
                                    <div class="space-y-2 flex flex-col my-2 form-group-1">
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Require Emergency Area</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Require Place Of Refugee</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Require Quarantine</span>
                                        </div>
                                        <div class="flex space-x-2 items-center">
                                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">
                                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                                            </div>
                                            <span class="text-lg font-medium">Aid To Navigation Marking</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex item-center w-full mt-4">
                                    <div class="flex flex-col my-1 form-group-1">
                                        <label class="font-bold mb-2">Keterangan / Bantuan Lainnya</label>
                                        <div class="flex justify-center items-center relative input-group-1">
                                            <textarea name="keterangan_bantuan_lainnya" class="form-control w-full active" id="" cols="30" rows="4"></textarea>
                                        </div>
                                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                            Info here !
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="flex flex-col" x-data="{ open: false }">
                            <div class="flex flex-col my-1 form-group-1">
                                <label class="font-bold mb-2">Sudah ada upaya pertolongan / penanggulangan yang sedang berlangsung ?</label>
                                <div class="flex items-center space-x-3">
                                    <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                        <input type="radio" @click="open = true" name="sudah_ada_pertolongan" class="form-radio h-5 w-5" value="1" id="radio_yes" autocomplete="off">
                                        <label for="radio_yes">Yes</label>
                                    </div>
                                    <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                        <input onclick="$('#upaya_pertolongan').val('')" type="radio" @click="open = false" name="sudah_ada_pertolongan" class="form-radio h-5 w-5" value="0" id="radio_no" autocomplete="off" checked>
                                        <label for="radio_no">No</label>
                                    </div>
                                </div>
                                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                    Info here !
                                </span>
                            </div>
                            <div class="flex item-center w-full mt-4" x-show="open">
                                <div class="flex flex-col my-1 form-group-1">
                                    <label class="font-bold mb-2">Pertolongan / Penanggulangan yang dilakukan</label>
                                    <div class="flex justify-center items-center relative input-group-1">
                                        <textarea name="deskripsi_pertolongan" class="form-control w-full active" id="upaya_pertolongan" cols="30" rows="4"></textarea>
                                    </div>
                                    <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                        Info here !
                                    </span>
                                </div>
                            </div>
                        </div>
    
                        <div class="addon">
                            <label class="font-bold mb-2">Korban Manusia</label>
    
                            <div class="flex items-center space-x-5 w-full" x-data="{accept: false}">
                                <div class="flex items-center w-1/3 relative input-group-1 space-x-2 ">
                                    <span class="text-lg font-bold"> M.O.B</span>
                                </div>
                                <div class="flex space-x-5 relative w-1/3 input-group-1">
                                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">
                                        <input onclick="$('#mob').val('')" @click="accept = false" type="radio" name="mob" class="form-radio h-5 w-5" value="0" id="0" checked>
                                        <label for="0" class="font-medium">Unknown</label>
                                    </div>
                                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">
                                        <input @click="accept = true" type="radio" name="mob" class="form-radio h-5 w-5" value="1" id="1">
                                        <label for="1" class="font-medium">Yes</label>
                                    </div>
                                    <div class="flex items-center relative input-group-1 space-x-2">
                                        <input onclick="$('#mob').val('')" @click="accept = false" type="radio" name="mob" class="form-radio h-5 w-5" value="2" id="2">
                                        <label for="2" class="font-medium">No</label>
                                    </div>
                                </div>
                                <div class="flex my-1 w-1/3 form-group-1">
                                    <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80">
                                        <input value='' type="number" min="0" name="" :class="{ 'readonly' : !accept , 'active' : accept}" class="form-control" id="mob"
                                            autocomplete="off"  x-bind:readonly="!accept">
                                        <span class="input-append font-bold">
                                            Orang
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-5 w-full" x-data="{accept: false}">
                                <div class="flex items-center w-1/3 relative input-group-1 space-x-2 ">
                                    <span class="text-lg font-bold"> Korban Luka</span>
                                </div>
                                <div class="flex space-x-5 relative w-1/3 input-group-1">
                                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">
                                        <input onclick="$('#korban_luka').val('')" @click="accept = false" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="0" id="0" checked>
                                        <label for="0" class="font-medium">Unknown</label>
                                    </div>
                                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">
                                        <input @click="accept = true" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="1" id="1">
                                        <label for="1" class="font-medium">Yes</label>
                                    </div>
                                    <div class="flex items-center relative input-group-1 space-x-2">
                                        <input onclick="$('#korban_luka').val('')" @click="accept = false" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="2" id="2">
                                        <label for="2" class="font-medium">No</label>
                                    </div>
                                </div>
                                <div class="flex my-1 w-1/3 form-group-1">
                                    <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80">
                                        <input type="number" min="0" name="" :class="{ 'readonly' : !accept , 'active' : accept}" class="form-control" id="korban_luka"
                                            autocomplete="off"  x-bind:readonly="!accept">
                                        <span class="input-append font-bold">
                                            Orang
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-5 w-full" x-data="{accept: false}">
                                <div class="flex items-center w-1/3 relative input-group-1 space-x-2 ">
                                    <span class="text-lg font-bold">Korban Jiwa</span>
                                </div>
                                <div class="flex space-x-5 relative w-1/3 input-group-1">
                                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">
                                        <input onclick="$('#korban_jiwa').val('')" @click="accept = false" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="0" id="0" checked>
                                        <label for="0" class="font-medium">Unknown</label>
                                    </div>
                                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">
                                        <input @click="accept = true" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="1" id="1">
                                        <label for="1" class="font-medium">Yes</label>
                                    </div>
                                    <div class="flex items-center relative input-group-1 space-x-2">
                                        <input onclick="$('#korban_jiwa').val('')" @click="accept = false" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="2" id="2">
                                        <label for="2" class="font-medium">No</label>
                                    </div>
                                </div>
                                <div class="flex my-1 w-1/3 form-group-1">
                                    <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80">
                                        <input type="number" min="0" name="" :class="{ 'readonly' : !accept , 'active' : accept}" class="form-control" id="korban_jiwa"
                                            autocomplete="off"  x-bind:readonly="!accept">
                                        <span class="input-append font-bold">
                                            Orang
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="flex item-center w-full mt-4">
                            <div class="flex flex-col my-1 form-group-1">
                                <label class="font-bold mb-2">Kerusakan Kapal</label>
                                <div class="flex justify-center items-center relative input-group-1">
                                    <textarea name="kerusakan_kapal" class="form-control w-full active" id="" cols="30" rows="4"></textarea>
                                </div>
                                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                    Info here !
                                </span>
                            </div>
                        </div>
    
                        <div class="flex item-center w-full mt-4">
                            <div class="flex flex-col my-1 form-group-1">
                                <label class="font-bold mb-2">Tindakan</label>
                                <div class="flex justify-center items-center relative input-group-1">
                                    <textarea name="tindakan" class="form-control w-full active" id="" cols="30" rows="4"></textarea>
                                </div>
                                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                    Info here !
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- button --}}
                <div class="mt-3 space-x-3 bg-white py-5 px-3 rounded-lg flex items-center justify-between">
                    <div class="ml-0 lg:ml-3">
                        <span class="font-bold text-2xl">
                            <span><</span>
                            <span class="text-yellow-400">3</span>
                            <span>/</span>
                            <span>3</span>
                            <span>></span>
                        </span>
                    </div>
                    <div class="space-x-3">
                        <button type="button" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg" @click="openTab = 2">Sebelumnya</button>
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
                    txt1: '',
                    txt2: '',
                    txt3: '',
                });
            },
            removeField(index) {
                this.fields.splice(index, 1);
            }
        }
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

{{-- get kapal --}}
<script>
    function getKapal() {
        // alert('ok')
        var total_get_mmsi_kapal = $('input[name=mmsi_kapal][type=checkbox]:checked');
        
        $(total_get_mmsi_kapal).each(function () { 
            // console.log(this.value)
            // ship_type = this.data
             $('#appendRowShip').append('<tr id="row_mmsi'+this.value+'">'
                 +'<td><input type="hidden" name="ship_mmsi[]" value="'+this.value+'">'+$(this).data('shipname')+'</td>'
                 +'<td>'+$(this).data('shiptype')+'</td>'
                 +'<td>'+$(this).data('gt')+'</td>'
                 +'<td>'+$(this).data('callsign')+'</td>'
                 +'<td class="flex items-center justify-center">'
                 +'    <button type="button" id="'+this.value+'" onclick="deleteRowShip(this)"  class="focus:outline-none cta-delete-table">'
                 +'        <img src="{{asset("assets/icons/svg/trash.svg")}}" alt="">'                                          
                 +'    </button>'
                 +'</td>'
             +'</tr>');

            // Jika butuh append data dari kapal ke dalam atribut silakan beautify dahulu, sesuaikan dengan kebutuhan, lalu minify lagi ke dalalm variabel  dynamicElement.
            // var dynamicElement = `
            //     <div id="elementShips_`+this.value+`" class=" p-6 rounded-lg bg-white w-full my-3 h-auto space-y-3" x-data="{open: false}">{{-- dinamis dari jumlah kapal distres yg dipilih kapal --}}<div class="header-card flex justify-between items-center"> <h2 class="text-2xl mb-4 underline font-bold">`+$(this).data('shipname')+`</h2> <button @click="open=! open" type="button" class="focus:outline-none bg-yellow-300 p-3 rounded-md hover:bg-yellow-400"> <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/> </svg> </button> </div><div x-show="open" class="mt-3"> <div class="flex item-center space-x-12"> <div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Jumlah Awak Kapal</label> <div class="relative flex justify-center items-center relative input-group-1"> <input type="text" name="jumlah_awak" id="" autocomplete="off" class="active form-control"> <span class="input-append"> <span class="font-bold">Orang</span> </span> </div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div><div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Jumlah Penumpang</label> <div class="relative flex justify-center items-center relative input-group-1"> <input type="text" name="jumlah_penumpang" id="" autocomplete="off" class="active form-control"> <span class="input-append"> <span class="font-bold">Orang</span> </span> </div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div><div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Jenis Muatan</label> <div class="relative flex justify-center items-center relative input-group-1"> <input type="text" name="jenis_muatan" id="" autocomplete="off" class="active form-control"> </div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div></div><div class="flex flex-col" x-data="{open: false}"> <div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Memerlukan Bantuan ?</label> <div class="flex items-center space-x-3"> <div class="flex justify-center items-center relative input-group-1 space-x-2"> <input type="radio" @click="open=true" name="memerlukan_bantuan" class="form-radio h-5 w-5" value="1" id="radio_yes" autocomplete="off"> <label for="radio_yes">Yes</label> </div><div class="flex justify-center items-center relative input-group-1 space-x-2"> <input onclick="$('.memerlukan_bantuan').val('')" type="radio" @click="open=false" name="memerlukan_bantuan" class="form-radio h-5 w-5" value="0" id="radio_no" autocomplete="off" checked> <label for="radio_no">No</label> </div></div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div><div class="flex flex-col item-center w-full mt-4" x-show="open"> <label class="font-bold mb-2">Jenis Bantuan</label> <div class="flex flex-col lg:flex-row"> <div class="space-y-2 flex flex-col my-2 form-group-1"> <div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="tugboat_assistance" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Tugboat Assistance</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Medical Assistance</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Ambulance</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">TMAS</span> </div></div><div class="space-y-2 flex flex-col my-2 form-group-1"> <div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Fire FIghting</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Oil Spill Combatting</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">HNS Spill Combatting</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Securite Assitance</span> </div></div><div class="space-y-2 flex flex-col my-2 form-group-1"> <div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Cargo Evacuation</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">DG Cargo Handling</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Search and Rescue</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Salvage</span> </div></div><div class="space-y-2 flex flex-col my-2 form-group-1"> <div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Require Emergency Area</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Require Place Of Refugee</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Require Quarantine</span> </div><div class="flex space-x-2 items-center"> <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 "> <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept"> <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg> </div><span class="text-lg font-medium">Aid To Navigation Marking</span> </div></div></div><div class="flex item-center w-full mt-4"> <div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Keterangan / Bantuan Lainnya</label> <div class="flex justify-center items-center relative input-group-1"> <textarea name="keterangan_bantuan_lainnya" class="form-control w-full active" id="" cols="30" rows="4"></textarea> </div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div></div></div></div><div class="flex flex-col" x-data="{open: false}"> <div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Sudah ada upaya pertolongan / penanggulangan yang sedang berlangsung ?</label> <div class="flex items-center space-x-3"> <div class="flex justify-center items-center relative input-group-1 space-x-2"> <input type="radio" @click="open=true" name="sudah_ada_pertolongan" class="form-radio h-5 w-5" value="1" id="radio_yes" autocomplete="off"> <label for="radio_yes">Yes</label> </div><div class="flex justify-center items-center relative input-group-1 space-x-2"> <input onclick="$('#upaya_pertolongan').val('')" type="radio" @click="open=false" name="sudah_ada_pertolongan" class="form-radio h-5 w-5" value="0" id="radio_no" autocomplete="off" checked> <label for="radio_no">No</label> </div></div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div><div class="flex item-center w-full mt-4" x-show="open"> <div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Pertolongan / Penanggulangan yang dilakukan</label> <div class="flex justify-center items-center relative input-group-1"> <textarea name="deskripsi_pertolongan" class="form-control w-full active" id="upaya_pertolongan" cols="30" rows="4"></textarea> </div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div></div></div><div class="addon"> <label class="font-bold mb-2">Korban Manusia</label> <div class="flex items-center space-x-5 w-full" x-data="{accept: false}"> <div class="flex items-center w-1/3 relative input-group-1 space-x-2 "> <span class="text-lg font-bold"> M.O.B</span> </div><div class="flex space-x-5 relative w-1/3 input-group-1"> <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3"> <input onclick="$('#mob').val('')" @click="accept=false" type="radio" name="mob" class="form-radio h-5 w-5" value="0" id="0" checked> <label for="0" class="font-medium">Unknown</label> </div><div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3"> <input @click="accept=true" type="radio" name="mob" class="form-radio h-5 w-5" value="1" id="1"> <label for="1" class="font-medium">Yes</label> </div><div class="flex items-center relative input-group-1 space-x-2"> <input onclick="$('#mob').val('')" @click="accept=false" type="radio" name="mob" class="form-radio h-5 w-5" value="2" id="2"> <label for="2" class="font-medium">No</label> </div></div><div class="flex my-1 w-1/3 form-group-1"> <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80"> <input value='' type="number" min="0" name="" :class="{'readonly' : !accept , 'active' : accept}" class="form-control" id="mob" autocomplete="off" x-bind:readonly="!accept"> <span class="input-append font-bold"> Orang </span> </div></div></div><div class="flex items-center space-x-5 w-full" x-data="{accept: false}"> <div class="flex items-center w-1/3 relative input-group-1 space-x-2 "> <span class="text-lg font-bold"> Korban Luka</span> </div><div class="flex space-x-5 relative w-1/3 input-group-1"> <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3"> <input onclick="$('#korban_luka').val('')" @click="accept=false" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="0" id="0" checked> <label for="0" class="font-medium">Unknown</label> </div><div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3"> <input @click="accept=true" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="1" id="1"> <label for="1" class="font-medium">Yes</label> </div><div class="flex items-center relative input-group-1 space-x-2"> <input onclick="$('#korban_luka').val('')" @click="accept=false" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="2" id="2"> <label for="2" class="font-medium">No</label> </div></div><div class="flex my-1 w-1/3 form-group-1"> <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80"> <input type="number" min="0" name="" :class="{'readonly' : !accept , 'active' : accept}" class="form-control" id="korban_luka" autocomplete="off" x-bind:readonly="!accept"> <span class="input-append font-bold"> Orang </span> </div></div></div><div class="flex items-center space-x-5 w-full" x-data="{accept: false}"> <div class="flex items-center w-1/3 relative input-group-1 space-x-2 "> <span class="text-lg font-bold">Korban Jiwa</span> </div><div class="flex space-x-5 relative w-1/3 input-group-1"> <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3"> <input onclick="$('#korban_jiwa').val('')" @click="accept=false" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="0" id="0" checked> <label for="0" class="font-medium">Unknown</label> </div><div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3"> <input @click="accept=true" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="1" id="1"> <label for="1" class="font-medium">Yes</label> </div><div class="flex items-center relative input-group-1 space-x-2"> <input onclick="$('#korban_jiwa').val('')" @click="accept=false" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="2" id="2"> <label for="2" class="font-medium">No</label> </div></div><div class="flex my-1 w-1/3 form-group-1"> <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80"> <input type="number" min="0" name="" :class="{'readonly' : !accept , 'active' : accept}" class="form-control" id="korban_jiwa" autocomplete="off" x-bind:readonly="!accept"> <span class="input-append font-bold"> Orang </span> </div></div></div></div><div class="flex item-center w-full mt-4"> <div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Kerusakan Kapal</label> <div class="flex justify-center items-center relative input-group-1"> <textarea name="kerusakan_kapal" class="form-control w-full active" id="" cols="30" rows="4"></textarea> </div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div></div><div class="flex item-center w-full mt-4"> <div class="flex flex-col my-1 form-group-1"> <label class="font-bold mb-2">Tindakan</label> <div class="flex justify-center items-center relative input-group-1"> <textarea name="tindakan" class="form-control w-full active" id="" cols="30" rows="4"></textarea> </div><span class="hidden mt-3 pl-2 text-red-600 font-base"> Info here ! </span> </div></div></div></div>
            // `;

            var dynamicElem = `<div id="elementShips_`+this.value+`" class="p-6 rounded-lg bg-white w-full my-3 h-auto space-y-3" x-data="{ open: false }">`
                +`    {{-- dinamis dari jumlah kapal distres yg dipilih kapal --}}`
                +`    <div class="header-card flex justify-between items-center">`
                +`        <h2 class="text-2xl mb-4 underline font-bold">`+$(this).data('shipname')+`</h2>`
                +`        <button @click="open = ! open" type="button" class="focus:outline-none bg-yellow-300 p-3 rounded-md hover:bg-yellow-400">`
                +`            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">`
                +`                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />`
                +`              </svg>`
                +`        </button>`
                +`    </div>`
                +`    <div x-show="open" class="mt-3">`
                +`        <div class="flex item-center space-x-12">`
                +`            <div class="flex flex-col my-1 form-group-1">`
                +`                <label class="font-bold mb-2">Jumlah Awak Kapal</label>`
                +`                <div class="relative flex justify-center items-center relative input-group-1">`
                +`                    <input type="text" name="jumlah_awak" id="" autocomplete="off" class="active form-control">`
                +`                    <span class="input-append">`
                +`                        <span class="font-bold">Orang</span>`
                +`                    </span>`
                +`                </div>`
                +`                <span class="hidden mt-3 pl-2 text-red-600 font-base">`
                +`                    Info here !`
                +`                </span>`
                +`            </div>`
                +`            <div class="flex flex-col my-1 form-group-1">`
                +`               <label class="font-bold mb-2">Jumlah Penumpang</label>`
                +`               <div class="relative flex justify-center items-center relative input-group-1">`
                +`                   <input type="text" name="jumlah_penumpang" id="" autocomplete="off" class="active form-control">`
                +`                   <span class="input-append">`
                +`                       <span class="font-bold">Orang</span>`
                +`                   </span>`
                +`               </div>`
                +`               <span class="hidden mt-3 pl-2 text-red-600 font-base">`
                +`                   Info here !`
                +`               </span>`
                +`           </div>`
                +`           <div class="flex flex-col my-1 form-group-1">`
                +`               <label class="font-bold mb-2">Jenis Muatan</label>`
                +`               <div class="relative flex justify-center items-center relative input-group-1">`
                +`                   <input type="text" name="jenis_muatan" id="" autocomplete="off" class="active form-control">`
                +`               </div>`
                +`               <span class="hidden mt-3 pl-2 text-red-600 font-base">`
                +`                   Info here !`
                +`               </span>`
                +`           </div>`
                +`       </div>`
                +`        <div class="flex flex-col" x-data="{ open: false }">`
                +`            <div class="flex flex-col my-1 form-group-1">`
                +`                <label class="font-bold mb-2">Memerlukan Bantuan  ?</label>`
                +`                <div class="flex items-center space-x-3">`
                +`                    <div class="flex justify-center items-center relative input-group-1 space-x-2">`
                +`                        <input type="radio" @click="open = true" name="memerlukan_bantuan" class="form-radio h-5 w-5" value="1" id="radio_yes" autocomplete="off">`
                +`                        <label for="radio_yes">Yes</label>`
                +`                    </div>`
                +`                    <div class="flex justify-center items-center relative input-group-1 space-x-2">`
                +`                        <input onclick="$('.memerlukan_bantuan').val('')" type="radio" @click="open = false" name="memerlukan_bantuan" class="form-radio h-5 w-5"     value="0" id="radio_no" autocomplete="off" checked>`
                +`                        <label for="radio_no">No</label>`
                +`                    </div>`
                +`                </div>`
                +`                <span class="hidden mt-3 pl-2 text-red-600 font-base">`
                +`                    Info here !`
                +`                </span>`
                +`            </div>`
                +`            <div class="flex flex-col item-center w-full mt-4" x-show="open">`
                +`                <label class="font-bold mb-2">Jenis Bantuan</label>`
                +`                <div class="flex flex-col lg:flex-row">`
                +`                    <div class="space-y-2 flex flex-col my-2 form-group-1">`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="tugboat_assistance" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Tugboat Assistance</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Medical Assistance</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Ambulance</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">TMAS</span>`
                +`                        </div>`
                +`                    </div>`
                +`                    <div class="space-y-2 flex flex-col my-2 form-group-1">`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Fire FIghting</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Oil Spill Combatting</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">HNS Spill Combatting</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Securite Assitance</span>`
                +`                        </div>`
                +`                    </div>`
                +`                    <div class="space-y-2 flex flex-col my-2 form-group-1">`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Cargo Evacuation</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">DG Cargo Handling</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Search and Rescue</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Salvage</span>`
                +`                        </div>`
                +`                    </div>`
                +`                    <div class="space-y-2 flex flex-col my-2 form-group-1">`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Require Emergency Area</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Require Place Of Refugee</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Require Quarantine</span>`
                +`                        </div>`
                +`                        <div class="flex space-x-2 items-center">`
                +`                            <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">`
                +`                                <input type="checkbox" value="" name="" class="memerlukan_bantuan opacity-0 cursor-pointer absolute" x-model="accept">`
                +`                                <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>`
                +`                            </div>`
                +`                            <span class="text-lg font-medium">Aid To Navigation Marking</span>`
                +`                        </div>`
                +`                    </div>`
                +`                </div>`
                +`                <div class="flex item-center w-full mt-4">`
                +`                    <div class="flex flex-col my-1 form-group-1">`
                +`                        <label class="font-bold mb-2">Keterangan / Bantuan Lainnya</label>`
                +`                        <div class="flex justify-center items-center relative input-group-1">`
                +`                            <textarea name="keterangan_bantuan_lainnya" class="form-control w-full active" id="" cols="30" rows="4"></textarea>`
                +`                        </div>`
                +`                        <span class="hidden mt-3 pl-2 text-red-600 font-base">`
                +`                            Info here !`
                +`                        </span>`
                +`                    </div>`
                +`                </div>`
                +`            </div>`
                +`        </div>`
                +`        <div class="flex flex-col" x-data="{ open: false }">`
                +`            <div class="flex flex-col my-1 form-group-1">`
                +`                <label class="font-bold mb-2">Sudah ada upaya pertolongan / penanggulangan yang sedang berlangsung ?</label>`
                +`                <div class="flex items-center space-x-3">`
                +`                    <div class="flex justify-center items-center relative input-group-1 space-x-2">`
                +`                        <input type="radio" @click="open = true" name="sudah_ada_pertolongan" class="form-radio h-5 w-5" value="1" id="radio_yes" autocomplete="off">`
                +`                        <label for="radio_yes">Yes</label>`
                +`                    </div>`
                +`                    <div class="flex justify-center items-center relative input-group-1 space-x-2">`
                +`                        <input onclick="$('#upaya_pertolongan').val('')" type="radio" @click="open = false" name="sudah_ada_pertolongan" class="form-radio h-5 w-5" value="0" id="radio_no" autocomplete="off" checked>`
                +`                        <label for="radio_no">No</label>`
                +`                    </div>`
                +`                </div>`
                +`                <span class="hidden mt-3 pl-2 text-red-600 font-base">`
                +`                    Info here !`
                +`                </span>`
                +`            </div>`
                +`            <div class="flex item-center w-full mt-4" x-show="open">`
                +`                <div class="flex flex-col my-1 form-group-1">`
                +`                    <label class="font-bold mb-2">Pertolongan / Penanggulangan yang dilakukan</label>`
                +`                    <div class="flex justify-center items-center relative input-group-1">`
                +`                        <textarea name="deskripsi_pertolongan" class="form-control w-full active" id="upaya_pertolongan" cols="30" rows="4"></textarea>`
                +`                    </div>`
                +`                    <span class="hidden mt-3 pl-2 text-red-600 font-base">`
                +`                        Info here !`
                +`                    </span>`
                +`                </div>`
                +`            </div>`
                +`        </div>`
                +`        <div class="addon">`
                +`            <label class="font-bold mb-2">Korban Manusia</label>`
                +`            <div class="flex items-center space-x-5 w-full" x-data="{accept: false}">`
                +`                <div class="flex items-center w-1/3 relative input-group-1 space-x-2 ">`
                +`                    <span class="text-lg font-bold"> M.O.B</span>`
                +`                </div>`
                +`                <div class="flex space-x-5 relative w-1/3 input-group-1">`
                +`                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">`
                +`                        <input onclick="$('#mob').val('')" @click="accept = false" type="radio" name="mob" class="form-radio h-5 w-5" value="0" id="0" checked>`
                +`                        <label for="0" class="font-medium">Unknown</label>`
                +`                    </div>`
                +`                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">`
                +`                        <input @click="accept = true" type="radio" name="mob" class="form-radio h-5 w-5" value="1" id="1">`
                +`                        <label for="1" class="font-medium">Yes</label>`
                +`                    </div>`
                +`                    <div class="flex items-center relative input-group-1 space-x-2">`
                +`                        <input onclick="$('#mob').val('')" @click="accept = false" type="radio" name="mob" class="form-radio h-5 w-5" value="2" id="2">`
                +`                        <label for="2" class="font-medium">No</label>`
                +`                    </div>`
                +`                </div>`
                +`                <div class="flex my-1 w-1/3 form-group-1">`
                +`                    <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80">`
                +`                        <input value='' type="number" min="0" name="" :class="{ 'readonly' : !accept , 'active' : accept}" class="form-control" id="mob" autocomplete="off"  x-bind:readonly="!accept">`
                +`                        <span class="input-append font-bold">Orang</span>`
                +`                    </div>`
                +`                </div>`
                +`            </div>`
                +`            <div class="flex items-center space-x-5 w-full" x-data="{accept: false}">`
                +`                <div class="flex items-center w-1/3 relative input-group-1 space-x-2 ">`
                +`                    <span class="text-lg font-bold"> Korban Luka</span>`
                +`                </div>`
                +`                <div class="flex space-x-5 relative w-1/3 input-group-1">`
                +`                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">`
                +`                        <input onclick="$('#korban_luka').val('')" @click="accept = false" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="0" id="0" checked>`
                +`                        <label for="0" class="font-medium">Unknown</label>`
                +`                    </div>`
                +`                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">`
                +`                        <input @click="accept = true" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="1" id="1">`
                +`                        <label for="1" class="font-medium">Yes</label>`
                +`                    </div>`
                +`                    <div class="flex items-center relative input-group-1 space-x-2">`
                +`                        <input onclick="$('#korban_luka').val('')" @click="accept = false" type="radio" name="korban_luka" class="form-radio h-5 w-5" value="2" id="2">`
                +`                        <label for="2" class="font-medium">No</label>`
                +`                    </div>`
                +`                </div>`
                +`                <div class="flex my-1 w-1/3 form-group-1">`
                +`                    <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80">`
                +`                        <input type="number" min="0" name="" :class="{ 'readonly' : !accept , 'active' : accept}" class="form-control" id="korban_luka" autocomplete="off"  x-bind:readonly="!accept">`
                +`                        <span class="input-append font-bold">Orang</span>`
                +`                    </div>`
                +`                </div>`
                +`            </div>`
                +`            <div class="flex items-center space-x-5 w-full" x-data="{accept: false}">`
                +`                <div class="flex items-center w-1/3 relative input-group-1 space-x-2 ">`
                +`                    <span class="text-lg font-bold">Korban Jiwa</span>`
                +`                </div>`
                +`                <div class="flex space-x-5 relative w-1/3 input-group-1">`
                +`                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">`
                +`                        <input onclick="$('#korban_jiwa').val('')" @click="accept = false" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="0" id="0" checked>`
                +`                        <label for="0" class="font-medium">Unknown</label>`
                +`                    </div>`
                +`                    <div class="flex items-center relative input-group-1 space-x-2 mr-0 lg:mr-3">`
                +`                        <input @click="accept = true" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="1" id="1">`
                +`                        <label for="1" class="font-medium">Yes</label>`
                +`                    </div>`
                +`                    <div class="flex items-center relative input-group-1 space-x-2">`
                +`                        <input onclick="$('#korban_jiwa').val('')" @click="accept = false" type="radio" name="korban_jiwa" class="form-radio h-5 w-5" value="2" id="2">`
                +`                        <label for="2" class="font-medium">No</label>`
                +`                    </div>`
                +`                </div>`
                +`                <div class="flex my-1 w-1/3 form-group-1">`
                +`                    <div class="flex justify-center items-center relative input-group-1 ml-0 lg:ml-24 lg:w-80">`
                +`                        <input type="number" min="0" name="" :class="{ 'readonly' : !accept , 'active' : accept}" class="form-control" id="korban_jiwa" autocomplete="off"  x-bind:readonly="!accept">`
                +`                        <span class="input-append font-bold">Orang</span>`
                +`                    </div>`
                +`                </div>`
                +`            </div>`
                +`        </div>`
                +`        <div class="flex item-center w-full mt-4">`
                +`            <div class="flex flex-col my-1 form-group-1">`
                +`                <label class="font-bold mb-2">Kerusakan Kapal</label>`
                +`                <div class="flex justify-center items-center relative input-group-1">`
                +`                    <textarea name="kerusakan_kapal" class="form-control w-full active" id="" cols="30" rows="4"></textarea>`
                +`                </div>`
                +`                <span class="hidden mt-3 pl-2 text-red-600 font-base">Info here !</span>`
                +`            </div>`
                +`        </div>`
                +`        <div class="flex item-center w-full mt-4">`
                +`            <div class="flex flex-col my-1 form-group-1">`
                +`                <label class="font-bold mb-2">Tindakan</label>`
                +`                <div class="flex justify-center items-center relative input-group-1">`
                +`                    <textarea name="tindakan" class="form-control w-full active" id="" cols="30" rows="4"></textarea>`
                +`                </div>`
                +`                <span class="hidden mt-3 pl-2 text-red-600 font-base">Info here !</span>`
                +`            </div>`
                +`        </div>`
                +`    </div>`
                +`</div>`;
             $('#appendRowShipDetail').append(dynamicElem)
        });        
    }
    function deleteRowShip(data) {
        var row_mmsi = '#row_mmsi'+data.id;
        var detail_distres_kapal = '#elementShips_'+data.id;
        $(row_mmsi).remove();
        $(detail_distres_kapal).remove();
    }
</script>
@endpush

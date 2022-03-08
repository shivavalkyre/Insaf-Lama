@extends('layouts.main', ['title' => 'Marine Safety Information - INSAF'])

@php
$date = date('Y-m-d H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Create Marine Safety Information</h1>
</div>
<div>
    <div class="space-y-4">
        <form action="{{route('msi_store.insaf')}}" method="post" class="space-y-4">
            <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    @csrf
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nomor Jurnal <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="no_jurnal" class="readonly form-control" id="" value="{{$no_jurnal}}"
                                    autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Valid From </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="datetime-local" name="valid_from" class="active form-control" id="" autocomplete="off"
                                    value="" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Valid To </label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="datetime-local" name="valid_to" class="active form-control" id="" autocomplete="off"
                                    value="" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Informasi Kenavigasian</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="information" class="form-control active" id="" cols="30" rows="4"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div>
            
                    <div class="flex item-center justify-between space-x-12 py-2">
                        <h2 class="text-2xl font-bold text-black">Data Cuaca</h2>
                    </div>
            
                    <div class="flex item-center justify-between py-5" x-data="{ open: false }">
                        <div class="flex flex space-x-6 my-1 form-group-1">
                            <div class="input-group flex items-center space-x-3">
                                <input type="radio" @click="open=true" onclick="getWeatherMetSensor()" name="sumber_data_cuaca" value="1" id="">
                                <span class="text-xl font-bold ">VTS Met Sensor</span> 
                            </div>
                            <div class="input-group flex items-center space-x-3">
                                <input type="radio" onclick="getWeatherBMKG()" name="sumber_data_cuaca" value="2" id="">
                                <span class="text-xl font-bold ">BMKG</span> 
                            </div>
                            <div class="input-group flex items-center space-x-3">
                                <input type="radio" onclick="manualFeedWeather()" name="sumber_data_cuaca" value="3" id="">
                                <span class="text-xl font-bold ">Manual Input</span> 
                            </div>
                        </div>
                        <div x-show="open" @click.away="open = false"  x-init="setTimeout(() => show = false, 8000)" 
                            x-transition:enter="transition duration-200 transform ease-out"
                            x-transition:enter-start="scale-75"
                            x-transition:leave="transition duration-100 transform ease-in"
                            x-transition:leave-end="opacity-0 scale-90" class=" overlay-modal fixed flex items-center justify-center z-50 w-screen h-screen bg-gray-900 bg-opacity-30 flex inset-0">
                            <div class="modal relative bg-white overflow-hidden rounded-xl w-96 h-96 z-50">
                                <div class="modal-header flex items-center justify-between py-2 px-2">
                                    <div></div>
                                    <div>
                                        <a href="#" @click="open=false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-5 flex flex-col items-center justify-center modal-body">
                                    <span class="w-18 h-18 mb-2 rounded-full overflow-hidden p-3">
                                        <img class="logo-brand w-14 h-14" src="{{url('assets/images/insaf-dark.png')}}">
                                    </span>
    
                                    <h1 class="text-3xl font-bold mb-4">INFO !</h1>
                                    <p class="text-base font-medium text-center text-gray-800"> Maaf, fitur ini belum aktif.</p>
    
                                </div>
                                <div class="modal-footer absolute inset-x-0 bottom-0 bg-gray-100 flex items-center justify-center py-3 space-x-2">
                                    <button @click="open=false" type="button" class="transition duration-100 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:bg-gray-500 hover:bg-gray-400 text-gray-800 font-medium hover:text-white  flex items-center justify-center py-2 px-5 rounded-lg">
                                        Tutup
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kecepatan Angin Minimal </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="wind_speed_min" class="form-control active" >
                                <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">m/s</span>                       
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kecepatan Angin Maksimal </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="wind_speed_max" class="form-control active" >
                                <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">m/s</span>                       
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Arah Angin Dari </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="wind_from" class="form-control active" >
                                {{-- <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">%</span>                       
                                </span> --}}
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Arah Angin Menuju </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="wind_to" class="form-control active" >
                                {{-- <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">%</span>                       
                                </span> --}}
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kelembapan Minimal </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="humidity_min" class="form-control active" >
                                <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">%</span>                       
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Kelembapan Maksimal </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="humidity_max" class="form-control active" >
                                <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">%</span>                       
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">

                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Air Presure </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="air_pressure" class="form-control active" >
                                <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">hPa</span>                       
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Pasang Surut </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="hidden" name="low_tide" class="form-control active" >
                                <input type="hidden" name="high_tide" class="form-control active" >
                                <input type="hidden" name="low_tide_time" class="form-control active" >
                                <input type="hidden" name="high_tide_time" class="form-control active" >
                                <input type="text" name="tide" class="form-control active" >
                                <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">Meter</span>                       
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Temperature Minimal </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="temperature_min" class="form-control active" >
                                <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">&deg;C</span>                       
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Temperature Maksimal </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="temperature_max" class="form-control active" >
                                <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">&deg;C</span>                       
                                </span>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Cuaca </label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" name="weather" class="form-control active" >
                                {{-- <span class="modal-open focus:outline-none input-append">
                                    <span class="font-bold">&deg;C</span>                       
                                </span> --}}
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1"></div>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Informasi Lainnya</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="additional_info" class="form-control active" id="" cols="30" rows="4"></textarea>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div>

                    {{-- <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-300 text-black font-bold text-lg"> Simpan </button>
                    </div> --}}
            </div>

            <div class="p-6 rounded-lg bg-white w-full h-auto" x-data="handler()">
                <h2 class="text-2xl mb-2 font-bold">Kapal Penerima MSI</h2>
                <br>
                <div class="mb-3 flex">
                    <span class="flex item-center justify-center space-x-2">
                        <div class="bg-white border-2 cursor-pointer rounded border-yellow-400 w-6 h-6 flex flex-shrink-0 p-0 justify-center items-center mr-2 focus-within:border-yellow-400 ">
                            <input type="checkbox" value="1" name="all_ship" class="opacity-0 cursor-pointer absolute" x-model="accept">
                            <svg class="fill-current hidden w-5 h-5 text-white bg-yellow-400 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                        </div>
                        <span class="font-bold">
                            Semua Kapal Partisipasi VTS    
                        </span>
                    </span>
                </div>
                <div class="overflow-x-auto overflow-y-auto">
                    <div class="w-100 py-3 flex items-center"  x-data="{ open: false }">
                        <button  @click="open = true" type="button" id="addelementfileupload" class="focus:outline-none btn-table-add">
                            <span class="label">Pilih Kapal</span>
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
                                                                        <input type="checkbox" name="mmsi_kapal" class="opacity-0 cursor-pointer absolute"
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
            <div class="mt-3 space-x-3 bg-white py-5 px-3 rounded-lg flex items-center justify-between">
                <div class="ml-0 lg:ml-3">
                </div>
                <div class="space-x-3">
                    <a href="{{route('msi.insaf')}}" class="bg-white py-3 px-10 hover:bg-gray-300 rounded-lg w-auto focus:outline-none text-gray-600 font-bold text-lg"> Batal </a>
                    <button type="submit" class="py-2 px-4 bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-bold text-lg">Simpan</button>
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
{{-- function get bmkg weather--}}
<script>
    function getWeatherMetSensor() {
        $("input[name=valid_from][type=datetime-local]").val('');
        $("input[name=valid_to][type=datetime-local]").val('');
        $("input[name=wind_speed_min][type=text]").val('');
        $("input[name=wind_speed_max][type=text]").val('');
        $("input[name=wind_from][type=text]").val('');
        $("input[name=wind_to][type=text]").val('');
        $("input[name=humidity_min][type=text]").val('');
        $("input[name=humidity_max][type=text]").val('');
        $("input[name=air_presure][type=text]").val('-');
        $("input[name=low_tide][type=text]").val('');
        $("input[name=high_tide][type=text]").val('');
        $("input[name=low_tide_time][type=text]").val('');
        $("input[name=high_tide_time][type=text]").val('');
        $("input[name=tide][type=text]").val('');
        $("input[name=temperature_min][type=text]").val('');
        $("input[name=temperature_max][type=text]").val('');
        $("input[name=weather][type=text]").val('');
        $("textarea[name=additional_info]").val('');
    }
    function manualFeedWeather() {
        $("input[name=valid_from][type=datetime-local]").val('');
        $("input[name=valid_to][type=datetime-local]").val('');
        $("input[name=wind_speed_min][type=text]").val('');
        $("input[name=wind_speed_max][type=text]").val('');
        $("input[name=wind_from][type=text]").val('');
        $("input[name=wind_to][type=text]").val('');
        $("input[name=humidity_min][type=text]").val('');
        $("input[name=humidity_max][type=text]").val('');
        $("input[name=air_presure][type=text]").val('-');
        $("input[name=low_tide][type=text]").val('');
        $("input[name=high_tide][type=text]").val('');
        $("input[name=low_tide_time][type=text]").val('');
        $("input[name=high_tide_time][type=text]").val('');
        $("input[name=tide][type=text]").val('');
        $("input[name=temperature_min][type=text]").val('');
        $("input[name=temperature_max][type=text]").val('');
        $("input[name=weather][type=text]").val('');
        $("textarea[name=additional_info]").val('');
    }

    function convertTZ(date, tzString) {
        return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));   
    }

    function getWeatherBMKG() {
        var url = '/bmkg/api/get_current_wather';
        $.getJSON(url, function (data) {
            var f = convertTZ(data['valid_from'], 'Asia/Jakarta')
            var t = convertTZ(data['valid_to'], 'Asia/Jakarta')

            var month_from = (f.getMonth()+1) < 10 ? '0'+(f.getMonth()+1) : ''+(f.getMonth()+1);
            var month_to = (t.getMonth()+1) < 10 ? '0'+(t.getMonth()+1) : ''+(t.getMonth()+1);
            var date_from = f.getFullYear()+'-'+ month_from +'-'+f.getDate() + 'T' + (("0" + f.getHours()).slice(-2)) +':'+ (("0" + f.getMinutes()).slice(-2))
            var date_to = t.getFullYear()+'-'+ month_to +'-'+t.getDate() + 'T' + (("0" + t.getHours()).slice(-2)) +':'+ (("0" + t.getMinutes()).slice(-2))
            var information = nbsp(stripTags(data['weather_desc']+ ' ' +data['warning_desc']));

            console.log(date_from)
            console.log(date_to)
            console.log( (("0" + f.getHours()).slice(-2)) +':'+ (("0" + f.getMinutes()).slice(-2)) )
            console.log( (("0" + t.getHours()).slice(-2)) +':'+ (("0" + t.getMinutes()).slice(-2)) )

            $("input[name=valid_from][type=datetime-local]").val(date_from);
            $("input[name=valid_to][type=datetime-local]").val(date_to);
            $("input[name=wind_speed_min][type=text]").val(data['wind_speed_min']);
            $("input[name=wind_speed_max][type=text]").val(data['wind_speed_max']);
            $("input[name=wind_from][type=text]").val(data['wind_from']);
            $("input[name=wind_to][type=text]").val(data['wind_to']);
            $("input[name=humidity_min][type=text]").val(data['rh_min']);
            $("input[name=humidity_max][type=text]").val(data['rh_max']);
            $("input[name=air_presure][type=text]").val('-');
            $("input[name=low_tide][type=text]").val(data['low_tide']);
            $("input[name=high_tide][type=text]").val(data['high_tide']);
            $("input[name=low_tide_time][type=text]").val(data['low_tide_time']);
            $("input[name=high_tide_time][type=text]").val(data['high_tide_time']);
            $("input[name=tide][type=text]").val(data['low_tide']+' - '+data['high_tide']);
            $("input[name=temperature_min][type=text]").val(data['temp_min']);
            $("input[name=temperature_max][type=text]").val(data['temp_max']);
            $("input[name=weather][type=text]").val(data['weather']);
            $("textarea[name=additional_info]").val(information);
        });
    }
    function stripTags(text) {
        var filter2 = text.replace(/(<([^>]+)>)/gi, "");
        return filter2
    }
    function nbsp(text) {
        var filter2 = text.replace(/&nbsp;/g, "");
        return filter2
    }
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
        });        
    }
    function deleteRowShip(data) {
        var row_mmsi = '#row_mmsi'+data.id;
        $(row_mmsi).remove();
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

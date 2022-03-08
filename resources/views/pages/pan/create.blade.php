@extends('layouts.main', ['title' => ($pandata == []) ? "Create PAN - INSAF" : "Edit PAN - INSAF"])

@php
$date = date('d/m/Y H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">{{ ($pandata == []) ? "Create PAN" : "Edit PAN" }}</h1>
</div>

<div x-data="{ openTab: 1 }">
    <div class="w-full pt-4">
        <form action="{{ ($pandata == []) ? route('pan_store.insaf') : route('pan_update.insaf', $id) }}" method="post">
            @csrf
            {{-- step 1 --}}
            <div x-show="openTab === 1" class="space-y-3">
                {{-- content 1--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex item-center justify-between space-x-12">
            
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nomor Jurnal <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="no_jurnal" class="readonly form-control" id="" value="{{ ($pandata == [] ? $no_jurnal : $pandata['no_jurnal'] ) }}"
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
                                    value="{{ ($pandata == [] ? $date : $tanggal ) }}" readonly>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
            
                    </div>
                    
                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Jenis PAN <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="jenis_pan" id="" class="active form-control">
                                    @foreach($jenispan as $pilihan)
										<option value="{{ $pilihan['id'] }}" <?php echo ($pandata == []) ? "" : ($pilihan['jenis_pan'] == $pandata['jenis_pan'] ? "selected" : "" ) ?>>{{ $pilihan['jenis_pan'] }}</option>
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
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="datetime-local" name="waktu_kejadian" id="" class="active form-control">
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
                            <label class="font-bold mb-2">Sumber Informasi Awal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <select name="sumber_informasi" id="" class="active form-control">
                                    @foreach($sumberinformasiawal as $pilihan)
										<option value="{{ $pilihan['id'] }}" <?php echo ($pandata == []) ? "" : ($pilihan['sumber_informasi_awal'] == $pandata['sumber_informasi_awal'] ? "selected" : "" ); ?>>{{ $pilihan['sumber_informasi_awal'] }}</option>
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
                            <label class="font-bold mb-2">Keterangan Lainnya Tentang Pelapor</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="keterangan_lainnya" class="form-control active" id="" cols="30" rows="4">{{ ($pandata == []) ? "" : $pandata["keterangan_lainnya"] }}</textarea>
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
                        <h2 class="text-2xl font-bold text-black">Kapal Yang Mengalami Insiden</h2>
                    </div>
        
                    <div class="overflow-x-auto overflow-y-auto" >
                        <div class="w-100 py-3 flex items-center" x-data="{ open: false }">
                            <button type="button" id="addelementfileupload" @click="open = true" class="focus:outline-none btn-table-add">
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
                                                        <thead class="">
                                                            <tr class="">
                                                                <th></th>
                                                                <th class="">IMO</th>
                                                                <th class="">Nama Kapal</th>
                                                                <th class="">Agen</th>
                                                                <th class="">Call Sign</th>
                                                                <th class="">MMSI</th>
                                                                <th class="">Length</th>
                                                                <th class="">Width</th>
                                                                <th class="">Tipe Sensor</th>
                                                                <th class="">Tipe Kapal</th>
                                                                <th class="">GT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="overflow-y-auto" id="tbody">
                                                            <!-- //berubah -->
                                                            @foreach($listkapal as $datakapal)
                                                                <tr  id="shipdata{{ $datakapal['mmsi'] }}">
                                                                    <td >
                                                                        <input name="pilih_kapal" id="kapal1" type="radio" value="shipdata{{ $datakapal['mmsi'] }}">
                                                                    </td>
                                                                    <td id="imo{{ $datakapal['mmsi'] }}" >{{ $datakapal["imo"] ?? '-' }}</td>
                                                                    <td id="ship_name{{ $datakapal['mmsi'] }}">{{ $datakapal["ship_name"] ?? '-' }}</td>
                                                                    <td id="agen{{ $datakapal['mmsi'] }}">-</td>
                                                                    <td id="call_sign{{ $datakapal['mmsi'] }}">{{ $datakapal["call_sign"] ?? '-' }}</td>
                                                                    <td id="mmsi{{ $datakapal['mmsi'] }}">{{ $datakapal["mmsi"] ?? '-' }}</td>
                                                                    <td id="length{{ $datakapal['mmsi'] }}">{{ $datakapal["length"] ?? '-' }}</td>
                                                                    <td id="width{{ $datakapal['mmsi'] }}">{{ $datakapal["width"] ?? '-' }}</td>
                                                                    <td id="sensor_type{{ $datakapal['mmsi'] }}">{{ $datakapal["sensor_type"] ?? '-' }}</td>
                                                                    <td id="ship_type{{ $datakapal['mmsi'] }}">{{ $datakapal["ship_type"] ?? '-' }}</td>
                                                                    <td id="gt{{ $datakapal['mmsi'] }}">{{ $datakapal["gt"] ?? '-' }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- modal- foooter --}}
                                        <div class="modal-footer absolute bottom-0 w-full flex justify-end items-center bg-white px-5 py-7">
                                                <button type="button" id="submitdatakapal" @click="open = false" class="bg-yellow-400 hover:bg-yellow-300 py-3 px-7 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-200 text-black font-medium text-lg">Pilih Kapal</button>    
                                        </div>
                            
                                    </div>
                                </div>
                            </div>
                        </div>
						<!-- //berubah -->
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
                                <tbody class="listmmsi">
									@if($mmsidata != [])
										@foreach($mmsidata as $datakapal)
											<tr id="shiplist{{ $datakapal['mmsi'] }}" value="exists">
												<td>{{ $datakapal['ship_name'] }}</td>
												<td>{{ $datakapal['ship_type'] }}</td>
												<td>{{ $datakapal['gt'] }}</td>
												<td>{{ $datakapal['call_sign'] }}</td>
												<td class="text-center fle">
													<input type="hidden" name="mmsi[]" value="{{ $datakapal['mmsi'] }}"/>
													<button class="cta-delete-table" onclick="deletemmsi('shiplist{{ $datakapal['mmsi'] }}')">
														<img src="{{asset('assets/icons/svg/trash.svg')}}" alt="">
													</button>
												</td>
											</tr>
										@endforeach
									@endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                {{-- content 3--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                    <div class="flex item-center justify-between space-x-12 py-3">
                        <h2 class="text-2xl font-bold text-black">Lokasi</h2>
                    </div>
        
                    <div class="flex flex-col space-y-4 w-1/2">
                        <div class="flex flex-col">
                            <label class="font-bold mb-3">Longitude </label>
                            <div class="flex space-x-3">
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="degree1" value="<?php echo ($pandata == []) ? "" : $pandata["degree1"]; ?>" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="minute1" value="<?php echo ($pandata == []) ? "" : $pandata["minute1"]; ?>" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            "
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="second1" value="<?php echo ($pandata == []) ? "" : $pandata["second1"]; ?>" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                           '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction1" id="" class="active form-control">
                                            <option value="N" {{ ($pandata == []) ? "" : ($pandata["direction1"] == "N" ? "selected" : "" ) }}>N</option>
                                            <option value="E" {{ ($pandata == []) ? "" : ($pandata["direction1"] == "E" ? "selected" : "" ) }}>E</option>
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
                                        <input type="text" name="degree2" value="<?php echo ($pandata == []) ? "" : $pandata["degree2"]; ?>" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            &deg;
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="minute2" value="<?php echo ($pandata == []) ? "" : $pandata["minute2"]; ?>" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                            "
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <input type="text" name="second2" value="<?php echo ($pandata == []) ? "" : $pandata["second2"]; ?>" class="active form-control">
                                        <span class="input-append font-bold text-2xl">
                                           '
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col my-1 form-group-1">
                                    <div class="relative flex justify-center items-center relative input-group-1">
                                        <select name="direction2" id="" class="active form-control">
                                            <option value="W" {{ ($pandata == []) ? "" : ($pandata["direction2"] == "W" ? "selected" : "" ) }}>W</option>
                                            <option value="S" {{ ($pandata == []) ? "" : ($pandata["direction2"] == "S" ? "selected" : "" ) }}>S</option>
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
                            <label class="font-bold mb-2">Deskripsi Laporan PAN dan Asesmen Situasi</label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <textarea name="deskripsi_laporan" class="form-control active" id="" cols="30" rows="4"><?php echo ($pandata == []) ? "" : $pandata["deskripsi_laporan"]; ?></textarea>
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
                                        <input type="radio" @click="open = true" name="memerlukan_tindakan" class="form-radio h-5 w-5" value="1" id="radio_yes" autocomplete="off" {{ ($pandata == []) ? "" : ($pandata["memerlukan_tindakan"] == "1" ? "checked" : "" ) }}>
                                        <label for="radio_yes">Yes</label>
                                    </div>
                                    <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                        <input type="radio" @click="open = false" name="memerlukan_tindakan" class="form-radio h-5 w-5" value="0" id="radio_no" autocomplete="off" {{ ($pandata == []) ? "checked" : ($pandata["memerlukan_tindakan"] == "0" ? "checked" : "" ) }}>
                                        <label for="radio_no">No</label>
                                    </div>
                                </div>
                                <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                    Info here !
                                </span>
                            </div>
                            {{-- <div class="flex flex-col my-1 form-group-1 mt-2" x-show="open">
                                <div class="flex justify-center items-center relative input-group-1">
                                    <input type="text" value="{{$date}}" class="readonly form-control" id="" autocomplete="off" readonly>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    
                </div>
                {{-- content 4--}}
                <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">

                    <div class="flex item-center justify-between space-x-12 py-3">
                        <h2 class="text-2xl font-bold text-black">Respon Tindak Lanjut</h2>
                    </div>

                    <div class="flex item-center justify-between space-x-12">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Master OnBoard <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="master_onboard" class="active form-control" value="<?php echo ($pandata == []) ? "" : $pandata["master_onboard"]; ?>"
                                    autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">No Handphone <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="phone_onboard" class="active form-control" id="" autocomplete="off"
                                    value="<?php echo ($pandata == []) ? "" : $pandata["phone_onboard"]; ?>" >
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
                                <input type="text" name="second_officer" class="active form-control" id="" value="<?php echo ($pandata == []) ? "" : $pandata["second_officer"]; ?>"
                                    autocomplete="off" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">No Handphone <span class="text-red-500">*</span></label>
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="phone_second_officer" class="active form-control" id="" autocomplete="off"
                                    value="<?php echo ($pandata == []) ? "" : $pandata["phone_second_officer"]; ?>" >
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                    </div>

                </div>
                {{-- button --}}
                <div class="mt-3 bg-white py-5 px-3 rounded-lg flex items-center justify-between">
                    <div class="ml-0 lg:ml-3"></div>
                    <div>
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
    $(document).ready(function(){
      $("#searchShip").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > 1)
        });
      });
    });
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
	//berubah
	// cara ambil data dari radio button ke form via js
	$("#submitdatakapal").click(function() {
		const loopdata = document.querySelectorAll('input[name="pilih_kapal"]')
		for(const id of loopdata){
			if(id.checked){
				listid = id.value;
				initvar = 'shiplist' + listid;
				cek = document.getElementById(initvar);
				if (cek == null) {
					panjangdata = listid.length;
					ambilangka = listid.substring(8, panjangdata);
					getvar = "ship_name"+ambilangka;
					ship_name = document.getElementById(getvar).innerHTML;
					getvar = "agen"+ambilangka;
					agen = document.getElementById(getvar).innerHTML;
					getvar = "call_sign"+ambilangka;
					call_sign = document.getElementById(getvar).innerHTML;
					getvar = "mmsi"+ambilangka;
					mmsi = document.getElementById(getvar).innerHTML;
					getvar = "length"+ambilangka;
					length = document.getElementById(getvar).innerHTML;
					getvar = "width"+ambilangka;
					width = document.getElementById(getvar).innerHTML;
					getvar = "sensor_type"+ambilangka;
					sensor_type = document.getElementById(getvar).innerHTML;
					getvar = "ship_type"+ambilangka;
					ship_type = document.getElementById(getvar).innerHTML;
					getvar = "gt"+ambilangka;
					gt = document.getElementById(getvar).innerHTML;
					$(".listmmsi").append('<tr id="'+initvar+'">'
											+'<td>'+ship_name+'</td>'
											+'<td>'+ship_type+'</td>'
											+'<td>'+gt+'</td>'
											+'<td>'+call_sign+'</td>'
											+'<td class="text-center fle">'
												+'<input type="hidden" name="mmsi[]" value="'+mmsi+'"/>'
												+'<button class="cta-delete-table" onclick="deletemmsi(\''+initvar+'\')">'
													+'<img src="{{asset("assets/icons/svg/trash.svg")}}" alt="">'
												+'</button>'
											+'</td>'
										+'</tr>');
				}
				break;
			}
		}
		toggleModal();
	});
</script>

<script>
	//berubah
	function deletemmsi(variable){
		getvar = '#'+variable;
		$(getvar).remove();
	}
</script>
@endpush

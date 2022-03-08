@extends('layouts.main', ['title' => 'NTM Create - INSAF'])

@php
$date = date('Y-m-d H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Create NTM</h1>
</div>
<div>
    <div class="space-y-4">
        <form action="{{route('ntm_store.insaf')}}" method="post" enctype="multipart/form-data" class="space-y-4">
            @csrf
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
                        <label class="font-bold mb-2">Judul NTM <span class="text-red-500">*</span></label>
                        <div class="flex justify-center items-center relative input-group-1">
                            <input type="text" name="title" class="active form-control" id="" autocomplete="off"
                                value="">
                        </div>
                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                            Info here !
                        </span>
                    </div>
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">Upload NTM (PDF)</label>
                        <div class="relative flex justify-center items-center relative input-group-1">
                            <input type="file" name="dokumen" class="form-control active" readonly>
                            <span class="absolute inset-y-0 right-0 flex items-center justify-center rounded-tr-lg rounded-br-lg px-5 bg-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
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
                        <label class="font-bold mb-2">Keterangan Lainnya </label>
                        <div class="flex justify-center items-center relative input-group-1">
                            <textarea name="keterangan" class="form-control active" id="" cols="30" rows="4"></textarea>
                        </div>
                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                            Info here !
                        </span>
                    </div>
        
                </div>
            </div>
            <div class="p-6 rounded-lg bg-white w-full h-auto" x-data="handler()">
                <h2 class="text-2xl mb-2 font-bold">Kapal Penerima Maklumat Pelayaran</h2>
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

@endpush

@extends('layouts.main', ['title' => 'Ship Departure - INSAF'])

@php
$date = date('d/m/Y H:i:s');
@endphp

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Create Ship Departure</h1>
</div>
<div>
    <div class="space-y-4">
        <form action="{{route('ship_departure_store.insaf')}}" method="post" enctype="multipart/form-data" class="space-y-4">
            @csrf
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
                        <label class="font-bold mb-2">Keterangan Tambahan </label>
                        <div class="flex justify-center items-center relative input-group-1">
                            <textarea name="keterangan_tambahan" class="form-control active" id="" cols="30" rows="4"></textarea>
                        </div>
                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                            Info here !
                        </span>
                    </div>
        
                </div>
            </div>

            <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                <div class="flex item-center justify-between space-x-12 py-3">
                    <h2 class="text-2xl font-bold text-black">Data Kapal</h2>
                </div>
					<!-- berubah SEMUA. Ambil dari Noon position modal -->
                    <div class="flex item-center justify-between" x-data="{ open: false }">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Nama Kapal <span class="text-red-500">*</span></label>
                            <div class="relative flex justify-center items-center relative input-group-1">
                                <input type="text" id="showshipname" class="form-control readonly" readonly>
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
        
				<input type="hidden" name="mmsi" id="setmmsi">
                <div class="flex item-center justify-between space-x-12">
					<!-- berubah -->
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">Perusahaan Pelayaran </label>
                        <div class="flex justify-center items-center relative input-group-1">
                            <input type="text" class="readonly form-control" id="showperusahaanpelayaran" autocomplete="off" readonly>
                        </div>
                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                            Info here !
                        </span>
                    </div>
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">IMO </label>
                        <div class="flex justify-center items-center relative input-group-1">
                            <input type="text" class="readonly form-control" id="showimo" autocomplete="off" readonly>
                        </div>
                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                            Info here !
                        </span>
                    </div>
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">Call Sign </label>
                        <div class="flex justify-center items-center relative input-group-1">
                            <input type="text" class="readonly form-control" id="showcallsign" autocomplete="off" readonly>
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
                            <input type="text" class="readonly form-control" id="showflag" autocomplete="off" readonly>
                        </div>
                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                            Info here !
                        </span>
                    </div>
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">MMSI </label>
                        <div class="flex justify-center items-center relative input-group-1">
                            <input type="text" class="readonly form-control" id="showmmsi" autocomplete="off" readonly>
                        </div>
                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                            Info here !
                        </span>
                    </div>
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">GT </label>
                        <div class="flex justify-center items-center relative input-group-1">
                            <input type="text" class="readonly form-control" id="showgt" autocomplete="off" readonly>
                        </div>
                        <span class="hidden mt-3 pl-2 text-red-600 font-base">
                            Info here !
                        </span>
                    </div>
                
                </div>

            </div>

            <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                <div class="flex item-center justify-between space-x-12 py-3">
                    <h2 class="text-2xl font-bold text-black">CLERANCE</h2>
                </div>
                <div class="flex item-center justify-between space-x-12">
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">Dok. SPB</label>
                        <div class="relative flex justify-center items-center relative input-group-1">
                            <input type="file" name="dok_spb" class="form-control active" readonly>
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
                    <div class="flex flex-col my-1 form-group-1"></div>
                </div>
                <div class="flex item-center justify-between space-x-12">
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">Dok. Bea Cukai</label>
                        <div class="relative flex justify-center items-center relative input-group-1">
                            <input type="file" name="dok_beacukai" class="form-control active" readonly>
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
                    <div class="flex flex-col my-1 form-group-1"></div>
                </div>
                <div class="flex item-center justify-between space-x-12">
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">Dok. Imigrasi</label>
                        <div class="relative flex justify-center items-center relative input-group-1">
                            <input type="file" name="dok_imigrasi" class="form-control active" readonly>
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
                    <div class="flex flex-col my-1 form-group-1"></div>
                </div>
                <div class="flex item-center justify-between space-x-12">
                    <div class="flex flex-col my-1 form-group-1">
                        <label class="font-bold mb-2">Dok. Karantina</label>
                        <div class="relative flex justify-center items-center relative input-group-1">
                            <input type="file" name="dok_karantina" class="form-control active" readonly>
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
                    <div class="flex flex-col my-1 form-group-1"></div>
                </div>
            </div>

            <div class="p-6 rounded-lg bg-white w-full h-auto space-y-3">
                <div class="flex item-center justify-between space-x-12">
                
                    <div x-data="{ open: false }">
                        <div class="flex flex-col my-1 form-group-1">
                            <label class="font-bold mb-2">Notifikasi Radio ON ?</label>
                            <div class="flex items-center space-x-3">
                                <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                    <input type="radio" @click="open = true" name="radio_notif" class="form-radio h-5 w-5" value="1" id="radio_yes" autocomplete="off">
                                    <label for="radio_yes">Yes</label>
                                </div>
                                <div class="flex justify-center items-center relative input-group-1 space-x-2">
                                    <input type="radio" @click="open = false" name="radio_notif" class="form-radio h-5 w-5" value="0" id="radio_no" autocomplete="off" checked>
                                    <label for="radio_no">No</label>
                                </div>
                            </div>
                            <span class="hidden mt-3 pl-2 text-red-600 font-base">
                                Info here !
                            </span>
                        </div>
                        <div class="flex flex-col my-1 form-group-1 mt-2" x-show="open">
                            <div class="flex justify-center items-center relative input-group-1">
                                <input type="text" name="tanggal_komunikasi" value="{{$date}}" class="readonly form-control" id="" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="bg-yellow-400 py-3 px-10 hover:bg-yellow-300 rounded-lg w-auto focus:outline-none focus:ring-4 focus:ring-yellow-300 text-black font-bold text-lg"> Simpan </button>
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
        var mmsi_kapal = $('input[name=mmsi_kapal][type=radio]:checked').val();

        var url = '/ships/get_ship/'+mmsi_kapal;
        $.getJSON(url, function (data) {
            var ship = data['data'][0];
            //$("input[name=ship_name][type=text]").val(ship['ship_name']);
			document.getElementById('showperusahaanpelayaran').value = ship['nama_perusahaan']
			document.getElementById('showimo').value = ship['imo']
			document.getElementById('showcallsign').value = ship['call_sign']
			document.getElementById('showflag').value = ship['flag']
			document.getElementById('showmmsi').value = ship['mmsi']
			document.getElementById('setmmsi').value = ship['mmsi']
			document.getElementById('showgt').value = ship['gt']
			document.getElementById('showshipname').value = ship['ship_name']
        });
    }
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

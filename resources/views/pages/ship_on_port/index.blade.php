@extends('layouts.main', ['title' => 'Ship On Port - INSAF'])

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Ship On Port</h1>
</div>
<div class="p-6 rounded-lg bg-white w-full h-auto" x-data="{ open: false }">
    <div class="block space-y-5 lg:space-y-0 lg:flex items-center justify-between mb-5 lg:w-full">
        <div class="w-full lg:w-1/2 search-table flex items-center space-x-2">
            <form action="">
                <div class="input-group-button">
                    <input type="text" name="search" placeholder="Search..." class="form-search-table">
                    <button type="submit" class="btn-search-table">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30.621" height="30.621"
                            viewBox="0 0 30.621 30.621">
                            <g id="Icon_feather-search" data-name="Icon feather-search" transform="translate(-3 -3)">
                                <path id="Path_57" data-name="Path 57"
                                    d="M28.5,16.5a12,12,0,1,1-12-12A12,12,0,0,1,28.5,16.5Z" fill="none" stroke="#171717"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="3" />
                                <path id="Path_58" data-name="Path 58" d="M31.5,31.5l-6.525-6.525" fill="none"
                                    stroke="#171717" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" />
                            </g>
                        </svg>
                    </button>
                </div>
            </form>
            <div x-data="{ open: false }" class="relative">
                <button @click="open=true" id="btnFilterAscDesc" class="btn-table-filter focus:bg-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="18" viewBox="0 0 27 18">
                        <path id="Icon_material-filter-list" data-name="Icon material-filter-list"
                            d="M15,27h6V24H15ZM4.5,9v3h27V9ZM9,19.5H27v-3H9Z" transform="translate(-4.5 -9)" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="dropdown-filter-table-asc-desc absolute top-0 right-0 mt-12 rounded-md overflow-hidden shadow-lg bg-yellow-300 clearfix px-0 w-40 h-auto">
                    <a href="?target=desc" class="item flex items-center space-x-3 hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-900 px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                        </svg>
                        <span>
                            Newest
                        </span>
                    </a>
                    <a href="?target=asc" class="item flex items-center space-x-3 hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-900 px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                          </svg>
                          <span>
                              Latest 
                          </span>
                    </a>
                </div>
            </div>
            <div x-data="{ open: false }" class="relative">
                <button @click="open=true" id="btnFilterAscDesc" class="btn-table-filter focus:bg-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="dropdown-filter-table-asc-desc py-5 px-3 absolute top-0 left-0 mt-12 rounded-md overflow-hidden shadow-lg bg-yellow-300 clearfix w-auto h-auto">
                    <form action="" class="flex items-center space-x-2">
                        <input type="text" id="dt1" name="time1" class="input-search" placeholder="Start Date">
                        <input type="text" id="dt2" name="time2" class="input-search" placeholder="To date">
                        <button type="submit" class="btn-search-date-range">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/2 flex items-center justify-end">
            <a href="{{route('ship_on_port_create.insaf')}}" class="btn-table-add">
                <span class="label">Tambah Data</span>
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                        <path id="Icon_material-add" data-name="Icon material-add" d="M32.5,21.786H21.786V32.5H18.214V21.786H7.5V18.214H18.214V7.5h3.571V18.214H32.5Z" transform="translate(-7.5 -7.5)" fill="#fff"/>
                      </svg>                      
                </span>
            </a>
        </div>
    </div>
    <!-- table -->
    <div class="overflow-x-auto overflow-y-auto">
        <div class="my-6">
            <table class="table table-auto my-3">
                <thead class="">
                    <tr>
                        <th class="text-left">No Ship on Port</th>
                        <th class="text-left">Tanggal/Jam</th>
                        <th class="text-left">Nama Kapal</th>
                        <th class="text-left">Keterangan</th>
                        <!--<th class="text-center">Aksi</th>-->
                    </tr>
                </thead>
                <tbody class="">
                    @foreach($array as $data)
                        <tr>
                            <td class="">
                                <a href="{{route('ship_on_port_detail.insaf', $data['id'])}}">
									{{ $data['no_jurnal'] }}
                                </a>
                            </td>
                            <td class="">
								<a href="{{route('ship_on_port_detail.insaf', $data['id'])}}">
									{{ \Carbon\carbon::parse(strtotime($data["tanggal"]))->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y | H:i') }}
                                </a>
                            <td class="">
								<a href="{{route('ship_on_port_detail.insaf', $data['id'])}}">
									{{ $data['ship_name'] }}
                                </a>
							</td>
                            <td class="">
								<a href="{{route('ship_on_port_detail.insaf', $data['id'])}}">
									{{ $data['keterangan'] }}
                                </a>
							</td>
                            <!--<td class="w-40 ">
                                <div class="flex items-center justify-center space-x-2 text-center">
                                    <a href="#" class="cta-edit-table">
                                        <img src="{{asset('assets/icons/svg/edit.svg')}}" alt="">                                          
                                    </a>
                                    <a href="#" @click="open=true" class="cta-delete-table">
                                        <img src="{{asset('assets/icons/svg/trash.svg')}}" alt="">                                          
                                    </a>
                                </div>
                            </td>-->
                        </tr>

                        <div x-show="open" @click.away="open = false"  x-init="setTimeout(() => show = false, 8000)"
                        x-transition:enter="transition duration-200 transform ease-out"
                        x-transition:enter-start="scale-75"
                        x-transition:leave="transition duration-100 transform ease-in"
                        x-transition:leave-end="opacity-0 scale-90" class=" overlay-modal fixed flex items-center justify-center z-50 w-screen h-screen bg-gray-900 bg-opacity-10 flex inset-0">
                            <div class="modal relative bg-white overflow-hidden rounded-xl w-96 h-96 z-50">
                                <div class="modal-header flex items-center justify-between py-3 px-2">
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
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                        </svg> --}}
                                        <img class="logo-brand w-14 h-14" src="{{url('assets/images/insaf-dark.png')}}">
                                    </span>

                                    <h1 class="text-3xl font-bold mb-4">INSAF</h1>
                                    <h3 class="text-lg font-bold">Hapus Ship on Port</h3>
                                    <p class="text-base font-medium text-gray-800"> Yakin ingin hapus data "Ship on Port 1" ?</p>

                                </div>
                                <div class="modal-footer absolute inset-x-0 bottom-0 bg-gray-100 flex items-center justify-center py-3 space-x-2">
                                    <button type="button" class="transition duration-100 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:bg-gray-500 hover:bg-gray-500 text-gray-800 font-medium hover:text-white  flex items-center justify-center py-2 px-5 rounded-lg">
                                        Batal
                                    </button>
                                    <a href="asdasd" class="transition duration-100 focus:outline-none focus:ring-4 focus:ring-red-400 focus:bg-red-500 bg-red-600 hover:bg-red-500 text-white font-medium hover:text-white  flex items-center justify-center py-2 px-5 rounded-lg">
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- table -->
    <div class="flex flex-col items-center justify-center space-y-8 p-3 mt-10">
        {{-- {!! $users->links() !!} --}}
        <ul class="pagination">
            <li><a href="">< Previous</a></li>
            <li><a href="">Next ></a></li>
            @for ($i = 1; $i <= 4; $i++)
            <li><a href="#" @if($i == 1) class="active" @endif>{{$i}}</a></li>
            @endfor
        </ul>

        <span class="text-sm">
            {{-- Total Data : {{$total}} --}}
        </span>
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
    var dtt1 = document.getElementById('dt1')
    var dtt2 = document.getElementById('dt2')
    dt1.onfocus = function (event) {
        this.type = 'datetime-local';
        this.focus();
    }
    dt2.onfocus = function (event) {
        this.type = 'datetime-local';
        this.focus();
    }
</script>
@endpush

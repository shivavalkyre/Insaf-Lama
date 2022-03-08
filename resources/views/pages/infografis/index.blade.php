@extends('layouts.main', ['title' => 'Marine Safety Information - INSAF'])

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Infografis & Reporting</h1>
</div>

<div class="flex flex-col lg:flex-row gap-4">
    
    <div class="p-3 rounded-lg bg-white flex flex-col w-full lg:w-1/3 h-auto" x-data="{ open: false }">
        {{-- INFOGRAFIS =================================================================== --}}
            <!-- Card -->
            <div class="card my-1 px-1 w-full lg:my-3 lg:px-3">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-full text-xl p-2 lg:p-3 font-bold flex justify-end items-center rounded-tl-lg overflow-hidden title">
                        <h3 class="mr-5">SHIP ACTIVITY</h3>
                    </div>
                    <div class="w-auto relative font-bold " x-data="{ open: false }">
                        <button @click="open=true" id="dropdown-button" class=" flex rounded-tr-lg items-center justify-center bg-warmGray-900 hover:bg-warmGray-700 hover:text-yellow-400 px-5 py-4 lg:py-5 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">
                            <img src="{{ url('assets/icons/svg/filter.svg') }}" alt="">
                        </button>
                        <div x-show="open" @click.away="open = false" id="dropdown" class="dropdown absolute right-0 w-40 bg-gray-400 rounded-bl-md rounded-br-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Latest</a>
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Newest</a>
                        </div>
                    </div>
                </header>
                {{-- card body --}}
                <div class="flex p-4 items-center justify-center w-full h-full card-content autoscroll rounded-b-lg ">
                    <img width="80%" src="{{ url('assets/images/shipactivity.png') }}" alt="">
                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card my-1 px-1 w-full lg:my-3 lg:px-3">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-full text-sm lg:text-xl font-bold flex justify-between items-center rounded-tl-lg overflow-hidden title">
                        <div class="flex">
                            <button class="flex items-center justify-center bg-warmGray-900 hover:bg-opacity-50 hover:text-yellow-400 px-4 py-3 mr-1 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">D</button>
                            <button class="flex items-center justify-center bg-warmGray-900 hover:bg-opacity-50 hover:text-yellow-400 px-4 py-3 mr-1 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">M</button>
                            <button class="flex items-center justify-center bg-warmGray-900 hover:bg-opacity-50 hover:text-yellow-400 px-4 py-3 mr-1 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">Y</button>
                        </div>
                        <h3 class="mr-5">INCIDENT</h3>
                    </div>
                    <div class="w-auto relative font-bold items-center rounded-tr-lg"  x-data="{ open: false }">
                        <button @click="open=true" id="dropdown-button" class="button flex rounded-tr-lg items-center justify-center bg-warmGray-900 hover:bg-warmGray-700 hover:text-yellow-400 px-5 py-4 lg:py-5 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">
                            <img src="{{ url('assets/icons/svg/filter.svg') }}" alt="">
                        </button>
                        <div x-show="open" @click.away="open = false" id="dropdown" data-dropdown-item="dropdown-items" class="dropdown absolute right-0 w-40 bg-gray-400 rounded-bl-md rounded-br-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Latest</a>
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Newest</a>
                        </div>
                    </div>
                </header>
                {{-- card body --}}
                <div class="flex items-center justify-center w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    <img class="w-29" src="{{ url('assets/images/incident.png') }}" alt="">
                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card my-1 px-1 w-full lg:my-3 lg:px-3">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-full text-sm lg:text-xl font-bold flex justify-between items-center rounded-tl-lg overflow-hidden title">
                        <div class="flex">
                            <button class="flex items-center justify-center bg-warmGray-900 hover:bg-opacity-50 hover:text-yellow-400 px-4 py-3 mr-1 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">D</button>
                            <button class="flex items-center justify-center bg-warmGray-900 hover:bg-opacity-50 hover:text-yellow-400 px-4 py-3 mr-1 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">M</button>
                            <button class="flex items-center justify-center bg-warmGray-900 hover:bg-opacity-50 hover:text-yellow-400 px-4 py-3 mr-1 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">Y</button>
                        </div>
                        <h3 class="mr-5">PERFORMANCE</h3>
                    </div>
                    <div class="w-auto relative font-bold items-center rounded-tr-lg" x-data="{ open: false }">
                        <button id="dropdown-button" @click="open=true" class="button flex rounded-tr-lg items-center justify-center bg-warmGray-900 hover:bg-warmGray-700 hover:text-yellow-400 px-5 py-4 lg:py-5 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">
                            <img src="{{ url('assets/icons/svg/filter.svg') }}" alt="">
                        </button>
                        <div id="dropdown" x-show="open" @click.away="open = false" class="dropdown absolute right-0 w-40 bg-gray-400 rounded-bl-md rounded-br-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Latest</a>
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Newest</a>
                        </div>
                    </div>
                </header>
                {{-- card body --}}
                <div class="flex items-center justify-center w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                   <img class="w-29" src="{{ url('assets/images/performance.png') }}" alt="">
                </div>
            </div>
            <!-- end Card -->
    </div>

    <div class="p-6 rounded-lg bg-white w-full lg:w-2/3 h-auto" x-data="{ open: false }">
        <div class="block space-y-5 lg:space-y-0 lg:flex items-center justify-between mb-5 lg:w-full">
            <div class="w-full lg:w-1/2 search-table">
                <form action="" class="flex items-center space-x-2">
                    <div class="flex items-end justify-center space-x-3 my-1 form-group-2">
                        <div class="w-full space-y-3">
                            <div class="relative flex justify-center items-center relative input-group-2">
                                <select name="modul" id="" class="active form-control">
                                    <option value="" selected disabled>-- Pilih Kategori --</option>
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
                    <div x-data="{ open: false }" class="relative">
                        <button type="button" @click="open=true" id="btnFilterAscDesc" class="btn-table-filter focus:bg-yellow-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="dropdown-filter-table-asc-desc py-5 px-3 absolute top-0 left-0 mt-12 rounded-md overflow-hidden shadow-lg bg-yellow-300 clearfix w-auto h-auto">
                            <div class="flex items-center space-x-2">
                                <input type="text" id="dt1" name="time1" class="input-search" placeholder="Start Date">
                                <input type="text" id="dt2" name="time2" class="input-search" placeholder="To date">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-table-filter-2 bg-gray-800 hover:bg-gray-700 text-white">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-full lg:w-1/2 flex items-center justify-end">
                <a href="{{route('msi_create.insaf')}}" class="flex items-center justify-center space-x-3 bg-yellow-400 hover:bg-yellow-300 focus:ring-4 focus:ring-yellow-400  rounded-xl px-6 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                        <g id="Group_2899" data-name="Group 2899" transform="translate(-1695 -180)">
                          <path id="Icon_open-data-transfer-download" data-name="Icon open-data-transfer-download" d="M4.049,0V4.049H1.35L5.4,8.1,9.448,4.049h-2.7V0ZM0,9.448V10.8H10.8V9.448Z" transform="translate(1700.399 185.398)" fill="#171717"/>
                          <g id="Ellipse_55" data-name="Ellipse 55" transform="translate(1695 180)" fill="none" stroke="#171717" stroke-width="2">
                            <circle cx="11" cy="11" r="11" stroke="none"/>
                            <circle cx="11" cy="11" r="10" fill="none"/>
                          </g>
                        </g>
                      </svg>                                   
                    <span class="font-bold">Export</span>
                </a>
            </div>
        </div>
        <!-- table -->
        <div class="overflow-x-hidden overflow-y-auto">
            <div class="my-3">
                <table class="table-infografis table-auto my-2">
                    <thead class="">
                        <tr>
                            <th class="text-left">Heading</th>
                            <th class="text-left">Heading</th>
                            <th class="text-left">Heading</th>
                            <th class="text-left">Heading</th>
                            <th class="text-left">Heading</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        {{-- @foreach ($users as $row) --}}
                        @for ($i = 1; $i <= 10; $i++)
                            <tr>
                                <td>Content table</td>
                                <td>Content table</td>
                                <td>Content table</td>
                                <td>Content table</td>
                                <td>Content table</td>
                            </tr>
                        @endfor
                        {{-- @endforeach --}}
                    </tbody>
                    <tfoot class="w-full">
                        <tr>
                            <td colspan="5">
                                <div class="flex justify-between items-center py-2 px-5">
                                    <div class="w-full lg:w-1/3 flex items-center justify-start">
                                        <span class="font-bold text-black"><span class="font-medium"> Total Data :</span> 1500</span>
                                    </div>
                                    <div class="w-full lg:w-1/3 flex items-center justify-center divide-x-reverse divide-gray-100">
                                        <div class="flex">
                                            <a href="#" class="flex items-center justify-center rounded-l-md bg-yellow-500 hover:bg-yellow-600 duration-75 px-7 py-2 text-lg font-medium  space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="5.558" height="9" viewBox="0 0 5.558 9">
                                                    <path id="Icon_material-navigate-next" data-name="Icon material-navigate-next" d="M17.385,9l1.058,1.057L15.008,13.5l3.435,3.443L17.385,18l-4.5-4.5Z" transform="translate(-12.885 -9)" fill="#171717"/>
                                                  </svg>                                              
                                                <span>Previous</span>
                                            </a>
                                            <a href="#" class="flex items-center justify-center rounded-r-md bg-yellow-500 hover:bg-yellow-600 duration-75 px-7 py-2 text-lg font-medium  space-x-2">
                                                <span>Previous</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="5.557" height="9" viewBox="0 0 5.557 9">
                                                    <path id="Icon_material-navigate-next" data-name="Icon material-navigate-next" d="M13.943,9l-1.058,1.057L16.32,13.5l-3.435,3.443L13.943,18l4.5-4.5Z" transform="translate(-12.885 -9)" fill="#171717"/>
                                                  </svg>                                              
                                            </a>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/3 flex items-center justify-end"></div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- table -->
        <div class="flex items-center justify-end mt-3">
            <div class="w-full lg:w-1/2 flex items-center justify-end">
                <a href="{{route('msi_create.insaf')}}" class="flex items-center justify-center space-x-3 bg-yellow-400 hover:bg-yellow-300 focus:ring-4 focus:ring-yellow-400 rounded-xl px-6 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.357" height="15.893" viewBox="0 0 18.357 15.893">
                        <path id="Icon_zocial-print" data-name="Icon zocial-print" d="M.18,19.854V13.238l2.3-2.563H4.173v1.271H3.061L1.471,13.715v4.867H17.266V13.715l-1.589-1.768H14.564V10.675h1.689l2.285,2.563v6.616H.18Zm3.993-6.338V6.96l3-3h7.39v9.556ZM5.365,12.3h8.006V5.152H8.365v3h-3Z" transform="translate(-0.18 -3.96)" fill="#171717"/>
                      </svg>                                                    
                    <span class="font-bold">Print</span>
                </a>
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

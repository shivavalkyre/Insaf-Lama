@extends('layouts.main', ['title' => 'Users - INSAF'])

@section('content')
<div class="flex mb-6">
    <h1 class="text-2xl font-bold">Users</h1>
</div>
<div class="p-6 rounded-lg bg-white w-full h-auto">
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
                    <a href="#" class="item flex items-center space-x-3 hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-900 px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                        </svg>
                        <span>
                            Newest
                        </span>
                    </a>
                    <a href="#" class="item flex items-center space-x-3 hover:bg-gray-900 hover:bg-opacity-5 flex items-center text-gray-900 px-6 py-3">
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
            <a href="{{ route('users_create.insaf') }}" class="btn-table-add">
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
                        <th>No</th>
                        <th class="text-left">Username</th>
                        <th class="text-left">Email</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($users as $row)
                            <tr>
                                <td class="text-center font-bold">{{$numbering++}}</td>
                                <td>
                                    <a href="{{ route('user_detail.insaf') }}">
                                        {{$row->username}}
                                    </a> 
                                </td>
                                <td>{{$row->email}}</td>
                                <td class="">
                                    <div class="flex items-center justify-center space-x-2 text-center">
                                        <a href="#" class="cta-edit-table">
                                            <img src="{{asset('assets/icons/svg/edit.svg')}}" alt="">                                          
                                        </a>
                                        <a href="#" class="cta-delete-table">
                                            <img src="{{asset('assets/icons/svg/trash.svg')}}" alt="">                                          
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- table -->
    <div class="flex flex-col items-center justify-center space-y-8 p-3 mt-10">
        {{-- {!! $users->links() !!} --}}
        <ul class="pagination">
            <!--<li><a href="">< Previous</a></li>
            <li><a href="">Next ></a></li>-->
            @for ($i = 1; $i <= $pagination; $i++)
            <!--<li><a href="#" @if($i == 1) class="active" @endif>{{$i}}</a></li>-->
            <li><a href="{{ route('users_pagination.insaf',$i) }}" class="active"> {{$i}} </a></li>
            @endfor
        </ul>

        <span class="text-sm">
            Total Data : {{$total}}
        </span>
    </div>
</div>
@endsection

@push('active.user')
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
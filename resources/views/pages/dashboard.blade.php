<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INFORMATION AND SAFETY</title>
    {{-- tailwind css --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- custom insaf css --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cute+Font&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <style>
        #chartDoughnut_ship_activity {
            width: 190px !important;
            height: 190px !important;
        }
        #chartDoughnut_compliance {
            width: 170px !important;
            height: 170px !important;
        }
        #chartDoughnut_safety {
            width: 170px !important;
            height: 170px !important;
        }
        #chartLine {
            width: 570px !important;
            height: 100% !important;
        }
        .angka_ship_call {
            /* font-family: 'Cute Font', cursive; */
            font-family: 'Bebas Neue', cursive;
            text-decoration-line:line-through white;
        }
    </style>

</head>

<body onload="startTime()" class="bg-white">
    {{-- top bar dashboard --}}
    <div class="flex flex-col lg:flex-row items-center justify-between text-white navbar-dashboard">

        <div class="fixed z-10 flex lg:hidden justify-center items-center w-full bg-yellow-400 py-3">
            <div>
                <h3 class="font-bold text-xl">INFORMATION AND SAFETY</h3>
                <span class="text-sm font-semibold text-gray-800">DISNAV TG. PRIOK</span>
            </div>
            &nbsp;
            &nbsp;
            <img class="w-5" src="{{url('assets/images/logo-insaf-no-outline.png')}}">
        </div>

        <div class="hidden lg:flex w-1/5 px-5 items-center justify-between h-full timestamp border-r-2">
            <button type="button" class="focus:outline-none"  onclick="toggleFullScreen()">
                <svg id="iconshow" xmlns="http://www.w3.org/2000/svg" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                </svg>
            </button>
            <span id="clock" class="md:text-base lg:text-2xl"></span>
        </div>

        <div class="fixed lg:relative z-10 lg:z-0 mt-14 lg:mt-0 lg:relativeh-full lg:w-3/5 weather-information">
            <marquee scrollamount="5" class="flex py-2 lg:py-0 items-center justify-center w-full h-full">
                <ul class="flex pl-4">
                    <li class="flex items-center justify-center px-8 lg:px-11">
                        <img src="{{url('assets/icons/svg/wu-cloudy.svg')}}" class="">
                        <span class="ml-2">{{$bmkg['weather']}}</span>
                    </li>
                    <li class="flex items-center justify-center px-8 lg:px-11">
                        <img src="{{url('assets/icons/svg/thermometer-half.svg')}}" class="">
                        <span class="ml-2">{{$bmkg['temp_max']}}&deg;C</span>
                    </li>
                    <li class="flex items-center justify-center px-8 lg:px-11">
                        <img src="{{url('assets/icons/svg/windy-strong.svg')}}" class="">
                        <span class="ml-2">{{$bmkg['wind_speed_max']}} mph {{$bmkg['wind_to']}}</span>
                    </li>
                    <li class="flex items-center justify-center px-8 lg:px-11">
                        <img src="{{url('assets/icons/svg/stream.svg')}}" class="">
                        <span class="ml-2">{{$bmkg['current_speed_max']}} knot {{$bmkg['current_to']}}</span>
                    </li>
                    <li class="flex items-center justify-center px-8 lg:px-11">
                        <img src="{{url('assets/icons/svg/sea.svg')}}" class="">
                        <span class="ml-2">{{$bmkg['high_tide']}} M</span>
                    </li>
                    <li class="flex items-center justify-center px-8 lg:px-11">
                        <img src="{{url('assets/icons/svg/windy-strong.svg')}}" class="">
                        <span class="ml-2">{{$bmkg['rh_min']}}% - {{$bmkg['rh_max']}}%</span>
                    </li>
                    <li class="flex items-center justify-center px-8 lg:px-11">
                        <img src="{{url('assets/icons/svg/barometer.svg')}}" class="">
                        <span class="ml-2">{{$bmkg['rh_max']}} hpa</span>
                    </li>
                </ul>
            </marquee>
        </div>

        <div class="hidden lg:flex w-2/5 justify-center items-center space-x-4 h-full logo">
            <div class="text-logo">
                <h3 class="font-bold md:text-xl lg:text-2xl text-gray-900">INFORMATION AND SAFETY</h3>
                <span class="text-md font-semibold text-gray-800">DISNAV TG. PRIOK</span>
            </div>
            <img class="w-7" src="{{url('assets/images/logo-insaf-no-outline.png')}}">
        </div>

    </div>

    {{-- content dashboard --}}
    <div class="my-10 lg:my-5 mx-auto px-4 lg:px-7 content">
        <div class="grid grid-col-1 lg:grid-cols-3 gap-2">
            {{-- DATA AKTUAL =================================================================== --}}
            <!-- Card -->
            <div class="card px-1 w-full h-52">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-3/4 p-3 text-xl font-bold flex items-center justify-center rounded-tl-lg title text-center">
                        <h3>DISTRESS</h3>
                    </div>
                    <div class="w-1/4 p-3 text-xl font-bold flex items-center justify-center rounded-tr-lg actions">
                        {{-- assign counting data --}}
                        0
                        {{-- end assign counting data --}}
                    </div>
                </header>
                {{-- card body --}}
                <div class="w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    <ul class="overflow-hidden auto-scroll">
                        <marquee class="marquee-card" onmouseover="this.stop()" onmouseout="this.start()" behavior="scroll" scrolldelay="2" scrollamount="2" direction="up" loop="infinite">
                            {{-- assign data --}}
                            
                                <li class="py-3 px-5">
                                    <a href="#" target="_blank" class="flex items-center">
                                        <span class=" mr-3 flex items-center justify-center rounded-full h-10 w-10 bg-yellow-300">
                                            <img src="{{url('assets/icons/svg/ship.svg')}}" alt=""> 
                                        </span>
                                        <span> Tidak Ada Data !</span>
                                    </a>
                                </li>
                            
                            {{-- end assign data --}}
                        </marquee>
                    </ul>
                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card px-1 w-full h-52">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-3/4 p-3 text-xl font-bold flex items-center justify-center rounded-tl-lg title text-center">
                        <h3>MSI</h3>
                    </div>
                    <div class="w-1/4 p-3 text-xl font-bold flex items-center justify-center rounded-tr-lg actions">
                        {{-- assign counting data --}}
                        <?php
                        $jumlah_msi = 0;
                        foreach($data_msi as $totaldata){
                            $jumlah_msi += 1;
                        }
                        echo $jumlah_msi;
                        ?>
                        {{-- end assign counting data --}}
                    </div>
                </header>
                {{-- card body --}}
                <div class="w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    <ul class="overflow-hidden auto-scroll">
                        <marquee class="marquee-card" onmouseover="this.stop()" onmouseout="this.start()" behavior="scroll" scrolldelay="2" scrollamount="2" direction="up" loop="infinite">
                            {{-- assign data --}}
                            <?php $jumlah_msi = 0; ?>
                            @foreach ($data_msi as $msi)
                            <?php $jumlah_msi += 1; ?>
                                <li class="py-3 px-5">
                                    <a href="{{route('msi_detail.insaf', $msi['id'])}}" target="_blank" class="flex items-center">
                                        <span class=" mr-3 flex items-center justify-center rounded-full h-10 w-10 bg-yellow-300">
                                            <img src="{{url('assets/icons/svg/ship.svg')}}" alt=""> 
                                        </span>
                                        <span> {{$msi['information']}}</span>
                                    </a>
                                </li>
                            @endforeach
                            {{-- end assign data --}}
                        </marquee>
                    </ul>
                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card px-1 w-full h-52">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-3/4 p-3 text-xl font-bold flex items-center justify-center rounded-tl-lg title text-center">
                        <h3>CONTRAVENTION</h3>
                    </div>
                    <div class="w-1/4 p-3 text-xl font-bold flex items-center justify-center rounded-tr-lg actions">
                        {{-- assign counting data --}}
                        <?php
                        $jumlah_contravention = 0;
                        foreach($array as $totalcontravention){
                            $jumlah_contravention += 1;
                        }
                        echo $jumlah_contravention;
                        ?>
                        {{-- end assign counting data --}}
                    </div>
                </header>
                {{-- card body --}}
                <div class="w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    <ul class="overflow-hidden auto-scroll">
                        <marquee class="marquee-card" onmouseover="this.stop()" onmouseout="this.start()" behavior="scroll" scrolldelay="2" scrollamount="2" direction="up" loop="infinite">
                            {{-- assign data --}}
                            @foreach($array as $contravention)
                                <li class="py-3 px-5">
                                    <a href="{{route('contravention_detail.insaf',$contravention["id"])}}" target="_blank" class="flex items-center">
                                        <span class=" mr-3 flex items-center justify-center rounded-full h-10 w-10 bg-yellow-300">
                                            <img src="{{url('assets/icons/svg/contravention.svg')}}" alt=""> 
                                        </span>
                                        <span> {{$contravention['keterangan']}}</span>
                                    </a>
                                </li>
                            @endforeach
                            {{-- end assign data --}}
                        </marquee>
                    </ul>
                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card px-1 w-full h-52 mt-14">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-3/4 p-3 text-xl font-bold flex items-center justify-center rounded-tl-lg title text-center">
                        <h3>TRAFFIC</h3>
                    </div>
                    <div class="w-1/4 p-3 text-xl font-bold flex items-center justify-center rounded-tr-lg actions">
                        {{-- assign counting data --}}
                        <?php
                        $jumlah_traffic = 0;
                        foreach($data_traffic as $ttraffic){
                            $jumlah_traffic += 1;
                        }
                        echo $jumlah_traffic;
                        ?>
                        {{-- end assign counting data --}}
                    </div>
                </header>
                {{-- card body --}}
                <div class="w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    <ul class="overflow-hidden auto-scroll">
                        <marquee class="marquee-card" onmouseover="this.stop()" onmouseout="this.start()" behavior="scroll" scrolldelay="2" scrollamount="2" direction="up" loop="infinite">
                            {{-- assign data --}}
                            @foreach($data_traffic as $traffic)
                                <li class="py-3 px-5">
                                    <a href="#" target="_blank" class="flex items-center">
                                        <span class=" mr-3 flex items-center justify-center rounded-full h-10 w-10 bg-yellow-300">
                                            <img src="{{url('assets/icons/svg/ship.svg')}}" alt=""> 
                                        </span>
                                        <span>{{$traffic['mmsi']}}</span>
                                    </a>
                                </li>
                            @endforeach
                            {{-- end assign data --}}
                        </marquee>
                    </ul>
                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card px-1 w-full h-52 mt-14">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-3/4 p-3 text-xl font-bold flex items-center justify-center rounded-tl-lg title text-center">
                        <h3>MASTER CABLE</h3>
                    </div>
                    <div class="w-1/4 p-3 text-xl font-bold flex items-center justify-center rounded-tr-lg actions">
                        {{-- assign counting data --}}
                        <?php
                        $jumlah_srop = 0;
                        foreach($data_srop as $sropdata){
                            $jumlah_srop += 1;
                        }
                        echo $jumlah_srop;
                        ?>
                        {{-- end assign counting data --}}
                    </div>
                </header>
                {{-- card body --}}
                <div class="w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    <ul class="overflow-hidden auto-scroll">
                        <marquee class="marquee-card" onmouseover="this.stop()" onmouseout="this.start()" behavior="scroll" scrolldelay="2" scrollamount="2" direction="up" loop="infinite">
                            {{-- assign data --}}

                            @foreach($data_srop as $srop)
                            
                                <li class="py-3 px-5">
                                    <a href="#" target="_blank" class="flex items-center">
                                        <span class=" mr-3 flex items-center justify-center rounded-full h-10 w-10 bg-yellow-300">
                                            <img src="{{url('assets/icons/svg/master-cable.svg')}}" alt=""> 
                                        </span>
                                        <span> {{$srop['mmsi']}}</span>
                                    </a>
                                </li>
                            @endforeach
                            {{-- end assign data --}}
                        </marquee>
                    </ul>
                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card px-1 w-full h-52 mt-14">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-3/4 p-3 text-xl font-bold flex items-center justify-center rounded-tl-lg title text-center">
                        <h3>VTS PARTICIPATION</h3>
                    </div>
                    <div class="w-1/4 p-3 text-xl font-bold flex items-center justify-center rounded-tr-lg actions">
                        {{-- assign counting data --}}
                        <?php
                        $jumlah_vts = 0;
                        foreach($data_vts as $totaldata){
                            $jumlah_vts += 1;
                        }
                        echo $jumlah_vts;
                        ?>
                        {{-- end assign counting data --}}
                    </div>
                </header>
                {{-- card body --}}
                <div class="w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    <ul class="overflow-hidden auto-scroll">
                        <marquee class="marquee-card" onmouseover="this.stop()" onmouseout="this.start()" behavior="scroll" scrolldelay="2" scrollamount="2" direction="up" loop="infinite">
                            {{-- assign data --}}
                            @foreach($data_vts as $vts)
                                <li class="py-3 px-5">
                                    <a href="#" target="_blank" class="flex items-center">
                                        <span class=" mr-3 flex items-center justify-center rounded-full h-10 w-10 bg-yellow-300">
                                            <img src="{{url('assets/icons/svg/vts.svg')}}" alt=""> 
                                        </span>
                                        <span> {{$vts['mmsi']}}</span>
                                    </a>
                                </li>
                            @endforeach
                            {{-- end assign data --}}
                        </marquee>
                    </ul>
                </div>
            </div>
            <!-- end Card -->

            {{-- INFOGRAFIS =================================================================== --}}
            <!-- Card -->
            <div class="card px-1 w-full h-72 mt-14">
                {{-- card header  --}}
                <header class="flex items-center">
                    <div class="w-full text-xl p-2 lg:p-3 font-bold flex justify-end items-center rounded-tl-lg overflow-hidden title">
                        <h3 class="mr-5">SHIP ACTIVITY</h3>
                    </div>
                    <div class="w-auto relative font-bold " x-data="{ open: false }">
                        <button @click="open=true" id="dropdown-button" class=" flex rounded-tr-lg items-center justify-center bg-warmGray-900 hover:bg-warmGray-700 hover:text-yellow-400 px-5 py-4 lg:py-5 font-bold text-yellow-400 focus:outline-none hover:transition duration-300 ease-in-out">
                            <img src="{{ url('assets/icons/svg/filter.svg') }}" alt="">
                        </button>
                        <div x-show="open" @click.away="open = false" id="dropdown" class="z-20 dropdown absolute right-0 w-40 bg-gray-400 rounded-bl-md rounded-br-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Latest</a>
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Newest</a>
                        </div>
                    </div>
                </header>
                {{-- card body --}}
                
                {{-- COUNT INFOGRAFIS SHIP ACTIVITY --}}
                <?php
                    $berthing = $data_berthing;
                    $anchorage = $data_anchorage;
                    $underway = $data_underway;
                    $allShipActivity = $berthing + $anchorage + $underway; 
                ?>
                <div class="flex flex-col relative px-2 pt-10 items-center justify-center w-full h-full  card-content autoscroll rounded-b-lg ">
                    <div class="grid grid-cols-1 lg:grid-cols-2 w-full">
                        <div class=" flex items-center justify-center relative">
                                <canvas class="lg:absolute z-20" id="chartDoughnut_ship_activity"></canvas>
                                <div class="absolute z-10 inset-0 flex items-center justify-center">
                                    <span class="text-2xl font-medium text-gray-900"><?php echo $allShipActivity; ?></span>
                                </div>
                        </div>
                        <div class="space-y-5 justify-center items-center px-10">
                            <div class="flex justify-start items-center space-x-3">
                                <span class="w-5 h-5 rounded-md" style="background-color:#FDB815;"></span>
                                <div class="flex w-full justify-between items-center">
                                    <span class="text-lg text-gray-700">Berthing</span>
                                    <span class="text-lg text-gray-800 font-semibold"> <?php echo $berthing; ?></span>
                                </div>
                            </div>
                            <div class="flex justify-start items-center space-x-3">
                                <span class="w-5 h-5 rounded-md" style="background-color:#A5780B;"></span>
                                <div class="flex w-full justify-between items-center">
                                    <span class="text-lg text-gray-700">At Anchor</span>
                                    <span class="text-lg text-gray-800 font-semibold"> <?php echo $anchorage; ?></span>
                                </div>
                            </div>
                            <div class="flex justify-start items-center space-x-3">
                                <span class="w-5 h-5 rounded-md" style="background-color:#171717;"></span>
                                <div class="flex w-full justify-between items-center">
                                    <span class="text-lg text-gray-700">Underway </span>
                                    <span class="text-lg text-gray-800 font-semibold"> <?php echo $underway; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 w-full">
                        <div class="text-center mt-14">
                            <span class="text-sm text-gray-700 font-semibold" id="clock2"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card px-1 w-full h-72 mt-14">
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
                        <div x-show="open" @click.away="open = false" id="dropdown" data-dropdown-item="dropdown-items" class="z-20 dropdown absolute right-0 w-40 bg-gray-400 rounded-bl-md rounded-br-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Latest</a>
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Newest</a>
                        </div>
                    </div>
                </header>
                {{-- card body --}}
                <div class="flex items-center justify-center w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    
                    <div>
                        <div class="flex justify-center items-center">
                            <canvas class="p-2 -mt-9" id="chartLine"></canvas>
                        </div>
                        <div class="w-full flex items-center justify-between -mt-2">
                            <div class="space-x-4 w-full flex items-center">
                                <div class="flex justify-start items-center space-x-3">
                                    <span class="w-4 h-4 rounded-md" style="background-color:#FDB815;"></span>
                                    <span class="text-md text-gray-700">Distress</span>
                                </div>
                                <div class="flex justify-start items-center space-x-3">
                                    <span class="w-4 h-4 rounded-md" style="background-color:#94701c;"></span>
                                    <span class="text-md text-gray-700">PAN</span>
                                </div>
                                <div class="flex justify-start items-center space-x-3">
                                    <span class="w-4 h-4 rounded-md" style="background-color:#1b160b;"></span>
                                    <span class="text-md text-gray-700">Securite</span>
                                </div>
                            </div>
                            <div>
                                <span class="text-lg font-semibold">2021</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end Card -->
            <!-- Card -->
            <div class="card px-1 w-full h-72 mt-14">
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
                        <div id="dropdown" x-show="open" @click.away="open = false" class="z-40 dropdown absolute right-0 w-40 bg-gray-400 rounded-bl-md rounded-br-md overflow-hidden shadow">
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Latest</a>
                            <a href="#" class="block px-4 py-2 text-sm font-medium text-white border-b hover:bg-gray-200 hover:text-gray-800">Newest</a>
                        </div>
                    </div>
                </header>
                {{-- card body --}}
                <?php 
                $count_shipcall = $data_arrival;
                $count_contravention = $jumlah_contravention;
                $patuh = $count_shipcall - $count_contravention;
                $count_compliance = (($count_shipcall - $count_contravention) / $count_shipcall) * (100/100)
                ?>
                <div class="flex items-center space-x-3 justify-between w-full h-full card-content autoscroll overflow-hidden rounded-b-lg p-0">
                    

                    <div class="text-center">
                        <div class="relative flex justify-center relative">
                            <canvas class=" z-20" id="chartDoughnut_compliance"></canvas>
                            <div class="inset-0 absolute z-10 flex items-center justify-center">
                                <span class="text-2xl font-semibold">{{$data_arrival}}</span>
                            </div>
                        </div>
                        <span class="text-2xl font-normal mt-3">Compliance</span>
                    </div>

                    <div class="ship_call w-full text-center border-2 border-yellow-400">
                        <div class="header_shipcall py-3 bg-yellow-400">
                            <span class="text-xl font-semibold">2021</span>
                        </div>
                        <div class="body_shipcall px-3 py-6">
                            <h3 class="angka_ship_call text-8xl font-bold">{{$data_arrival}}</h3>
                        </div>
                        <div class="footer_shipcall py-3 bg-yellow-400">
                            <span class="text-xl font-semibold">Ship Call</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="relative flex justify-center relative">
                            <canvas class=" z-20" id="chartDoughnut_safety"></canvas>
                            <div class="inset-0 absolute z-10 flex items-center justify-center">
                                <span class="text-2xl font-semibold">150</span>
                            </div>
                        </div>
                        <span class="text-2xl font-normal mt-3">Safety</span>
                    </div>
                    

                </div>
            </div>
            <!-- end Card -->
    
            
        </div>
    </div>

{{-- alpine js --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
{{-- chartjs links --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


{{-- modify chat --}}
<script>
    // $('canvas#chartDoughnut_ship_activity').attr('style', 'height: 100px !important; width: 100px !important;')
    // $('#chartDoughnut_ship_activity').attr('width', '300');
    // $('#chartDoughnut_ship_activity').attr('height', '300');
</script>

{{-- dattime  --}}
<script>
    function startTime() {
    const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    ];
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
    //   document.getElementById('clock').innerHTML =
    //   h + ":" + m + ":" + s;
      document.getElementById('clock').innerHTML = today.getDate() + " " + monthNames[today.getMonth()] + " " + today.getFullYear() + "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;" + h + ":" + m + ":" + s;
      document.getElementById('clock2').innerHTML = today.getDate() + " " + monthNames[today.getMonth()] + " " + today.getFullYear() + "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;" + h + ":" + m;
      var t = setTimeout(startTime, 1000);
    }
    function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
</script>

{{-- fullscreen toggle --}}
<script>
    function toggleFullScreen() {
        
        if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
    }
</script>

{{-- chartjs --}}
<script>
    // doughnut chart ship activity =====================================================
    const dataDoughnut_ship_activity = {
        // labels: [
        // 'Berthing',
        // 'At Anchor',
        // 'Underway'
        // ],
        <?php
        $berthing = $data_berthing;
        $anchorage = $data_anchorage;
        $underway = $data_underway;
        $allShipActivity = $berthing + $anchorage + $underway; 
        ?>
        datasets: [
            {
                label: 'Ship Activity',
                data: [{{$berthing}}, {{$anchorage}}, {{$underway}}],
                backgroundColor: [
                    '#FDB815',
                    '#A5780B',
                    '#171717'
                ],
                hoverOffset: 4
            },
        ]
    };

    const configDoughnut_ship_activity = {
        type: 'doughnut',
        data: dataDoughnut_ship_activity,
        options: {
            // animation : animateRotate
        }
    };

    var chartBar_ship_activity = new Chart(
        document.getElementById('chartDoughnut_ship_activity'),
        configDoughnut_ship_activity
    );

    // doughnut chart compliance =====================================================
    const dataDoughnut_compliance = {
        // labels: [
        // 'Berthing',
        // 'At Anchor',
        // 'Underway'
        // ],
        datasets: [
            {
                label: 'Compliance',
                data: [{{$count_contravention}},{{$patuh}}],
                backgroundColor: [
                    '#FDB815',
                    '#171717'
                ],
                hoverOffset: 4
            },
        ]
    };

    const configDoughnut_compliance = {
        type: 'doughnut',
        data: dataDoughnut_compliance,
        options: {
            // animation : animateRotate
        }
    };

    var chartBar_compliance = new Chart(
        document.getElementById('chartDoughnut_compliance'),
        configDoughnut_compliance
    );
    
    // doughnut chart safety =====================================================
    const dataDoughnut_safety = {
        // labels: [
        // 'Berthing',
        // 'At Anchor',
        // 'Underway'
        // ],
        datasets: [
            {
                label: 'safety',
                data: [70,10],
                backgroundColor: [
                    '#FDB815',
                    '#171717'
                ],
                hoverOffset: 4
            },
        ]
    };

    const configDoughnut_safety = {
        type: 'doughnut',
        data: dataDoughnut_safety,
        options: {
            // animation : animateRotate
        }
    };

    var chartBar_safety = new Chart(
        document.getElementById('chartDoughnut_safety'),
        configDoughnut_safety
    );
    
    // linechart pan securite distress =================================================
    const labels = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'June',
        'July',
        'Aug',
        'Sept',
        'Oct',
        'Nov',
        'Dec',
    ];
    const data = {
        labels: labels,
        datasets: [
            {
                label: '.', // DIstress
                backgroundColor: '#FDB815',
                borderColor: '#FDB815',
                data: [0, 70, 0, 0, 17, 0, 0, 0, 0, 0, 0, 20],
            },
            {
                label: '.', // PAN
                backgroundColor: '#A5780B',
                borderColor: '#A5780B',
                data: [0, 0, 0, 0, 0, 20, 0, 10, 20, 0, 12, 78]
            },
            {
                label: '', //securite
                backgroundColor: '#171717',
                borderColor: '#171717',
                data: [10, 20, 10, 20, 10, 20, 10, 20, 10, 20, 10, 20],
            },
        ]
    };

    const configLineChart = {
        type: 'line',
        data,
        options: {
            scales: {
            y: {
                stacked: true
            }
        }
        }
    };

    var chartLine = new Chart(
        document.getElementById('chartLine'),
        configLineChart
    );
</script>

</body>
</html>

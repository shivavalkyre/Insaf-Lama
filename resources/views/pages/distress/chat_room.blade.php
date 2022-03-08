<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title??'INSAF'}}</title>
    <link rel="shortcut icon" href="{{url('assets/images/insaf-light.png')}}" type="image/x-icon">
    @stack('before_styles')
    {{-- tailwind css --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- custom insaf css --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- datatable --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/af-2.3.7/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fc-3.3.3/fh-3.1.9/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.4/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css"/>
 
    <style>
        textarea::placeholder {
            color: black;
        }
    </style>

    @stack('after_styles')

</head>

<body class="bg-gray-300">

    <div class="flex justify-center relative">
        <div class="header-chat flex w-full  z-50 flex-col fixed">
            <div class="block-head flex items-center bg-yellow-400">
                <div class="py-1 px-2 flex items-center justify-center flex-grow w-16 h-full">
                    <a class="hover:bg-yellow-400 duration-75 p-4 rounded-md text-lg" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 18.343 12.398">
                            <path id="Icon_material-keyboard-backspace" data-name="Icon material-keyboard-backspace" d="M22.843,14.166H8.4l3.648-3.709L10.614,9,4.5,15.2l6.114,6.2,1.437-1.457L8.4,16.232h14.44Z" transform="translate(-4.5 -9)"/>
                          </svg>                      
                    </a>
                </div>
                <div class="py-1 px-2 flex items-center justify-center flex-shrink w-full h-full">
                    <h1 class="text-gray-900 font-bold text-lg lg:text-xl">Distress Chat Room</h1>
                </div>
                <div class="py-1 px-2 flex items-center justify-center flex-grow w-16 h-full">
                    <a class="hover:bg-yellow-400 duration-75 p-4 rounded-md text-lg" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="18" viewBox="0 0 4 16">
                        <g id="Group_2840" data-name="Group 2840" transform="translate(-10483 -6164)">
                          <circle id="Ellipse_52" data-name="Ellipse 52" cx="2" cy="2" r="2" transform="translate(10483 6164)" fill="#171717"/>
                          <circle id="Ellipse_52-2" data-name="Ellipse 52" cx="2" cy="2" r="2" transform="translate(10483 6170)" fill="#171717"/>
                          <circle id="Ellipse_52-3" data-name="Ellipse 52" cx="2" cy="2" r="2" transform="translate(10483 6176)" fill="#171717"/>
                        </g>
                      </svg>
                    </a>
                </div>
            </div>
            <div class="block-info flex items-center justify-between bg-gray-100 shadow-md">
                <div class="space-y-1 px-3 py-2">
                    <h2 class="text-gray-700 text-sm lg:text-lg font-semibold">001 DSC/Priok - Tabrakan Estuari Mas...</h2>
                    <span class="text-gray-500 text-xs lg:text-md font-medium">23/05/2021 19:37  |  Depan Pulau Untung Jawa</span>
                </div>
                <div class="py-1 px-3 flex items-center justify-center" x-data="{ open: false }">
                    <button type="button" @click="open=true" class="bg-yellow-400 hover:bg-yellow-400 duration-75 focus:ring-4 focus:ring-yellow-100 p-2 rounded-lg text-lg focus:outline-none" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 13.882 13.882">
                            <g id="ship-on-port" transform="translate(-34 -340.832)">
                              <g id="cargo-ship" transform="translate(34 340.832)">
                                <path id="Path_6" data-name="Path 6" d="M13.475,462a1.686,1.686,0,0,0-1.042.339.966.966,0,0,1-1.185,0,1.771,1.771,0,0,0-2.084,0,.963.963,0,0,1-1.183,0,1.769,1.769,0,0,0-2.083,0,.963.963,0,0,1-1.183,0A1.684,1.684,0,0,0,3.673,462a1.684,1.684,0,0,0-1.041.339.9.9,0,0,1-.591.2.9.9,0,0,1-.591-.2A1.684,1.684,0,0,0,.407,462a.407.407,0,1,0,0,.813.9.9,0,0,1,.591.2,1.684,1.684,0,0,0,1.041.339,1.684,1.684,0,0,0,1.041-.339.9.9,0,0,1,.591-.2.9.9,0,0,1,.591.2,1.684,1.684,0,0,0,1.041.339,1.685,1.685,0,0,0,1.042-.339.962.962,0,0,1,1.183,0,1.77,1.77,0,0,0,2.083,0,.965.965,0,0,1,1.185,0,1.772,1.772,0,0,0,2.085,0,.9.9,0,0,1,.593-.2.407.407,0,0,0,0-.813Z" transform="translate(0 -449.474)" fill="#171717"/>
                                <circle id="Ellipse_1" data-name="Ellipse 1" cx="0.407" cy="0.407" r="0.407" transform="translate(6.534 3.579)" fill="#171717"/>
                                <circle id="Ellipse_2" data-name="Ellipse 2" cx="0.407" cy="0.407" r="0.407" transform="translate(8.161 3.579)" fill="#171717"/>
                                <circle id="Ellipse_3" data-name="Ellipse 3" cx="0.407" cy="0.407" r="0.407" transform="translate(4.907 3.579)" fill="#171717"/>
                                <path id="Path_7" data-name="Path 7" d="M.407,11.442a.9.9,0,0,1,.591.2,1.684,1.684,0,0,0,1.041.339,1.684,1.684,0,0,0,1.041-.339.9.9,0,0,1,.591-.2.9.9,0,0,1,.591.2,1.684,1.684,0,0,0,1.041.339,1.684,1.684,0,0,0,1.042-.339.962.962,0,0,1,1.183,0,1.769,1.769,0,0,0,2.083,0,.965.965,0,0,1,1.185,0,1.772,1.772,0,0,0,2.085,0,.9.9,0,0,1,.593-.2.407.407,0,1,0,0-.813,1.686,1.686,0,0,0-1.042.339.965.965,0,0,1-1.185,0,1.983,1.983,0,0,0-.484-.254L11.93,7.655a.407.407,0,0,0-.225-.521L10.33,6.568V2.359a.407.407,0,0,0-.407-.407H8.7V.407A.407.407,0,0,0,8.3,0H5.585a.407.407,0,0,0-.407.407V1.952H3.958a.407.407,0,0,0-.407.407V6.568l-1.375.566a.407.407,0,0,0-.225.521l1.163,3.058a1.981,1.981,0,0,0-.484.254.9.9,0,0,1-.591.2.9.9,0,0,1-.591-.2,1.684,1.684,0,0,0-1.041-.339.407.407,0,1,0,0,.813Zm9.51-.793a1.726,1.726,0,0,0-.754.318.963.963,0,0,1-1.183,0,1.8,1.8,0,0,0-.632-.3V6.22l3.681,1.516ZM5.992.813h1.9V1.952h-1.9ZM4.365,2.766H9.517V6.233l-2.421-1a.407.407,0,0,0-.31,0l-2.421,1ZM6.534,6.22v4.451a1.8,1.8,0,0,0-.637.3.963.963,0,0,1-1.183,0,1.725,1.725,0,0,0-.753-.318L2.853,7.736Z" transform="translate(0 0)" fill="#171717"/>
                              </g>
                            </g>
                          </svg>
                                             
                    </button>
                    <div x-show="open" @click="open=false"  x-init="setTimeout(() => show = false, 8000)" 
                        x-transition:enter="transition duration-200 transform ease-out"
                        x-transition:enter-start="scale-75"
                        x-transition:leave="transition duration-100 transform ease-in"
                        x-transition:leave-end="opacity-0 scale-90" class=" overlay-modal fixed flex items-center justify-center z-50 w-screen h-screen bg-gray-900 bg-opacity-50 flex inset-0 px-5">
                        <div class="modal relative bg-white overflow-hidden rounded-xl w-96 h-4/5 z-50">
                            <div class="modal-header flex items-center justify-between py-3 px-4 bg-gray-100">
                                <div>
                                    <span class="text-xs lg:text-sm font-medium text-gray-600">TGPRK/DISTRESS/2021.7.10/1</span>
                                </div>
                                <div>
                                    <a href="#" @click="open=false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="py-1 px-4 flex flex-col modal-body h-full pb-32 overflow-y-auto">

                                <h1 class="text-md text-yellow-500 font-semibold mb-2">Tabrakan Estuari Mas Dngan Minas Baru Misalnya.</h1>
                                <hr>

                                <div class="grid grid-cols-2 mt-3">
                                    <div class="h-auto py-2">
                                        <h5 class="text-sm text-gray-800 font-semibold">Kapal Distress :</h5>
                                        <ul>
                                            <li class="text-sm text-gray-600">- MV Test 1</li>
                                            <li class="text-sm text-gray-600">- MV Test 2</li>
                                        </ul>
                                    </div>
                                    <div class="h-auto py-2">
                                        <h5 class="text-sm text-gray-800 font-semibold">Waktu Kejadian :</h5>
                                        <p class="text-sm text-gray-600">Senin, 21 Juli 2021</p>
                                    </div>
                                    <div class="h-auto py-2">
                                        <h5 class="text-sm text-gray-800 font-semibold">Jenis Distress :</h5>
                                        <p class="text-sm text-gray-600">Collision</p>
                                    </div>
                                    <div class="h-auto py-2">
                                        <h5 class="text-sm text-gray-800 font-semibold">Lokasi Kejadian :</h5>
                                        <p class="text-sm text-gray-600">Priok</p>
                                    </div>
                                    <div class="h-auto py-2 col-span-2">
                                        <h5 class="text-sm text-gray-800 font-semibold">Sumber Informasi Awal :</h5>
                                        <p class="text-sm text-gray-600">Kapal yang Mengalami Distress</p>
                                    </div>
                                    <div class="h-auto py-2 col-span-2">
                                        <h5 class="text-sm text-gray-800 font-semibold">Deskripsi Kejadian :</h5>
                                        <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum deserunt alias eum aliquam, doloremque, sit dolor explicabo incidunt dolores repellat, inventore rerum. Natus obcaecati consequuntur odio sint neque numquam quasi.</p>
                                    </div>
                                    <div class="h-auto py-2 col-span-2">
                                        <div class="overflow-hidden rounded-lg flex items-center justify-center h-50 w-full">
                                            <img src="{{url('assets/images/kapal-nelayan.jpg')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                            <div class="modal-footer absolute bottom-0 inset-x-0 bg-gray-100 flex items-center justify-center py-3 px-3 space-x-2">
                                {{-- <button @click="open=false" type="button" class="transition duration-100 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:bg-gray-500 hover:bg-gray-400 text-gray-800 font-medium hover:text-white  flex items-center justify-center py-2 px-5 rounded-lg">
                                    Batal
                                </button> --}}
                                <button type="button" @click="open=false" class="w-full duration-100 focus:outline-none focus:ring-4 focus:ring-red-400 focus:bg-red-500 bg-red-600 hover:bg-red-500 text-white font-medium hover:text-white  flex items-center justify-center py-3 px-5 rounded-lg">
                                    End Distress
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-chat w-full h-full">
            <div class="flex flex-col my-24 p-4">
                <div class="flex justify-start w-full">
                    <div class="w-full max-w-xs justify-start lg:max-w-md mt-4">
                        <div class="relative flex items-start space-x-3 bg-white duration-75 shadow-lg rounded-xl h-auto py-2 px-2">
                            <div class="px-1">
                                <div class="overflow-hidden rounded-full w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center">
                                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="w-full flex flex-col">
                                <div class="flex items-center justify-between space-x-6">
                                    <h5 class="text-sm lg:text-base font-bold text-gray-600">Tedy Hidayat</h5>
                                    <span class="font-semibold text-gray-900 text-xs bg-yellow-400 rounded-md p-1">
                                        OSC
                                    </span>
                                </div>
                                <hr class="my-2">
                                <p class="text-sm lg:text-base text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, cupiditate. Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, molestiae?</p>
                                <div class="flex items-center justify-end">
                                    <small class="text-xs lg:text-sm text-warmGray-400">20:00</smal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="flex justify-end w-full">
                    <div class="w-full max-w-xs justify-end lg:max-w-md mt-4">
                        <div class="relative flex items-start space-x-3 bg-white duration-75 shadow-lg rounded-xl h-auto py-2 px-2">
                            <div class="px-1">
                                <div class="overflow-hidden rounded-full w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center">
                                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="w-full flex flex-col">
                                <div class="flex items-center justify-between space-x-6">
                                    <h5 class="text-sm lg:text-base font-bold text-gray-600">Tedy Hidayat</h5>
                                </div>
                                <hr class="my-2">
                                <p class="text-sm lg:text-base text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, cupiditate. </p>
                                <div class="flex items-center justify-end">
                                    <small class="text-xs lg:text-sm text-warmGray-400">20:10</smal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end w-full">
                    <div class="w-full max-w-xs justify-start lg:max-w-md mt-4">
                        <div class="relative flex items-start space-x-3 bg-white duration-75 shadow-lg rounded-xl h-auto py-2 px-2">
                            <div class="px-1">
                                <div class="overflow-hidden rounded-full w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center">
                                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="w-full flex flex-col">
                                <div class="flex items-center justify-between space-x-6">
                                    <h5 class="text-sm lg:text-base font-bold text-gray-600">Tedy Hidayat</h5>
                                </div>
                                <hr class="my-2">
                                <p class="text-sm lg:text-base text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, cupiditate. </p>
                                <div class="flex items-center justify-end">
                                    <small class="text-xs lg:text-sm text-warmGray-400">20:10</smal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-start w-full">
                    <div class="w-full max-w-xs justify-end lg:max-w-md mt-4">
                        <div class="relative flex items-start space-x-3 bg-white duration-75 shadow-lg rounded-xl h-auto py-2 px-2">
                            <div class="px-1">
                                <div class="overflow-hidden rounded-full w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center">
                                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="w-full flex flex-col">
                                <div class="flex items-center justify-between space-x-6">
                                    <h5 class="text-sm lg:text-base font-bold text-gray-600">Tedy Hidayat</h5>
                                </div>
                                <hr class="my-2">
                                <p class="text-sm lg:text-base text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, cupiditate. </p>
                                <div class="flex items-center justify-end">
                                    <small class="text-xs lg:text-sm text-warmGray-400">20:10</smal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end w-full">
                    <div class="w-full max-w-xs justify-start lg:max-w-md mt-4">
                        <div class="relative flex items-start space-x-3 bg-white duration-75 shadow-lg rounded-xl h-auto py-2 px-2">
                            <div class="px-1">
                                <div class="overflow-hidden rounded-full w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center">
                                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="w-full flex flex-col">
                                <div class="flex items-center justify-between space-x-6">
                                    <h5 class="text-sm lg:text-base font-bold text-gray-600">Tedy Hidayat</h5>
                                </div>
                                <hr class="my-2">
                                <p class="text-sm lg:text-base text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, cupiditate. </p>
                                <div class="flex items-center justify-end">
                                    <small class="text-xs lg:text-sm text-warmGray-400">20:10</smal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-start w-full">
                    <div class="w-full max-w-xs justify-start lg:max-w-md mt-4">
                        <div class="relative flex items-start space-x-3 bg-white duration-75 shadow-lg rounded-xl h-auto py-2 px-2">
                            <div class="px-1">
                                <div class="overflow-hidden rounded-full w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center">
                                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="w-full flex flex-col">
                                <div class="flex items-center justify-between space-x-6">
                                    <h5 class="text-sm lg:text-base font-bold text-gray-600">Tedy Hidayat</h5>
                                </div>
                                <hr class="my-2">
                                <p class="text-sm lg:text-base text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, cupiditate. </p>
                                <div class="flex items-center justify-end">
                                    <small class="text-xs lg:text-sm text-warmGray-400">20:10</smal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end w-full">
                    <div class="w-full max-w-xs justify-end lg:max-w-md mt-4">
                        <div class="relative flex items-start space-x-3 bg-white duration-75 shadow-lg rounded-xl h-auto py-2 px-2">
                            <div class="px-1">
                                <div class="overflow-hidden rounded-full w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center">
                                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="w-full flex flex-col">
                                <div class="flex items-center justify-between space-x-6">
                                    <h5 class="text-sm lg:text-base font-bold text-gray-600">Tedy Hidayat</h5>
                                </div>
                                <hr class="my-2">
                                <p class="text-sm lg:text-base text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, cupiditate. </p>
                                <div class="flex items-center justify-end">
                                    <small class="text-xs lg:text-sm text-warmGray-400">20:10</smal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="newLineChat"></div>
            </div>
        </div>

        <div class="text-chat fixed inset-x-0 bottom-0 px-4 py-2 flex w-full px-0" id="sectionMessage">
            <form action="" class="flex items-center justify-between space-x-2 w-full px-0">
                <textarea name="" id="textMessage" cols="30" rows="1" autofocus="on" placeholder="Type message..." class="shadow-sm bg-yellow-400 w-full p-4 rounded-md focus:outline-none text-gray-900 font-semibold"></textarea>
                <div class="w-auto flex items-center justify-center">
                    <button type="button" onclick="sendMessage()" id="sendMessage" class="h-10 lg:h-12 w-10 lg:w-12 p-2 flex items-center justify-center rounded-full bg-gray-900 focus:outline-none hover:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-auto h-auto"  viewBox="0 0 22.779 22.779">
                            <path id="Path_654" data-name="Path 654" d="M10.054,15.54l7.054,1.567L10.054,3,3,17.107Zm0,0V9.27" transform="translate(11.389 -2.828) rotate(45)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                          </svg>
                          
                    </button>
                </div>
            </form>
        </div>
    </div>

    <a id="showNewMessage" href="#sectionMessage"></a>


    @stack('before_scripts')
    {{-- alpine js --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script> --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{-- select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- datatable --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/af-2.3.7/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fc-3.3.3/fh-3.1.9/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.4/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table-1').DataTable();
        } );
    </script>

    <script>

        $('#sendMessage').click(function() {
            var textMessage = $('#textMessage').val();
            var newChat = '<div id="containerChat" class="flex justify-end w-full">' +
                            '    <div class="w-full max-w-xs justify-end lg:max-w-md mt-4">' +
                            '        <div class="relative flex items-start space-x-3 bg-white duration-75 shadow-lg rounded-xl h-auto py-2 px-2">' +
                            '            <div class="px-1">' +
                            '                <div class="overflow-hidden rounded-full w-10 lg:w-12 h-10 lg:h-12 flex items-center justify-center">' +
                            '                    <img src="{{asset('assets/images/tedy.jpg')}}" alt="">' +
                            '                </div>' +
                            '            </div>' +
                            '            <div class="w-full flex flex-col">' +
                            '                <div class="flex items-center justify-between space-x-6">' +
                            '                    <h5 class="text-sm lg:text-base font-bold text-gray-600">Tedy Hidayat</h5>' +
                            '                </div>' +
                            '                <hr class="my-2">' +
                            '                <p class="text-sm lg:text-base text-gray-700">' + textMessage + '</p>' +
                            '                <div class="flex items-center justify-end">' +
                            '                    <small class="text-xs lg:text-sm text-warmGray-400">20:10</smal>' +
                            '                </div>' +
                            '            </div>' +
                            '        </div>' +
                            '    </div>' +
                            ' </div>';

            $('#newLineChat').append(newChat);
            $('#showNewMessage').find('a').trigger('click');
        })
    </script>

    @stack('after_scripts')

</body>

</html>

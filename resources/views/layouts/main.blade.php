<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title??'INSAF'}}</title>
    <link rel="shortcut icon" href="{{url('assets/images/insaf-light.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @stack('before_styles')
    {{-- tailwind css --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- custom insaf css --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- datatable --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/af-2.3.7/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fc-3.3.3/fh-3.1.9/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.4/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css"/>
 
    @stack('after_styles')

</head>

<body>

    {{-- container --}}
    <div class="flex min-w-screen min-h-screen bg-gray-200 wrapper-admin relative">
        {{-- sidebar --}}
        <aside class="hidden lg:block relative sidebar w-64 h-full ">
            {{-- logo/menu/footer-menu --}}
            @include('layouts.parts.sidebar')
        </aside>
        {{-- content --}}
        <div class="content flex-1">
            {{-- navbar --}}
            @include('layouts.parts.navbar')
            {{-- component --}}
            <div class="p-5">
                {{-- <div class="p-5 mb-5 b-white">
                    <h3 class="text-lg">{{session()->get('token')}}</h3>
                    <h3 class="text-lg">{{session()->get('level')}}</h3>
                    <a href="{{route('logout.insaf')}}">logout</a>
                </div> --}}
                @include('layouts.parts.alerts')
                @yield('content')
            </div>
        </div>
    </div>

    <!--Modal-->
    
    

    @stack('before_scripts')
    {{-- alpine js --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script> --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{-- select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- datatable --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/af-2.3.7/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fc-3.3.3/fh-3.1.9/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.4/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $(document).ready( function () {
            $('#table-1').DataTable();
        } );
        
        $(document).ready( function () {
            $('#table-2').DataTable({
                "searching": false,
                "lengthChange": false,
            });
        } );

        oTable = $('#table-3').DataTable({
                "searching": true,
                "lengthChange": false,
        }); 
        $('#saerchOutside').keyup(function(){
            oTable.search($(this).val()).draw() ;
        })
    </script>
    <script>
        var btnSidebar = document.querySelector('.btn-sidebar');
        var sidebar = document.querySelector('.sidebar');
        var iconSidebar = document.querySelector('.icon-sidebar');
        var labelSidebar = document.querySelector('.label-sidebar');
        var logoBrand = document.querySelector('.logo-brand');
        var logoTitle = document.querySelector('.logo-title');
        var chatPopup = document.querySelector('.dropdown-chat');
        var notifPopup = document.querySelector('.dropdown-notif');
        var profilePopup = document.querySelector('.dropdown-profile');
        var sidebarDropdown = document.querySelector('.btn-dropdown-sidebar');
        var sidebarDivDropdown = document.querySelector('.dropdown-sidebar');

        var toggleSidebar = () => {
            sidebar.classList.toggle("lg:hidden");
            sidebar.classList.toggle("hidden");
            sidebar.classList.toggle("z-10");
        }
        
        var toggleProfile = () => {
            profilePopup.classList.toggle("hidden");
        }
        var toggleNotif = () => {
            notifPopup.classList.toggle("hidden");
        }
        var toggleChat = () => {
            chatPopup.classList.toggle("hidden");
        }
        
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
    <!-- preview image upload -->
    <script>
        jQuery(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        $('#imgPrev').empty();
                        reader.onload = function(event) {
                            $($.parseHTML('<img class="w-full ">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            jQuery(document).on('change','.fileupload',function() {
                imagesPreview(this, 'div#imgPrev');
            });
        });
    </script>
    @stack('after_scripts')

</body>

</html>

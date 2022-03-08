@extends('layouts.main', ['title' => " Detail | User"])

@section('content')

<div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3">
    <div class="flex py-7 px-12">
        <h1 class="text-3xl font-medium text-yellow-500">{{$title}}</h1>
    </div>
    <div class="flex flex-col px-10 pb-10">
        <table class="w-full">
            <tbody>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Nomor Jurnal</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">001231</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Waktu Kejadian</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">27 Juni 2021</span>
                    </td>
                </tr>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Jenis PAN</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">Man over Board</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Sumber Infornasi Awal</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">91239</span>
                    </td>
                </tr>
                <tr class="">
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Keterangan Lainnya</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">Di Kepulauan Seribu dekat pulau Untung jawa, DKI Jakarta</span>
                    </td>
                </tr>
                <tr class="">
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Longitude</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">
                          45o 30' 45'' E
                        </span>
                    </td>
                </tr>
                <tr class="">
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Latitude</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">
                          45o 30' 45'' S
                        </span>
                    </td>
                </tr>
                <tr class="">
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Memerlukan Tindakan</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">Yes</span>
                    </td>
                </tr>

                <tr>
                  <td colspan="2">
                    <h1 class="mx-2 my-10 text-3xl font-medium text-yellow-500">Respon Tidak Lanjut</h1>
                  </td>
                </tr>

                <tr class="">
                  <td class="py-4 px-3">
                      <span class="text-lg mb-2 font-bold text-yellow-400">Master OnBoard</span> 
                      <br>
                      <span class="text-2xl font-bold mt-2">-</span>
                  </td>
                  <td class="py-4 px-3">
                      <span class="text-lg mb-2 font-bold text-yellow-400">No Handphone</span>
                      <br>
                      <span class="text-2xl font-bold mt-2">-</span>
                  </td>
              </tr>
              <tr class="">
                  <td class="py-4 px-3">
                      <span class="text-lg mb-2 font-bold text-yellow-400">2nd Officer</span> 
                      <br>
                      <span class="text-2xl font-bold mt-2">-</span>
                  </td>
                  <td class="py-4 px-3">
                      <span class="text-lg mb-2 font-bold text-yellow-400">No Handphone</span>
                      <br>
                      <span class="text-2xl font-bold mt-2">-</span>
                  </td>
              </tr>
            </tbody>
        </table>



    </div>
</div>
<div class="rounded-lg w-full overflow-hidden h-auto space-y-3 py-5 mt-4 px-2 bg-">
    <a href="{{route('pan.insaf')}}" class="px-10 py-3 rounded-lg font-bold hover:bg-yellow-300 bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300">Kembali</a>
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

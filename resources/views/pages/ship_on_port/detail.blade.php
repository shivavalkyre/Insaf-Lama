@extends('layouts.main', ['title' => $title ." | ". "Ship on Port"])

@section('content')

<div class="space-y-5">
    {{-- main data --}}
    <div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3">
        <div class="flex py-7 px-12">
            <h1 class="text-3xl font-medium text-yellow-400">001 SOP / Priok - KM. Abadi</h1>
        </div>
        <div class="flex px-10 pb-10">
            <table class="w-full">
                <tbody>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">IMO</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Call Sign</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Bendera</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">MMSI</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Jumlah Kru</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Jumlah Penumpang</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Pelabuhan Asal</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Pelabuhan Tujuan</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Status Navigasi</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Muatan</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Master on Board</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">No. Handphone</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">2nd Officer</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">No. Handphone</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Longitude</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Latitude</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td colspan="2" class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Alasan Olah Gerak</span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
    
    {{-- child data --}}
    <div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3">
        <div class="flex py-7 px-12">
            <h1 class="text-3xl font-medium text-yellow-400">LOKASI SEA TRIAL</h1>
        </div>
        <div class="flex px-10 pb-10">
            <table class="w-full">
                <tbody>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Longitude </span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Latitude</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Rencana Durasi </span> 
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                        <td class="py-4 px-3">
                            <span class="text-lg mb-2 font-bold text-yellow-400">Sea Trial dilakukan dalam kondisi</span>
                            <br>
                            <span class="text-2xl font-bold mt-2">(data)</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="rounded-lg w-full overflow-hidden h-auto space-y-3 py-5 mt-4 px-2 bg-">
    <a href="{{route('ship_on_port.insaf')}}" class="px-10 py-3 rounded-lg font-bold hover:bg-yellow-300 bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300">Kembali</a>
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

@endpush



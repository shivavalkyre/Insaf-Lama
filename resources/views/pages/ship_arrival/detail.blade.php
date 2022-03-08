@extends('layouts.main', ['title' => 'Ship Arrival' ." | ". "INSAF"])

@section('content')

<div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3">
    <div class="flex items-center justify-center py-7 text-center px-12">
        <h1 class="text-3xl font-bold text-gray-900">INSAF</h1>
    </div>
    <div class="flex px-10 pb-10">
        <table class="w-full">
            <tbody>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Nomor Jurnal</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">001231</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Waktu Keberangaktan</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">27 Juni 2021</span>
                    </td>
                </tr>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Perusahaan Pelayaran</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">99910231</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">IMO</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">91239</span>
                    </td>
                </tr>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Call Sign</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">213523</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Bendera</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">Indonesia</span>
                    </td>
                </tr>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">MMSI</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">14134</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">GT</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">91231</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="rounded-lg w-full overflow-hidden h-auto space-y-3 py-5 mt-4 px-2 bg-">
    <a href="{{route('ship_arrival.insaf')}}" class="px-10 py-3 rounded-lg font-bold hover:bg-yellow-300 bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300">Kembali</a>
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



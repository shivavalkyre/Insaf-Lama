@extends('layouts.main', ['title' => $title ." | ". "Ship Departure"])

@section('content')

<div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3">
    <div class="flex py-7 px-12">
        <h1 class="text-3xl font-medium text-yellow-400">{{$title}}</h1>
    </div>
    <div class="flex px-10 pb-10">
        <table class="w-full">
            <tbody>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Nomor Jurnal</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $shipdata['no_jurnal'] }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Waktu Keberangaktan</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ \Carbon\carbon::parse(strtotime($shipdata["tanggal_berangkat"]))->setTimezone('Asia/Jakarta')->translatedFormat('l, d F Y | H:i') }}</span>
                    </td>
                </tr>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Perusahaan Pelayaran</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $shipdata['nama_perusahaan'] }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">IMO</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $shipdata['imo'] }}</span>
                    </td>
                </tr>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Call Sign</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $shipdata['call_sign'] }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Bendera</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $shipdata['flag'] }}</span>
                    </td>
                </tr>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">MMSI</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $shipdata['mmsi'] }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">GT</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $shipdata['gt'] }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="rounded-lg w-full overflow-hidden h-auto space-y-3 py-5 mt-4 px-2 bg-">
    <a href="{{ route('ship_departure.insaf') }}" class="px-10 py-3 rounded-lg font-bold hover:bg-yellow-300 bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300">Kembali</a>
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



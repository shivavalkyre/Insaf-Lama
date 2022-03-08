@extends('layouts.main', ['title' => 'Securite' ." | ". "INSAF"])

@section('content')

<div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3">
    <div class="flex items-center py-7 px-12">
        <h1 class="text-3xl font-bold text-yellow-500">001 SC/Priok - Pelabuhan Tanjung Priok</h1>
    </div>
    <div class="flex px-10 pb-10">
        <table class="w-full">
            <tbody>
                <tr class="">
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Jenis Securite</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['jenis_securite'] }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Sumber Informasi Awal</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['sumber_informasi_awal'] }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Waktu Kejadian</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['waktu_kejadian'] }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Keterangan</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['keterangan_lainnya'] }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="py-4 px-3">
                        <h1 class="my-3 text-2xl font-bold text-yellow-500">SMS Voyager Securite </h1>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Call Sign</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['call_sign'] }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Bendera</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['flag'] }}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">MMSI</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['mmsi'] }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Longitude</span> 
                        <br>
                        <span class="text-3xl font-bold mt-2">{!! $data['degree1'] .'&deg; '. $data['minute1'] ."' ". $data['second1'] .'" '. $data['direction1'] !!}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Latitude</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{!! $data['degree2'] .'&deg; '. $data['minute2'] ."' ". $data['second2'] .'" '. $data['direction2'] !!}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Status Navigasi</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['status_navigasi'] }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="py-4 px-3">
                        <h1 class="my-3 text-3xl font-bold text-yellow-500">{{ $data['lokasi_terlapor'] }}</h1>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Longitude</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{!! $data['degree3'] .'&deg; '. $data['minute3'] ."' ". $data['second3'] .'" '. $data['direction3'] !!}</span>
                    </td>
                    <td class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Latitude</span>
                        <br>
                        <span class="text-2xl font-bold mt-2">{!! $data['degree4'] .'&deg; '. $data['minute4'] ."' ". $data['second4'] .'" '. $data['direction4'] !!}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Assesmen Situasi</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">-</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Memerlukan Tidakan ?</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">{{ $data['memerlukan_tindakan'] }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="rounded-lg w-full overflow-hidden h-auto space-y-3 py-5 mt-4 px-2 bg-">
    <a href="{{route('securite.insaf')}}" class="px-10 py-3 rounded-lg font-bold hover:bg-yellow-300 bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300">Kembali</a>
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



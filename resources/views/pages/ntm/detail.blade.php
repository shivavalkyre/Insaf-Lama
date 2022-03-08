@extends('layouts.main', ['title' => $data_parent['no_jurnal'] ." | ". "NTM"])

@section('content')

<div class="rounded-lg relative bg-white w-full overflow-hidden h-auto space-y-3">
    <div class="flex py-7 px-12">
        <h1 class="text-3xl font-medium text-yellow-400">{{$data_parent['title']}} | {{$data_parent['no_jurnal']}}</h1>
    </div>
    <div class="flex px-10 pb-10">
        <table class="w-full">
            <tbody>
                <tr class="">
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Keterangan Notice To Mariner</span> 
                        <br>
                        <span class="text-2xl font-bold mt-2">
                            {{$data_parent['keterangan']}}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="py-4 px-3">
                        <span class="text-lg mb-2 font-bold text-yellow-400">Attachment</span> 
                        <br>
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-md bg-gray-200 flex items-center justify-center p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                  </svg>
                            </div>
                            <a target="_blank" href="{{route('download.file', $data_parent['dokumen'])}}" class="text-gray-400 hover:underline hover:text-gray-600">{{$data_parent['dokumen']}}</a>
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>
<div class="rounded-lg w-full overflow-hidden h-auto space-y-3 py-5 mt-4 px-2 bg-">
    <a href="{{route('ntm.insaf')}}" class="px-10 py-3 rounded-lg font-bold hover:bg-yellow-300 bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300">Kembali</a>
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



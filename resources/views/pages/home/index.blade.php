@extends('layouts.main', ['title' => 'Home - INSAF'])

@section('content')
    <div class="p-6 rounded-lg bg-white w-full h-auto">
        <h1 class="text-3xl font-bold mb-3">INFORMATION AND SAFETY</h1>
        @for ($i = 1; $i < 1; $i++)
            <p class="my-3">Sistem Pertukaran Data Lalulintas Pelayaran untuk kepentingan Keselamatan Pelayaran, Kelancaran 
                Lalulintas Pelayaran, Perlindungan Lingkungan Maritim, Keamanan Pelayaran, dan berbagai kepentingan 
                terkait lainnya (VTS Allied Services) yang dikelola dan diselenggarakan oleh Stasiun Vessel Traffic Services 
                dan Stasiun Radio Pantai dengan memanfaatkan data dan informasi yang dihasilkan oleh Sensor VTS, 
                Telekomunikasi Pelayaran, serta komunikasi dan koordinasi dengan pihak-pihak terkait.</p>
        @endfor
    </div>

    
@endsection

@push('active.teams')
    active
@endpush

@push('before_styles')
    
@endpush

@push('after_styles')
    
@endpush

@push('before_scripts')
    
@endpush

@push('after_scripts')
    
@endpush

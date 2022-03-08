<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function public()
    {
        // DATA MSI //
        $response = Http::post('http://127.0.0.1:3000/api/msi/insaf/read', [
            'page' => '',
            'rows' => '',
        ]);

        $decode = $response->json();
        $data_msi = $decode[1][0]['rows'];

        ($data_msi == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';

        // DATA KAPAL //
        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        // CONTRAVENTION //
        $response = Http::get('127.0.0.1:3000/api/contravention/', [
            'page' => '',
            'rows' => '',
        ]);

        $decode = $response->json();
        $array = $decode[1][0]['rows'];
        
        ($array == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';

        // DATA BMKG //
        $response = Http::get('http://127.0.0.1:3000/api/weather/bmkg');
        $decode_bmkg = $response->json();
        $data_bmkg = $decode_bmkg['data'][0];
        //$data_securite_detail_pelapor = $decode_securite_detail;
        $bmkg = $data_bmkg;
        

        // DATA DISTRESS //
        $response = Http::post('localhost:3000/api/distress/insaf/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_distress = $response->json();
        $data_distress = $decode_distress[1][0]['rows'];

        // DATA VTS PARTICIPANT //
        $response = Http::post('localhost:3000/api/ship_arrival/insaf/read/vts',[
            'page' => '',
            'rows' => '',
        ]);
        $vts = $response->json();
        $data_vts = $vts[1][0]['rows'];


        // DATA SROP (MASTER CABLE) PARTICIPANT //
        $response = Http::post('localhost:3000/api/ship_arrival/insaf/read/srop',[
            'page' => '',
            'rows' => '',
        ]);
        $srop = $response->json();
        $data_srop = $srop[1][0]['rows'];


        // DATA TRAFFIC //
        $response = Http::post('localhost:3000/api/ship_arrival/insaf/read/traffic',[
            'page' => '',
            'rows' => '',
        ]);
        $traffic = $response->json();
        $data_traffic = $traffic[1][0]['rows'];

        // DATA JUMLAH SHIP ARRIVAL //
        $response = Http::post('localhost:3000/api/ship_arrival/insaf/read',[
            'page' => '',
            'rows' => '',
        ]);
        $arrival = $response->json();
        $data_arrival = $arrival[0]['total'];

        // DATA SHIP ACTIVITY (Berthing) //
        $response = Http::post('localhost:3000/api/ship_arrival/insaf/read/berthing',[
            'page' => '',
            'rows' => '',
        ]);
        $berthing = $response->json();
        $data_berthing = $berthing[0]['total'];

        // DATA SHIP ACTIVITY (Anchorage) //
        $response = Http::post('localhost:3000/api/ship_arrival/insaf/read/anchorage',[
            'page' => '',
            'rows' => '',
        ]);
        $anchorage = $response->json();
        $data_anchorage = $anchorage[0]['total'];
        
        // DATA SHIP ACTIVITY (Underway) //
        $response = Http::post('localhost:3000/api/ship_arrival/insaf/read/traffic',[
            'page' => '',
            'rows' => '',
        ]);
        $underway = $response->json();
        $data_underway = $underway[0]['total'];
        // echo "<pre>";
        // print_r($data_arrival);
        // echo "</pre>";
        // die;
        // return view('pages.dashboard', compact('data_msi'));
        return view('pages.dashboard', compact('data_msi','tanggal_range', 'data_berthing', 'data_anchorage', 'data_underway', 'data_arrival',  'kapal', 'data_vts', 'data_srop', 'data_traffic', 'array', 'bmkg'));

        // return view('pages.dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MsiController extends Controller
{
    public function index()
    {
        $response = Http::post('localhost:3000/api/msi/insaf/read', [
            'page' => '',
            'rows' => '',
        ]);

        $decode = $response->json();
        
        $data = $decode[1][0];
        $data_msi = $decode[1][0]['rows'];

        ($data_msi == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';

        return view('pages.msi.index', compact('data_msi','tanggal_range'));
    }

    public function range_date(Request $request)
    {
        $response = Http::post('localhost:3000/api/msi/insaf/read/range', [
            'range1' => $request->time1,
            'range2' => $request->time2,
        ]);
     
        $decode = $response->json();

        $data_msi = $decode[1][0]['rows'];
        
        ($data_msi == null) ? $tanggal_range = 'Tidak ada data di tanggal '.$request->time1.' s/d '. $request->time2 : $tanggal_range = ''; 
        
        return view('pages.msi.index', compact('data_msi','tanggal_range'));
    }

    public function create()
    {
        
        // TGPRK/MSI/2021.07.16/1 KODE OTOMATIS
        $kodejurnal = DB::table('tbl_insaf_msi')->orderBy('id', 'desc')->first();
        if($kodejurnal == null )
        {
            $no_jurnal = 'TGPRK/MSI/'.date('Y.n.d').'/1';
        }
        else
        {
            $split_kode = explode("/", $kodejurnal->no_jurnal);
            $get_kode_nomor = $split_kode['3'];
            $penjumlahan_kode = $get_kode_nomor + 1;
            $no_jurnal = 'TGPRK/MSI/'.date('Y.n.d').'/'.$penjumlahan_kode;
        }

        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        return view('pages.msi.create', compact('no_jurnal', 'kapal'));
    }
    
    public function store(Request $request)
    {
        // dd($request->all_ship);
        $url_msi = 'http://127.0.0.1:3000/api/msi/insaf/create';
        $url_detail_msi = 'http://127.0.0.1:3000/api/msi/insaf/createDetail';
        $url_ships = 'localhost:3000/api/kapal/masdex/read';

        $mmsi = $request->ship_mmsi;
        $all_ships = $request->all_ship;

        if($mmsi == null && $all_ships != 1) 
        {
            return redirect(route('msi_create.insaf'))->with('error', 'Belum ada kapal yang dipilih! Silakan pilih kapal terlebih dahulu.');
        }
        else 
        {
            $response_msi = Http::post($url_msi, [
                'no_jurnal' => $request->no_jurnal,
                'valid_from' => $request->valid_from,
                'valid_to' => $request->valid_to,
                'information' => $request->information,
                'sumber_data' => $request->sumber_data_cuaca, // 1 met sensor, 2 bmkg, 3 manual
                'wind_speed_min' => $request->wind_speed_min,
                'wind_speed_max' => $request->wind_speed_max,
                'wind_from' => $request->wind_from,
                'wind_to' => $request->wind_to,
                'humidity_min' => $request->humidity_min,
                'humidity_max'=> $request->humidity_max,
                'air_pressure' => $request->air_presure,
                'temperature_min' => $request->temperature_min,
                'temperature_max' => $request->temperature_max,
                'low_tide' => $request->low_tide,
                'high_tide' => $request->high_tide,
                'low_tide_time' => $request->low_tide_time,
                'high_tide_time' => $request->high_tide_time,
                'weather' => $request->weather,
                'additional_info' => $request->additional_info,
            ]);
    
            $decode_msi = $response_msi->json();
            $last_id_msi = $decode_msi['data'];
            
            if($all_ships == 1)
            {
                $response_ships = Http::post($url_ships);
                $decode_ships = $response_ships->json();
                $list_ships = $decode_ships['data'][1][0]['rows'];
                
                foreach($list_ships as $row)
                {
                    $response_detail_msi = Http::post($url_detail_msi, [
                        'msi_id' => $last_id_msi,
                        'mmsi' => $row['mmsi'],
                    ]);
                }
            }
            else{
                foreach($mmsi as $key => $value)
                {
                    $response_detail_msi = Http::post($url_detail_msi, [
                        'msi_id' => $last_id_msi,
                        'mmsi' => $value,
                    ]);
                }
            }
    
            $decode_detail_msi = $response_detail_msi->json();
    
            if($decode_msi['succes'] == true AND $decode_detail_msi['succes'] == true)
            {
                return redirect(route('msi.insaf'))->with('success', 'Data Marine Safety Information berhasil ditambahkan');
            } else {
                return redirect(route('msi.insaf'))->with('error', 'Data Marine Safety Information gagal ditambahkan');
            }
        }
    }

    public function edit($id)
    {
        // msi id
        $response = Http::get('http://127.0.0.1:3000/api/msi/insaf/read/'.$id);
        $decode = $response->json();
        $data_msi = $decode[0];
        
        // ships by msi id
        $response2 = Http::get('localhost:3000/api/msi/kapal/'.$id);
        $decode_detail_msi = $response2->json();
        $data_kapal_msi = $decode_detail_msi;
        $data_old_ship = $data_kapal_msi;
        
                // dd($data_old_ship);

        // data ships
        $response3 = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response3->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        return view('pages.msi.edit', compact('data_msi', 'data_old_ship', 'kapal'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $msi_id = $request->id;

        $url_msi = '127.0.0.1:3000/api/msi/insaf/update/'.$msi_id;
        $url_detail_msi = '127.0.0.1:3000/api/msi/insaf/createDetail';

        $mmsi = $request->ship_mmsi;
        
        // step1 : store update parent msi
        $response_msi = Http::put($url_msi, [
            'no_jurnal' => $request->no_jurnal,
            'valid_from' => $request->valid_from,
            'valid_to' => $request->valid_to,
            'information' => $request->information,
            'sumber_data' => $request->sumber_data_cuaca, // 1 met sensor, 2 bmkg, 3 manual
            'wind_speed_min' => $request->wind_speed_min,
            'wind_speed_max' => $request->wind_speed_max,
            'wind_from' => $request->wind_from,
            'wind_to' => $request->wind_to,
            'humidity_min' => $request->humidity_min,
            'humidity_max'=> $request->humidity_max,
            'air_pressure' => $request->air_presure,
            'temperature_min' => $request->temperature_min,
            'temperature_max' => $request->temperature_max,
            'low_tide' => $request->low_tide,
            'high_tide' => $request->high_tide,
            'low_tide_time' => $request->low_tide_time,
            'high_tide_time' => $request->high_tide_time,
            'weather' => $request->weather,
            'additional_info' => $request->additional_info,
        ]);
        $decode_msi = $response_msi->json();
        

        // step2 : check if new mmsi not null
        if($mmsi != null) 
        {
            foreach($mmsi as $key => $value)
            {
                $response_detail_msi = Http::post($url_detail_msi, [
                    'msi_id' => $msi_id,
                    'mmsi' => $value,
                ]);
            }
            $decode_detail_msi = $response_detail_msi->json();
        }

        // step3: information and redirecting
        if($decode_msi['succes'] == true)
        {
            return redirect(route('msi.insaf'))->with('success', 'Data Marine Safety Information berhasil diupdate');
        } else {
            return redirect(route('msi.insaf'))->with('error', 'Data Marine Safety Information gagal diupdate');
        }

    }
   
    public function show($id)
    {
        $response = Http::get('http://127.0.0.1:3000/api/msi/insaf/read/'.$id);
        $decode = $response->json();
        $data_msi = $decode[0];
        return view('pages.msi.detail', compact('data_msi'));
    }

    public function delete(Request $request)
    {
        $response = Http::delete('http://127.0.0.1:3000/api/msi/insaf/delete/'.$request->id);

        $decode = $response->json();

        if($decode['success'] == true)
        {
            return redirect(route('msi.insaf'))->with('success', 'MSI berhasil dihapus.');
        }
        else
        {
            return redirect(route('msi.insaf'))->with('error', 'MSI gagal dihapus.');
        }
    }

    public function delete_detail_msi_mmsi($msi_detail_id = null)
    {
        $response = Http::delete('127.0.0.1:3000/api/msidetail/insaf/delete/'.$msi_detail_id);
        return json_decode($response->ok());
    }
}

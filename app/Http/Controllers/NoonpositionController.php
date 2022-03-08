<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoonpositionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NoonpositionController extends Controller
{
    // controller untuk get api kapal di modal popup create & edit 
    public function get_kapal($mmsi) 
    {
        $response = Http::get('http://127.0.0.1:3000/api/kapal/masdex/read/'.$mmsi);
        return $response->json();
    }

    public function index()
    {
        $response = Http::post('localhost:3000/api/noonposition/insaf/read', [
            'page' => '',
            'rows' => '',
        ]);

        $decode = $response->json();
        $array = $decode[1][0]['rows'];

        ($array == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';

        return view('pages.noon_position.index', compact('array','tanggal_range'));
    }

    public function range_date(Request $request)
    {
        $response = Http::post('http://127.0.0.1:3000/api/noonposition/insaf/read/range', [
            'range1' => $request->time1,
            'range2' => $request->time2,
        ]);
     
        $decode = $response->json();

        $array = $decode['data'][1][0]['rows'];
        
        ($array == null) ? $tanggal_range = 'Tidak ada data di tanggal '.$request->time1.' s/d '. $request->time2 : $tanggal_range = ''; 
        
        return view('pages.noon_position.index', compact('array','tanggal_range'));
    }

    public function create()
    {
        // TGPRK/NP/2021.07.16/1 KODE OTOMATIS
        $kodejurnal = DB::table('tbl_insaf_noon_position')->orderBy('id', 'desc')->first();
        if($kodejurnal == null )
        {
            $no_jurnal = 'TGPRK/NP/'.date('Y.n.d').'/1';
        }
        else
        {
            $split_kode = explode("/", $kodejurnal->no_jurnal);
            $get_kode_nomor = $split_kode['3'];
            $penjumlahan_kode = $get_kode_nomor + 1;
            $no_jurnal = 'TGPRK/NP/'.date('Y.n.d').'/'.$penjumlahan_kode;
        }

        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        // ais status navigation
        $response2 = Http::get('localhost:3000/api/ais_status_navigaion/');
        $decode_status_navigation = $response2->json();
        $data_status_navigation = $decode_status_navigation['data'][0][0]['rows'];
        $status_navigation = $data_status_navigation;

        // dd($kapal);
        return view('pages.noon_position.create', compact('no_jurnal', 'kapal', 'status_navigation'));
    }
    
    public function store(NoonpositionRequest $request)
    {
        // dd($request->all());
        $response = Http::post('http://127.0.0.1:3000/api/noonposition/insaf/create', [
            'no_jurnal'             => $request->no_jurnal,
            'tgl_jurnal'            => $request->tgl_jurnal,
            'mmsi'                  => $request->mmsi,
            'status_nav'            => $request->status_nav,
            'degree1'               => $request->degree1,
            'minute1'               => $request->minute1,
            'second1'               => $request->second1,
            'direction1'            => $request->direction1,
            'degree2'               => $request->degree2,
            'minute2'               => $request->minute2,
            'second2'               => $request->second2,
            'direction2'            => $request->direction2,
            'haluan'                => $request->haluan,
            'kecepatan'             => $request->kecepatan,
            'nama_lokasi_kejadian'  => $request->nama_lokasi_perairan,
            'pelabuhan_asal'        => $request->pelabuhan_asal,
            'pelabuhan_tujuan'      => $request->pelabuhan_tujuan,
            'jumlah_awak'           => $request->jumlah_awak,
            'jumlah_penumpang'      => $request->jumlah_penumpang,
            'jenis_muatan'          => $request->jenis_muatan,
            'kondisi_awak_kapal'    => $request->kondisi_awak_kapal,
            'kondisi_kapal'         => $request->kondisi_kapal,
            'posisi_bbm'            => $request->posisi_bbm,
            'kecepatan_angin'       => $request->kecepatan_angin,
            'temperature'           => $request->temperature,
            'arus'                  => $request->arus,
            'kelembaban'            => $request->kelembapan,
            'curah_hujan'           => $request->curah_hujan,
            'arah_angin'            => $request->arah_angin,
            'tinggi_gelombang'      => $request->tinggi_gelombang,
            'jarak_penglihatan'     => $request->jarak_penglihatan,
            'pasang_surut'          => $request->pasang_surut,
            'tekanan_udara'         => $request->tekanan_udara,
            'remark'                => $request->remark_keterangan,
        ]);

        $decode = $response->json();

        if($decode['status'] == true) {
            session()->flash('success', 'Noon Position Berhasil Disimpan.');
            return redirect(route('noon_position.insaf'));
        } else {
            session()->flash('error', 'Noon Position Gagal Disimpan !');
            return redirect(route('noon_position.insaf'));
        }

    }

    public function edit($id = null)
    {
        // get noon position by id
        $response_edit = Http::get('http://127.0.0.1:3000/api/noonposition/insaf/read/'. $id);
        $decode_edit = $response_edit->json();
        $data = $decode_edit[0];
        
        // get kapal old by data noon position mmsi
        $response_old_kapal = Http::get('localhost:3000/api/kapal/masdex/read/'. $data['mmsi']);
        $decode_kapal_old = $response_old_kapal->json();
        $kapal_old = $decode_kapal_old['data'][0];

        // get data kapal buat modalm popup data kapal
        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        // ais status navigation
        $response2 = Http::get('localhost:3000/api/ais_status_navigaion/');
        $decode_status_navigation = $response2->json();
        $data_status_navigation = $decode_status_navigation['data'][0][0]['rows'];
        $status_navigation = $data_status_navigation;

        return view('pages.noon_position.edit', compact('data', 'kapal', 'kapal_old','status_navigation'));
    }

    public function update(NoonpositionRequest $request)
    {
        
        $response = Http::put('http://127.0.0.1:3000/api/noonposition/insaf/update/'.$request->id, [
            'no_jurnal'             => $request->no_jurnal,
            'tgl_jurnal'            => $request->tgl_jurnal,
            'mmsi'                  => $request->mmsi,
            'status_nav'            => $request->status_nav,
            'degree1'               => $request->degree1,
            'minute1'               => $request->minute1,
            'second1'               => $request->second1,
            'direction1'            => $request->direction1,
            'degree2'               => $request->degree2,
            'minute2'               => $request->minute2,
            'second2'               => $request->second2,
            'direction2'            => $request->direction2,
            'haluan'                => $request->haluan,
            'kecepatan'             => $request->kecepatan,
            'nama_lokasi_kejadian'  => $request->nama_lokasi_perairan,
            'pelabuhan_asal'        => $request->pelabuhan_asal,
            'pelabuhan_tujuan'      => $request->pelabuhan_tujuan,
            'jumlah_awak'           => $request->jumlah_awak,
            'jumlah_penumpang'      => $request->jumlah_penumpang,
            'jenis_muatan'          => $request->jenis_muatan,
            'kondisi_awak_kapal'    => $request->kondisi_awak_kapal,
            'kondisi_kapal'         => $request->kondisi_kapal,
            'posisi_bbm'            => $request->posisi_bbm,
            'kecepatan_angin'       => $request->kecepatan_angin,
            'temperature'           => $request->temperature,
            'arus'                  => $request->arus,
            'kelembaban'            => $request->kelembapan,
            'curah_hujan'           => $request->curah_hujan,
            'arah_angin'            => $request->arah_angin,
            'tinggi_gelombang'      => $request->tinggi_gelombang,
            'jarak_penglihatan'     => $request->jarak_penglihatan,
            'pasang_surut'          => $request->pasang_surut,
            'tekanan_udara'         => $request->tekanan_udara,
            'remark'                => $request->remark_keterangan,
        ]);

        $decode = $response->json();

        if($decode['succes'] == true) {
            session()->flash('success', 'Noon Position Berhasil Diubah.');
            return redirect(route('noon_position.insaf'));
        } else {
            session()->flash('error', 'Noon Position Gagal Diubah !');
            return redirect(route('noon_position.insaf'));
        }

    }
   
    public function show($id = null)
    {
        // data parent noon position
        $response_parent = Http::get('http://127.0.0.1:3000/api/noonposition/insaf/read/'.$id);
        $decode_parent = $response_parent->json();
        $data_parent = $decode_parent[0];
        
        // data child kapal by mmsi di data parent noon position
        $response_ship_by_parent = Http::get('localhost:3000/api/kapal/masdex/read/'.$data_parent['mmsi']);
        $decode_ship = $response_ship_by_parent->json();
        $data_kapal = $decode_ship['data'][0];
                
        return view('pages.noon_position.detail', compact('data_parent','data_kapal'));
    }

    public function delete(Request $request)
    {
        $response = Http::delete('localhost:3000/api/noonposition/insaf/delete/'.$request->id);
        
        // $get_data = (object)json_decode($response);

        $decode = json_decode($response->ok());

        if($decode == true) {
            session()->flash('success', 'Noon Position Berhasil Dihapus.');
            return redirect()->route('noon_position.insaf');
        } else {
            session()->flash('error', 'Noon Position Gagal Dihapus !');
            return redirect()->route('noon_position.insaf');
        }
    }

}

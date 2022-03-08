<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoonpositionRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SecuriteController extends Controller
{
    public function index()
    {
        $response = Http::post('http://127.0.0.1:3000/api/securite/insaf/read/', [
            'page' => '',
            'rows' => '',
        ]);

        $decode = $response->json();
        $data_securite = $decode[1][0]['rows'];

        ($data_securite == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';

        return view('pages.securite.index', compact('data_securite','tanggal_range'));
    }

    public function range_date(Request $request)
    {
        $response = Http::post('http://127.0.0.1:3000/api/securite/insaf/read/range', [
            'range1' => $request->time1,
            'range2' => $request->time2,
        ]);
     
        $decode = $response->json();

        $data_securite = $decode[1][0]['rows'];
        
        ($data_securite == null) ? $tanggal_range = 'Tidak ada data di tanggal '.$request->time1.' s/d '. $request->time2 : $tanggal_range = ''; 
        
        return view('pages.securite.index', compact('data_securite','tanggal_range'));
    }

    public function create()
    {
        
        // TGPRK/SECURITE/2021.7.16/1 KODE OTOMATIS
        $kodejurnal = DB::table('tbl_insaf_securite')->orderBy('id', 'desc')->first();
        if($kodejurnal == null )
        {
            $no_jurnal = 'TGPRK/SECURITE/'.date('Y.n.d').'/1';
        }
        else
        {
            $split_kode = explode("/", $kodejurnal->no_jurnal);
            $get_kode_nomor = $split_kode['3'];
            $penjumlahan_kode = $get_kode_nomor + 1;
            $no_jurnal = 'TGPRK/SECURITE/'.date('Y.n.d').'/'.$penjumlahan_kode;
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
        
        // jenis securite
        $jenis_securite = [
            ['id' => 1, 'jenis_securite' => 'Kelalaian SBNP'],
            ['id' => 2, 'jenis_securite' => 'Pekerjaan Bawah Laut'],
            ['id' => 3, 'jenis_securite' => 'Adanya Kerangka Kapal'],
            ['id' => 4 , 'jenis_securite' => 'Perompak di Laut'],
        ];
        
        // jenis securite
        $sumber_informasi_awal = [
            ['id' => 1, 'sumber_informasi' => 'Dari Kapal'],
            ['id' => 2, 'sumber_informasi' => 'Dari Instansi Lain'],
        ];
        
        // jenis securite
        $nama_pelabuhan = [
            ['id' => 1, 'nama_pelabuhan' => 'TG Priok'],
            ['id' => 2, 'nama_pelabuhan' => 'Merak'],
            ['id' => 3, 'nama_pelabuhan' => 'Panjang'],
            ['id' => 4, 'nama_pelabuhan' => 'Cirebon'],
            ['id' => 5, 'nama_pelabuhan' => 'Bengkulu'],
        ];

        return view('pages.securite.create', compact('no_jurnal', 'kapal', 'status_navigation', 'sumber_informasi_awal', 'jenis_securite','nama_pelabuhan'));
    }
    
    public function store(Request $request)
    {
        $url_securite = 'http://127.0.0.1:3000/api/securite/insaf/create';
        $url_detail_securite = 'http://127.0.0.1:3000/api/securitedetail/insaf/create';

        $response_securite = Http::post($url_securite, [
            'no_jurnal' => $request->no_jurnal,
            'tgl_jurnal' => $request->tanggal,
            'jenis_securite' => $request->jenis_securite,
            'waktu_kejadian' => $request->waktu_kejadian,
            'sumber_info' => $request->sumber_informasi_awal,
            'ket_lainnya' => $request->keterangan_lainnya,
            'mmsi' => $request->mmsi,
            'status_nav' => $request->status_navigation,
            'info_tambahan' => $request->info_tambahan,
            'degree1' => $request->degree1,
            'minute1' => $request->minute1,
            'second1' => $request->second1,
            'direction1' => $request->direction1,
            'degree2' => $request->degree2,
            'minute2' => $request->minute2,
            'second2' => $request->second2,
            'direction2' => $request->direction2,
            'lokasi_terlapor' => $request->nama_lokasi_terlapor,
            'degree3' => $request->degree3,
            'minute3' => $request->minute3,
            'second3' => $request->second3,
            'direction3' => $request->direction3,
            'degree4' => $request->degree4,
            'minute4' => $request->minute4,
            'second4' => $request->second4,
            'direction4' => $request->direction4,
            'pelabuhan_asal' => $request->pelabuhan_asal,
            'pelabuhan_tujuan' => $request->pelabuhan_tujuan,
            'desc_securite' => $request->deskripsi_laporan_securite,
            'memerlukan_tindakan' => $request->memerlukan_tindakan,
            'deskripsi_tindakan' => $request->deskripsi_tindakan,
            'mob' => $request->mob,
            'nohp1' => $request->nohp1,
            'secc_officer' => $request->sec_officer,
            'nohp2' => $request->nohp2,
        ]);

        $decode_securite = $response_securite->json();

        // dd($decode_securite);
        $last_id_securite = $decode_securite['last_id'];
        
        if($request->nama_pelapor != null)
        {
            for($x = 0; $x < count($request->nama_pelapor); $x++) 
            {
                $response_detail_msi = Http::post($url_detail_securite, [
                    'securite_id' => $last_id_securite,
                    'nama_pelapor' => $request->nama_pelapor[$x],
                    'instansi' => $request->instansi_pelapor[$x],
                    'kontak' =>  $request->kontak_pelapor[$x],
                    'tgl_lapor' => $request->tanggal_lapor[$x],
                    'info_tambahan' => $request->info_tambahan_pelapor[$x],
                ]);
            }
        }
        $decode_detail_msi = $response_detail_msi->json();

        if($decode_securite['status'] == true)
        {
            return redirect(route('securite.insaf'))->with('success', 'Data Securite berhasil ditambahkan');
        } 
        else 
        {
            return redirect(route('securite.insaf'))->with('error', 'Data Securite gagal ditambahkan');
        }
    }

    public function store_detail(Request $request)
    {
        $url_detail_securite = 'http://127.0.0.1:3000/api/securitedetail/insaf/create';
        $response_detail_msi = Http::post($url_detail_securite, [
            'securite_id' => $request->securite_id,
            'nama_pelapor' => $request->nama_pelapor,
            'instansi' => $request->instansi,
            'kontak' =>  $request->kontak,
            'tgl_lapor' => $request->tgl_lapor,
            'info_tambahan' => $request->info_tambahan,
        ]);
        $decode_detail_msi = $response_detail_msi->json();

        if($decode_detail_msi['status'] == true)
        {
            return redirect(route('securite.insaf'))->with('success', 'Data Securite berhasil ditambahkan');
        } 
        else 
        {
            return redirect(route('securite.insaf'))->with('error', 'Data Securite gagal ditambahkan');
        }
    }

    public function edit($id = null)
    {
        // get securite detail by id
        $response = Http::get('http://127.0.0.1:3000/api/securite/insaf/read/'.$id);
        $decode_securite = $response->json();
        $data_securite = $decode_securite[0];
        //$data_securite_detail_pelapor = $decode_securite_detail;
        $securite = $data_securite;
         //dd($securite);

        $response = Http::get('http://127.0.0.1:3000/api/securite/insaf/read_detail/'.$id); 
        $decode_securite_detail = $response->json();
        $data_securite_detail = $decode_securite_detail;
        $securite_detail = $data_securite_detail;
        //dd($securite_detail);

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
        
        // jenis securite
        $jenis_securite = [
            ['id' => 1, 'jenis_securite' => 'Kelalaian SBNP'],
            ['id' => 2, 'jenis_securite' => 'Pekerjaan Bawah Laut'],
            ['id' => 3, 'jenis_securite' => 'Adanya Kerangka Kapal'],
            ['id' => 4 , 'jenis_securite' => 'Perompak di Laut'],
        ];
        
        // jenis securite
        $sumber_informasi_awal = [
            ['id' => 1, 'sumber_informasi' => 'Dari Kapal'],
            ['id' => 2, 'sumber_informasi' => 'Dari Instansi Lain'],
        ];
        
        // jenis securite
        $nama_pelabuhan = [
            ['id' => 1, 'nama_pelabuhan' => 'TG Priok'],
            ['id' => 2, 'nama_pelabuhan' => 'Merak'],
            ['id' => 3, 'nama_pelabuhan' => 'Panjang'],
            ['id' => 4, 'nama_pelabuhan' => 'Cirebon'],
            ['id' => 5, 'nama_pelabuhan' => 'Bengkulu'],
        ];

        return view('pages.securite.edit', compact('securite','securite_detail',  'kapal', 'status_navigation', 'sumber_informasi_awal', 'jenis_securite','nama_pelabuhan'));
    }

    public function update(Request $request)
    {
        // echo ($request->tgl_jurnal);
        $url_securite = 'http://127.0.0.1:3000/api/securite/insaf/update/'. $request->id;
        $response_securite = Http::put($url_securite, [
            'no_jurnal' => $request->no_jurnal,
            'tgl_jurnal' => $request->tgl_jurnal,
            'jenis_securite' => $request->jenis_securite,
            'waktu_kejadian' => $request->waktu_kejadian,
            'sumber_informasi_awal' => $request->sumber_informasi_awal,
            'keterangan_lainnya' => $request->keterangan_lainnya,
            'mmsi' => $request->mmsi,
            'status_bernavigasi' => $request->status_bernavigasi,
            'info_tambahan' => $request->info_tambahan,
            'degree1' => $request->degree1,
            'minute1' => $request->minute1,
            'second1' => $request->second1,
            'direction1' => $request->direction1,
            'degree2' => $request->degree2,
            'minute2' => $request->minute2,
            'second2' => $request->second2,
            'direction2' => $request->direction2,
            'lokasi_terlapor' => $request->nama_lokasi_terlapor,
            'degree3' => $request->degree3,
            'minute3' => $request->minute3,
            'second3' => $request->second3,
            'direction3' => $request->direction3,
            'degree4' => $request->degree4,
            'minute4' => $request->minute4,
            'second4' => $request->second4,
            'direction4' => $request->direction4,
            'pelabuhan_asal' => $request->pelabuhan_asal,
            'pelabuhan_tujuan' => $request->pelabuhan_tujuan,
            'deskripsi_laporan_securite' => $request->deskripsi_laporan_securite,
            'memerlukan_tindakan' => $request->memerlukan_tindakan,
            'deskripsi_tindakan' => $request->deskripsi_tindakan,
            'mob' => $request->mob,
            'nohp1' => $request->hp1,
            'second_officer' => $request->second_officer,
            'nohp2' => $request->hp2,

        ]);

        $decode_securite = $response_securite->json();

        //echo($decode_securite);
        dd($decode_securite);

        if($decode_securite['status'] == true)
        {
            //return redirect(route('securite.insaf'))->with('success', 'Data Securite berhasil diupdate');
            echo ($decode_securite['status']);
        } 
        else 
        {
            return redirect(route('securite.insaf'))->with('error', 'Data Securite gagal ditambahkan');
        }
        //echo($decode_securite);
    }

    public function update_detail (Request $request)
    {
        $url_securite_detail = 'http://127.0.0.1:3000/api/securite/insaf/update_detail/'. $request->id;
        $response_securite = Http::put($url_securite_detail, [
            'securite_id' => $request->securite_id,
            'nama_pelapor' => $request->nama_pelapor,
            'instansi' => $request->instansi,
            'kontak' =>  $request->kontak,
            'tgl_pelapor' => $request->tgl_lapor,
            'info_tambahan_p' => $request->info_tambahan,
        ]);
        
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
        $response = Http::delete('http://127.0.0.1:3000/api/securite/insaf/delete/'.$request->id);

        $decode = $response->json();

        if($decode['status'] == true)
        {
            return redirect(route('securite.insaf'))->with('success', 'Securite berhasil dihapus.');
        }
        else
        {
            return redirect(route('securite.insaf'))->with('error', 'Securite gagal dihapus.');
        }
    }

    public function delete_detail_msi_mmsi($msi_detail_id = null)
    {
        $response = Http::delete('127.0.0.1:3000/api/msidetail/insaf/delete/'.$msi_detail_id);
        return json_decode($response->ok());
    }
}

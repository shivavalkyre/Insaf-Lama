<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ContraventionController extends Controller
{
    public function index()
    {
        $response = Http::get('127.0.0.1:3000/api/contravention/', [
            'page' => '',
            'rows' => '',
        ]);

        $decode = $response->json();
        $array = $decode[1][0]['rows'];
        
        ($array == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';

        return view('pages.contravention.index', compact('array','tanggal_range'));
    }

    public function range_date(Request $request)
    {
        $response = Http::get('127.0.0.1:3000/api/contravention/show/'.$request->time1.'/'.$request->time2);
        
        $decode = $response->json();
        // dd($decode);

        $array = $decode[1][0]['rows'];
        
        ($array == null) ? $tanggal_range = 'Tidak ada data di tanggal '.$request->time1.' s/d '. $request->time2 : $tanggal_range = ''; 
        
        return view('pages.contravention.index', compact('array','tanggal_range'));
    }

    public function create()
    {
        
        // TGPRK/CTV/2021.07.16/1 KODE OTOMATIS
        $kodejurnal = DB::table('tbl_insaf_contravention')->orderBy('id', 'desc')->first();
        // dd($kodejurnal);
        if($kodejurnal == null )
        {
            $no_jurnal = 'TGPRK/CTV/'.date('Y.n.d').'/1';
        }
        else
        {
            $split_kode = explode("/", $kodejurnal->no_jurnal);
            $get_kode_nomor = $split_kode['3'];
            $penjumlahan_kode = $get_kode_nomor + 1;
            $no_jurnal = 'TGPRK/CTV/'.date('Y.n.d').'/'.$penjumlahan_kode;
        }
        
        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;
        
        // jenis pelanggaran
        $response2 = Http::get('127.0.0.1:3000/api/contravention/jenispelanggaran');
        $decode_jenis_pelanggaran = $response2->json();
        $jenis_pelanggaran = $decode_jenis_pelanggaran;

        return view('pages.contravention.create', compact('kapal','jenis_pelanggaran','no_jurnal'));
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        $response = Http::post('127.0.0.1:3000/api/contravention/store', [
            'no_jurnal'             => $request->no_jurnal,
            'tanggal'               => $request->tanggal,
            'mmsi'                  => $request->mmsi,
            'subject'               => '-',
            'keterangan'            => $request->keterangan,
            'data_feed_type'        => 1, //1 manual insaf, 2 automatic marlens
            'jenis_pelanggaran_id'     => $request->jenis_pelanggaran,
            'created_at'            => date('Y-m-d H:i:s'),
            'created_by'            => session()->get('id'),
            
        ]);

        $decode = $response->json();

        if($decode['success'] == true) {
            session()->flash('success', 'Contravention Berhasil Disimpan.');
            return redirect(route('contravention.insaf'));
        } else {
            session()->flash('error', 'Contravention Gagal Disimpan !');
            return redirect(route('contravention.insaf'));
        }
    }
   
    public function show($id)
    {
        // data parent noon position
        $response_parent = Http::get('127.0.0.1:3000/api/contravention/show/'.$id);
        $decode_parent = $response_parent->json();
        $data_parent = $decode_parent[0];
        //  dd($data_parent);
        
        // data child kapal by mmsi di data parent noon position
        $response_ship_by_parent = Http::get('localhost:3000/api/kapal/masdex/read/'.$data_parent['mmsi']);
        $decode_ship = $response_ship_by_parent->json();
        $data_kapal = $decode_ship['data'][0];
                
        return view('pages.contravention.detail', compact('data_parent','data_kapal'));
    }

    public function edit($id = null)
    {
        // get contravention by id
        $response_edit = Http::get('127.0.0.1:3000/api/contravention/show/'. $id);
        $decode_edit = $response_edit->json();
        $data = $decode_edit[0];

        // dd($data);

        // get contravention by id
        $response_jenis_pelanggaran = Http::get('127.0.0.1:3000/api/contravention/jenispelanggaran');
        $decode_jenis_pelanggaran = $response_jenis_pelanggaran->json();
        $jenis_pelanggaran = $decode_jenis_pelanggaran;

        // get kapal old by data contravention mmsi
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

        return view('pages.contravention.edit', compact('data', 'kapal', 'kapal_old', 'jenis_pelanggaran'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $response = Http::put('127.0.0.1:3000/api/contravention/update/'.$request->id, [
            'no_jurnal'             => $request->no_jurnal,
            'tanggal'               => $request->tanggal,
            'mmsi'                  => $request->mmsi,
            'subject'               => '-',
            'keterangan'            => $request->keterangan,
            'data_feed_type'        => 1, //1 manual insaf, 2 automatic marlens
            'jenis_pelanggaran_id'  => $request->jenis_pelanggaran,
            'updated_at'            => date('Y-m-d H:i:s'),
            'updated_by'            => session()->get('id'),
            
        ]);

        $decode = $response->json();

        if($decode['success'] == true) {
            session()->flash('success', 'Contravention Berhasil Diperbarui.');
            return redirect(route('contravention.insaf'));
        } else {
            session()->flash('error', 'Contravention Gagal Diperbarui !');
            return redirect(route('contravention.insaf'));
        }
    }
    
    public function delete(Request $request)
    {
        $response = Http::delete('127.0.0.1:3000/api/contravention/destroy/'.$request->id,[
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => 10,
        ]);

        $decode = $response->json();
        // dd($decode);

        if($decode['success'] == true) {
            session()->flash('success', 'Contravention Berhasil Dihapus.');
            return redirect()->back();
        } else {
            session()->flash('error', 'Contravention Gagal Dihapus !');
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class NtmController extends Controller
{   
    public function index()
    {
        $response = Http::get('127.0.0.1:3000/api/ntm', [
            'page' => '',
            'rows' => '',
        ]);

        $decode = $response->json();
        // dd($decode);
        $array = $decode[1][0]['rows'];

        ($array == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';

        return view('pages.ntm.index', compact('array','tanggal_range'));
    }

    public function get_dokumen($dokumen = null)
    {
        // $url_file = '../../../../../../nodejs/Masdex/Insaf/uploads/'; 
        $path = '../../../../../nodejs/Masdex/Insaf/uploads/'.$dokumen; 
        // $path = Storage::putFile('dokumen', new File('/nodejs/Masdex/Insaf/uploads/'.$dokumen));
        return $path;
    }

    public function range_date(Request $request)
    {
        // dd($request->all());
        $response = Http::get('127.0.0.1:3000/api/ntm/show/'. $request->time1 . '/' . $request->time2);
        // dd($response->json());
        $decode = $response->json();

        $array = $decode[1][0]['rows'];
        
        ($array == null) ? $tanggal_range = 'Tidak ada data di tanggal '.$request->time1.' s/d '. $request->time2 : $tanggal_range = ''; 
        
        return view('pages.ntm.index', compact('array','tanggal_range'));
    }

    public function create()
    {
        // dd(session()->get('token'));
        // TGPRK/NTM/2021.07.16/1 KODE OTOMATIS
        $kodejurnal = DB::table('tbl_insaf_notice_to_mariner')->orderBy('id', 'desc')->first();
        // dd($kodejurnal->id);
        if($kodejurnal == null )
        {
            $no_jurnal = 'TGPRK/NTM/'.date('Y.n.d').'/1';
        }
        else
        {
            $split_kode = explode("/", $kodejurnal->no_jurnal);
            $get_kode_nomor = $split_kode['3'];
            $penjumlahan_kode = $get_kode_nomor + 1;
            $no_jurnal = 'TGPRK/NTM/'.date('Y.n.d').'/'.$penjumlahan_kode;
        }

        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        // dd($kapal);
        return view('pages.ntm.create', compact('no_jurnal', 'kapal'));
    }
    
    public function store(Request $request)
    {
        // dd();
        $url_ntm = 'localhost:3000/api/ntm/store';
        $url_detail_ntm = 'localhost:3000/api/ntm/kapal/store/';
        $url_get_last_ntm = 'localhost:3000/api/ntm/latest';
        $url_upload_dokumen = 'localhost:3000/api/insaf/uploadfile';
        $url_ships = 'localhost:3000/api/kapal/masdex/read';

        $dokumen = $request->file('dokumen');
        // dd($dokumen);
        $mmsi = $request->ship_mmsi;
        $all_ships = $request->all_ship;
        

        if($mmsi == null && $all_ships != 1) 
        {
            return redirect(route('ntm_create.insaf'))->with('error', 'Belum ada kapal yang dipilih! Silakan pilih kapal terlebih dahulu.');
        }
        else 
        {
            // step1 : upload dokumen
            $response_upload_dokumen =  Http::attach(
                'dataFile', file_get_contents($dokumen),  $dokumen->getClientOriginalName(),
            )->post($url_upload_dokumen, [
                'dataFile' => $dokumen->getClientOriginalName(),
            ]);
            $decode_upload_dokumen = $response_upload_dokumen->json();
            $file_name = $decode_upload_dokumen['file']['filename'];
            
            // step2:  store parent ntm
            $response_ntm = Http::post($url_ntm, [
                'no_jurnal' => $request->no_jurnal,
                'tanggal' => $request->tanggal,
                'title' => $request->title,
                'keterangan' => $request->keterangan,
                // 'dokumen' => $dokumen->getClientOriginalName(),
                'dokumen' => $file_name,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('id'),
            ]);
            $decode_ntm = $response_ntm->json();

            // step3: get latest ntm id
            $response_last_ntm = Http::get($url_get_last_ntm);
            $decode_latest_ntm = $response_last_ntm->json();
            $last_id_ntm = $decode_latest_ntm['id'];
            
            // step4: store detail ntm (data mmsi)
            if($all_ships == 1) //share all ships
            {
                $response_ships = Http::post($url_ships);
                $decode_ships = $response_ships->json();
                $list_ships = $decode_ships['data'][1][0]['rows'];
                
                foreach($list_ships as $row)
                {
                    $response_detail_ntm = Http::post($url_detail_ntm.$last_id_ntm, [
                        'ntm_id' => $last_id_ntm,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => session()->get('id'),
                        'mmsi' => $row['mmsi'],
                    ]);
                }
            }
            else // share selected ships
            {
                foreach($mmsi as $key => $value)
                {
                    $response_detail_ntm = Http::post($url_detail_ntm.$last_id_ntm, [
                        'ntm_id' => $last_id_ntm,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => session()->get('id'),
                        'mmsi' => $value,
                    ]);
                }
            }
            $decode_detail_ntm = $response_detail_ntm->json();
    
            // step5: information and redirecting
            if($decode_ntm['success'] == true AND $decode_detail_ntm['success'] == true)
            {
                return redirect(route('ntm.insaf'))->with('success', 'Data Notice To Mariner berhasil ditambahkan');
            } else {
                return redirect(route('ntm.insaf'))->with('error', 'Data Notice To Mariner gagal ditambahkan');
            }
        }
    }

    public function edit($id = null)
    {
        // data parent Notice to Mariner
        $response_parent = Http::get('127.0.0.1:3000/api/ntm/show/'.$id);
        $decode_parent = $response_parent->json();
        $data_parent = $decode_parent[0];

        // data mmsi ship by id ntm
        $response_ship = Http::get('127.0.0.1:3000/api/ntm/kapal/'.$id);
        $decode_ship = $response_ship->json();
        $data_old_ship = $decode_ship;

        // get data kapal buat modalm popup data kapal
        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        return view('pages.ntm.edit', compact('data_parent', 'kapal', 'data_old_ship'));
    }

    public function update(Request $request)
    {
        // dd($request->old_dokumen);
        $ntm_id = $request->id;

        $url_ntm = '127.0.0.1:3000/api/ntm/update/';
        $url_detail_ntm = 'localhost:3000/api/ntm/kapal/store/'.$ntm_id;
        $url_delete_old_dokumen = 'localhost:3000/api/insaf/delete_uploadfile/';
        $url_detail_old_ntm = '127.0.0.1:3000/api/ntm/kapal/'.$ntm_id;
        $url_upload_dokumen = 'localhost:3000/api/insaf/uploadfile';
        $url_ships = 'localhost:3000/api/kapal/masdex/read';

        $dokumen = $request->file('dokumen');
        $mmsi = $request->ship_mmsi;
        $all_ships = $request->all_ship;
        
        // Step1 : cek if nothing filte to upload
        if($dokumen != null)
        {
            
            // delet old dokumen
            $response_upload_dokumen =  Http::withToken(session()->get('token'))->delete($url_delete_old_dokumen.$request->old_dokumen);

            // upload new dokumen
            $response_upload_dokumen =  Http::attach(
                'dataFile', file_get_contents($dokumen),  $dokumen->getClientOriginalName(),
            )->post($url_upload_dokumen, [
                'dataFile' => $dokumen->getClientOriginalName(),
            ]);
            $decode_upload_dokumen = $response_upload_dokumen->json();
            $file_name = $decode_upload_dokumen['file']['filename'];

            $nama_dokumen = $file_name;
        }
        else
        {
            $nama_dokumen = $request->old_dokumen;
        }

        // step2 : store update parent ntm
        $response_ntm = Http::put($url_ntm.$ntm_id, [
            'no_jurnal' => $request->no_jurnal,
            'tanggal' => $request->tanggal,
            'title' => $request->title,
            'keterangan' => $request->keterangan,
            'dokumen' => $nama_dokumen,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => session()->get('id'),
        ]);
        $decode_ntm = $response_ntm->json();
        
        // step3: get latest ntm id
        // $response_old_detail_ntm = Http::get($url_detail_old_ntm);
        // $decode_old_detail_ntm = $response_old_detail_ntm->json();
        // $last_id_ntm = $decode_old_detail_ntm;

        // step4 : check if new mmsi not null
        if($mmsi != null) 
        {
            foreach($mmsi as $key => $value)
            {
                $response_detail_ntm = Http::post($url_detail_ntm, [
                    'ntm_id' => $ntm_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => session()->get('id'),
                    'mmsi' => $value,
                ]);
            }
            $decode_detail_ntm = $response_detail_ntm->json();
        }

        // step5: information and redirecting
        if($decode_ntm['success'] == true)
        {
            return redirect(route('ntm.insaf'))->with('success', 'Data Notice To Mariner berhasil diupdate');
        } else {
            return redirect(route('ntm.insaf'))->with('error', 'Data Notice To Mariner gagal diupdate');
        }

    }
   
    public function show($id = null)
    {
        // data parent Notice to Mariner
        $response_parent = Http::get('127.0.0.1:3000/api/ntm/show/'.$id);
        $decode_parent = $response_parent->json();
        $data_parent = $decode_parent[0];

        // data mmsi ship by id ntm
        $response_ship = Http::get('127.0.0.1:3000/api/ntm/kapal/'.$id);
        $decode_ship = $response_ship->json();
        $data_ship = $decode_ship;
                
        return view('pages.ntm.detail', compact('data_parent', 'data_ship'));
    }

    public function delete(Request $request)
    {
        $response = Http::delete('127.0.0.1:3000/api/ntm/destroy/'.$request->id);
        
        // $get_data = (object)json_decode($response);

        $decode = json_decode($response->ok());

        if($decode == true) {
            session()->flash('success', 'Notice to Mariner Berhasil Dihapus.');
            return redirect()->route('ntm.insaf');
        } else {
            session()->flash('error', 'Notice to Mariner Gagal Dihapus !');
            return redirect()->route('ntm.insaf');
        }
    }

    public function delete_detail_ntm_mmsi($ntm_id = null, $ntm_detail_id = null)
    {
        
        $response = Http::delete('127.0.0.1:3000/api/ntm/kapal/destroy/'.$ntm_id.'/'.$ntm_detail_id);

        return json_decode($response->ok());

    }
}

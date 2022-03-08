<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShipsactivityController extends Controller
{

	// =========== activity ===========
    // 1.ship arrival
    // 2.ship on port 
    // 3.ship departure
    // =========== location ===========
    // 1. VTS
    // 2. SROP

	// cek total tagihan PNBP
	public function cek_total_tagihan(Request $request)
	{
		if($request->pintu_kedatangan == 1) //VTS
		{
			$response_vts = Http::post('http://localhost:3000/api/ship_arrival/total_tagihan/insaf/1/1', [
				'jenis_pelayaran' => $request->jenis_pelayaran,
				'mmsi' => $request->mmsi,
			]);
			$decode_vts = $response_vts->json();
			$tagihan_vts = $decode_vts['data'];
			return $tagihan_vts;
			// return "VTS";
		}
		elseif($request->pintu_kedatangan == 2) //SROP
		{
			$response_srop = Http::post('http://localhost:3000/api/ship_arrival/total_tagihan/insaf/1/2', [
				'isi_berita' => $request->isi_berita,
				'mmsi' => $request->mmsi,
			]);
			$decode_srop = $response_srop->json();
			$tagihan_srop = $decode_srop['data'];
			return $tagihan_srop;
			// return "srop";
		}
	}

    // ship arrival =================================================================================
    public function arrival_date_range(Request $request)
	{
		$response = Http::post('localhost:3000/api/ship_arrival/insaf/read/range', [
            'range1' => $request->time1,
            'range2' => $request->time2,
        ]);
     
        $decode = $response->json();

        $ships_arrival = $decode[1][0]['rows'];
        
        ($ships_arrival == null) ? $tanggal_range = 'Tidak ada data di tanggal '.$request->time1.' s/d '. $request->time2 : $tanggal_range = ''; 
        
        return view('pages.ship_arrival.index', compact('ships_arrival','tanggal_range'));
	}
	public function arrival()
    {
        // list ship arrival
        $response = Http::post('localhost:3000/api/ship_arrival/insaf/read', [
            'page' => '',
            'rows' => 100,
        ]);
        $decode = $response->json();
        $ships_arrival = $decode[1][0]['rows'];

		($ships_arrival == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';
        
        return view('pages.ship_arrival.index', compact('ships_arrival','tanggal_range'));
    }
    public function arrival_srop_create()
    {
        // TGPRK/SROP.ARV/2021.07.16/1 KODE OTOMATIS
        $kodejurnal = DB::table('tbl_insaf_ship_activity')->where(['ship_status' => 1])->orderBy('id', 'desc')->first(); 
        // dd($kodejurnal);
        if($kodejurnal == null )
        {
            $no_jurnal = 'TGPRK/SROP.ARV/'.date('Y.n.d').'/1';
        }
        else
        {
            $split_kode = explode("/", $kodejurnal->no_jurnal);
            $get_kode_nomor = $split_kode['3'];
            $penjumlahan_kode = $get_kode_nomor + 1;
            $no_jurnal = 'TGPRK/SROP.ARV/'.date('Y.n.d').'/'.$penjumlahan_kode;
        }

        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        $jenis_pelayaran = [
            ['id' => '1', 'value' => 'Dalam Negeri'],
            ['id' => '2', 'value' => 'Luar Negeri'],
        ];
        
        // ais status navigation
        $response2 = Http::get('localhost:3000/api/ais_status_navigaion/');
        $decode_status_navigation = $response2->json();
        $data_status_navigation = $decode_status_navigation['data'][0][0]['rows'];
        $status_bernavigasi = $data_status_navigation;
        
        $sumber_informasi_awal = [
            // ['id' => '1', 'value' => 'VTS (Radio Communication VHF)'],
            ['id' => '2', 'value' => 'SROP (Master Cable)'],
        ];

        $agen_kapal = [
            ['id' => '1', 'value' => 'PT. Ratu Oceania'],
            ['id' => '2', 'value' => 'CTI Group Indonesia'],
            ['id' => '3', 'value' => 'PT Samudera Indonesia'],
            ['id' => '4', 'value' => 'PT Sumber Bakat Insani'],
            ['id' => '5', 'value' => 'Alpha Magsaysay'],
        ];
        
        $pelabuhan = [
            ['id' => 1, 'value' => 'TG Priok'],
            ['id' => 2, 'value' => 'Merak'],
            ['id' => 3, 'value' => 'Panjang'],
            ['id' => 4, 'value' => 'Cirebon'],
            ['id' => 5, 'value' => 'Bengkulu'],
        ];
        
        $dermaga = [
            ['id' => '1', 'value' => 'Dermaga 1'],
            ['id' => '2', 'value' => 'Dermaga 2'],
            ['id' => '3', 'value' => 'Dermaga 3'],
        ];
        
        return view('pages.ship_arrival.create_srop', compact('no_jurnal','kapal','jenis_pelayaran','status_bernavigasi','sumber_informasi_awal','agen_kapal','pelabuhan','dermaga'));
    }
	public function arrival_vts_create()
    {
		// TGPRK/VTS.ARV/2021.07.16/1 KODE OTOMATIS
        $kodejurnal = DB::table('tbl_insaf_ship_activity')->where(['ship_status' => 1])->orderBy('id', 'desc')->first();
        // dd($kodejurnal);
        if($kodejurnal == null )
        {
            $no_jurnal = 'TGPRK/VTS.ARV/'.date('Y.n.d').'/1';
        }
        else
        {
            $split_kode = explode("/", $kodejurnal->no_jurnal);
            $get_kode_nomor = $split_kode['3'];
            $penjumlahan_kode = $get_kode_nomor + 1;
            $no_jurnal = 'TGPRK/VTS.ARV/'.date('Y.n.d').'/'.$penjumlahan_kode;
        }

        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        $jenis_pelayaran = [
            ['id' => '1', 'value' => 'Dalam Negeri'],
            ['id' => '2', 'value' => 'Luar Negeri'],
        ];
        
        // ais status navigation
        $response2 = Http::get('localhost:3000/api/ais_status_navigaion/');
        $decode_status_navigation = $response2->json();
        $data_status_navigation = $decode_status_navigation['data'][0][0]['rows'];
        $status_bernavigasi = $data_status_navigation;
        
        $sumber_informasi_awal = [
            ['id' => '1', 'value' => 'VTS (Radio Communication VHF)'],
            // ['id' => '2', 'value' => 'SROP (Master Cable)'],
        ];

        $agen_kapal = [
            ['id' => '1', 'value' => 'PT. Ratu Oceania'],
            ['id' => '2', 'value' => 'CTI Group Indonesia'],
            ['id' => '3', 'value' => 'PT Samudera Indonesia'],
            ['id' => '4', 'value' => 'PT Sumber Bakat Insani'],
            ['id' => '5', 'value' => 'Alpha Magsaysay'],
        ];
        
        $pelabuhan = [
            ['id' => 1, 'value' => 'TG Priok'],
            ['id' => 2, 'value' => 'Merak'],
            ['id' => 3, 'value' => 'Panjang'],
            ['id' => 4, 'value' => 'Cirebon'],
            ['id' => 5, 'value' => 'Bengkulu'],
        ];
        
        $dermaga = [
            ['id' => '1', 'value' => 'Dermaga 1'],
            ['id' => '2', 'value' => 'Dermaga 2'],
            ['id' => '3', 'value' => 'Dermaga 3'],
        ];
        
        return view('pages.ship_arrival.create_vts', compact('no_jurnal','kapal','jenis_pelayaran','status_bernavigasi','sumber_informasi_awal','agen_kapal','pelabuhan','dermaga'));
    }
    public function arrival_store(Request $request)
    {
        // dd($request->all());

		if($request->sumber_informasi == 1)
		{
			$url = 'http://localhost:3000/api/ship_arrival/insaf/create/1';
			$response = Http::post($url, [
				'no_jurnal' => $request->no_jurnal,
				'tanggal' => $request->tanggal,
				'sumber_informasi' => $request->sumber_informasi,
				'keterangan' => $request->keterangan,
				'agen' => $request->agen,
				'jenis_pelayaran' => $request->jenis_pelayaran,
				'mmsi' => $request->mmsi,
				'status_bernavigasi' => $request->status_bernavigasi,
				'degree1' => $request->degree1,
				'minute1' => $request->minute1,
				'second1' => $request->second1,
				'direction1' => $request->direction1,
				'degree2' => $request->degree2,
				'minute2' => $request->minute2,
				'second2' => $request->second2,
				'direction2' => $request->direction2,
				'pelabuhan_asal' => $request->pelabuhan_asal,
				'pelabuhan_tujuan' => $request->pelabuhan_tujuan,
				'eta' => $request->eta,
				'kurs_tengah' => $request->kurs_tengah,
				'total_tagihan' => $request->total_tagihan,
				'ship_status' => 1,
			]);
			
			$decode = $response->json();
	
			if($decode['success'] == true) {
				session()->flash('success', 'Ship Arrival VTS (Radio Communication VFH) Berhasil Dibuat.');
				return redirect()->route('ship_arrival.insaf');
			} else {
				session()->flash('error', 'Ship Arrival VTS (Radio Communication VFH) Gagal Dibuat !');
				return redirect()->route('ship_arrival.insaf');
			}
		}
		elseif($request->sumber_informasi == 2)
		{
			$berita_tambahan = [
				[
					'berita_tambahan_1' => $request->berita_tambahan_1 ?? 0,
					'nama_permintaan_1' => 'Jenis Muatan',
					'isi_berita_tambahan_1' => $request->isi_berita_tambahan_1,
				],
				[
					'berita_tambahan_2' => $request->berita_tambahan_2 ?? 0,
					'nama_permintaan_2' => 'Permintaan Lokasi Sandar',
					'isi_berita_tambahan_2' => $request->isi_berita_tambahan_2,
				],
				[
					'berita_tambahan_3' => $request->berita_tambahan_3 ?? 0,
					'nama_permintaan_3' => 'Permintaan Lokasi STS',
					'isi_berita_tambahan_3' => $request->isi_berita_tambahan_3,
				],
				[
					'berita_tambahan_4' => $request->berita_tambahan_4 ?? 0,
					'nama_permintaan_4' => 'Permintaan Karantina',
					'isi_berita_tambahan_4' => $request->isi_berita_tambahan_4,
				],
				[
					'berita_tambahan_5' => $request->berita_tambahan_5 ?? 0,
					'nama_permintaan_5' => 'Permintaan Pemeriksaan Bea Cukai',
					'isi_berita_tambahan_5' => $request->isi_berita_tambahan_5,
				],
				[
					'berita_tambahan_6' => $request->berita_tambahan_6 ?? 0,
					'nama_permintaan_6' => 'Permintaan Pemeriksaan Imigrasi',
					'isi_berita_tambahan_6' => $request->isi_berita_tambahan_6,
				],
				[
					'berita_tambahan_7' => $request->berita_tambahan_7 ?? 0,
					'nama_permintaan_7' => 'Permintaan Bunker Bahan Bakar',
					'isi_berita_tambahan_7' => $request->isi_berita_tambahan_7,
				],
				[
					'berita_tambahan_8' => $request->berita_tambahan_8 ?? 0,
					'nama_permintaan_8' => 'Permintaan Bunker Air Tawar',
					'isi_berita_tambahan_8' => $request->isi_berita_tambahan_8,
				],
				[
					'berita_tambahan_9' => $request->berita_tambahan_9 ?? 0,
					'nama_permintaan_9' => 'Permintaan Ship Chandler',
					'isi_berita_tambahan_9' => $request->isi_berita_tambahan_9,
				],
				[
					'berita_tambahan_10' => $request->berita_tambahan_10 ?? 0,
					'nama_permintaan_10' => 'Permintaan Suku Cadang',
					'isi_berita_tambahan_10' => $request->isi_berita_tambahan_10,
				],
				[
					'berita_tambahan_11' => $request->berita_tambahan_11 ?? 0,
					'nama_permintaan_11' => 'Permintaan Layanan Perbaikan Kapal',
					'isi_berita_tambahan_11' => $request->isi_berita_tambahan_11,
				],
				[
					'berita_tambahan_12' => $request->berita_tambahan_12 ?? 0,
					'nama_permintaan_12' => 'Permintaan Ambulance',
					'isi_berita_tambahan_12' => $request->isi_berita_tambahan_12,
				],
				[
					'berita_tambahan_13' => $request->berita_tambahan_13 ?? 0,
					'nama_permintaan_13' => 'Permintaan Layanan Medis',
					'isi_berita_tambahan_13' => $request->isi_berita_tambahan_13,
				],
				[
					'berita_tambahan_14' => $request->berita_tambahan_14 ?? 0,
					'nama_permintaan_14' => 'Permintaan Layanan Fumigasi',
					'isi_berita_tambahan_14' => $request->isi_berita_tambahan_14,
				],
				[
					'berita_tambahan_15' => $request->berita_tambahan_15 ?? 0,
					'nama_permintaan_15' => 'Permintaan Layanan Crewing',
					'isi_berita_tambahan_15' => $request->isi_berita_tambahan_15,
				],
				[
					'berita_tambahan_16' => $request->berita_tambahan_16 ?? 0,
					'nama_permintaan_16' => 'Permintaan Layanan Sertifikasi Dan Buku Pelaut',
					'isi_berita_tambahan_16' => $request->isi_berita_tambahan_16,
				],
				[
					'berita_tambahan_17' => $request->berita_tambahan_17 ?? 0,
					'nama_permintaan_17' => 'Informasi / Permintaan Lain',
					'isi_berita_tambahan_17' => $request->isi_berita_tambahan_17,
				],
			];
			$data_berita_tambahan = json_encode($berita_tambahan);
	
			$url = 'http://localhost:3000/api/ship_arrival/insaf/create/2';
			$response = Http::post($url, [
				'no_jurnal' => $request->no_jurnal,
				'tanggal' => $request->tanggal,
				'sumber_informasi' => $request->sumber_informasi,
				'keterangan' => $request->keterangan,
				'agen' => $request->agen,
				'jenis_pelayaran' => $request->jenis_pelayaran,
				'mmsi' => $request->mmsi,
				'status_bernavigasi' => $request->status_bernavigasi,
				'degree1' => $request->degree1,
				'minute1' => $request->minute1,
				'second1' => $request->second1,
				'direction1' => $request->direction1,
				'degree2' => $request->degree2,
				'minute2' => $request->minute2,
				'second2' => $request->second2,
				'direction2' => $request->direction2,
				'pelabuhan_asal' => $request->pelabuhan_asal,
				'pelabuhan_tujuan' => $request->pelabuhan_tujuan,
				'eta' => $request->eta,
				'preamble' => $request->preamble,
				'isi_berita' => $request->isi_berita,
				'ck' => $request->ck,
				'kurs_tengah' => $request->kurs_tengah,
				'tagihan_lsc' => $request->tagihan_lsc,
				'tagihan_llc' => $request->tagihan_llc,
				'berita_tambahan' => $data_berita_tambahan,
				'total_tagihan' => $request->total_tagihan,
				'ship_status' => 1,
			]);
			
			$decode = $response->json();
	
			if($decode['success'] == true) {
				session()->flash('success', 'Ship Arrival Berhasil Dibuat.');
				return redirect()->route('ship_arrival.insaf');
			} else {
				session()->flash('error', 'Ship Arrival Gagal Dibuat !');
				return redirect()->route('ship_arrival.insaf');
			}
		}
    }
	public function arrival_srop_edit($id = null)
    {
		//  get data main srop arrival
		$response_srop = Http::get('localhost:3000/api/ship_arrival/insaf/read/'.$id);
        $decode_data_srop = $response_srop->json();
        $data_srop = $decode_data_srop['data'][0];
        $srop = $data_srop;

		// get berita tambahan
        $berita_tambahan = json_decode($data_srop['berita_tambahan']);
		// dd($berita_tambahan[14]);

		$response_old_ship = Http::get('localhost:3000/api/kapal/masdex/read/'.$srop['mmsi']);
        $decode_data_old_ship = $response_old_ship->json();
        $data_old_ship = $decode_data_old_ship['data'][0];
        $old_ship = $data_old_ship;

        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        $jenis_pelayaran = [
            ['id' => '1', 'value' => 'Dalam Negeri'],
            ['id' => '2', 'value' => 'Luar Negeri'],
        ];
        
        // ais status navigation
        $response2 = Http::get('localhost:3000/api/ais_status_navigaion/');
        $decode_status_navigation = $response2->json();
        $data_status_navigation = $decode_status_navigation['data'][0][0]['rows'];
        $status_bernavigasi = $data_status_navigation;
        
        $sumber_informasi_awal = [
            // ['id' => '1', 'value' => 'VTS (Radio Communication VHF)'],
            ['id' => '2', 'value' => 'SROP (Master Cable)'],
        ];

        $agen_kapal = [
            ['id' => '1', 'value' => 'PT. Ratu Oceania'],
            ['id' => '2', 'value' => 'CTI Group Indonesia'],
            ['id' => '3', 'value' => 'PT Samudera Indonesia'],
            ['id' => '4', 'value' => 'PT Sumber Bakat Insani'],
            ['id' => '5', 'value' => 'Alpha Magsaysay'],
        ];
        
        $pelabuhan = [
            ['id' => 1, 'value' => 'TG Priok'],
            ['id' => 2, 'value' => 'Merak'],
            ['id' => 3, 'value' => 'Panjang'],
            ['id' => 4, 'value' => 'Cirebon'],
            ['id' => 5, 'value' => 'Bengkulu'],
        ];
        
        $dermaga = [
            ['id' => '1', 'value' => 'Dermaga 1'],
            ['id' => '2', 'value' => 'Dermaga 2'],
            ['id' => '3', 'value' => 'Dermaga 3'],
        ];
        
        return view('pages.ship_arrival.edit_srop', compact( 'srop','berita_tambahan','kapal','old_ship','jenis_pelayaran','status_bernavigasi','sumber_informasi_awal','agen_kapal','pelabuhan','dermaga'));
    }
	public function arrival_vts_edit($id = null)
    {
        $response_vts = Http::get('localhost:3000/api/ship_arrival/insaf/read/'.$id);
        $decode_data_vts = $response_vts->json();
        $data_vts = $decode_data_vts['data'][0];
        $vts = $data_vts;
        
		$response_old_ship = Http::get('localhost:3000/api/kapal/masdex/read/'.$vts['mmsi']);
        $decode_data_old_ship = $response_old_ship->json();
        $data_old_ship = $decode_data_old_ship['data'][0];
        $old_ship = $data_old_ship;

		// dd($old_ship);

        $jenis_pelayaran = [
            ['id' => '1', 'value' => 'Dalam Negeri'],
            ['id' => '2', 'value' => 'Luar Negeri'],
        ];

        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

        $jenis_pelayaran = [
            ['id' => '1', 'value' => 'Dalam Negeri'],
            ['id' => '2', 'value' => 'Luar Negeri'],
        ];
        
        // ais status navigation
        $response2 = Http::get('localhost:3000/api/ais_status_navigaion/');
        $decode_status_navigation = $response2->json();
        $data_status_navigation = $decode_status_navigation['data'][0][0]['rows'];
        $status_bernavigasi = $data_status_navigation;
        
        $sumber_informasi_awal = [
            ['id' => '1', 'value' => 'VTS (Radio Communication VHF)'],
            // ['id' => '2', 'value' => 'SROP (Master Cable)'],
        ];

        $agen_kapal = [
            ['id' => '1', 'value' => 'PT. Ratu Oceania'],
            ['id' => '2', 'value' => 'CTI Group Indonesia'],
            ['id' => '3', 'value' => 'PT Samudera Indonesia'],
            ['id' => '4', 'value' => 'PT Sumber Bakat Insani'],
            ['id' => '5', 'value' => 'Alpha Magsaysay'],
        ];
        
        $pelabuhan = [
            ['id' => 1, 'value' => 'TG Priok'],
            ['id' => 2, 'value' => 'Merak'],
            ['id' => 3, 'value' => 'Panjang'],
            ['id' => 4, 'value' => 'Cirebon'],
            ['id' => 5, 'value' => 'Bengkulu'],
        ];
        
        $dermaga = [
            ['id' => '1', 'value' => 'Dermaga 1'],
            ['id' => '2', 'value' => 'Dermaga 2'],
            ['id' => '3', 'value' => 'Dermaga 3'],
        ];
        
        return view('pages.ship_arrival.edit_vts', compact('vts','old_ship','kapal','jenis_pelayaran','status_bernavigasi','sumber_informasi_awal','agen_kapal','pelabuhan','dermaga'));
    }
	public function arrival_update(Request $request)
    {
        // dd($request->all());

		if($request->sumber_informasi == 1) // VTS
		{
			// dd($request->all());
			$url = 'http://localhost:3000/api/ship_arrival/insaf/update/'.$request->id;
			$response = Http::put($url, [
				'no_jurnal' => $request->no_jurnal,
				'tanggal' => $request->tanggal,
				'sumber_informasi' => $request->sumber_informasi,
				'keterangan' => $request->keterangan,
				'agen' => $request->agen,
				'jenis_pelayaran' => $request->jenis_pelayaran,
				'mmsi' => $request->mmsi,
				'status_bernavigasi' => $request->status_bernavigasi,
				'degree1' => $request->degree1,
				'minute1' => $request->minute1,
				'second1' => $request->second1,
				'direction1' => $request->direction1,
				'degree2' => $request->degree2,
				'minute2' => $request->minute2,
				'second2' => $request->second2,
				'direction2' => $request->direction2,
				'pelabuhan_asal' => $request->pelabuhan_asal,
				'pelabuhan_tujuan' => $request->pelabuhan_tujuan,
				'eta' => $request->eta,
				'kurs_tengah' => $request->kurs_tengah,
				'total_tagihan' => $request->total_tagihan,
				// 'pintu_kedatangan' => 2,
				// // 'ship_status' => 1,
			]);
			
			$decode = $response->json();
	
			if($decode['success'] == true) {
				session()->flash('success', 'Ship Arrival VTS (Radio Communication VFH) Berhasil Diperbarui.');
				return redirect()->route('ship_arrival.insaf');
			} else {
				session()->flash('error', 'Ship Arrival VTS (Radio Communication VFH) Gagal Diperbarui !');
				return redirect()->route('ship_arrival.insaf');
			}
		}
		elseif($request->sumber_informasi == 2) // SROP
		{
			$berita_tambahan = [
				[
					'berita_tambahan_1' => $request->berita_tambahan_1 ?? 0,
					'nama_permintaan_1' => 'Jenis Muatan',
					'isi_berita_tambahan_1' => $request->isi_berita_tambahan_1,
				],
				[
					'berita_tambahan_2' => $request->berita_tambahan_2 ?? 0,
					'nama_permintaan_2' => 'Permintaan Lokasi Sandar',
					'isi_berita_tambahan_2' => $request->isi_berita_tambahan_2,
				],
				[
					'berita_tambahan_3' => $request->berita_tambahan_3 ?? 0,
					'nama_permintaan_3' => 'Permintaan Lokasi STS',
					'isi_berita_tambahan_3' => $request->isi_berita_tambahan_3,
				],
				[
					'berita_tambahan_4' => $request->berita_tambahan_4 ?? 0,
					'nama_permintaan_4' => 'Permintaan Karantina',
					'isi_berita_tambahan_4' => $request->isi_berita_tambahan_4,
				],
				[
					'berita_tambahan_5' => $request->berita_tambahan_5 ?? 0,
					'nama_permintaan_5' => 'Permintaan Pemeriksaan Bea Cukai',
					'isi_berita_tambahan_5' => $request->isi_berita_tambahan_5,
				],
				[
					'berita_tambahan_6' => $request->berita_tambahan_6 ?? 0,
					'nama_permintaan_6' => 'Permintaan Pemeriksaan Imigrasi',
					'isi_berita_tambahan_6' => $request->isi_berita_tambahan_6,
				],
				[
					'berita_tambahan_7' => $request->berita_tambahan_7 ?? 0,
					'nama_permintaan_7' => 'Permintaan Bunker Bahan Bakar',
					'isi_berita_tambahan_7' => $request->isi_berita_tambahan_7,
				],
				[
					'berita_tambahan_8' => $request->berita_tambahan_8 ?? 0,
					'nama_permintaan_8' => 'Permintaan Bunker Air Tawar',
					'isi_berita_tambahan_8' => $request->isi_berita_tambahan_8,
				],
				[
					'berita_tambahan_9' => $request->berita_tambahan_9 ?? 0,
					'nama_permintaan_9' => 'Permintaan Ship Chandler',
					'isi_berita_tambahan_9' => $request->isi_berita_tambahan_9,
				],
				[
					'berita_tambahan_10' => $request->berita_tambahan_10 ?? 0,
					'nama_permintaan_10' => 'Permintaan Suku Cadang',
					'isi_berita_tambahan_10' => $request->isi_berita_tambahan_10,
				],
				[
					'berita_tambahan_11' => $request->berita_tambahan_11 ?? 0,
					'nama_permintaan_11' => 'Permintaan Layanan Perbaikan Kapal',
					'isi_berita_tambahan_11' => $request->isi_berita_tambahan_11,
				],
				[
					'berita_tambahan_12' => $request->berita_tambahan_12 ?? 0,
					'nama_permintaan_12' => 'Permintaan Ambulance',
					'isi_berita_tambahan_12' => $request->isi_berita_tambahan_12,
				],
				[
					'berita_tambahan_13' => $request->berita_tambahan_13 ?? 0,
					'nama_permintaan_13' => 'Permintaan Layanan Medis',
					'isi_berita_tambahan_13' => $request->isi_berita_tambahan_13,
				],
				[
					'berita_tambahan_14' => $request->berita_tambahan_14 ?? 0,
					'nama_permintaan_14' => 'Permintaan Layanan Fumigasi',
					'isi_berita_tambahan_14' => $request->isi_berita_tambahan_14,
				],
				[
					'berita_tambahan_15' => $request->berita_tambahan_15 ?? 0,
					'nama_permintaan_15' => 'Permintaan Layanan Crewing',
					'isi_berita_tambahan_15' => $request->isi_berita_tambahan_15,
				],
				[
					'berita_tambahan_16' => $request->berita_tambahan_16 ?? 0,
					'nama_permintaan_16' => 'Permintaan Layanan Sertifikasi Dan Buku Pelaut',
					'isi_berita_tambahan_16' => $request->isi_berita_tambahan_16,
				],
				[
					'berita_tambahan_17' => $request->berita_tambahan_17 ?? 0,
					'nama_permintaan_17' => 'Informasi / Permintaan Lain',
					'isi_berita_tambahan_17' => $request->isi_berita_tambahan_17,
				],
			];
			$data_berita_tambahan = json_encode($berita_tambahan);
	
			$url = 'http://localhost:3000/api/ship_arrival/insaf/update/'.$request->id;
			$response = Http::put($url, [
				'no_jurnal' => $request->no_jurnal,
				'tanggal' => $request->tanggal,
				'sumber_informasi' => $request->sumber_informasi,
				'keterangan' => $request->keterangan,
				'agen' => $request->agen,
				'jenis_pelayaran' => $request->jenis_pelayaran,
				'mmsi' => $request->mmsi,
				'status_bernavigasi' => $request->status_bernavigasi,
				'degree1' => $request->degree1,
				'minute1' => $request->minute1,
				'second1' => $request->second1,
				'direction1' => $request->direction1,
				'degree2' => $request->degree2,
				'minute2' => $request->minute2,
				'second2' => $request->second2,
				'direction2' => $request->direction2,
				'pelabuhan_asal' => $request->pelabuhan_asal,
				'pelabuhan_tujuan' => $request->pelabuhan_tujuan,
				'eta' => $request->eta,
				'preamble' => $request->preamble,
				'isi_berita' => $request->isi_berita,
				'ck' => $request->ck,
				'kurs_tengah' => $request->kurs_tengah,
				'tagihan_lsc' => $request->tagihan_lsc,
				'tagihan_llc' => $request->tagihan_llc,
				'berita_tambahan' => $data_berita_tambahan,
				'total_tagihan' => $request->total_tagihan,
				// 'ship_status' => 1,
			]);
			
			$decode = $response->json();
	
			if($decode['success'] == true) {
				session()->flash('success', 'Ship Arrival Berhasil Diperbarui.');
				return redirect()->route('ship_arrival.insaf');
			} else {
				session()->flash('error', 'Ship Arrival Gagal Diperbarui !');
				return redirect()->route('ship_arrival.insaf');
			}
		}
    }
    public function arrival_detail()
    {
        return view('pages.ship_arrival.detail');
    }
    public function arrival_delete(Request $request)
    {
        $response = Http::delete('localhost:3000/api/ship_arrival/insaf/delete/'.$request->id);
        
        $decode = $response->json();

        if($decode['success'] == true) {
            session()->flash('success', 'Ship Arrival Berhasil Dihapus.');
            return redirect()->back();
        } else {
            session()->flash('error', 'Ship Arrival Gagal Dihapus !');
            return redirect()->back();
        }
    }

    // ship departure ===============================================================================
    public function departure()
    {
		$searchtext = isset($_GET["search"]) ? $_GET["search"] : "";
		$time1 = isset($_GET["time1"]) ? $_GET["time1"] : "";
		$time2 = isset($_GET["time2"]) ? $_GET["time2"] : "";
		$page = isset($_GET["page"]) ? $_GET["page"] : '1' ;
		$target = isset($_GET["target"]) ? $_GET["target"] : "" ;
		$rows = '10';
		if($searchtext != "")
		{
			$url = 'localhost:3000/api/ship_departure/insaf/search/'.$searchtext;
			$response = Http::get($url, []);
		}
		elseif($time1 != "" and $time2 != "")
		{
			$url = 'localhost:3000/api/ship_departure/insaf/show/'.$time1.'/'.$time2;
			$response = Http::get($url, []);
		}
		elseif($target != '')
		{
			$url = 'localhost:3000/api/ship_departure/insaf/order/'.$target;
			$response = Http::get($url, []);
		}
		else
		{	
			$response = Http::get('localhost:3000/api/ship_departure/insaf/', []);
		}
		
		// $rows dan $page belum berfungsi dengan bener
		$decode = $response->json();
		
		$data = $decode[1][0];
		
		$total = $decode[0];
		$array = [];
		foreach($data as $datas)
		{
			// buat jadi array
			foreach($datas as $datalagi)
			{
				array_push($array, $datalagi);
			}
		}
		
        return view('pages.ship_departure.index', compact('array'));
    }
    public function departure_create()
    {
		$response = Http::get('localhost:3000/api/ship_on_port/insaf/', []);
		$decode = $response->json();
		$data = $decode[1][0];
		$total = (int) $decode[0]["total"];
		if($total == 0)
		{
			$response = Http::post('localhost:3000/api/ship_arrival/insaf/read', []);
			$decode = $response->json();
			$data = $decode[1][0];
			$total = (int) $decode[0]["total"];
			
			if($total == 0)
			{
				return redirect()->back()->with('error', 'Harap untuk mengisi data ship arrival terlebih dahulu');
			}
		}
		
		$response = Http::post('localhost:3000/api/kapal/masdex/read', []);
		$decode = $response->json();
		$objectkapal = $decode["data"][1];
		$totalkapal = $decode["data"][0];
		
		$kapal = [];
		foreach($objectkapal as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($kapal, $arraylagi);					
				}
			}
		}
		
		$response = Http::get('localhost:3000/api/ship_departure/insaf/latest/', []);
		$decode = $response->json();
		$no_jurnal = $decode["no_jurnal"];
		
        return view('pages.ship_departure.create', compact('kapal', 'no_jurnal'));
    }
	public function departure_store(Request $request)
	{
		request()->validate([
			'mmsi' => 'required',
		],
		[
			'mmsi.required' => 'Belum ada kapal yang dipilih! Silakan pilih kapal terlebih dahulu.',
		]);
		
		$userid = session('id');
		
		if($request->keterangan_tambahan == '')
		{
			$request->keterangan_tambahan = 'null';
		}
		
		if($request->hasFile('dok_spb'))
		{
			$response = Http::attach(
				'dataFile', file_get_contents($request->dok_spb), 'spb.pdf'
			)->post('localhost:3000/api/insaf/uploadfile');
			
			$result = $response->json();
			$request->dok_spb = $result["file"]["filename"];
		}
		else
		{
			$request->dok_spb = 'null';
		}
		
		if($request->hasFile('dok_beacukai'))
		{
			$response = Http::attach(
				'dataFile', file_get_contents($request->dok_beacukai), 'beacukai.pdf'
			)->post('localhost:3000/api/insaf/uploadfile');
			
			$result = $response->json();
			$request->dok_beacukai = $result["file"]["filename"];
		}
		else
		{
			$request->dok_beacukai = 'null';
		}
		
		if($request->hasFile('dok_imigrasi'))
		{
			$response = Http::attach(
				'dataFile', file_get_contents($request->dok_imigrasi), 'imigrasi.pdf'
			)->post('localhost:3000/api/insaf/uploadfile');
			
			$result = $response->json();
			$request->dok_imigrasi = $result["file"]["filename"];
		}
		else
		{
			$request->dok_imigrasi = 'null';
		}
		
		if($request->hasFile('dok_karantina'))
		{
			$response = Http::attach(
				'dataFile', file_get_contents($request->dok_karantina), 'karantina.pdf'
			)->post('localhost:3000/api/insaf/uploadfile');
			
			$result = $response->json();
			$request->dok_karantina = $result["file"]["filename"];
		}
		else
		{
			$request->dok_karantina = 'null';
		}
		
		$date = Carbon::now();
		$time = $date->isoFormat('Y-MM-D hh:mm:ss');
		
		$tanggal = $this->convertdate($request->tanggal, "todb");
		$tanggal_komunikasi = $this->convertdate($request->tanggal_komunikasi, "todb");
		
		$url = 'localhost:3000/api/ship_departure/insaf/update';
		$response = Http::put($url, [
			'no_jurnal' => $request->no_jurnal,
			'tanggal' => $tanggal,
			'keterangan_tambahan' => $request->keterangan_tambahan,
			'mmsi' => $request->mmsi,
			'radio_notif' => $request->radio_notif,
			'tanggal_komunikasi' => $tanggal_komunikasi,
			'dok_beacukai' => $request->dok_beacukai,
			'dok_imigrasi' => $request->dok_imigrasi,
			'dok_karantina' => $request->dok_karantina,
			'dok_spb' => $request->dok_spb,
			'updated_at' => $time,
			'updated_by' => $userid,
		]);
		
		$decode = $response->json();
		
		if($decode['success'] == true)
		{
			$url = 'localhost:3000/api/log_ship_departure/insaf/store';
			$response = Http::post($url, [
				'no_jurnal' => $request->no_jurnal,
				'tanggal' => $tanggal,
				'keterangan_tambahan' => $request->keterangan_tambahan,
				'mmsi' => $request->mmsi,
				'radio_notif' => $request->radio_notif,
				'tanggal_komunikasi' => $tanggal_komunikasi,
				'dok_beacukai' => $request->dok_beacukai,
				'dok_imigrasi' => $request->dok_imigrasi,
				'dok_karantina' => $request->dok_karantina,
				'dok_spb' => $request->dok_spb,
				'created_at' => $time,
				'created_by' => $userid,
			]);
			
			$decode = $response->json();
		
			if($decode['success'] == true)
			{
				return redirect()->route('ship_departure.insaf')->with('success', 'Data Ship Departure berhasil disimpan');
			}
			else
			{
				return redirect()->back()->with('error', 'Error to save data');
			}
		}
		else
		{
			return redirect()->back()->with('error', 'Error to save data');
		}
	}
    public function departure_detail($id)
    {
		$url = 'localhost:3000/api/ship_departure/insaf/show/'.$id;
		$response = Http::get($url, []);
		$getdata = $response->json();
		$shipdata = $getdata[0];
		
		$title = "Ship Departure - ".$shipdata['ship_name'];
        return view('pages.ship_departure.detail', compact('title', 'shipdata'));
    }

    // ship on port =================================================================================
    public function on_port()
    {
		$searchtext = isset($_GET["search"]) ? $_GET["search"] : "";
		$time1 = isset($_GET["time1"]) ? $_GET["time1"] : "";
		$time2 = isset($_GET["time2"]) ? $_GET["time2"] : "";
		$page = isset($_GET["page"]) ? $_GET["page"] : '1' ;
		$target = isset($_GET["target"]) ? $_GET["target"] : "" ;
		$rows = '10';
		if($searchtext != "")
		{
			$url = 'localhost:3000/api/ship_on_port/insaf/search/'.$searchtext;
			$response = Http::get($url, []);
		}
		elseif($time1 != "" and $time2 != "")
		{
			$url = 'localhost:3000/api/ship_on_port/insaf/show/'.$time1.'/'.$time2;
			$response = Http::get($url, []);
		}
		elseif($target != '')
		{
			$url = 'localhost:3000/api/ship_on_port/insaf/order/'.$target;
			$response = Http::get($url, []);
		}
		else
		{	
			$response = Http::get('localhost:3000/api/ship_on_port/insaf/', []);
		}
		
		// $rows dan $page belum berfungsi dengan bener
		$decode = $response->json();
		
		$data = $decode[1][0];
		
		$total = $decode[0];
		$array = [];
		foreach($data as $datas)
		{
			// buat jadi array
			foreach($datas as $datalagi)
			{
				array_push($array, $datalagi);
			}
		}
		
        return view('pages.ship_on_port.index', compact('array'));
    }
    public function on_port_create()
    {
		$response = Http::post('localhost:3000/api/ship_arrival/insaf/read', []);
		$decode = $response->json();
		$data = $decode[1][0];
		$total = (int) $decode[0]["total"];
			
		if($total == 0)
		{
			return redirect()->back()->with('error', 'Harap untuk mengisi data ship arrival terlebih dahulu');
		}
		
		$response = Http::post('localhost:3000/api/kapal/masdex/read', []);
		$decode = $response->json();
		$objectkapal = $decode["data"][1];
		$totalkapal = $decode["data"][0];
		
		$kapal = [];
		foreach($objectkapal as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($kapal, $arraylagi);					
				}
			}
		}
		
		$response = Http::get('localhost:3000/api/ais_status_navigaion/', []);
		$decode = $response->json();
		$navigasidata = $decode["data"][0];
		
		$status_bernavigasi = [];
		foreach($navigasidata as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($status_bernavigasi, $arraylagi);					
				}
			}
		}
		
		$response = Http::get('localhost:3000/api/ship_on_port/satuanvolume/', []);
		$decode = $response->json();
		
		$satuanvolume = [];
		foreach($decode as $data)
		{
			array_push($satuanvolume, $data);
		}
		
		$pelabuhan = [
            ['id' => '1', 'value' => 'Pelabuhan 1'],
            ['id' => '2', 'value' => 'Pelabuhan 2'],
            ['id' => '3', 'value' => 'Pelabuhan 3'],
        ];
		
		$response = Http::get('localhost:3000/api/ship_on_port/insaf/latest/', []);
		$decode = $response->json();
		$no_jurnal = $decode['no_jurnal'];
		
        return view('pages.ship_on_port.create', compact('kapal', 'no_jurnal', 'pelabuhan', 'status_bernavigasi', 'satuanvolume'));
    }
	public function on_port_store(Request $request)
	{
		/*
			degree1_anchorage = pilihan data untuk degree1_request diisi oleh degree1 milik anchorage
			list : 
				- anchorage
				- sts
				- sea_trial
				- emergency
		*/
		
		if($request->pelabuhan_asal == $request->pelabuhan_tujuan)
		{
			return redirect()->back()->with('error', 'Harap untuk mengisi tujuan pelabuhan berbeda')->withInput();
		}
		
		request()->validate([
			'mmsi' => 'required',
			'muatan' => 'required',
			'master_onboard' => 'required|string',
			'nohp1' => 'required|integer',
			'second_officer' => 'required|string',
			'nohp2' => 'required|integer',
			'keterangan_tambahan' => 'string',
		],
		[
			'mmsi.required' => 'Belum ada kapal yang dipilih! Silakan pilih kapal terlebih dahulu.',
			'muatan.required' => 'Harap untuk mengisi muatan terlebih dahulu.',
			'master_onboard.required' => 'Harap untuk mengisi nama Master On Board terlebih dahulu.',
			'master_onboard.string' => 'Harap untuk mengisi nama Master On Board berupa huruf.',
			'nohp1.required' => 'Harap untuk mengisi nomor Master On Board terlebih dahulu.',
			'nohp1.string' => 'Harap untuk mengisi nomor Master On Board berupa angka.',
			'second_officer.required' => 'Harap untuk mengisi nama Operator kedua terlebih dahulu.',
			'second_officer.string' => 'Harap untuk mengisi nama Operator kedua berupa huruf.',
			'nohp2.required' => 'Harap untuk mengisi nomor Operator kedua terlebih dahulu.',
			'nohp2.string' => 'Harap untuk mengisi nomor Operator kedua berupa angka.',
			'keterangan_tambahan.string' => 'Harap untuk mengisi keterangan tambahan kapal di dermaga berupa angka.',
		]);
		
		// cek apabila ada user input request koordinasi
		if($request->degree1 != '' or $request->degree2 != '' or $request->minute1 != '' or $request->minute2 != '' or $request->second1 != '' or $request->second2 != '')
		{
			request()->validate([
				'degree1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'minute1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'second1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'degree2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'minute2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'second2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
			],
			[
				'degree1.required' => 'Harap untuk mengisi data koordinat',
				'degree1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'minute1.required' => 'Harap untuk mengisi data koordinat',
				'minute1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'second1.required' => 'Harap untuk mengisi data koordinat',
				'second1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'degree2.required' => 'Harap untuk mengisi data koordinat',
				'degree2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'minute2.required' => 'Harap untuk mengisi data koordinat',
				'minute2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'second2.required' => 'Harap untuk mengisi data koordinat',
				'second2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
			]);
		}
		else
		{
			$request->degree1 = ' ';
			$request->minute1 = ' ';
			$request->second1 = ' ';
			$request->degree2 = ' ';
			$request->minute2 = ' ';
			$request->second2 = ' ';
		}
		
		//dd($request->all());
		// berfungsi untuk mengecek apakah data diisi atau tidak. kalo tidak dibikin kosong
		$list = ['jenis_jangkar_anchorage_request', 'need_port_area_request', 'tipe_oli_request', 'total_oli_request', 'satuan_volume_oli_request', 'operator_sts_request', 'nohp_operator_sts_request', 'lokasi_kejadian_request', 'pelabuhan_asal_request', 'pelabuhan_tujuan_request', 'jumlah_kru_request', 'jumlah_penumpang_request', 'jenis_muatan_request', 'deskripsi_kejadian_request', 'need_help_request', 'jenis_bantuan_request', 'mob_status_request', 'mob_qty_request', 'korban_luka_status_request', 'korban_luka_qty_request', 'korban_jiwa_status_request', 'korban_jiwa_qty_request', 'degree1_request', 'minute1_request', 'second1_request', 'direction1_request', 'degree2_request', 'minute2_request', 'second2_request', 'direction2_request', 'rencana_durasi_hour_request', 'rencana_durasi_minutes_request', 'tanggal_request', 'proses_kondisi_request'];
		foreach($list as $data)
		{
			$name = (string) $data;
			$result = isset($request->$name) ? $request->$name : ' ';
			//var_dump($name, $result, '<br><br>');
		}
		
		$alasan_olah_gerak = '';
		if($request->alasan_olah_gerak == '1')
		{
			request()->validate([
				'dok_spog_anchorage' => 'required|mimes:pdf',
			],
			[
				'dok_spog_anchorage.required' => 'Harap untuk mengupload dokumen SPOG',
			]);
			
			// cek apabila ada user input request koordinasi
			if($request->degree1_anchorage != '' or $request->minute1_anchorage != '' or $request->second1_anchorage != '' or $request->degree2_anchorage != '' or $request->minute2_anchorage != '' or $request->second2_anchorage != '')
			{
				request()->validate([
					'degree1_anchorage' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'minute1_anchorage' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'second1_anchorage' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'degree2_anchorage' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'minute2_anchorage' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'second2_anchorage' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				],
				[
					'degree1_anchorage.required' => 'Harap untuk mengisi data koordinat',
					'degree1_anchorage.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'minute1_anchorage.required' => 'Harap untuk mengisi data koordinat',
					'minute1_anchorage.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'second1_anchorage.required' => 'Harap untuk mengisi data koordinat',
					'second1_anchorage.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'degree2_anchorage.required' => 'Harap untuk mengisi data koordinat',
					'degree2_anchorage.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'minute2_anchorage.required' => 'Harap untuk mengisi data koordinat',
					'minute2_anchorage.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'second2_anchorage.required' => 'Harap untuk mengisi data koordinat',
					'second2_anchorage.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				]);
			}
			else
			{
				$request->degree1_anchorage = ' ';
				$request->minute1_anchorage = ' ';
				$request->second1_anchorage = ' ';
				$request->degree2_anchorage = ' ';
				$request->minute2_anchorage = ' ';
				$request->second2_anchorage = ' ';
			}
			
			$dok_spog = ' ';
			
			if($request->hasFile('dok_spog_anchorage'))
			{
				$response = Http::attach(
					'dataFile', file_get_contents($request->dok_spog_anchorage), 'tes.pdf'
				)->post('localhost:3000/api/insaf/uploadfile');
				
				$result = $response->json();
			}
			
			if($result != '')
			{
				$dok_spog = $result["file"]["filename"];
			}
			
			// tujuannya : karena datanya wajib masuk ke dalam database
			// walaupun gak dibutuhkan
			$request->dok_spog = $dok_spog;
			$request->dok_rencana_kerja_sts_request = ' ';
			$alasan_olah_gerak = 'anchorage';
		}
		elseif($request->alasan_olah_gerak == '2')
		{
			request()->validate([
				'dok_spog_sts' => 'required|mimes:pdf',
				'dok_rencana_kerja_sts_request' => 'required|mimes:pdf',
				'tipe_oli_request' => 'required|string',
				'total_oli_request' => 'required|integer',
				'rencana_durasi_hour_sts' => 'required|integer',
				'rencana_durasi_minutes_sts' => 'required|integer',
				'operator_sts_request' => 'required|string',
				'nohp_operator_sts_request' => 'required|integer',
			],
			[
				'dok_spog_sts.required' => 'Harap untuk mengupload dokumen SPOG',
				'dok_spog_sts.mimes' => 'Harap untuk mengupload dokumen SPOG berupa pdf',
				'tipe_oli_request.required' => 'Harap untuk mengisi tipe oli',
				'tipe_oli_request.string' => 'Harap untuk mengisi tipe oli berupa huruf',
				'total_oli_request.required' => 'Harap untuk mengisi jumlah oli',
				'total_oli_request.integer' => 'Harap untuk mengisi jumlah oli berupa angka',
				'rencana_durasi_hour_sts.required' => 'Harap untuk mengisi rencana durasi jam',
				'rencana_durasi_hour_sts.integer' => 'Harap untuk mengisi rencana durasi jam berupa angka',
				'rencana_durasi_minutes_sts.required' => 'Harap untuk mengisi rencana durasi menit',
				'rencana_durasi_minutes_sts.integer' => 'Harap untuk mengisi rencana durasi menit berupa angka',
				'operator_sts_request.required' => 'Harap untuk mengisi nama operator',
				'operator_sts_request.string' => 'Harap untuk mengisi nama operator berupa huruf',
				'nohp_operator_sts_request.required' => 'Harap untuk mengisi nomor kontak operator',
				'nohp_operator_sts_request.integer' => 'Harap untuk mengisi nomor kontak operator berupa angka',
				'dok_rencana_kerja_sts_request.required' => 'Harap untuk mengupload dokumen rencana kerja',
				'dok_rencana_kerja_sts_request.mimes' => 'Harap untuk mengupload dokumen rencana kerja berupa pdf',
			]);
			
			// cek apabila ada user input request koordinasi
			if($request->degree1_sts != '' or $request->minute1_sts != '' or $request->second1_sts != '' or $request->degree2_sts != '' or $request->minute2_sts != '' or $request->second2_sts != '')
			{
				request()->validate([
					'degree1_sts' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'minute1_sts' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'second1_sts' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'degree2_sts' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'minute2_sts' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'second2_sts' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				],
				[
					'degree1_sts.required' => 'Harap untuk mengisi data koordinat',
					'degree1_sts.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'minute1_sts.required' => 'Harap untuk mengisi data koordinat',
					'minute1_sts.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'second1_sts.required' => 'Harap untuk mengisi data koordinat',
					'second1_sts.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'degree2_sts.required' => 'Harap untuk mengisi data koordinat',
					'degree2_sts.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'minute2_sts.required' => 'Harap untuk mengisi data koordinat',
					'minute2_sts.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'second2_sts.required' => 'Harap untuk mengisi data koordinat',
					'second2_sts.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				]);
			}
			else
			{
				$request->degree1_sts = ' ';
				$request->minute1_sts = ' ';
				$request->second1_sts = ' ';
				$request->degree2_sts = ' ';
				$request->minute2_sts = ' ';
				$request->second2_sts = ' ';
			}
			
			$dok_spog = ' ';
			$result = '';
			
			if($request->hasFile('dok_spog_sts'))
			{
				$response = Http::attach(
					'dataFile', file_get_contents($request->dok_spog_sts), 'tes.pdf'
				)->post('localhost:3000/api/insaf/uploadfile');
				
				$result = $response->json();
			}
			
			if($result != '')
			{
				$dok_spog = $result["file"]["filename"];
			}
			
			$dok_rencana_kerja_sts_request = ' ';
			$result = '';
			
			if($request->hasFile('dok_rencana_kerja_sts_request'))
			{
				$response = Http::attach(
					'dataFile', file_get_contents($request->dok_rencana_kerja_sts_request), 'tes.pdf'
				)->post('localhost:3000/api/insaf/uploadfile');
				
				$result = $response->json();
			}
			
			if($result != '')
			{
				$dok_rencana_kerja_sts_request = $result["file"]["filename"];
			}
			
			$request->dok_spog = $dok_spog;
			$request->dok_rencana_kerja_sts_request = $dok_rencana_kerja_sts_request;
			$alasan_olah_gerak = 'sts';
		}
		elseif($request->alasan_olah_gerak == '3')
		{
			request()->validate([
				'dok_spog_sea_trial' => 'required|mimes:pdf',
				'rencana_durasi_hour_sea_trial' => 'required|integer',
				'rencana_durasi_minutes_sea_trial' => 'required|integer',
			],
			[
				'dok_spog_sea_trial.required' => 'Harap untuk mengupload dokumen SPOG',
				'dok_spog_sea_trial.mimes' => 'Harap untuk mengupload dokumen SPOG berupa pdf',
				'rencana_durasi_hour_sea_trial.required' => 'Harap untuk mengisi rencana durasi jam',
				'rencana_durasi_hour_sea_trial.integer' => 'Harap untuk mengisi rencana durasi jam berupa angka',
				'rencana_durasi_minutes_sea_trial.required' => 'Harap untuk mengisi rencana durasi menit',
				'rencana_durasi_minutes_sea_trial.integer' => 'Harap untuk mengisi rencana durasi menit berupa angka',
			]);
			
			// cek apabila ada user input request koordinasi
			if($request->degree1_sea_trial != '' or $request->minute1_sea_trial != '' or $request->second1_sea_trial != '' or $request->degree2_sea_trial != '' or $request->minute2_sea_trial != '' or $request->second2_sea_trial != '')
			{
				request()->validate([
					'degree1_sea_trial' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'minute1_sea_trial' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'second1_sea_trial' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'degree2_sea_trial' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'minute2_sea_trial' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'second2_sea_trial' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				],
				[
					'degree1_sea_trial.required' => 'Harap untuk mengisi data koordinat',
					'degree1_sea_trial.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'minute1_sea_trial.required' => 'Harap untuk mengisi data koordinat',
					'minute1_sea_trial.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'second1_sea_trial.required' => 'Harap untuk mengisi data koordinat',
					'second1_sea_trial.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'degree2_sea_trial.required' => 'Harap untuk mengisi data koordinat',
					'degree2_sea_trial.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'minute2_sea_trial.required' => 'Harap untuk mengisi data koordinat',
					'minute2_sea_trial.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'second2_sea_trial.required' => 'Harap untuk mengisi data koordinat',
					'second2_sea_trial.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				]);
			}
			else
			{
				$request->degree1_sea_trial = ' ';
				$request->minute1_sea_trial = ' ';
				$request->second1_sea_trial = ' ';
				$request->degree2_sea_trial = ' ';
				$request->minute2_sea_trial = ' ';
				$request->second2_sea_trial = ' ';
			}
			
			$dok_spog = ' ';
			$result = '';
			
			if($request->hasFile('dok_spog_sea_trial'))
			{
				$response = Http::attach(
					'dataFile', file_get_contents($request->dok_spog_sea_trial), 'tes.pdf'
				)->post('localhost:3000/api/insaf/uploadfile');
				
				$result = $response->json();
			}
			
			if($result != '')
			{
				$dok_spog = $result["file"]["filename"];
			}
			
			$request->dok_spog = $dok_spog;
			$request->dok_rencana_kerja_sts_request = ' ';
			$alasan_olah_gerak = 'sea_trial';
		}
		elseif($request->alasan_olah_gerak == '4')
		{
			if($request->pelabuhan_asal_request == $request->pelabuhan_tujuan_request)
			{
				return redirect()->back()->with('error', 'Harap untuk mengisi tujuan pelabuhan emergency request berbeda')->withInput();
			}
			
			request()->validate([
				'dok_spog_emergency' => 'required|mimes:pdf',
				'jumlah_kru_request' => 'required|integer',
				'jumlah_penumpang_request' => 'required|integer',
				'jenis_muatan_request' => 'required|string',
			],
			[
				'dok_spog_emergency.required' => 'Harap untuk mengupload dokumen SPOG',
				'dok_spog_emergency.mimes' => 'Harap untuk mengupload dokumen SPOG berupa pdf',
				'jumlah_kru_request.required' => 'Harap untuk mengisi jumlah kru emergency request',
				'jumlah_kru_request.integer' => 'Harap untuk mengisi jumlah kru emergency request berupa angka',
				'jumlah_penumpang_request.required' => 'Harap untuk mengisi jumlah penumpang emergency request',
				'jumlah_penumpang_request.integer' => 'Harap untuk mengisi jumlah penumpang emergency request berupa angka',
				'jenis_muatan_request.required' => 'Harap untuk mengisi jenis muatan',
				'jenis_muatan_request.string' => 'Harap untuk mengisi jenis muatan berupa huruf',
			]);
			
			// cek apabila ada user input request koordinasi
			if($request->degree1_emergency != '' or $request->minute1_emergency != '' or $request->second1_emergency != '' or $request->degree2_emergency != '' or $request->minute2_emergency != '' or $request->second2_emergency != '')
			{
				request()->validate([
					'degree1_emergency' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'minute1_emergency' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'second1_emergency' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'degree2_emergency' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'minute2_emergency' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
					'second2_emergency' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				],
				[
					'degree1_emergency.required' => 'Harap untuk mengisi data koordinat',
					'degree1_emergency.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'minute1_emergency.required' => 'Harap untuk mengisi data koordinat',
					'minute1_emergency.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'second1_emergency.required' => 'Harap untuk mengisi data koordinat',
					'second1_emergency.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'degree2_emergency.required' => 'Harap untuk mengisi data koordinat',
					'degree2_emergency.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'minute2_emergency.required' => 'Harap untuk mengisi data koordinat',
					'minute2_emergency.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
					'second2_emergency.required' => 'Harap untuk mengisi data koordinat',
					'second2_emergency.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				]);
			}
			else
			{
				$request->degree1_emergency = ' ';
				$request->minute1_emergency = ' ';
				$request->second1_emergency = ' ';
				$request->degree2_emergency = ' ';
				$request->minute2_emergency = ' ';
				$request->second2_emergency = ' ';
			}
			
			if($request->mob_status_request == '1')
			{
				request()->validate([
					'mob_qty_request' => 'required|integer|min:1',
				],
				[
					'mob_qty_request.required' => 'Harap untuk mengisi jumlah MOB',
					'mob_qty_request.integer' => 'Harap untuk mengisi jumlah MOB berupa angka',
					'mob_qty_request.min' => 'Harap untuk mengisi jumlah MOB minimal 1 orang',
				]);
			}
			
			if($request->korban_luka_status_request == '1')
			{
				request()->validate([
					'korban_luka_qty_request' => 'required|integer|min:1',
				],
				[
					'korban_luka_qty_request.required' => 'Harap untuk mengisi jumlah korban luka',
					'korban_luka_qty_request.integer' => 'Harap untuk mengisi jumlah korban luka berupa angka',
					'korban_luka_qty_request.min' => 'Harap untuk mengisi jumlah korban luka minimal 1 orang',
				]);
			}
			
			if($request->korban_jiwa_status_request == '1')
			{
				request()->validate([
					'korban_jiwa_qty_request' => 'required|integer|min:1',
				],
				[
					'korban_jiwa_qty_request.required' => 'Harap untuk mengisi jumlah korban jiwa',
					'korban_jiwa_qty_request.integer' => 'Harap untuk mengisi jumlah korban jiwa berupa angka',
					'korban_jiwa_qty_request.min' => 'Harap untuk mengisi jumlah korban jiwa minimal 1 orang',
				]);
			}
			
			$dok_spog = ' ';
			$result = '';
			
			if($request->hasFile('dok_spog_emergency'))
			{
				$response = Http::attach(
					'dataFile', file_get_contents($request->dok_spog_emergency), 'tes.pdf'
				)->post('localhost:3000/api/insaf/uploadfile');
				
				$result = $response->json();
			}
			
			if($result != '')
			{
				$dok_spog = $result["file"]["filename"];
			}
			
			$request->dok_spog = $dok_spog;
			$request->dok_rencana_kerja_sts_request = ' ';
			$alasan_olah_gerak = 'emergency';
		}
		
		$listinputdata = ['degree1_request', 'minute1_request', 'second1_request', 'direction1_request', 'degree2_request', 'minute2_request', 'second2_request', 'direction2_request', 'rencana_durasi_hour_request', 'rencana_durasi_minutes_request', 'tanggal_request', 'proses_kondisi_request'];
		foreach($listinputdata as $data)
		{
			$name = (string) $data;
			$result = $this->convertuserinput($name, $alasan_olah_gerak, $request);
			$request->$name = $result;
		}
		
		$time = $this->convertdate($request->tanggal_request, "todb");
		$request->tanggal_request = $time;
		$time = $this->convertdate($request->tanggal, "todb");
		$request->tanggal = $time;
		$time = $this->convertdate($request->tanggal_komunikasi, "todb");
		$request->tanggal_komunikasi = $time;
		
		$listlengkap = ['no_jurnal', 'tanggal', 'keterangan_tambahan', 'mmsi', 'jumlah_kru', 'jumlah_penumpang', 'pelabuhan_asal', 'pelabuhan_tujuan', 'status_bernavigasi', 'muatan', 'master_onboard', 'nohp1', 'second_officer', 'nohp2', 'degree1', 'minute1', 'second1', 'direction1', 'degree2', 'minute2', 'second2', 'direction2', 'alasan_olah_gerak', 'radio_notif', 'tanggal_komunikasi', 'jenis_jangkar_anchorage_request', 'need_port_area_request', 'tipe_oli_request', 'total_oli_request', 'satuan_volume_oli_request', 'operator_sts_request', 'nohp_operator_sts_request', 'dok_rencana_kerja_sts_request', 'lokasi_kejadian_request', 'pelabuhan_asal_request', 'pelabuhan_tujuan_request', 'jumlah_kru_request', 'jumlah_penumpang_request', 'jenis_muatan_request', 'deskripsi_kejadian_request', 'need_help_request', 'jenis_bantuan_request', 'mob_status_request', 'mob_qty_request', 'korban_luka_status_request', 'korban_luka_qty_request', 'korban_jiwa_status_request', 'korban_jiwa_qty_request', 'degree1_request', 'minute1_request', 'second1_request', 'direction1_request', 'degree2_request', 'minute2_request', 'second2_request', 'direction2_request', 'rencana_durasi_hour_request', 'rencana_durasi_minutes_request', 'tanggal_request', 'proses_kondisi_request', 'dok_spog'];
		foreach($listlengkap as $data)
		{
			$name = (string) $data;
			$result = $request->$name;
			if($result == '')
			{
				$request->$name = '0';
			}
			$result = $request->$name;
			//var_dump($name, $result, '<br><br>');
		}
		
		$date = Carbon::now();
		$time = $date->isoFormat('Y-MM-D hh:mm:ss');
		$id = session('id');
		
		$response = Http::put('localhost:3000/api/ship_on_port/insaf/update', [
			'no_jurnal' => $request->no_jurnal,
			'tanggal' => $request->tanggal,
			'keterangan_tambahan' => $request->keterangan_tambahan,
			'mmsi' => $request->mmsi,
			'jumlah_kru' => $request->jumlah_kru,
			'jumlah_penumpang' => $request->jumlah_penumpang,
			'pelabuhan_asal' => $request->pelabuhan_asal,
			'pelabuhan_tujuan' => $request->pelabuhan_tujuan,
			'status_bernavigasi' => $request->status_bernavigasi,
			'muatan' => $request->muatan,
			'master_onboard' => $request->master_onboard,
			'nohp1' => $request->nohp1,
			'second_officer' => $request->second_officer,
			'nohp2' => $request->nohp2,
			'degree1' => $request->degree1,
			'minute1' => $request->minute1,
			'second1' => $request->second1,
			'direction1' => $request->direction1,
			'degree2' => $request->degree2,
			'minute2' => $request->minute2,
			'second2' => $request->second2,
			'direction2' => $request->direction2,
			'alasan_olah_gerak' => $request->alasan_olah_gerak,
			'radio_notif' => $request->radio_notif,
			'tanggal_komunikasi' => $request->tanggal_komunikasi,
			'jenis_jangkar_anchorage_request' => $request->jenis_jangkar_anchorage_request,
			'need_port_area_request' => $request->need_port_area_request,
			'tipe_oli_request' => $request->tipe_oli_request,
			'total_oli_request' => $request->total_oli_request,
			'satuan_volume_oli_request' => $request->satuan_volume_oli_request,
			'operator_sts_request' => $request->operator_sts_request,
			'nohp_operator_sts_request' => $request->nohp_operator_sts_request,
			'dok_rencana_kerja_sts_request' => $request->dok_rencana_kerja_sts_request,
			'lokasi_kejadian_request' => $request->lokasi_kejadian_request,
			'pelabuhan_asal_request' => $request->pelabuhan_asal_request,
			'pelabuhan_tujuan_request' => $request->pelabuhan_tujuan_request,
			'jumlah_kru_request' => $request->jumlah_kru_request,
			'jumlah_penumpang_request' => $request->jumlah_penumpang_request,
			'jenis_muatan_request' => $request->jenis_muatan_request,
			'deskripsi_kejadian_request' => $request->deskripsi_kejadian_request,
			'need_help_request' => $request->need_help_request,
			'jenis_bantuan_request' => $request->jenis_bantuan_request,
			'mob_status_request' => $request->mob_status_request,
			'mob_qty_request' => $request->mob_qty_request,
			'korban_luka_status_request' => $request->korban_luka_status_request,
			'korban_luka_qty_request' => $request->korban_luka_qty_request,
			'korban_jiwa_status_request' => $request->korban_jiwa_status_request,
			'korban_jiwa_qty_request' => $request->korban_jiwa_qty_request,
			'degree1_request' => $request->degree1_request,
			'minute1_request' => $request->minute1_request,
			'second1_request' => $request->second1_request,
			'direction1_request' => $request->direction1_request,
			'degree2_request' => $request->degree2_request,
			'minute2_request' => $request->minute2_request,
			'second2_request' => $request->second2_request,
			'direction2_request' => $request->direction2_request,
			'rencana_durasi_hour_request' => $request->rencana_durasi_hour_request,
			'rencana_durasi_minutes_request' => $request->rencana_durasi_minutes_request,
			'tanggal_request' => $request->tanggal_request,
			'proses_kondisi_request' => $request->proses_kondisi_request,
			'dok_spog' => $request->dok_spog,
			'updated_at' => $time,
			'updated_by' => $id,
		]);
		
		$result = $response->json();
		if($result["success"] == False)
		{
			return redirect()->back();
		}
		else
		{
			$response = Http::post('localhost:3000/api/log_ship_on_port/insaf/store', [
				'no_jurnal' => $request->no_jurnal,
				'tanggal' => $request->tanggal,
				'keterangan_tambahan' => $request->keterangan_tambahan,
				'mmsi' => $request->mmsi,
				'jumlah_kru' => $request->jumlah_kru,
				'jumlah_penumpang' => $request->jumlah_penumpang,
				'pelabuhan_asal' => $request->pelabuhan_asal,
				'pelabuhan_tujuan' => $request->pelabuhan_tujuan,
				'status_bernavigasi' => $request->status_bernavigasi,
				'muatan' => $request->muatan,
				'master_onboard' => $request->master_onboard,
				'nohp1' => $request->nohp1,
				'second_officer' => $request->second_officer,
				'nohp2' => $request->nohp2,
				'degree1' => $request->degree1,
				'minute1' => $request->minute1,
				'second1' => $request->second1,
				'direction1' => $request->direction1,
				'degree2' => $request->degree2,
				'minute2' => $request->minute2,
				'second2' => $request->second2,
				'direction2' => $request->direction2,
				'alasan_olah_gerak' => $request->alasan_olah_gerak,
				'radio_notif' => $request->radio_notif,
				'tanggal_komunikasi' => $request->tanggal_komunikasi,
				'jenis_jangkar_anchorage_request' => $request->jenis_jangkar_anchorage_request,
				'need_port_area_request' => $request->need_port_area_request,
				'tipe_oli_request' => $request->tipe_oli_request,
				'total_oli_request' => $request->total_oli_request,
				'satuan_volume_oli_request' => $request->satuan_volume_oli_request,
				'operator_sts_request' => $request->operator_sts_request,
				'nohp_operator_sts_request' => $request->nohp_operator_sts_request,
				'dok_rencana_kerja_sts_request' => $request->dok_rencana_kerja_sts_request,
				'lokasi_kejadian_request' => $request->lokasi_kejadian_request,
				'pelabuhan_asal_request' => $request->pelabuhan_asal_request,
				'pelabuhan_tujuan_request' => $request->pelabuhan_tujuan_request,
				'jumlah_kru_request' => $request->jumlah_kru_request,
				'jumlah_penumpang_request' => $request->jumlah_penumpang_request,
				'jenis_muatan_request' => $request->jenis_muatan_request,
				'deskripsi_kejadian_request' => $request->deskripsi_kejadian_request,
				'need_help_request' => $request->need_help_request,
				'jenis_bantuan_request' => $request->jenis_bantuan_request,
				'mob_status_request' => $request->mob_status_request,
				'mob_qty_request' => $request->mob_qty_request,
				'korban_luka_status_request' => $request->korban_luka_status_request,
				'korban_luka_qty_request' => $request->korban_luka_qty_request,
				'korban_jiwa_status_request' => $request->korban_jiwa_status_request,
				'korban_jiwa_qty_request' => $request->korban_jiwa_qty_request,
				'degree1_request' => $request->degree1_request,
				'minute1_request' => $request->minute1_request,
				'second1_request' => $request->second1_request,
				'direction1_request' => $request->direction1_request,
				'degree2_request' => $request->degree2_request,
				'minute2_request' => $request->minute2_request,
				'second2_request' => $request->second2_request,
				'direction2_request' => $request->direction2_request,
				'rencana_durasi_hour_request' => $request->rencana_durasi_hour_request,
				'rencana_durasi_minutes_request' => $request->rencana_durasi_minutes_request,
				'tanggal_request' => $request->tanggal_request,
				'proses_kondisi_request' => $request->proses_kondisi_request,
				'dok_spog' => $request->dok_spog,
				'created_at' => $time,
				'created_by' => $id,
			]);
			
			$result = $response->json();
			if($result["success"] == False)
			{
				return redirect()->back();
			}
			else
			{
				return redirect()->route('ship_on_port.insaf')->with('success', 'Data ship on port berhasil bertambah');
			}
		}
	}
    public function on_port_detail($id)
    {
		$url = 'localhost:3000/api/ship_on_port/insaf/show/'.$id;
		$response = Http::get($url, []);
		$getdata = $response->json();
		$data = $getdata[0];
		
		$url = 'localhost:3000/api/kapal/masdex/read/'.$data['mmsi'];
		$response = Http::get($url, []);
		$getdata = $response->json();
		$shipdata = $getdata["data"][0];
		
        $title = "Ship On Port - ".$shipdata['ship_name'];
        return view('pages.ship_on_port.detail', compact('title', 'shipdata', 'data'));
    }
	public function convertdate($data, $tipedata)
	{
		if($tipedata == "todb")
		{
			$split = explode(" ", $data);
			$splittanggal = explode('/', $split[0]);
			$convert = $splittanggal[2].'-'.$splittanggal[1].'-'.$splittanggal[0].' '.$split[1];
		}
		else
		{
			$split = explode(" ", $data);
			$splittanggal = explode("-", $split[0]);
			$convert = $splittanggal[2].'/'.$splittanggal[1].'/'.$splittanggal[0].' '.$split[1];
		}
		return $convert;
	}
	/*
		melakukan looping input data user untuk persiapan
		simpan data ke dalam database
		
		note = need refactory (terutama ship on port)!!
	*/
	public function convertuserinput($namaasli, $alasan_olah_gerak, $request)
	{		
		$name = str_replace('request', $alasan_olah_gerak, $namaasli);
		$result = isset($request->$name) ? $request->$name : $request->$namaasli;
		$request->$namaasli = $result;
		
		return $result;
	}
}

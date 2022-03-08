<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DistressController extends Controller
{
    public function index()
    {
        $response = Http::post('localhost:3000/api/distress/insaf/read', [
            'page' => '',
            'rows' => '',
        ]);

        $decode = $response->json();
        
        $data = $decode[1][0];
        $data_distress = $decode[1][0]['rows'];

        ($data_distress == null ) ? $tanggal_range = 'Belum Ada Data' : $tanggal_range = '';

        return view('pages.distress.index', compact('data_distress','tanggal_range'));
    }

    public function create()
    {
        $response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;
		
		$response = Http::post('localhost:3000/api/distress/insaf/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode = $response->json();
		$date = Carbon::now();
		$time = $date->isoFormat('Y.M.D');
		if($decode[0]["total"] == "0")
		{
			$no_jurnal = 'TGPRK/DISTRESS/'.$time.'/2';
		}
		else
		{
			$getnojurnal = $decode[1][0]["rows"][0]["no_jurnal"];
			$pecahdata = explode("/", $getnojurnal);
			$tambahsatu = (int) $pecahdata[3] + 1;
			$no_jurnal = $pecahdata[0].'/'.$pecahdata[1].'/'.$time.'/'.$tambahsatu;
		}

		$response = Http::get('localhost:3000/api/distress/insaf/getjenisdistress',[]);
        $jenis_distress = $response->json();

        $response = Http::get('localhost:3000/api/pan/sumberinformasiawal', []);
		$sumber_informasi_awal = $response->json();
		
		$response = Http::get('localhost:3000/api/ais_status_navigaion/', []);
		$decode = $response->json();
		$status_bernavigasi = $decode["data"][0][0]["rows"];
		
		$pelabuhan = DB::table('tbl_masdex_pelabuhan')->where('is_delete', '0')->orderBy('namapelabuhan','ASC')->get();
		
		$distress = [];
		
		$distressdetail = [];
		$pelapordistress = [];

        return view('pages.distress.create', compact('kapal','jenis_distress', 'sumber_informasi_awal', 'no_jurnal', 'distress', 'pelapordistress', 'distressdetail', 'status_bernavigasi', 'pelabuhan'));
    }
    
    public function store(Request $request)
    {
        request()->validate([
			'jenis_distress' => 'required',
			'sumber_informasi' => 'required',
			'judul_distress' => 'required|string|max:255',
			'lokasi_kejadian' => 'required|string|max:255',
			'waktu_kejadian' => 'required',
			'waktu_selesai' => 'required',
			'deskripsi_assesment' => 'nullable|string',
			'foto_kejadian_distress' => 'mimes:pdf,jpeg,png,jpg',
		],
		[
			'jenis_distress.required' => 'Harap untuk memilih data jenis distress',
			'jenis_distress.required' => 'Harap untuk memilih data sumber informasi awal',
			'judul_distress.required' => 'Harap untuk mengisi judul distress',
			'judul_distress.string' => 'Harap untuk mengisi judul distress berupa huruf',
			'judul_distress.max' => 'Harap untuk mengisi judul distress maksimal 255 huruf',
			'lokasi_kejadian.required' => 'Harap untuk mengisi nama lokasi kejadian',
			'lokasi_kejadian.string' => 'Harap untuk mengisi nama lokasi kejadian berupa huruf',
			'lokasi_kejadian.max' => 'Harap untuk mengisi nama lokasi kejadian maksimal 255 huruf',
			'waktu_kejadian.required' => 'Harap untuk mengisi tanggal waktu kejadian',
			'waktu_selesai.required' => 'Harap untuk mengisi tanggal waktu selesai',
			'deskripsi_assesment.string' => 'Harap untuk mengisi deskripsi assessment berupa huruf',
			'foto_kejadian_distress.mimes' => 'Harap untuk mengupload foto kejadian distress dengan ekstensi file : jpg, png atau jpeg',
		]);
		
		// cek apabila ada user input request koordinasi
		if($request->degree1 != '' or $request->degree2 != '' or $request->minute1 != '' or $request->minute2 != '' or $request->second1 != '' or $request->second2 != '')
		{
			request()->validate([
				'degree1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'minute1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'second1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'direction1' => ['required'],
				'degree2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'minute2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'second2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'direction2' => ['required'],
			],
			[
				'degree1.required' => 'Harap untuk mengisi data koordinat',
				'degree1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'minute1.required' => 'Harap untuk mengisi data koordinat',
				'minute1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'second1.required' => 'Harap untuk mengisi data koordinat',
				'second1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'direction1.required' => 'Harap untuk mengisi data arah koordinat',
				'degree2.required' => 'Harap untuk mengisi data koordinat',
				'degree2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'minute2.required' => 'Harap untuk mengisi data koordinat',
				'minute2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'second2.required' => 'Harap untuk mengisi data koordinat',
				'second2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'direction2.required' => 'Harap untuk mengisi data arah koordinat',
			]);
		}
		else
		{
			$request->degree1 = ' ';
			$request->minute1 = ' ';
			$request->second1 = ' ';
			$request->direction1 = ' ';
			$request->degree2 = ' ';
			$request->minute2 = ' ';
			$request->second2 = ' ';
			$request->direction2 = ' ';
		}
		
		if($request->input('nama_pelapor') == '' and $request->input('tgl_lapor') == '')
		{
			return redirect()->back()->with('error', 'Harap untuk mengisi nama pelapor dan tanggal lapor dengan lengkap')->withInput($request->input());
		}
		else
		{
			foreach($request->input('nama_pelapor') as $key => $value) 
			{
				$rules["nama_pelapor.{$key}"] = 'required|string|max:255';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi nama pelapor berupa huruf dan tidak lebih dari 255 karakter huruf')->withInput($request->input());
			}
			
			foreach($request->input('nohp') as $key => $value) 
			{
				$rules["nohp.{$key}"] = 'nullable|integer';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi nomor kontak berupa angka')->withInput($request->input());
			}
			
			foreach($request->input('instansi') as $key => $value) 
			{
				$rules["instansi.{$key}"] = 'nullable|string|max:255';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi data asal instansi berupa huruf dan tidak lebih dari 255 karakter huruf')->withInput($request->input());
			}
			
			foreach($request->input('tgl_lapor') as $key => $value) 
			{
				$rules["tgl_lapor.{$key}"] = 'required';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi tanggal lapor')->withInput($request->input());
			}
			
			foreach($request->input('info_tambahan') as $key => $value) 
			{
				$rules["info_tambahan.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi informasi tambahan berupa huruf')->withInput($request->input());
			}
		}
		
		if($request->input('mmsi') == '')
		{
			return redirect()->back()->with('error', 'Harap untuk mengisi data kapal yang mengalami distress')->withInput($request->input());
		}
		else
		{
			$templist = [];
			foreach($request->input('mmsi') as $key => $value) 
			{
				foreach($templist as $tempdata)
				{
					if($tempdata == $value)
					{
						return redirect()->back()->with('error', 'Data kapal yang anda input harus unik')->withInput($request->input());
					}
				}
				$panjangdata = count($templist);
				array_push($templist, $value);
				
				foreach($request->input('pelabuhan_from') as $key => $value) 
				{
					foreach($request->input('pelabuhan_to') as $key2 => $value2)
					{
						if($key == $key2 and $value == $value2)
						{
							return redirect()->back()->with('error', 'Data pelabuhan asal dan pelabuhan tujuan yang anda masukkan sama')->withInput($request->input());
						}
					}
				}
				
				foreach($request->input('korban_luka_qty_child') as $key => $value) 
				{
					$rules["korban_luka_qty_child.{$key}"] = 'required|integer|min:0';
				}
				
				$validator = Validator::make($request->all(), $rules);
				
				if($validator->fails())
				{
					return redirect()->back()->with('error', 'harap untuk mengisi data korban luka berupa angka')->withInput($request->input());
				}
				
				foreach($request->input('mob_qty_child') as $key => $value) 
				{
					$rules["mob_qty_child.{$key}"] = 'required|integer|min:0';
				}
				
				$validator = Validator::make($request->all(), $rules);
				
				if($validator->fails())
				{
					return redirect()->back()->with('error', 'harap untuk mengisi data M.O.B berupa angka')->withInput($request->input());
				}
				
				foreach($request->input('korban_jiwa_qty_child') as $key => $value) 
				{
					$rules["korban_jiwa_qty_child.{$key}"] = 'required|integer|min:0';
				}
				
				$validator = Validator::make($request->all(), $rules);
				
				if($validator->fails())
				{
					return redirect()->back()->with('error', 'harap untuk mengisi data korban jiwa berupa angka')->withInput($request->input());
				}
			}
			
			foreach($request->input('jumlah_awak_kapal_child') as $key => $value) 
			{
				$rules["jumlah_awak_kapal_child.{$key}"] = 'integer|min:0';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi jumlah awak kapal berupa angka dengan benar')->withInput($request->input());
			}
			
			foreach($request->input('jumlah_penumpang_child') as $key => $value) 
			{
				$rules["jumlah_penumpang_child.{$key}"] = 'integer|min:0';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi jumlah penumpang berupa angka dengan benar')->withInput($request->input());
			}
			
			foreach($request->input('jenis_muatan_child') as $key => $value) 
			{
				$rules["jenis_muatan_child.{$key}"] = 'nullable|string|max:255';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi jenis muatan berupa huruf dan tidak lebih dari 255 karakter huruf')->withInput($request->input());
			}
			
			foreach($request->input('keterangan_lainnya_child') as $key => $value) 
			{
				$rules["keterangan_lainnya_child.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi keterangan lainnya berupa huruf')->withInput($request->input());
			}
			
			foreach($request->input('penanggulangan_yang_dilakukan_child') as $key => $value) 
			{
				$rules["penanggulangan_yang_dilakukan_child.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi penanggulangan yang dilakukan berupa huruf')->withInput($request->input());
			}
			
			foreach($request->input('kerusakan_kapal_child') as $key => $value) 
			{
				$rules["kerusakan_kapal_child.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi penanggulangan yang dilakukan berupa huruf');
			}
			
			foreach($request->input('tindakan_child') as $key => $value) 
			{
				$rules["tindakan_child.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi data tindakan berupa huruf');
			}
		}
		
		$foto = ' ';
		$result = '';
		if($request->hasFile('foto_kejadian_distress'))
		{
			$response = Http::attach(
				'dataFile', file_get_contents($request->foto_kejadian_distress), 'tes.pdf'
			)->post('localhost:3000/api/insaf/uploadfile');
			
			$result = $response->json();
		}
		
		if($result != '')
		{
			$foto = $result["file"]["filename"];
		}
		
		$date = Carbon::now();
		$time = $date->isoFormat('Y-MM-D hh:mm:ss');
		$tanggal = $this->convertdate($request->tanggal, 'todb');
		$userid = session()->get('id');
		
		$waktu_kejadian = date("Y-m-d h:m:s", strtotime($request->waktu_kejadian));
		$waktu_selesai = date("Y-m-d h:m:s", strtotime($request->waktu_selesai));
		
		//var_dump($userid, $tanggal, $waktu_kejadian, $waktu_selesai);
		
		// ambil nama tgprk1 dari mmmsi
		//$array = ['mmsi', 'pelabuhan_from', 'pelabuhan_to', 'status_bernavigasi', 'degree1_child', 'minute1_child', 'second1_child', 'direction1_child', 'degree2_child', 'minute2_child', 'second2_child', 'direction2_child', 'jumlah_awak_kapal_child', 'jumlah_penumpang_child', 'jenis_muatan_child', 'jenis_bantuan_child', 'keterangan_lainnya_child', 'penanggulangan_yang_dilakukan_child', 'mob_qty_child', 'korban_luka_qty_child', 'korban_jiwa_qty_child', 'kerusakan_kapal_child', 'tindakan_child'];
		foreach($request->input('mmsi') as $key => $value)
			{
				$mmsi = $this->getindexarray('mmsi', $key, $request);
				$pelabuhan_from = $this->getindexarray('pelabuhan_from', $key, $request);
				$pelabuhan_to = $this->getindexarray('pelabuhan_to', $key, $request);
				$status_bernavigasi = $this->getindexarray('status_bernavigasi', $key, $request);
				$degree1 = $this->getindexarray('degree1_child', $key, $request);
				$minute1 = $this->getindexarray('minute1_child', $key, $request);
				$second1 = $this->getindexarray('second1_child', $key, $request);
				$direction1 = $this->getindexarray('direction1_child', $key, $request);
				$degree2 = $this->getindexarray('degree2_child', $key, $request);
				$minute2 = $this->getindexarray('minute2_child', $key, $request);
				$second2 = $this->getindexarray('second2_child', $key, $request);
				$direction2 = $this->getindexarray('direction2_child', $key, $request);
				$jumlah_awak_kapal = $this->getindexarray('jumlah_awak_kapal_child', $key, $request);
				$jumlah_penumpang = $this->getindexarray('jumlah_penumpang_child', $key, $request);
				$jenis_muatan = $this->getindexarray('jenis_muatan_child', $key, $request);
				$jenis_bantuan = $this->getindexarray('jenis_bantuan_child', $key, $request);
				$keterangan_lainnya = $this->getindexarray('keterangan_lainnya_child', $key, $request);
				$penanggulangan_yang_dilakukan = $this->getindexarray('penanggulangan_yang_dilakukan_child', $key, $request);
				$mob_qty = $this->getindexarray('mob_qty_child', $key, $request);
				$korban_luka_qty = $this->getindexarray('korban_luka_qty_child', $key, $request);
				$korban_jiwa_qty = $this->getindexarray('korban_jiwa_qty_child', $key, $request);
				$kerusakan_kapal = $this->getindexarray('kerusakan_kapal_child', $key, $request);
				$tindakan = $this->getindexarray('tindakan_child', $key, $request);
				$need_help = $this->getvardata('need_help', $mmsi, $request);
				$sudah_upaya = $this->getvardata('sudah_upaya', $mmsi, $request);
				$mob_status = $this->getvardata('mob_status', $mmsi, $request);
				$korban_luka_status = $this->getvardata('korban_luka_status', $mmsi, $request);
				$korban_jiwa_status = $this->getvardata('korban_jiwa_status', $mmsi, $request);
			}
		
		//dd($request->all());
		//die();
		
		$response = Http::post('localhost:3000/api/distress/insaf/create', [
			'no_jurnal' => $request->no_jurnal,
			'tanggal' => $tanggal,
			'jenis_distress' => $request->jenis_distress,
			'sumber_informasi' => $request->sumber_informasi,
			'judul_distress' => $request->judul_distress,
			'foto_kejadian_distress' => $foto,
			'deskripsi_assesment' => $request->deskripsi_assesment, 
			'waktu_kejadian' => $waktu_kejadian, 
			'waktu_selesai' => $waktu_selesai, 
			'degree1' => $request->degree1, 
			'minute1' => $request->minute1, 
			'second1' => $request->second1, 
			'direction1' => $request->direction1,
			'degree2' => $request->degree2, 
			'minute2' => $request->minute2, 
			'second2' => $request->second2, 
			'direction2' => $request->direction2,
			'lokasi_kejadian' => $request->lokasi_kejadian,
		]);
		
		$result = $response->json();
		if($result["success"] == False)
		{
			return redirect()->back()->with('error', $result['data']);
		}
		else
		{
			$distress_id = $result["data"];
			
			foreach($request->input('nama_pelapor') as $key => $value)
			{
				$nama_pelapor = $this->getindexarray('nama_pelapor', $key, $request);
				$nohp = $this->getindexarray('nohp', $key, $request);
				$instansi = $this->getindexarray('instansi', $key, $request);
				$tgl_lapor = $this->getindexarray('tgl_lapor', $key, $request);
				$info_tambahan = $this->getindexarray('info_tambahan', $key, $request);
				
				$response = Http::post('localhost:3000/api/pelapor_distress/insaf/create', [
					'distress_id' => $distress_id,
					'nama_pelapor' => $nama_pelapor,
					'tgl_lapor' => $tgl_lapor,
					'instansi' => $instansi,
					'info_tambahan' => $info_tambahan,
					'nohp' => $nohp,
				]);
				
				$result = $response->json();
				if($result['success'] == false)
				{
					$url = 'localhost:3000/api/distress/insaf/delete/'.$distress_id;
					$hapusdata = Http::delete($url);
					return redirect()->back()->with('error', 'Data gagal menyimpan data');
				}
			}
			
			foreach($request->input('mmsi') as $key => $value)
			{
				$mmsi = $this->getindexarray('mmsi', $key, $request);
				$pelabuhan_from = $this->getindexarray('pelabuhan_from', $key, $request);
				$pelabuhan_to = $this->getindexarray('pelabuhan_to', $key, $request);
				$status_bernavigasi = $this->getindexarray('status_bernavigasi', $key, $request);
				$degree1 = $this->getindexarray('degree1_child', $key, $request);
				$minute1 = $this->getindexarray('minute1_child', $key, $request);
				$second1 = $this->getindexarray('second1_child', $key, $request);
				$direction1 = $this->getindexarray('direction1_child', $key, $request);
				$degree2 = $this->getindexarray('degree2_child', $key, $request);
				$minute2 = $this->getindexarray('minute2_child', $key, $request);
				$second2 = $this->getindexarray('second2_child', $key, $request);
				$direction2 = $this->getindexarray('direction2_child', $key, $request);
				$jumlah_awak_kapal = $this->getindexarray('jumlah_awak_kapal_child', $key, $request);
				$jumlah_penumpang = $this->getindexarray('jumlah_penumpang_child', $key, $request);
				$jenis_muatan = $this->getindexarray('jenis_muatan_child', $key, $request);
				$jenis_bantuan = $this->getindexarray('jenis_bantuan_child', $key, $request);
				$keterangan_lainnya = $this->getindexarray('keterangan_lainnya_child', $key, $request);
				$penanggulangan_yang_dilakukan = $this->getindexarray('penanggulangan_yang_dilakukan_child', $key, $request);
				$mob_qty = $this->getindexarray('mob_qty_child', $key, $request);
				$korban_luka_qty = $this->getindexarray('korban_luka_qty_child', $key, $request);
				$korban_jiwa_qty = $this->getindexarray('korban_jiwa_qty_child', $key, $request);
				$kerusakan_kapal = $this->getindexarray('kerusakan_kapal_child', $key, $request);
				$tindakan = $this->getindexarray('tindakan_child', $key, $request);
				$need_help = $this->getvardata('need_help', $mmsi, $request);
				$status_upaya = $this->getvardata('status_upaya', $mmsi, $request);
				$mob_status = $this->getvardata('mob_status', $mmsi, $request);
				$korban_luka_status = $this->getvardata('korban_luka_status', $mmsi, $request);
				$korban_jiwa_status = $this->getvardata('korban_jiwa_status', $mmsi, $request);
				
				$response = Http::post('localhost:3000/api/distress_detail/insaf/create', [
					'distress_id' => $distress_id,
					'mmsi' => $mmsi,
					'pelabuhan_from' => $pelabuhan_from,
					'pelabuhan_to' => $pelabuhan_to,
					'status_bernavigasi' => $status_bernavigasi,
					'degree1' => $degree1,
					'minute1' => $minute1,
					'second1' => $second1,
					'direction1' => $direction1,
					'degree2' => $degree2,
					'minute2' => $minute2,
					'second2' => $second2,
					'direction2' => $direction2,
					'jumlah_awak_kapal' => $jumlah_awak_kapal,
					'jumlah_penumpang' => $jumlah_penumpang,
					'jenis_muatan' => $jenis_muatan,
					'jenis_bantuan' => $jenis_bantuan,
					'keterangan_lainnya' => $keterangan_lainnya,
					'penanggulangan_yang_dilakukan' => $penanggulangan_yang_dilakukan,
					'mob_qty' => $mob_qty,
					'korban_luka_qty' => $korban_luka_qty,
					'korban_jiwa_qty' => $korban_jiwa_qty,
					'kerusakan_kapal' => $kerusakan_kapal,
					'tindakan' => $tindakan,
					'need_help' => $need_help,
					'status_upaya' => $status_upaya,
					'mob_status' => $mob_status,
					'korban_luka_status' => $korban_luka_status,
					'korban_jiwa_status' => $korban_jiwa_status,
				]);
				
				$result = $response->json();
				if($result['success'] == false)
				{
					$url = 'localhost:3000/api/distress/insaf/delete/'.$distress_id;
					$hapusdata = Http::delete($url);
					return redirect()->back()->with('error', 'Data gagal menyimpan data');
				}
			}
			
			return redirect()->route('distress.insaf')->with('success', 'Data distress berhasil bertambah');
		}		
    }
   
    public function show($id)
    {
        $response = Http::post('localhost:3000/api/users/insaf/read',[
            'page' => '',
            'rows' => 10,
        ]);
        $decode_users = json_decode($response->body());
        $data_total = (array)$decode_users[0];
        $data_list = (array)$decode_users[1][0];
        $total =  $data_total['total'];
        
        $users = $data_list['rows'];
		
		$url = 'localhost:3000/api/distress/insaf/read/'.$id;
		$response = Http::get($url, []);
		$decode = $response->json();
		$distress = $decode[0];
		
		$response = Http::post('localhost:3000/api/distress_detail/insaf/read', [
			'distress_id' => $id
		]);
		$decode = $response->json();
		$list = $decode[1];
		
		$distressdetail = [];
		foreach($list as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($distressdetail, $arraylagi);					
				}
			}
		}
		
		$response = Http::post('localhost:3000/api/pelapor_distress/insaf/read', [
			'distress_id' => $id
		]);
		$decode = $response->json();
		$list = $decode[1];
		$totalpelapordistress = $decode[0]['total'];
		
		$pelapordistress = [];
		foreach($list as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($pelapordistress, $arraylagi);					
				}
			}
		}

        $title = $distress['no_jurnal'].' | '.$distress['judul_distress'];
        return view('pages.distress.detail', compact('title', 'users', 'pelapordistress', 'distressdetail', 'distress'));
    }
	
	public function edit($id)
	{
		$response = Http::post('localhost:3000/api/kapal/masdex/read',[
            'page' => '',
            'rows' => '',
        ]);
        $decode_kapal = $response->json();
        $data_kapal = $decode_kapal['data'][1][0]['rows'];
        $kapal = $data_kapal;

		$response = Http::get('localhost:3000/api/distress/insaf/getjenisdistress',[]);
        $jenis_distress = $response->json();

        $response = Http::get('localhost:3000/api/pan/sumberinformasiawal', []);
		$sumber_informasi_awal = $response->json();
		
		$response = Http::get('localhost:3000/api/ais_status_navigaion/', []);
		$decode = $response->json();
		$status_bernavigasi = $decode["data"][0][0]["rows"];
		
		$pelabuhan = DB::table('tbl_masdex_pelabuhan')->where('is_delete', '0')->orderBy('namapelabuhan','ASC')->get();
		
		$url = 'localhost:3000/api/distress/insaf/read/'.$id;
		$response = Http::get($url, []);
		$decode = $response->json();
		$distress = $decode[0];
		
		$response = Http::post('localhost:3000/api/distress_detail/insaf/read', [
			'distress_id' => $id
		]);
		$decode = $response->json();
		$list = $decode[1];
		
		$distressdetail = [];
		foreach($list as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($distressdetail, $arraylagi);					
				}
			}
		}
		
		$response = Http::post('localhost:3000/api/pelapor_distress/insaf/read', [
			'distress_id' => $id
		]);
		$decode = $response->json();
		$list = $decode[1];
		$totalpelapordistress = $decode[0]['total'];
		
		$pelapordistress = [];
		foreach($list as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($pelapordistress, $arraylagi);					
				}
			}
		}
		
		return view('pages.distress.create', compact('kapal','jenis_distress', 'sumber_informasi_awal', 'distress', 'pelapordistress', 'distressdetail', 'status_bernavigasi', 'pelabuhan', 'totalpelapordistress'));
	}
	
	public function update($id, Request $request)
	{
		request()->validate([
			'jenis_distress' => 'required',
			'sumber_informasi' => 'required',
			'judul_distress' => 'required|string|max:255',
			'lokasi_kejadian' => 'required|string|max:255',
			'waktu_kejadian' => 'required',
			'waktu_selesai' => 'required',
			'deskripsi_assesment' => 'nullable|string',
			'foto_kejadian_distress' => 'mimes:pdf,jpeg,png,jpg',
		],
		[
			'jenis_distress.required' => 'Harap untuk memilih data jenis distress',
			'jenis_distress.required' => 'Harap untuk memilih data sumber informasi awal',
			'judul_distress.required' => 'Harap untuk mengisi judul distress',
			'judul_distress.string' => 'Harap untuk mengisi judul distress berupa huruf',
			'judul_distress.max' => 'Harap untuk mengisi judul distress maksimal 255 huruf',
			'lokasi_kejadian.required' => 'Harap untuk mengisi nama lokasi kejadian',
			'lokasi_kejadian.string' => 'Harap untuk mengisi nama lokasi kejadian berupa huruf',
			'lokasi_kejadian.max' => 'Harap untuk mengisi nama lokasi kejadian maksimal 255 huruf',
			'waktu_kejadian.required' => 'Harap untuk mengisi tanggal waktu kejadian',
			'waktu_selesai.required' => 'Harap untuk mengisi tanggal waktu selesai',
			'deskripsi_assesment.string' => 'Harap untuk mengisi deskripsi assessment berupa huruf',
			'foto_kejadian_distress.mimes' => 'Harap untuk mengupload foto kejadian distress dengan ekstensi file : jpg, png atau jpeg',
		]);
		
		// cek apabila ada user input request koordinasi
		if($request->degree1 != '' or $request->degree2 != '' or $request->minute1 != '' or $request->minute2 != '' or $request->second1 != '' or $request->second2 != '')
		{
			request()->validate([
				'degree1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'minute1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'second1' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'direction1' => ['required'],
				'degree2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'minute2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'second2' => ['required','regex:/^([0-9|0-9.|0-9,]*)$/'],
				'direction2' => ['required'],
			],
			[
				'degree1.required' => 'Harap untuk mengisi data koordinat',
				'degree1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'minute1.required' => 'Harap untuk mengisi data koordinat',
				'minute1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'second1.required' => 'Harap untuk mengisi data koordinat',
				'second1.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'direction1.required' => 'Harap untuk mengisi data arah koordinat',
				'degree2.required' => 'Harap untuk mengisi data koordinat',
				'degree2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'minute2.required' => 'Harap untuk mengisi data koordinat',
				'minute2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'second2.required' => 'Harap untuk mengisi data koordinat',
				'second2.regex' => 'Harap untuk mengisi data koordinat tidak berupa huruf',
				'direction2.required' => 'Harap untuk mengisi data arah koordinat',
			]);
		}
		else
		{
			$request->degree1 = ' ';
			$request->minute1 = ' ';
			$request->second1 = ' ';
			$request->direction1 = ' ';
			$request->degree2 = ' ';
			$request->minute2 = ' ';
			$request->second2 = ' ';
			$request->direction2 = ' ';
		}
		
		if($request->input('nama_pelapor') == '' and $request->input('tgl_lapor') == '')
		{
			return redirect()->back()->with('error', 'Harap untuk mengisi nama pelapor dan tanggal lapor dengan lengkap')->withInput($request->input());
		}
		else
		{
			foreach($request->input('nama_pelapor') as $key => $value) 
			{
				$rules["nama_pelapor.{$key}"] = 'required|string|max:255';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi nama pelapor berupa huruf dan tidak lebih dari 255 karakter huruf')->withInput($request->input());
			}
			
			foreach($request->input('nohp') as $key => $value) 
			{
				$rules["nohp.{$key}"] = 'nullable|integer';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi nomor kontak berupa angka')->withInput($request->input());
			}
			
			foreach($request->input('instansi') as $key => $value) 
			{
				$rules["instansi.{$key}"] = 'nullable|string|max:255';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi data asal instansi berupa huruf dan tidak lebih dari 255 karakter huruf')->withInput($request->input());
			}
			
			foreach($request->input('tgl_lapor') as $key => $value) 
			{
				$rules["tgl_lapor.{$key}"] = 'required';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi tanggal lapor')->withInput($request->input());
			}
			
			foreach($request->input('info_tambahan') as $key => $value) 
			{
				$rules["info_tambahan.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi informasi tambahan berupa huruf')->withInput($request->input());
			}
		}
		
		if($request->input('mmsi') == '')
		{
			return redirect()->back()->with('error', 'Harap untuk mengisi data kapal yang mengalami distress')->withInput($request->input());
		}
		else
		{
			$templist = [];
			foreach($request->input('mmsi') as $key => $value) 
			{
				foreach($templist as $tempdata)
				{
					if($tempdata == $value)
					{
						return redirect()->back()->with('error', 'Data kapal yang anda input harus unik')->withInput($request->input());
					}
				}
				$panjangdata = count($templist);
				array_push($templist, $value);
				
				foreach($request->input('pelabuhan_from') as $key => $value) 
				{
					foreach($request->input('pelabuhan_to') as $key2 => $value2)
					{
						if($key == $key2 and $value == $value2)
						{
							return redirect()->back()->with('error', 'Data pelabuhan asal dan pelabuhan tujuan yang anda masukkan sama')->withInput($request->input());
						}
					}
				}
				
				foreach($request->input('korban_luka_qty_child') as $key => $value) 
				{
					$rules["korban_luka_qty_child.{$key}"] = 'required|integer|min:0';
				}
				
				$validator = Validator::make($request->all(), $rules);
				
				if($validator->fails())
				{
					return redirect()->back()->with('error', 'harap untuk mengisi data korban luka berupa angka')->withInput($request->input());
				}
				
				foreach($request->input('mob_qty_child') as $key => $value) 
				{
					$rules["mob_qty_child.{$key}"] = 'required|integer|min:0';
				}
				
				$validator = Validator::make($request->all(), $rules);
				
				if($validator->fails())
				{
					return redirect()->back()->with('error', 'harap untuk mengisi data M.O.B berupa angka')->withInput($request->input());
				}
				
				foreach($request->input('korban_jiwa_qty_child') as $key => $value) 
				{
					$rules["korban_jiwa_qty_child.{$key}"] = 'required|integer|min:0';
				}
				
				$validator = Validator::make($request->all(), $rules);
				
				if($validator->fails())
				{
					return redirect()->back()->with('error', 'harap untuk mengisi data korban jiwa berupa angka')->withInput($request->input());
				}
			}
			
			foreach($request->input('jumlah_awak_kapal_child') as $key => $value) 
			{
				$rules["jumlah_awak_kapal_child.{$key}"] = 'integer|min:0';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi jumlah awak kapal berupa angka dengan benar')->withInput($request->input());
			}
			
			foreach($request->input('jumlah_penumpang_child') as $key => $value) 
			{
				$rules["jumlah_penumpang_child.{$key}"] = 'integer|min:0';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi jumlah penumpang berupa angka dengan benar')->withInput($request->input());
			}
			
			foreach($request->input('jenis_muatan_child') as $key => $value) 
			{
				$rules["jenis_muatan_child.{$key}"] = 'nullable|string|max:255';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi jenis muatan berupa huruf dan tidak lebih dari 255 karakter huruf')->withInput($request->input());
			}
			
			foreach($request->input('keterangan_lainnya_child') as $key => $value) 
			{
				$rules["keterangan_lainnya_child.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi keterangan lainnya berupa huruf')->withInput($request->input());
			}
			
			foreach($request->input('penanggulangan_yang_dilakukan_child') as $key => $value) 
			{
				$rules["penanggulangan_yang_dilakukan_child.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi penanggulangan yang dilakukan berupa huruf')->withInput($request->input());
			}
			
			foreach($request->input('kerusakan_kapal_child') as $key => $value) 
			{
				$rules["kerusakan_kapal_child.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi penanggulangan yang dilakukan berupa huruf');
			}
			
			foreach($request->input('tindakan_child') as $key => $value) 
			{
				$rules["tindakan_child.{$key}"] = 'nullable|string';
			}
			
			$validator = Validator::make($request->all(), $rules);
			
			if($validator->fails())
			{
				return redirect()->back()->with('error', 'harap untuk mengisi data tindakan berupa huruf');
			}
		}
		
		$foto = ' ';
		$result = '';
		if($request->hasFile('foto_kejadian_distress'))
		{
			$response = Http::attach(
				'dataFile', file_get_contents($request->foto_kejadian_distress), 'tes.pdf'
			)->post('localhost:3000/api/insaf/uploadfile');
			
			$result = $response->json();
		}
		
		if($result != '')
		{
			$foto = $result["file"]["filename"];
		}
		
		$date = Carbon::now();
		$time = $date->isoFormat('Y-MM-D hh:mm:ss');
		$tanggal = $this->convertdate($request->tanggal, 'todb');
		$userid = session()->get('id');
		
		$waktu_kejadian = date("Y-m-d h:m:s", strtotime($request->waktu_kejadian));
		$waktu_selesai = date("Y-m-d h:m:s", strtotime($request->waktu_selesai));
		
		//var_dump($userid, $tanggal, $waktu_kejadian, $waktu_selesai);
		
		// ambil nama tgprk1 dari mmmsi
		//$array = ['mmsi', 'pelabuhan_from', 'pelabuhan_to', 'status_bernavigasi', 'degree1_child', 'minute1_child', 'second1_child', 'direction1_child', 'degree2_child', 'minute2_child', 'second2_child', 'direction2_child', 'jumlah_awak_kapal_child', 'jumlah_penumpang_child', 'jenis_muatan_child', 'jenis_bantuan_child', 'keterangan_lainnya_child', 'penanggulangan_yang_dilakukan_child', 'mob_qty_child', 'korban_luka_qty_child', 'korban_jiwa_qty_child', 'kerusakan_kapal_child', 'tindakan_child'];
		foreach($request->input('mmsi') as $key => $value)
		{
			$mmsi = $this->getindexarray('mmsi', $key, $request);
			$pelabuhan_from = $this->getindexarray('pelabuhan_from', $key, $request);
			$pelabuhan_to = $this->getindexarray('pelabuhan_to', $key, $request);
			$status_bernavigasi = $this->getindexarray('status_bernavigasi', $key, $request);
			$degree1 = $this->getindexarray('degree1_child', $key, $request);
			$minute1 = $this->getindexarray('minute1_child', $key, $request);
			$second1 = $this->getindexarray('second1_child', $key, $request);
			$direction1 = $this->getindexarray('direction1_child', $key, $request);
			$degree2 = $this->getindexarray('degree2_child', $key, $request);
			$minute2 = $this->getindexarray('minute2_child', $key, $request);
			$second2 = $this->getindexarray('second2_child', $key, $request);
			$direction2 = $this->getindexarray('direction2_child', $key, $request);
			$jumlah_awak_kapal = $this->getindexarray('jumlah_awak_kapal_child', $key, $request);
			$jumlah_penumpang = $this->getindexarray('jumlah_penumpang_child', $key, $request);
			$jenis_muatan = $this->getindexarray('jenis_muatan_child', $key, $request);
			$jenis_bantuan = $this->getindexarray('jenis_bantuan_child', $key, $request);
			$keterangan_lainnya = $this->getindexarray('keterangan_lainnya_child', $key, $request);
			$penanggulangan_yang_dilakukan = $this->getindexarray('penanggulangan_yang_dilakukan_child', $key, $request);
			$mob_qty = $this->getindexarray('mob_qty_child', $key, $request);
			$korban_luka_qty = $this->getindexarray('korban_luka_qty_child', $key, $request);
			$korban_jiwa_qty = $this->getindexarray('korban_jiwa_qty_child', $key, $request);
			$kerusakan_kapal = $this->getindexarray('kerusakan_kapal_child', $key, $request);
			$tindakan = $this->getindexarray('tindakan_child', $key, $request);
			$need_help = $this->getvardata('need_help', $mmsi, $request);
			$sudah_upaya = $this->getvardata('sudah_upaya', $mmsi, $request);
			$mob_status = $this->getvardata('mob_status', $mmsi, $request);
			$korban_luka_status = $this->getvardata('korban_luka_status', $mmsi, $request);
			$korban_jiwa_status = $this->getvardata('korban_jiwa_status', $mmsi, $request);
		}
		
		//dd($request->all());
		//die();
		
		$url = 'localhost:3000/api/distress/insaf/update/'.$id;
		$response = Http::put($url, [
			'no_jurnal' => $request->no_jurnal,
			'tanggal' => $tanggal,
			'jenis_distress' => $request->jenis_distress,
			'sumber_informasi' => $request->sumber_informasi,
			'judul_distress' => $request->judul_distress,
			'foto_kejadian_distress' => $foto,
			'deskripsi_assesment' => $request->deskripsi_assesment, 
			'waktu_kejadian' => $waktu_kejadian, 
			'waktu_selesai' => $waktu_selesai, 
			'degree1' => $request->degree1, 
			'minute1' => $request->minute1, 
			'second1' => $request->second1, 
			'direction1' => $request->direction1,
			'degree2' => $request->degree2, 
			'minute2' => $request->minute2, 
			'second2' => $request->second2, 
			'direction2' => $request->direction2,
			'lokasi_kejadian' => $request->lokasi_kejadian,
		]);
		
		$result = $response->json();
		if($result["success"] == False)
		{
			return redirect()->back()->with('error', $result['data']);
		}
		else
		{
			$distress_id = $id;
			
			$response = Http::post('localhost:3000/api/pelapor_distress/insaf/read', [
				'distress_id' => $distress_id,
			]);
			$decode = $response->json();
			$list = $decode[1];
			$listarray = [];
			
			foreach($list as $data)
			{
				foreach($data as $arraydata)
				{
					foreach($arraydata as $arraylagi)
					{
						array_push($listarray, $arraylagi['id']);					
					}
				}
			}
			
			foreach($list as $data)
			{
				foreach($data as $arraydata)
				{
					foreach($arraydata as $arraylagi)
					{
						$url = 'localhost:3000/api/pelapor_distress/insaf/delete/'.$arraylagi['id'];
						$response = Http::delete($url, []);
						
						$decode = $response->json();
						if($decode['success'] == False)
						{
							foreach($list as $data)
							{
								foreach($data as $arraydata)
								{
									foreach($arraydata as $arraylagi)
									{
										$url = 'localhost:3000/api/pelapor_distress/insaf/update/'.$arraylagi['id'];
										$response = Http::put($url, [
											'distress_id' => $distress_id,
											'nama_pelapor' => $arraylagi['nama_pelapor'],
											'tgl_lapor' => $arraylagi['tgl_lapor'],
											'info_tambahan' => $arraylagi['info_tambahan'], 
											'nohp' => $arraylagi['nohp'], 
											'instansi' => $arraylagi['instansi'],
										]);
									}
								}
							}
							return redirect()->back()->with('error', $decode['data']);
						}
					}
				}
			}
			
			foreach($request->input('nama_pelapor') as $key => $value)
			{
				$pelapordistressid = $this->getindexarray('pelaporid', $key, $request);
				$nama_pelapor = $this->getindexarray('nama_pelapor', $key, $request);
				$nohp = $this->getindexarray('nohp', $key, $request);
				$instansi = $this->getindexarray('instansi', $key, $request);
				$tgl_lapor = $this->getindexarray('tgl_lapor', $key, $request);
				$info_tambahan = $this->getindexarray('info_tambahan', $key, $request);
				
				if (in_array($pelapordistressid, $listarray)) 
				{
					$url = 'localhost:3000/api/pelapor_distress/insaf/update/'.$pelapordistressid;
					$response = Http::put($url, [
						'distress_id' => $distress_id,
						'nama_pelapor' => $nama_pelapor,
						'tgl_lapor' => $tgl_lapor,
						'instansi' => $instansi,
						'info_tambahan' => $info_tambahan,
						'nohp' => $nohp,
					]);
				}
				else
				{
					$response = Http::post('localhost:3000/api/pelapor_distress/insaf/create', [
						'distress_id' => $distress_id,
						'nama_pelapor' => $nama_pelapor,
						'tgl_lapor' => $tgl_lapor,
						'instansi' => $instansi,
						'info_tambahan' => $info_tambahan,
						'nohp' => $nohp,
					]);					
				}
				
				$result = $response->json();
				if($result['success'] == false)
				{
					return redirect()->back()->with('error', 'Data gagal menyimpan data');
				}
			}
			
			$response = Http::post('localhost:3000/api/distress_detail/insaf/read', [
				'distress_id' => $distress_id,
			]);
			$decode = $response->json();
			$list = $decode[1];
			$listarray = [];
			$loadmmsidata = [];
			
			foreach($list as $data)
			{
				foreach($data as $arraydata)
				{
					foreach($arraydata as $arraylagi)
					{
						array_push($listarray, $arraylagi['id']);
						array_push($loadmmsidata, $arraylagi['mmsi']);					
					}
				}
			}
			
			foreach($list as $data)
			{
				foreach($data as $arraydata)
				{
					foreach($arraydata as $arraylagi)
					{
						$url = 'localhost:3000/api/distress_detail/insaf/delete/'.$arraylagi['id'];
						$response = Http::delete($url, []);
						
						$decode = $response->json();
						if($decode['success'] == False)
						{
							foreach($list as $data)
							{
								foreach($data as $arraydata)
								{
									foreach($arraydata as $arraylagi)
									{
										$url = 'localhost:3000/api/distress_detail/insaf/update/'.$arraylagi['id'];
										$response = Http::put($url, [
											'distress_id' => $distress_id,
											'mmsi' => $arraylagi['mmsi'],
											'pelabuhan_from' => $arraylagi['pelabuhan_from'],
											'pelabuhan_to' => $arraylagi['$pelabuhan_to'],
											'status_bernavigasi' => $arraylagi['status_bernavigasi'],
											'degree1' => $arraylagi['degree1'],
											'minute1' => $arraylagi['minute1'],
											'second1' => $arraylagi['second1'],
											'direction1' => $arraylagi['direction1'],
											'degree2' => $arraylagi['degree2'],
											'minute2' => $arraylagi['minute2'],
											'second2' => $arraylagi['second2'],
											'direction2' => $arraylagi['direction2'],
											'jumlah_awak_kapal' => $arraylagi['jumlah_awak_kapal'],
											'jumlah_penumpang' => $arraylagi['jumlah_penumpang'],
											'jenis_muatan' => $arraylagi['jenis_muatan'],
											'jenis_bantuan' => $arraylagi['jenis_bantuan'],
											'keterangan_lainnya' => $arraylagi['keterangan_lainnya'],
											'penanggulangan_yang_dilakukan' => $arraylagi['penanggulangan_yang_dilakukan'],
											'mob_qty' => $arraylagi['mob_qty'],
											'korban_luka_qty' => $arraylagi['korban_luka_qty'],
											'korban_jiwa_qty' => $arraylagi['korban_jiwa_qty'],
											'kerusakan_kapal' => $arraylagi['kerusakan_kapal'],
											'tindakan' => $arraylagi['tindakan'],
											'need_help' => $arraylagi['need_help'],
											'status_upaya' => $arraylagi['status_upaya'],
											'mob_status' => $arraylagi['mob_status'],
											'korban_luka_status' => $arraylagi['korban_luka_status'],
											'korban_jiwa_status' => $arraylagi['korban_jiwa_status'],
										]);
									}
								}
							}
							return redirect()->back()->with('error', $decode['data']);
						}
					}
				}
			}
			
			foreach($request->input('mmsi') as $key => $value)
			{	
				$mmsi = $this->getindexarray('mmsi', $key, $request);
				$pelabuhan_from = $this->getindexarray('pelabuhan_from', $key, $request);
				$pelabuhan_to = $this->getindexarray('pelabuhan_to', $key, $request);
				$status_bernavigasi = $this->getindexarray('status_bernavigasi', $key, $request);
				$degree1 = $this->getindexarray('degree1_child', $key, $request);
				$minute1 = $this->getindexarray('minute1_child', $key, $request);
				$second1 = $this->getindexarray('second1_child', $key, $request);
				$direction1 = $this->getindexarray('direction1_child', $key, $request);
				$degree2 = $this->getindexarray('degree2_child', $key, $request);
				$minute2 = $this->getindexarray('minute2_child', $key, $request);
				$second2 = $this->getindexarray('second2_child', $key, $request);
				$direction2 = $this->getindexarray('direction2_child', $key, $request);
				$jumlah_awak_kapal = $this->getindexarray('jumlah_awak_kapal_child', $key, $request);
				$jumlah_penumpang = $this->getindexarray('jumlah_penumpang_child', $key, $request);
				$jenis_muatan = $this->getindexarray('jenis_muatan_child', $key, $request);
				$jenis_bantuan = $this->getindexarray('jenis_bantuan_child', $key, $request);
				$keterangan_lainnya = $this->getindexarray('keterangan_lainnya_child', $key, $request);
				$penanggulangan_yang_dilakukan = $this->getindexarray('penanggulangan_yang_dilakukan_child', $key, $request);
				$mob_qty = $this->getindexarray('mob_qty_child', $key, $request);
				$korban_luka_qty = $this->getindexarray('korban_luka_qty_child', $key, $request);
				$korban_jiwa_qty = $this->getindexarray('korban_jiwa_qty_child', $key, $request);
				$kerusakan_kapal = $this->getindexarray('kerusakan_kapal_child', $key, $request);
				$tindakan = $this->getindexarray('tindakan_child', $key, $request);
				$need_help = $this->getvardata('need_help', $mmsi, $request);
				$status_upaya = $this->getvardata('status_upaya', $mmsi, $request);
				$mob_status = $this->getvardata('mob_status', $mmsi, $request);
				$korban_luka_status = $this->getvardata('korban_luka_status', $mmsi, $request);
				$korban_jiwa_status = $this->getvardata('korban_jiwa_status', $mmsi, $request);
				
				if (in_array($mmsi, $loadmmsidata)) 
				{
					$indexarray = array_search($mmsi, $loadmmsidata);
					$distressid = $listarray[$indexarray];
					$url = 'localhost:3000/api/distress_detail/insaf/update/'.$distressid;
					$response = Http::put($url, [
						'distress_id' => $distress_id,
						'mmsi' => $mmsi,
						'pelabuhan_from' => $pelabuhan_from,
						'pelabuhan_to' => $pelabuhan_to,
						'status_bernavigasi' => $status_bernavigasi,
						'degree1' => $degree1,
						'minute1' => $minute1,
						'second1' => $second1,
						'direction1' => $direction1,
						'degree2' => $degree2,
						'minute2' => $minute2,
						'second2' => $second2,
						'direction2' => $direction2,
						'jumlah_awak_kapal' => $jumlah_awak_kapal,
						'jumlah_penumpang' => $jumlah_penumpang,
						'jenis_muatan' => $jenis_muatan,
						'jenis_bantuan' => $jenis_bantuan,
						'keterangan_lainnya' => $keterangan_lainnya,
						'penanggulangan_yang_dilakukan' => $penanggulangan_yang_dilakukan,
						'mob_qty' => $mob_qty,
						'korban_luka_qty' => $korban_luka_qty,
						'korban_jiwa_qty' => $korban_jiwa_qty,
						'kerusakan_kapal' => $kerusakan_kapal,
						'tindakan' => $tindakan,
						'need_help' => $need_help,
						'status_upaya' => $status_upaya,
						'mob_status' => $mob_status,
						'korban_luka_status' => $korban_luka_status,
						'korban_jiwa_status' => $korban_jiwa_status,
					]);
				}
				else
				{
					$response = Http::post('localhost:3000/api/distress_detail/insaf/create', [
						'distress_id' => $distress_id,
						'mmsi' => $mmsi,
						'pelabuhan_from' => $pelabuhan_from,
						'pelabuhan_to' => $pelabuhan_to,
						'status_bernavigasi' => $status_bernavigasi,
						'degree1' => $degree1,
						'minute1' => $minute1,
						'second1' => $second1,
						'direction1' => $direction1,
						'degree2' => $degree2,
						'minute2' => $minute2,
						'second2' => $second2,
						'direction2' => $direction2,
						'jumlah_awak_kapal' => $jumlah_awak_kapal,
						'jumlah_penumpang' => $jumlah_penumpang,
						'jenis_muatan' => $jenis_muatan,
						'jenis_bantuan' => $jenis_bantuan,
						'keterangan_lainnya' => $keterangan_lainnya,
						'penanggulangan_yang_dilakukan' => $penanggulangan_yang_dilakukan,
						'mob_qty' => $mob_qty,
						'korban_luka_qty' => $korban_luka_qty,
						'korban_jiwa_qty' => $korban_jiwa_qty,
						'kerusakan_kapal' => $kerusakan_kapal,
						'tindakan' => $tindakan,
						'need_help' => $need_help,
						'status_upaya' => $status_upaya,
						'mob_status' => $mob_status,
						'korban_luka_status' => $korban_luka_status,
						'korban_jiwa_status' => $korban_jiwa_status,
					]);
				}
				
				$result = $response->json();
				if($result['success'] == false)
				{
					return redirect()->back()->with('error', 'Data gagal menyimpan data');
				}
			}
			
			return redirect()->route('distress.insaf')->with('success', 'Data distress berhasil berubah');
		}
	}
	
	public function destroy($id)
	{
		$url = 'localhost:3000/api/distress/insaf/delete/'.$id;
		$response = Http::delete($url);
		$decode = $response->json();
		
		if($decode['success'] == True)
		{
			return redirect()->back()->with('success', 'Data distress berhasil dihapus');
		}
		else
		{
			return redirect()->back()->with('error', $decode['error']);
		}
	}

    public function chat_room()
    {
        return view('pages.distress.chat_room');
    }
	
	// berfungsi untuk merubah format tanggal berdasarkan kebutuhan
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
	
	// ambil data dari request input array berdasarkan index array yang dipinta
	public function getindexarray($list, $index, $request)
	{
		//$array = ['mmsi', 'pelabuhan_from', 'pelabuhan_to', 'status_bernavigasi', 'degree1_child', 'minute1_child', 'second1_child', 'direction1_child', 'degree2_child', 'minute2_child', 'second2_child', 'direction2_child', 'jumlah_awak_kapal_child', 'jumlah_penumpang_child', 'jenis_muatan_child', 'jenis_bantuan_child', 'keterangan_lainnya_child', 'penanggulangan_yang_dilakukan_child', 'mob_qty_child', 'korban_luka_qty_child', 'korban_jiwa_qty_child', 'kerusakan_kapal_child', 'tindakan_child'];
		$var = (string) $list;
		$data = $request->$var;
		$result = $data[$index];
		if($result == '')
		{
			$result = ' ';
		}
		return $result;
	}
	
	// ambil data dari request input dengan tipe data radio (tipe data radio tidak bisa masuk dan dijadikan sebagai array
	public function getvardata($list, $mmsi, $request)
	{
		$varname = (string) $list.'_'.$mmsi;
		$data = $request->$varname;
		return $data;
	}
}
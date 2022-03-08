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

class PanController extends Controller
{
    public function index()
    {
		/*
			Bikin authentification kalo udah jadi
		*/
		
		$searchtext = isset($_GET["search"]) ? $_GET["search"] : "";
		$time1 = isset($_GET["time1"]) ? $_GET["time1"] : "";
		$time2 = isset($_GET["time2"]) ? $_GET["time2"] : "";
		$page = isset($_GET["page"]) ? $_GET["page"] : '1' ;
		$target = isset($_GET["target"]) ? $_GET["target"] : "" ;
		$rows = '1000';
		if($searchtext != "")
		{
			$url = 'localhost:3000/api/pan/search/'.$searchtext;
			$response = Http::get($url, []);
		}
		elseif($time1 != "" and $time2 != "")
		{
			$url = 'localhost:3000/api/pan/show/'.$time1.'/'.$time2;
			$response = Http::get($url, []);
		}
		elseif($target != '')
		{
			$url = 'localhost:3000/api/pan/order/'.$target;
			$response = Http::get($url, []);
		}
		else
		{	
			$response = Http::get('localhost:3000/api/pan', []);
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
		
		/* return view('aktivitas.index',compact('aktivitas', 'breadcrumb'))
					->with('searchtext',$searchtext)
					->with('i', (request()->input('page', 1) - 1)* 5); */
		
        return view('pages.pan.index', compact('array', 'total', 'page'));
    }

    public function create()
    {
		$kodejurnal = DB::table('tbl_insaf_pan')->orderBy('id', 'desc')->first();
        if($kodejurnal == null )
        {
            $no_jurnal = 'TGPRK/PAN/'.date('Y.n.d').'/1';
        }
        else
        {
            $split_kode = explode("/", $kodejurnal->no_jurnal);
            $get_kode_nomor = $split_kode['3'];
            $penjumlahan_kode = $get_kode_nomor + 1;
            $no_jurnal = 'TGPRK/PAN/'.date('Y.n.d').'/'.$penjumlahan_kode;
        }
		
		$response = Http::get('localhost:3000/api/pan/latest', []);
		$decode = $response->json();
		$latestpan = $decode["no_jurnal"];
		
		$response = Http::get('localhost:3000/api/pan/sumberinformasiawal', []);
		$sumberinformasiawal = $response->json();
		
		$response = Http::get('localhost:3000/api/pan/jenispan', []);
		$jenispan = $response->json();
		
		$response = Http::post('localhost:3000/api/kapal/masdex/read', []);
		$decode = $response->json();
		$objectkapal = $decode["data"][1];
		$totalkapal = $decode["data"][0];
		
		$pandata = [];
		$mmsidata = [];
		
		$listkapal = [];
		foreach($objectkapal as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($listkapal, $arraylagi);					
				}
			}
		}
		
		return view('pages.pan.create', compact('latestpan', 'sumberinformasiawal', 'jenispan', 'totalkapal', 'listkapal', 'pandata', 'mmsidata','no_jurnal'));
    }
    
    public function store(Request $request)
    {
		request()->validate([
			'waktu_kejadian' => 'required',
			'master_onboard' => 'required|string',
			'phone_onboard' => 'required|numeric',
			'second_officer' => 'required|string',
			'phone_second_officer' => 'required|numeric',
		],
		[
			'waktu_kejadian.required' => 'Harap untuk mengisi data waktu kejadian',
			'master_onboard.required' => 'Harap untuk mengisi nama master onboard',
			'master_onboard.string' => 'Harap untuk mengisi nama master onboard berupa huruf',
			'phone_onboard.required' => 'Harap untuk mengisi nomor master onboard',
			'phone_onboard.numeric' => 'Harap untuk mengisi nomor master onboard berupa angka',
			'second_officer.required' => 'Harap untuk mengisi nama second officer',
			'second_officer.string' => 'Harap untuk mengisi nama second officer berupa huruf',
			'phone_second_officer.required' => 'Harap untuk mengisi nomor second officer',
			'phone_second_officer.numeric' => 'Harap untuk mengisi nomor second officer berupa angka',
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
			$request->degree1 = 'null';
			$request->minute1 = 'null';
			$request->second1 = 'null';
			$request->degree2 = 'null';
			$request->minute2 = 'null';
			$request->second2 = 'null';
		}
		
		if($request->input('mmsi') == '')
		{
			return redirect()->back()->with('error', 'Cek data kapal lagi');
		}
		
		if($request->keterangan_lainnya == '')
		{
			$request->keterangan_lainnya = 'null';
		}
		
		if($request->deskripsi_laporan == '')
		{
			$request->deskripsi_laporan = 'null';
		}
		
		$date = Carbon::now();
		$time = $date->isoFormat('Y-MM-D hh:mm:ss');
		$tanggal = $this->convertdate($request->tanggal, "todb");
		$waktu_kejadian = str_replace('/', '-', $request->waktu_kejadian);
		
		$response = Http::post('localhost:3000/api/pan/store', [
			'no_jurnal' => $request->no_jurnal,
			'jenis_pan' => $request->jenis_pan,
			'waktu_kejadian' => $waktu_kejadian,
			'sumber_informasi' => $request->sumber_informasi,
			'keterangan_lainnya' => $request->keterangan_lainnya,
			'deskripsi_laporan' => $request->deskripsi_laporan,
			'degree1' => $request->degree1,
			'minute1' => $request->minute1,
			'second1' => $request->second1,
			'direction1' => $request->direction1,
			'degree2' => $request->degree2,
			'minute2' => $request->minute2,
			'second2' => $request->second2,
			'direction2' => $request->direction2,
			'master_onboard' => $request->master_onboard,
			'phone_onboard' => $request->phone_onboard,
			'second_officer' => $request->second_officer,
			'phone_second_officer' => $request->phone_second_officer,
			'tanggal' => $tanggal,
			'memerlukan_tindakan' => $request->memerlukan_tindakan,
			'created_at' => $time,
			'created_by' => '00',
		]);
		
		$result = $response->json();
		if($result["success"] == False)
		{
			return redirect()->back();
		}
		else
		{
			$response = Http::get('localhost:3000/api/pan/latest', []);
			$decode = $response->json();
			$id = (string) $decode["id"];
			$url = 'localhost:3000/api/pan/kapal/store/'.$id;
			foreach($request->input('mmsi') as $key => $value) 
			{
				$response = Http::post($url, [
					'mmsi' => $value,
					'created_at' => $time,
					'created_by' => '00',
				]);
			}
		}
		
		
        return redirect()->route('pan.insaf')->with('success', 'Data PAN berhasil ditambahkan');
    }
   
    public function show($id)
    {
		$url = 'localhost:3000/api/pan/show/'.$id;
		$response = Http::get($url, []);
		$getdata = $response->json();
		$pandata = $getdata[0];
		
		$tanggal = $this->convertdate($pandata["tanggal"], "toview");
		$convert = $this->convertdate($pandata["waktu_kejadian"], "toview");
		$convert1 = explode(" ", $convert);
		$convert2 = explode(":", $convert1[1]);
		$waktu_kejadian = $convert1[0].' '.$convert2[0].':'.$convert2[1];
		
        return view('pages.pan.detail', compact('waktu_kejadian', 'tanggal', 'pandata'));
    }
	
	public function edit($id)
    {
		$response = Http::get('localhost:3000/api/pan/sumberinformasiawal', []);
		$sumberinformasiawal = $response->json();
		
		$response = Http::get('localhost:3000/api/pan/jenispan', []);
		$jenispan = $response->json();
		
		$response = Http::post('localhost:3000/api/kapal/masdex/read', []);
		$decode = $response->json();
		$objectkapal = $decode["data"][1];
		$totalkapal = $decode["data"][0];
		
		$url = 'localhost:3000/api/pan/show/'.$id;
		$response = Http::get($url, []);
		$getdata = $response->json();
		$pandata = $getdata[0];
		
		$tanggal = $this->convertdate($pandata["tanggal"], "toview");
		$convert = $this->convertdate($pandata["waktu_kejadian"], "toview");
		$convert1 = explode(" ", $convert);
		$convert2 = explode(":", $convert1[1]);
		$waktu_kejadian = $convert1[0].' '.$convert2[0].':'.$convert2[1];
		
		$url = 'localhost:3000/api/pan/kapal/'.$id;
		$response = Http::get($url, []);
		$mmsidata = $response->json();
		
		$listkapal = [];
		foreach($objectkapal as $data)
		{
			foreach($data as $arraydata)
			{
				foreach($arraydata as $arraylagi)
				{
					array_push($listkapal, $arraylagi);					
				}
			}
		}
		
		return view('pages.pan.create', compact('sumberinformasiawal', 'jenispan', 'totalkapal', 'listkapal', 'pandata', 'mmsidata', 'tanggal', 'waktu_kejadian', 'id'));
    }
    
    public function update(Request $request, $id)
    {
		request()->validate([
			'waktu_kejadian' => 'required',
			'master_onboard' => 'required|string',
			'phone_onboard' => 'required|numeric',
			'second_officer' => 'required|string',
			'phone_second_officer' => 'required|numeric',
		],
		[
			'waktu_kejadian.required' => 'Harap untuk mengisi data waktu kejadian',
			'master_onboard.required' => 'Harap untuk mengisi nama master onboard',
			'master_onboard.string' => 'Harap untuk mengisi nama master onboard berupa huruf',
			'phone_onboard.required' => 'Harap untuk mengisi nomor master onboard',
			'phone_onboard.numeric' => 'Harap untuk mengisi nomor master onboard berupa angka',
			'second_officer.required' => 'Harap untuk mengisi nama second officer',
			'second_officer.string' => 'Harap untuk mengisi nama second officer berupa huruf',
			'phone_second_officer.required' => 'Harap untuk mengisi nomor second officer',
			'phone_second_officer.numeric' => 'Harap untuk mengisi nomor second officer berupa angka',
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
			$request->degree1 = 'null';
			$request->minute1 = 'null';
			$request->second1 = 'null';
			$request->degree2 = 'null';
			$request->minute2 = 'null';
			$request->second2 = 'null';
		}
		
		if($request->input('mmsi') == '')
		{
			return redirect()->back()->with('danger', 'Cek data kapal lagi');
		}
		
		if($request->keterangan_lainnya == '')
		{
			$request->keterangan_lainnya = 'null';
		}
		
		if($request->deskripsi_laporan == '')
		{
			$request->deskripsi_laporan = 'null';
		}
		
		$date = Carbon::now();
		$time = $date->isoFormat('Y-MM-D hh:mm:ss');
		$tanggal = $this->convertdate($request->tanggal, 'todb');
		$waktu_kejadian = str_replace('/', '-', $request->waktu_kejadian);
		
		$url = 'localhost:3000/api/pan/update/'.$id;
		$response = Http::put($url, [
			'no_jurnal' => $request->no_jurnal,
			'jenis_pan' => $request->jenis_pan,
			'waktu_kejadian' => $waktu_kejadian,
			'sumber_informasi' => $request->sumber_informasi,
			'keterangan_lainnya' => $request->keterangan_lainnya,
			'deskripsi_laporan' => $request->deskripsi_laporan,
			'degree1' => $request->degree1,
			'minute1' => $request->minute1,
			'second1' => $request->second1,
			'direction1' => $request->direction1,
			'degree2' => $request->degree2,
			'minute2' => $request->minute2,
			'second2' => $request->second2,
			'direction2' => $request->direction2,
			'master_onboard' => $request->master_onboard,
			'phone_onboard' => $request->phone_onboard,
			'second_officer' => $request->second_officer,
			'phone_second_officer' => $request->phone_second_officer,
			'tanggal' => $tanggal,
			'memerlukan_tindakan' => $request->memerlukan_tindakan,
			'updated_at' => $time,
			'updated_by' => '00',
		]);
		
		$result = $response->json();
		if($result["success"] == False)
		{
			return redirect()->back();
		}
		else
		{
			// refactory lagi
			$url = 'localhost:3000/api/pan/kapal/'.$id;
			$response = Http::get($url, []);
			$mmsidata = $response->json();
			$array = [];
			
			foreach($mmsidata as $dataold)
			{
				$cekbenar = False;
				foreach($request->input('mmsi') as $key => $value)
				{
					if($value == $dataold['mmsi'])
					{
						$cekbenar = True;
						array_push($array, $value);
					}
				}
				if($cekbenar == False)
				{
					$url = 'localhost:3000/api/pan/kapal/destroy/'.$id.'/'.$dataold["id"];
					$response = Http::delete($url, []);
					$result = $response->ok();
				}
			}
			
			foreach($request->input('mmsi') as $key => $value)
			{
				$cekbenar = False;
				foreach($array as $ceksaveddata)
				{
					if($value == $ceksaveddata)
					{
						$cekbenar = True;
					}
				}
				
				if($cekbenar == False)
				{
					$url = 'localhost:3000/api/pan/kapal/store/'.$id;
					$response = Http::post($url, [
						'mmsi' => $value,
						'created_at' => $time,
						'created_by' => '00',
					]);
				}
			}
		}
		
        return redirect()->route('pan.insaf')->with('success', 'data PAN berhasil update');
    }
	
	public function destroy($id)
	{
		$url = 'localhost:3000/api/pan/destroy/'.$id;
		$response = Http::delete($url, []);
		$result = $response->ok();

        ($result == true) ? session()->flash('success', 'Noon Position Berhasil Dihapus.') : session()->flash('error', 'Noon Position Gagal Dihapus.');  
		
		return redirect()->route('pan.insaf');
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
}

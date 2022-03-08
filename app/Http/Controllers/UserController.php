<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserloginRequest;
use App\Http\Requests\UserregistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function logout() 
    {
        session()->forget('token');
        session()->forget('level');
        session()->forget('id');
        session()->forget('username');
        return redirect(route('login.insaf'));
    }
    public function login()
    {
        if(session()->get('token')) {
            return redirect(route('home.insaf'));
        }
        return view('pages.auth.login');
    }

    public function process_login(UserloginRequest $request)
    {
        $response = Http::post('localhost:3000/api/users/insaf/login', [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        $get_data = (object)json_decode($response);

        $decode = json_decode($response->ok());

        if($decode == true) {
            session()->put('token', $get_data->token);
            session()->put('level', $get_data->level);
            session()->put('id', $get_data->id);
            session()->put('username', $get_data->username);

            // print_r($get_data->token);
            // echo "<br>";
            // print_r(session()->get('token'));
            // die;
            
            // $response_1 = Http::post('localhost:3000/api/users/insaf/check_token',[
            //     'token' => session()->get('token')
            // ]);
            // dd($response_1->json());
            return redirect(route('home.insaf'));
        } else {
            session()->flash('error', 'Login gagal. Username atau password salah !');
            return redirect()->back();
        }
    }
    
    public function registration()
    {
        if(session()->get('token')) {
            return redirect(route('home.insaf'));
        }
        return view('pages.auth.registration');
    }

    public function process_registration(UserregistrationRequest $request)
    {
        // dd($request->all());
        $response = Http::post('localhost:3000/api/users/insaf/create', [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            're_password' => $request->input('confirmation_password'),
        ]);
        
        $decode = json_decode($response->ok());
        
        if($decode == true) {
            session()->flash('success', 'Daftar akun berhasil. Silakan cek email anda untuk verifikasi akun !');
            return redirect(route('registration.insaf'));
        } else {
            session()->flash('error', 'Daftar akun gagal !');
            return redirect(route('registration.insaf'));
        }
    }
    
    public function reset_password()
    {
        return view('pages.auth.reset_password');
    }
    
    public function get_users_by_modul_id(Request $request)
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

        $pagination = ceil($total / 10);

        $numbering = 1;

        return view('pages.users.index', compact('users','numbering','pagination', 'total'));
    }

    public function get_users_by_page($i)
    {
         //dd($i);
         $response = Http::post('localhost:3000/api/users/insaf/read',[
            'page' => $i,
            'rows' => 10,
        ]);
        $decode_users = json_decode($response->body());
        $data_total = (array)$decode_users[0];
        $data_list = (array)$decode_users[1][0];
        $total =  $data_total['total'];
        
        $users = $data_list['rows'];

        $pagination = ceil($total / 10);

        if ($i>1) {
            //$numbering = ($i*10);
            $p1 = $i*10;
            $p2 = ($p1-10)+1;
            $numbering = $p2;
        }else
        {
            $numbering = 1;
        }
        return view('pages.users.index', compact('users','numbering','pagination', 'total'));
       
    }

    public function create()
    {
        return view('pages.users.create');
    }
    
    public function store(Request $request)
    {
        // $request->all();
        // dd($request);
        return view('pages.users.index');
    }
   
    public function show()
    {
        $title = 'Tedy Hidayat';
        return view('pages.users.detail', compact('title'));
    }

}
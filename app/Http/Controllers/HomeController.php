<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // $response = Http::get('localhost:3000/api/levels/read');
        // $decode = json_decode($response->body());

        return view('pages.home.index');
        // return view('insaf.layouts.app');
    }
}

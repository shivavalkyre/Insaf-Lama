<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TmasController extends Controller
{
    public function index()
    {
        return view('pages.home.index');
    }
}

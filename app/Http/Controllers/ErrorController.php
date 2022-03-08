<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error_404()
    {
        return view('pages.errors.404');
    }
    public function error_500()
    {
        return view('pages.errors.500');
    }
    public function error_503()
    {
        return view('pages.errors.503');
    }
}

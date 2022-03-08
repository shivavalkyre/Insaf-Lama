<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandlerAccessInsaf
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $request->header('Authorization',"Bearer ".session()->get('token'));
        if(session()->get('token') == null){
            session()->flash('error', '403! Forbidden.');
            return redirect()->to('/');
        } 
        return $next($request);
    }
}

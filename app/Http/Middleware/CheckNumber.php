<?php

namespace App\Http\Middleware;
use Closure;
class Check
{
	public function handle($request,Closure $next)
	{
		if(intval($response->stuid)<=99999999&&intval($response->stuid)>=00000000){
			return view('welcome');
		}else{
			return $response;
		}
	}
}
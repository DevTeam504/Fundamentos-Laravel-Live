<?php


namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request,Closure $next){
        return $next($request)
            ->header('Acess-Control-Allow-Origin',"*")
            ->header('Acces-Control-Allow-Methods','GET,POST,PUT,DELETE');
    }
}

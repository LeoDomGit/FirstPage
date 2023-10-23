<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $idRole = Auth::user()->idRole;
        $id= DB::Table('userroles')
        ->where('name','=','Admin')
        ->value('id');
        if($idRole!=$id){
            return  redirect('/products');
        }
        return $next($request);
    }
}

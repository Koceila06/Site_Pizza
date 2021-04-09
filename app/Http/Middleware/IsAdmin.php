<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        if($request->user()->isAdmin()) {//Gestion avant appel
            return $next($request);//Appel du middleware suivant
        }//Gestion après appel
        abort(403,'Vous etes pas un administrateur');
    }
}

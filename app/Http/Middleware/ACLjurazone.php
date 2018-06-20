<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Groupe;
use Illuminate\Support\Facades\Auth;

class ACLjurazone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        dd(Route::currentRouteName());

        $actionData = $request->route()->getAction();
        list($resource, $action) = explode('.', $actionData["as"]);

        dd($actionData);
        if (Auth::check()) {
            $user = Auth::user();
            $groupe = $user->groupes();
        }
//
        return $next($request);
    }

}

<?php

namespace App\Http\Middleware;

use App\Models\Lists;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckList
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentRoute = Route::current();
        $parameters = $currentRoute->parameters();

        if ($request->user()->id != $parameters['list']['user_id']) {
            return back();
        }

        return $next($request);
    }
}

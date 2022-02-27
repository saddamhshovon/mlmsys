<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MemberAuth
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
        if (!$request->session()->has('MEMBER_LOGIN')) {
            $request->session()->flash('error', 'Please login to continue.');
            return redirect('login');
        }
        return $next($request);
    }
}

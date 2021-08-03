<?php

namespace App\Http\Middleware;

use App\Models\Business;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessProfileMiddleware
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
        if(Auth::user()->uType==1)
        {
            $business=Business::where('user_id',Auth::user()->userId)->first();
            if($business==null)
            {
                return redirect()->route('partner.create');
            }
        }
        return $next($request);
    }
}

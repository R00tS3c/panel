<?php

namespace Laravel\Nova\Http\Middleware;

use Laravel\Nova\Nova;
use Closure;
use Illuminate\Http\Request;

class RestrictIP
{
    public function restrictedEnabled() {
        return config('casino-dog.panel_ip_restrict');
    }
    public function restrictedIp(){
        return config('casino-dog.panel_allowed_ips');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request):mixed  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        if($this->restrictedEnabled()) {
            if (!in_array($request->DogGetIP(), $this->restrictedIp())) {
                abort(401, "You are not allowed to access this area. IP: ".$request->DogGetIP());
                return response()->json(['message' => "You are not allowed to access this site.", 'ip' => $request->DogGetIP()]);
            }
        }

        return $next($request);
    }
}
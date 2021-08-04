<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AuthToken;
use Validator;

class DeviceAuthMiddleware
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
        $r = $request->all();
        $validator = Validator::make($r, [
            'token'         => 'required|min:64',
            'serial_number' => 'required|min:16',
            'value'         => 'required',
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        
        if (AuthToken::where('token', $r['token'])->where('serial_number', $r['serial_number'])->count() < 1) {
            return abort(401);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika pengguna terautentikasi
        if ($request->user()) {
            // Catat aktivitas
            ActivityLog::create([
                'user_id' => $request->user()->id,
                'email' => $request->user()->email,
                'action' => $request->method() . ' ' . $request->path(),
                'ip_address' => $request->ip(),
            ]);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOfficeIp
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil IP client
        $clientIp = $request->ip();


        // Ambil daftar IP kantor dari .env, dipisah koma
        $allowedIps = explode(',', env('OFFICE_IP', '127.0.0.1'));

        // Validasi apakah IP sesuai prefix daftar IP kantor
        $isAllowed = false;

        foreach ($allowedIps as $ip) {
            if (str_starts_with($clientIp, trim($ip))) {
                $isAllowed = true;
                break;
            }
        }

        if (!$isAllowed) {
            return redirect()->back()->with('error', 'Absensi hanya bisa dilakukan di dalam jaringan kantor.');
        }

        return $next($request);
    }

    // Simple CIDR check
    protected function ipInRange($ip, $cidr)
    {
        list($subnet, $mask) = explode('/', $cidr);
        $ip = ip2long($ip);
        $subnet = ip2long($subnet);
        $mask = ~((1 << (32 - (int)$mask)) - 1);

        return ($ip & $mask) === ($subnet & $mask);
    }
}

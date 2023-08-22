<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureIpNotBlackListed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->checkIfBlacklisted($request->ip())) {
            return redirect('/_');
        }
        return $next($request);
    }
    public function checkIfBlacklisted($ip_address)
    {
        try {
            $blacklist = fopen(public_path('blacklist.txt'), 'r');
            $already_blacklisted = false;
            while (!feof($blacklist)) {
                $currentLine = fgets($blacklist);
                Log::info($currentLine);
                if (strpos($currentLine, $ip_address) !== false) {
                    $already_blacklisted = true;
                    break;
                }
            }
            return $already_blacklisted;
        } catch (Exception $e) {
            return false;
        }
    }
}

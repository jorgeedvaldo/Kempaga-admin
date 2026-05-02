<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DeviceVerifyMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        // A restrição que exigia 'Dart' no User-Agent foi removida
        // para permitir requisições do novo app feito em React Native.

        return $next($request);
    }
}

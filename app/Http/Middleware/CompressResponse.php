<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class CompressResponse
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (App::environment('production')) {
            $response->setContent(gzencode($response->getContent(), 9));
            $response->headers->set('Content-Encoding', 'gzip');
            $response->headers->set('Content-Length', strlen($response->getContent()));
        }

        return $response;
    }
}


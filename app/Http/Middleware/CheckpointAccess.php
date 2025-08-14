<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckpointAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(Request): Response  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // On vérifie si la session contient bien la clé 'checkpoint_validated' et qu'elle est true
        if (!session()->has('checkpoint_validated') || session('checkpoint_validated') !== true) {
            // Sinon, on redirige vers la route du formulaire checkpoint
            return redirect()->route('checkpoint.form');
        }

        // Sinon on laisse passer la requête
        return $next($request);
    }
}

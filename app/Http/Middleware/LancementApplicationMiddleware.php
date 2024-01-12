<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LancementApplicationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                // Récupérer tous les libellés présents dans la base de données
                $libellesMasques = DB::table('recouvrements')->pluck('libelle')->toArray();

                // Mettre à jour la session pour refléter l'état de masquage
                Session::put('addedLibelles', $libellesMasques);
        
                return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class usuarioEscolares
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuarioActual = \Auth::user();
        if ($usuarioActual == null || $usuarioActual->tipo != 'escolares') {
            return redirect()->route('sinAcceso')->with('error','Lo sentimos, no tienes acceso a esta sección. Comunícate con la coordinación en caso de necesitar acceso.');
        }
        return $next($request);
    }
}

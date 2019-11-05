<?php

namespace App\Http\Middleware;

use App\Docente;
use Closure;

class usuarioDocente
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
        $estatus_docente = Docente::where('curp_docente',$usuarioActual->curp_user)
                                ->select('estatus')
                                ->get();
                                dd($estatus_docente);
        if ($usuarioActual == null || $usuarioActual->tipo != 'docente') {
            return redirect()->route('sinAcceso')->with('error','Lo sentimos, no tienes acceso a esta sección. Comunícate con la coordinación en caso de necesitar acceso.');
        }
        return $next($request);
    }
}

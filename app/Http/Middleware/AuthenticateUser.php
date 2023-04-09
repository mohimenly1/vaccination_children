<?php

namespace App\Http\Middleware;

use App\Models\AmountVaccination;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->to(url('/auth/login-basic'));
        }

      
            $health_id = Auth::user()->id;

            $vaccination_data = AmountVaccination::select('vaccination_names.vaccination_name', 'amount_vaccination.vaccination_count')
                ->join('vaccination_names', 'amount_vaccination.vaccination_name', '=', 'vaccination_names.id')
                ->where('health_id', $health_id)
                ->get();

             

            view()->share('vaccination_data', $vaccination_data);
     
    
        return $next($request);
    }
    
    
}

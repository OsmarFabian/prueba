<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        $user = $request->user();
        if($user == NULL) {
            return redirect('/login');

        }
        if ( $user != NULL && $user->rol != $role ) {
            // Redirect...
            return redirect('home');
        }

        return $next($request);
    }}

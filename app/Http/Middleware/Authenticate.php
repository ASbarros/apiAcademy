<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\TokenController;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        /* if (! $request->expectsJson()) {
            return route('login');
        } */
        try {
            //code...
            if (strcmp(
                TokenController::getToken(apache_request_headers()['Apiemail']),
                apache_request_headers()['Apitoken']
            ) != 0)
                return ['msg' => 'Usuário não autenticado!', 'color' => 'warning'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['msg' => 'Usuário não autenticado!', 'color' => 'warning'];
        }
    }
}

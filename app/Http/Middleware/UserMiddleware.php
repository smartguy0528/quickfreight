<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class UserMiddleware extends Authenticate
{
    /**
     * Determine if the user is authorized to access the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if ($this->auth->guard('web')->guest() && $this->auth->guard('carrierguard')->guest() && $this->auth->guard('customerguard')->guest()) {
            return route('frontend.home');
        }
    }
}

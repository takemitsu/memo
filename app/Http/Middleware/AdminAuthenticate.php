<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminAuthenticate
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $admin_flg = false;
        if ($this->auth->check()) {
            if($this->auth->user()->is_admin) {
                $admin_flg = true;
            }
        }
        if(!$admin_flg) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return abort(403, 'permission denied');
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\GeneralHelper;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->response = new GeneralHelper;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            $response = $this->response->formatResponseWithPages("Unauthorized", '', $this->response->STAT_UNAUTHORIZED());
            return response()->json($response, $this->response->STAT_UNAUTHORIZED());
        }

        return $next($request);
    }
}

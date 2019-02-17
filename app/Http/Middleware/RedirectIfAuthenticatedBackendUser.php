<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedBackendUser
{
    /**
     * @var AuthManager
     */
    private $authManager;

    /**
     * RedirectIfAuthenticated constructor.
     * @param AuthManager $authManager
     */
    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
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
        if ($this->authManager->guard('dashboard')->check()) {
            return redirect(route('root.index'));
        }

        return $next($request);
    }
}

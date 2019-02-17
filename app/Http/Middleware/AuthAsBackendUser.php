<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthAsBackendUser
{
    /**
     * @var AuthManager
     */
    private $auth;

    /**
     * @param AuthManager $auth
     */
    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param Closure $next
     *
     * @return RedirectResponse|Response
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guard('dashboard')->guest()) {
            return redirect(route('dashboard.login.show'));
        }
        return $next($request);
    }
}

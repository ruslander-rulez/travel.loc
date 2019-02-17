<?php
namespace App\Http\Controllers\Dashboard\Auth;

use App\Application\Auth\Logout;
use App\Application\Auth\SignInAsBackendUser;
use App\Http\Controllers\Dashboard\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorizationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginPage()
    {
        return view('dashboard.auth.login');
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $this->dispatch(new SignInAsBackendUser(
                trim($request->input('email')),
                $request->input('password')
            ));

            return redirect('root');
        } catch (AuthorizationException $e) {
            return redirect(route('dashboard.login.show'))
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'These credentials do not match records.',
                ]);
        } catch (ValidationException $e) {
            return redirect(route('dashboard.login.show'))
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    $e->getMessage()
                ]);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        $this->dispatch(new Logout());

        return redirect(route('dashboard.login.show'));
    }
}
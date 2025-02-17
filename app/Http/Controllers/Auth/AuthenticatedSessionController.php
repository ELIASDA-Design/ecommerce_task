<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function customLogin(Request $request){

        $input = $request->all();
        $validate_result = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validate_result) {
            // check if the given user exists in db
            if(Auth::attempt(['email'=> $input['email'], 'password'=> $input['password']])){
                // check the user role
                if(Auth::user()->type == 0){
                    return redirect()->route('dashboard');
                }
                elseif (Auth::user()->type == 1) {
                    return redirect()->route('adminDashboardShow');
                }
            }
            else{
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

    }
}

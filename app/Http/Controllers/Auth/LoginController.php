<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (Auth()->user()->role == '1') {
            return route('admin.dashboard');
        } elseif (Auth()->user()->role == '0') {
            return route('user.dashboard');
        } elseif (Auth()->user()->role == '2') {
            return route('director.dashboard');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->role == 1) {
                Alert::success('Login Successfully!!');
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->role == 2) {
                Alert::success('Login Successfully!!');
                return redirect()->route('director.dashboard');
            } elseif (auth()->user()->role == 0) {
                Alert::success('Login Successfully!!');
                return redirect()->route('user.dashboard');
            }
        } else {
            Alert::error('Email or password incorrect');
            return redirect()->route('login')->with('error', 'Email or password incorrect');
        }
    }
}

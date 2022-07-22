<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('backends.pages.auth.login');
    }

    public function login(Request $request){

        $request->validate([
            "name"  => 'required|string',
            'password' => 'required',
        ]);

        if(filter_var($request->name, FILTER_VALIDATE_EMAIL)){
            $request['email'] = $request->name;
            $credentials = $request->only('email', 'password');
        }else{
            $request['username'] = $request->name;
            $credentials = $request->only('username', 'password');
        }
        unset($request['name']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route("admin.dashboard"));
        }else{
            return back()->with('error','some thing is wrong');
        }
    }

    public function email(){
        return 'email';
    }
    public function username(){
        return 'username';
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

}

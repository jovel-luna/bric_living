<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('login');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }
 
    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }


    // protected function attemptLogin(Request $request)
    // {
    //     $login = $request->input('login');
    //     $password = $request->input('password');

    //     $user = User::where(function ($query) use ($login) {
    //         $query->where('email', $login)->orWhere('username', $login);
    //     })->first();

    //     if ($user && Hash::check($password, $user->password)) {
    //         $this->guard()->login($user, $request->filled('remember'));
    //         return true;
    //     }

    //     return false;
    // }

    public function apiLogin(Request $request)
    {
        $this->validateLogin($request);

        // if ($this->attemptLogin($request)) {
        if (Auth::attempt([$this->username() => $request->login, 'password' => $request->password, 'deleted_at' => null])) {
            $user = $this->guard()->user();
            $user->generateToken();
            return response()->json([
                'data' => $user->toArray(),
            ]);
        }
        return $this->sendFailedLoginResponse($request);
    }
    public function apiLogout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['data' => 'User logged out.'], 200);
    }
}

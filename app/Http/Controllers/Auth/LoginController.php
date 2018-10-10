<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {

        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        $this->loginOrCreate($user);
        return redirect()->home();
    }

    public function loginOrCreate($gitUser)
    {
        $user = User::where('email', $gitUser->getEmail())->first();

        if(! $user){
            $user = User::create([
                'email' => $gitUser->getEmail(),
                'name' => $gitUser->getName(),
                'git_id' => $gitUser->getId(),
            ]);
        }
        auth()->login($user);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->home();
    }
}

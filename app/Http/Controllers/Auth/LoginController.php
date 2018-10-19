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
    protected $redirectTo = '/';
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGitHub()
    {

        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGitHubCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        $this->loginOrCreate($user);

        flash()->success('Welcome','You are now loged in');
        return redirect()->back();
    }

    public function redirectToFacebook()
    {

        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $this->loginOrCreate($user);

        flash()->success('Welcome','You are now loged in');
        return redirect()->back();
    }
    

    public function loginOrCreate($providedUser)
    {
        $user = User::where('email', $providedUser->getEmail())->first();


        if(! $user){
            $user = User::create([
                'email' => $providedUser->getEmail(),
                'name' => $providedUser->getName(),
                'provided_id' => $providedUser->getId(),
            ]);
        }

        flash()->success('Loged In', 'You are now loged in!');
        auth()->login($user);
    }

    public function logout()
    {
        auth()->logout();

        flash('Loged out', 'Bye!!!');

        return redirect()->home();
    }
}

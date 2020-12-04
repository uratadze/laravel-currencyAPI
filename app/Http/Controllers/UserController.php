<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\AccessToken;
use App\Models\User;

class UserController extends BaseController
{
    /**
     * Show login form.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function loginForm()
    {
        return view('auth\login');
    }

    /**
     * Login logic.
     * 
     * @param App\Http\Requests\LoginRequest
     * 
     * @return Illuminate\Support\Facades\Response
     */
    public function login(LoginRequest $request)
    {
        return Auth::attempt(['email'=>$request->email,'password'=> $request->password]) ? redirect()->route('dashboard') : redirect()->route('login')->with('error', __("არასწორი ინფორმაცია!"));
    }

    /**
     * Show register form.
     * 
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function registerForm()
    {
        return view('auth\register');
    }

    /**
     * Register and token generate logic.
     * 
     * @param App\Http\Requests\RegisterRequest
     * 
     * @return Illuminate\Support\Facades\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('MyApp')->accessToken;
        $this->saveToken($token, $user->id);
        Auth::attempt(['email'=>$request->email,'password'=> $request->password]);
        return redirect()->route('dashboard')->with('error', __("წარმატებით დარეგისტრირდით!"));
    }

    /**
     * Logout logic.
     * 
     * @return Illuminate\Support\Facades\Response 
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('dashboard');
    }

    /**
     * Show token.
     * 
     * @param App\Models\AccessToken
     * 
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function token(AccessToken $token)
    {
        return view('token')
            ->with('token', $token->getToken());
    }

    /**
     * Save token into App\Models\AccessToken.
     * 
     * @param string  $token
     * @param integer $userId
     */
    public function saveToken($token, $userId)
    {
        AccessToken::create([
            'user_id' => $userId,
            'token'   => $token,
        ]);
    }
}

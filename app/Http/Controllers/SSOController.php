<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class SSOController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('sso')->redirect();
    }

    public function callback(Request $request)
    {
        $ssoUser = Socialite::driver('sso')->user();

        $user = User::updateOrCreate(
            ['email' => $ssoUser->email],
            [
                'name' => $ssoUser->name,
                'password' => bcrypt(str()->random(16))
            ]
        );

        // log info
        logger()->info('User', [
            'user' => $user,
            'ssoUser' => $ssoUser,
        ]);

        $request->session()->regenerate();
        $request->session()->put('user', $user);
        $request->session()->put('token', $ssoUser->token);

        return redirect('/dashboard');
    }
}

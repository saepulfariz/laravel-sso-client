<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    // method login return view login
    public function login(Request $request)
    {
        return view('auth.login');
    }

    function index(Request $request)
    {
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => env('SSO_CLIENT_ID'),
            'redirect_uri' => env('SSO_CLIENT_CALLBACK_PATH'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);

        return redirect(env('SSO_BASE_URL') . '/oauth/authorize?' . $query);
    }

    function callback(Request $request)
    {
        $request->validate([
            'state' => 'required|in:' . $request->session()->pull('state'),
            'code' => 'required',
        ]);

        $response = Http::asForm()->post(env('SSO_BASE_URL') . '/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => env('SSO_CLIENT_ID'),
            'client_secret' => env('SSO_CLIENT_SECRET'),
            'redirect_uri' => env('SSO_CLIENT_CALLBACK_PATH'),
            'code' => $request->code,
        ]);

        $data = $response->json();

        $request->session()->put('access_token', $data['access_token']);
        $request->session()->put('refresh_token', $data['refresh_token']);

        return redirect('/dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    /**
     * Login
     */
    function login(Request $request)
    {
        $validator = validator(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $email = $request->post('email');
        $password = $request->post('password');

        $client = new Client();
        try {
            return $client->post(config('service.passport.login_endpoint'), [
                'form_params' => [
                    'client_id' => config('service.passport.client_id'),
                    'client_secret' => config('service.passport.client_secret'),
                    'grant_type' => 'password',
                    'username' => $email,
                    'password' => $password,
                    'scope' => '',
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Email or password wrong',
                'error' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Refresh token
     */
    function refreshToken(Request $request) {
        $validator = validator(
            $request->all(),
            [
                'refresh_token' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $client = new Client();
        try {
            return $client->post(config('service.passport.login_endpoint'), [
                'form_params' => [
                    'client_id' => config('service.passport.client_id'),
                    'client_secret' => config('service.passport.client_secret'),
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $request->post('refresh_token'),
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Refresh token fail',
            ]);
        }
    }

    /**
     * Logout
     */
    function logout() {
        if (!auth()->check()) {
            return response()->json(['status' => true, 'message' => 'Logout success']);
        }
        try {
            auth()->user()->token()->revoke();
            return response()->json(['status' => true, 'message' => 'Logout success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Logout fail']);
        }
    }
}

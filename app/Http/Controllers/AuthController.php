<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password)
		]);

		$accessToken = $user->createToken('authToken')->accessToken;

		return response()->json(['user' => $user, 'access_token'=> $accessToken], 201);
	} 

	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|string|email',
			'password' => 'required|string'
		]);

		$credentials = request(['email', 'password']);

		if(!Auth::attempt($credentials)){
			return response()->json(['message' => 'Unauthorized'], 401);
		}

		$user = Auth::user();
		$accessToken = $user->createToken('authToken')->accessToken;

		return response()->json(['user' => $user, 'access_token'=> $accessToken], 200);
	}

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout () {

    	$token = Auth::user()->token();
    	$token->revoke();

    	$response = array('msg' =>'You have been succesfully logged out!');
    	return response()->json($response, 200);
    }
}

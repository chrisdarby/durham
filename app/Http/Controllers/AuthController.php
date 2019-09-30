<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller {

	public function login() {

		if (Auth::attempt(
			[
				'email' => request('email'),
				'password' => request('password')
			]
		)) {
			$user = Auth::user();
			$success['token'] = $user->createToken('app')->accessToken;
			return response()->json(
				['success' => $success], 200
			);
		} else {
			return response()->json(
				['error' => 'Unauthorised'], 401);
		}
		
	}
}
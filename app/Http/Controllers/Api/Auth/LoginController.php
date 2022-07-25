<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends ApiController
{
    public function store(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = $this->getUser();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] =  $user;
            $success['roles'] = $user->getRoleNames();
            $success['permissions'] = $user->getDirectPermissions();
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
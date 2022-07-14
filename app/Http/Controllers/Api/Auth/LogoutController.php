<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class LogoutController extends ApiController
{
    public function delete(Request $request)
    {
        $condition = empty($request->condition) ? 'current' : $request->condition;
        $user = $this->getUser();

        if ($condition === 'all') {
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });
            return $this->sendResponse('Logout: all', 'User logout successfully.');
        }

        if ($condition === 'others') {
            $tokens = $user->tokens;
            $tokenKey = $user->token()->getKey();
            foreach ($tokens as $token) {
                $tokenKey !== $token->getKey() && $token->delete();
            }
            return $this->sendResponse('Logout: others', 'User logout successfully.');
        }

        $user->token()->delete();
        return $this->sendResponse('Logout: current', 'User logout successfully.');
    }
}
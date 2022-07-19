<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PasswordReset;

class ResetPasswordController extends ApiController
{
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|different:old_password',
            'c_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = $this->getUser();

        if (!Hash::check($request->old_password, $user->password)) {
            return $this->sendError('Error: incorrect password.');
        }

        PasswordReset::create([
            'email' => $user->email,
            'old_password' => Hash::make($request->old_password),
            'token' => Str::random(64),
            'status' => 'CHANGED'
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        $success['user'] = $user->username;
        $success['email'] = $user->email;
        return $this->sendResponse($success, 'password reset successfully.');
    }
}
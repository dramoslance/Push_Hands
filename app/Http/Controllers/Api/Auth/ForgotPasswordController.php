<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Models\User;
use App\Mail\SendMail;

class ForgotPasswordController extends ApiController
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = User::where('email', $request->email)->first();

        $email = $user->email;
        $token = Str::random(64);
        $link = URL::full() . '/' . $token;

        PasswordReset::create([
            'email' => $user->email,
            'old_password' => $user->password,
            'token' => $token
        ]);

        $mail_data = [
            'title' => 'Forget user password',
            'subject' => 'Reset Password',
            'body' => 'This is for testing email using smtp.',
            'view' => 'templateMail',
            'link' => $link
        ];

        Mail::to($email)->send(new SendMail($mail_data));

        $success['Issue'] = 'Forget user password';
        $success['To'] = $email;
        // $success['link'] = $link;

        return $this->sendResponse($success, 'email sent successfully.');
    }

    public function update(Request $request, string $token)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required',
            'c_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $password_reset = PasswordReset::where('token', $token)->first();
        if (empty($password_reset)) {
            return $this->sendError('Alert: token does not exist.');
        }

        if ($password_reset->status === 'CHANGED') {
            return $this->sendError('Alert: this token is already used to change the password.');
        }

        $user = User::where('email', $password_reset->email)->first();

        if (Hash::check($request->new_password, $user->password)) {
            return $this->sendError('Error: this password is current .');
        }

        $password_reset->status = 'CHANGED';
        $password_reset->save();

        $user->password = Hash::make($request->new_password);
        $user->save();

        $success['user'] = $user->username;
        $success['email'] = $user->email;
        return $this->sendResponse($success, 'password reset successfully.');
    }
}
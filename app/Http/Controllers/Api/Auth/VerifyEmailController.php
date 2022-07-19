<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\CheckMail;
use App\Models\User;
use App\Mail\SendMail;

class VerifyEmailController extends ApiController
{
    public function send()
    {
        $user = $this->getUser();

        $email = $user->email;
        $token = Str::random(64);
        $link = URL::full() . '/' . $token;

        if (!empty($user->email_verified_at)) {
            return $this->sendError('Alert: verified mail.');
        }

        CheckMail::create([
            'email' => $user->email,
            'token' => $token
        ]);

        $mail_data = [
            'title' => 'Verify user email',
            'subject' => 'Mail Verify',
            'body' => 'This is for testing email using smtp.',
            'view' => 'templateMail',
            'link' => $link
        ];

        Mail::to($email)->send(new SendMail($mail_data));

        $success['Issue'] = 'Verify user email';
        $success['To'] = $email;
        // $success['link'] = $link;

        return $this->sendResponse($success, 'email sent successfully.');
    }

    public function verify(string $token)
    {
        $verifyEmail = CheckMail::where('token', $token)->first();
        if (empty($verifyEmail)) {
            return $this->sendError('Alert: token does not exist.');
        }

        $user = User::where('email', $verifyEmail->email)->first();

        if (!empty($user->email_verified_at) && $verifyEmail->status === 'VERIFIED') {
            return $this->sendError('Alert: this user is already verified.');
        }

        $verifyEmail->status = 'VERIFIED';
        $verifyEmail->save();

        $user->email_verified_at = Carbon::now();
        $user->save();

        $success['email_verified_at'] = $user->email_verified_at;
        $success['email'] = $user->email;

        return $this->sendResponse($success, 'User email successfully verified.');
    }
}
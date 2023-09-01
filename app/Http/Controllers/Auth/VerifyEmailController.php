<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VerifyEmailController extends Controller
{
    public function sendEmailVerification(Request $request){
        $request->validate([
            'email'=>'required|email',
        ]);
        $email = $request->email;

        // Check if Email Exist in DB
        $user = User::where('email', $email)->first();
        if(!$user){
            return response([
                'message'=>'Email doesnt exists',
                'status'=>'failed'
            ], 404);
        }

        // Create Token
        $token = Str::random(60);

        // Create a User ID and Token
        UserVerify::create([
        'user_id' => $user->id, 
        'token' => $token,
        'created_at'=>Carbon::now()
    ]);

        // Sending EMail with Password Reset View
        Mail::send('verify', ['token'=>$token], function(Message $message)use($email){
            $message->subject('Verify your Email');
            $message->to($email);
        });
        return response([
            'message'=>'Email Verification Sent... Check Your Email',
            'status'=>'success'
        ], 200);
    }

    
    public function verifyAccount(Request $request, $token)
    {
        //  // Delete Token older than 5 minute
        $formatted = Carbon::now()->subMinutes(5)->toDateTimeString();
        UserVerify::where('created_at', '<=', $formatted)->delete();

        $verifyUser = UserVerify::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $user->email_verified_at = now();
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

    return response(['message' => $message], 200);
    }
}